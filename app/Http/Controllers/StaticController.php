<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Slide;
use Session;
use Config;

class StaticController extends Controller
{
    private $data;
    
    public function index()
    {
        return view('landing', ['slides' => Slide::where('active',1)->get()]);
    }

    public function home()
    {
        return $this->showView('home');
    }

    public function feedback(Request $request)
    {
        $this->validate($request, [
            'feedback_name' => 'required|min:5|max:50',
            'feedback_email' => 'required|email',
            'feedback' => 'required|min:5|max:500',
        ]);
        $this->sendMessage($request, trans('content.thanks_for_your_message'));
    }

//    public function changeLang(Request $request)
//    {
//        $this->validate($request, ['lang' => 'required|in:en,ru']);
//        setcookie('lang', $request->input('lang'), time()+(60*60*24*365));
//        return redirect()->back();
//    }

    private function sendMessage(Request $request, $sessionMessage, $pathToFile=null)
    {
        $creds = [
            'name' => $request->input('feedback_name'),
            'email' => $request->input('feedback_email'),
            'phone' => $request->has('feedback_phone') ? $request->input('feedback_phone') : '',
            'content' => $request->input('feedback')
        ];

        Mail::send('auth.emails.sendmessage', ['creds' => $creds], function($message) use ($request, $pathToFile) {
            $message->subject(trans('content.message_from').$request->server->get('SERVER_NAME'));
            $message->from(Config::get('app.mail_to'), Config::get('app.title'));
            $message->to(Config::get('app.mail_to'));
            if ($pathToFile) $message->attach($pathToFile);
        });
    }

    private function showView($view)
    {
        if (!isset($this->data['slider'])) {
            for ($i=1;$i<=5;$i++) {
                $this->data['slider'][] = 'slide'.$i.'.jpg';
            }
        }

        return view($view, [
            'mainMenu' => [
                ['href' => '#', 'name' => trans('menu.about')],
                ['href' => '#', 'name' => trans('menu.faq')],
                ['href' => 'news', 'name' => trans('menu.news')],
                ['href' => '#', 'name' => trans('menu.contacts')]
            ],

//            'homeBlocks' => [
//                ['head' => trans('content.home_block1'), 'text' => trans('content.home_block1_subscribe'), 'image' => '/images/home_images/cloud.jpg', 'href' => '/cloud-mining'],
//                ['head' => trans('content.home_block2'), 'text' => trans('content.home_block2_subscribe'), 'image' => '/images/home_images/exchange.jpg', 'href' => '/exchange'],
//                ['head' => trans('content.home_block3'), 'text' => trans('content.home_block3_subscribe'), 'image' => '/images/home_images/hardware.jpg', 'href' => '/mining-hardware'],
//            ],

            'data' => $this->data
        ]);
    }
}
