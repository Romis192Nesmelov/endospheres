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
    public function index()
    {
        return view('landing', ['slides' => Slide::where('active',1)->get()]);
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
            $message->from(Config::get('app.mail_to'), 'Tessart');
            $message->to(Config::get('app.mail_to'));
            if ($pathToFile) $message->attach($pathToFile);
        });
    }

}
