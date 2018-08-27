<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use App\Slide;
use App\Chapter;
use App\SubChapter;
use App\Device;
use App\NewsHeading;
use App\News;
use App\MassMedia;
use App\Truth;
use Session;
use Config;

class StaticController extends Controller
{
    private $data;
    
    public function chapter($slug=null, $subSlug=null, $subSubSlug=null)
    {
        if (!$slug) return view('landing', ['slides' => Slide::where('active',1)->get()]);
        else {
            $this->data['chapter'] = Chapter::findBySlug($slug);
            if (!$this->data['chapter']) abort(404,'Page not found');
            else if ($this->data['chapter']->id == 1) {
                $this->data['devices'] = Device::where('active',1)->get();
                $this->data['slider'] = [];
                foreach (glob(base_path('/public/images/slider/*')) as $file) {
                    $this->data['slider'][] = pathinfo($file)['basename'];
                }
            } elseif ($this->data['chapter']->id == 2) {
                $hrefs = [];
                foreach ($this->data['chapter']->files as $file) {
                    $hrefs[] = ['head' => $file['head_'.App::getLocale()], 'link' => $file->path, 'is_video' => false, 'time' => $file->created_at->timestamp];
                }

                foreach ($this->data['chapter']->videos as $video) {
                    $hrefs[] = ['head' => $video['head_'.App::getLocale()], 'link' => $video->url, 'is_video' => true, 'time' => $file->created_at->timestamp];
                }
                $collection = collect($hrefs);
                $this->data['hrefs'] = count($collection) ? $collection->sortByDesc('time') : [];
            } elseif ($this->data['chapter']->id == 3 && $subSlug) {
                $this->data['device'] = Device::findBySlug($subSlug);
            } elseif ($this->data['chapter']->id == 6) {
                $this->data['news_headings'] = NewsHeading::all();
                $this->data['heading_id'] = 1;
                $this->data['news_heading'] = $this->data['news_headings'][0]['head_'.App::getLocale()];
                if ($subSlug) {
                    foreach ($this->data['news_headings'] as $heading) {
                        if ($heading->slug == $subSlug) {
                            $this->data['heading_id'] = $heading->id;
                            $this->data['news_heading'] = $heading['head_'.App::getLocale()];
                            break;
                        }
                    }
                }

                if ($subSubSlug) $this->data['current_news'] = News::findBySlug($subSubSlug);
                else $this->data['news'] = News::where('news_heading_id',$this->data['heading_id'])->where('active',1)->orderBy('time','desc')->paginate(10);
            }

            if (count($this->data['chapter']->subChapters)) {
                $this->data['sub_chapter'] = $subSlug ? SubChapter::findBySlug($subSlug) : $this->data['chapter']->subChapters[0];

                if (count($this->data['sub_chapter']->massMedia)) {
                    $this->data['years'] = MassMedia::distinct()->orderBy('id','desc')->pluck('year');
                    $this->data['mass_media'] = [];
                    if (count($this->data['years'])) {
                        for ($i=0;$i<count($this->data['years']);$i++) {
                            $this->data['current_year'] = $subSubSlug ? $subSubSlug : $this->data['years'][$i];
                            $this->data['mass_media'] = MassMedia::where('year',$this->data['current_year'])->orderBy('id','desc')->paginate(12);
                            if (count($this->data['mass_media'])) break;
                        }
                    }
                }

            }
            return $this->showView($slug);
        }
    }

    public function truth()
    {
        $this->data['all_truth'] = Truth::orderBy('time','desc')->get();
//        $this->data['last_truth'] = Truth::orderBy('time','desc')->limit(4)->get();
        return $this->showView('all-truth');
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

        return view($view, [
            'mainMenu' => $mainMenu,
            'data' => $this->data
        ]);
    }
}
