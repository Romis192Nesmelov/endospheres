<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use App\Slide;
use App\Chapter;
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
        $this->data['slider'] = ['slide1.jpg','slide2.jpg','slide3.jpg','slide4.jpg'];
        $this->data['chapter'] = Chapter::find(1);
        return $this->showView('home');
    }

    public function feedback(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5|max:50',
            'email' => 'required|email',
            'message' => 'required|min:5|max:500',
            'phone' => 'string|regex:/^((\+)?(\d)(\s)?(\()?9[0-9]{2}(\))?(\s)?([0-9]{3})(\-)?([0-9]{2})(\-)?([0-9]{2}))$/'
        ]);
        $this->sendMessage($request);
        return response()->json(['success' => true]);
    }

//    public function changeLang(Request $request)
//    {
//        $this->validate($request, ['lang' => 'required|in:en,ru']);
//        setcookie('lang', $request->input('lang'), time()+(60*60*24*365));
//        return redirect()->back();
//    }

    private function sendMessage(Request $request, $pathToFile=null)
    {
        $creds = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->has('phone') ? $request->input('phone') : '',
            'content' => $request->input('message')
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
        $chapters = Chapter::where('active',1)->get();
        $mainMenu = [];
        foreach ($chapters as $chapter) {
            $mainMenu[] = ['href' => $chapter->slug, 'name' => $chapter['head_'.App::getLocale()]];
        }
        $mainMenu[] = ['href' => 'contacts', 'name' => trans('menu.contacts')];

        return view($view, [
            'mainMenu' => $mainMenu,
            'data' => $this->data
        ]);
    }
}
