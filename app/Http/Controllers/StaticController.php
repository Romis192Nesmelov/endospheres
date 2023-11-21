<?php

namespace App\Http\Controllers;

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
use App\Article;
use App\Truth;
use Illuminate\Support\Facades\Config;

class StaticController extends Controller
{
    use HelperTrait;

    protected $data;
    
    public function chapter($slug=null, $subSlug=null, $subSubSlug=null)
    {
        if (!$slug) return view('landing', ['slides' => Slide::where('active',1)->get(), 'metas' => $this->metas]);
        else {
            if (!$this->data['chapter'] = Chapter::findBySlug($slug)) abort(404,'Page not found');

            if ($this->data['chapter']->id == 1) {
                $this->data['devices'] = Device::where('active',1)->get();
                $this->data['slider'] = [];
                foreach (glob(base_path('/public/images/slider/*')) as $file) {
                    $this->data['slider'][] = pathinfo($file)['basename'];
                }
            } elseif ($this->data['chapter']->id == 2) {
                $hrefs = [];
                foreach ($this->data['chapter']->files as $file) {
                    $hrefs[] = ['head' => $file['head_'.App::getLocale()], 'link' => $file->path, 'type' => $file->type, 'time' => $file->created_at->timestamp];
                }

                foreach ($this->data['chapter']->videos as $video) {
                    $hrefs[] = ['head' => $video['head_'.App::getLocale()], 'link' => $video->url, 'type' => 'video', 'time' => $file->created_at->timestamp];
                }
                $collection = collect($hrefs);
                $this->data['hrefs'] = count($collection) ? $collection->sortByDesc('time') : [];
            } elseif ($this->data['chapter']->id == 3) {
                $this->data['device'] = $subSlug ? Device::findBySlug($subSlug) : Device::find(1);
            } elseif ($this->data['chapter']->id == 6) {
                $this->data['headings'] = NewsHeading::all();
                $this->data['heading'] = $subSlug ? NewsHeading::findBySlug($subSlug) : $this->data['headings'][0];
//
//                // If choose magic
//                if ($this->data['heading']->id == 4) {
//                    if ($subSubSlug) $this->data['current_magic'] = Magic::findBySlug($subSubSlug);
//                    else $this->data['magic'] = Magic::where('active',1)->orderBy('id','desc')->paginate(10);
//                } else {
                    if ($subSubSlug) $this->data['current_news'] = News::findBySlug($subSubSlug);
                    else $this->data['news'] = News::where('news_heading_id',$this->data['heading']->id)->where('active',1)->orderBy('time','desc')->paginate(10);
//                }
            }

            if (count($this->data['chapter']->subChapters)) {
                $this->data['sub_chapter'] = $subSlug ? SubChapter::findBySlug($subSlug) : $this->data['chapter']->subChapters[0];

                if (count($this->data['sub_chapter']->massMedia)) {
                    $this->data['years'] = MassMedia::distinct()->orderBy('year','desc')->pluck('year');
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
//            var_dump($this->data['chapter']->id);
//            die;
            return $this->showView($slug);
        }
    }

    public function truth()
    {
        $this->data['all_truth'] = Truth::orderBy('time','desc')->get();
//        $this->data['last_truth'] = Truth::orderBy('time','desc')->limit(4)->get();
        return $this->showView('all-truth');
    }

    public function articles($slug)
    {
        $this->data['article'] = Article::findBySlug($slug);
        if (!$this->data['article']) abort(404,'Page not found');
        return $this->showView('article');
    }
    
    public function policy()
    {
        return $this->showView('policy');
    }

    public function feedback(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5|max:50',
            'email' => 'required|email',
            'phone' => 'string|regex:/^((\+)?(7|8)(\d)+)$/',
            'city' => 'required|min:2|max:500',
            'type' => 'required',
            'message' => 'required|min:2|max:500',
            'i_agree' => 'required|accepted'
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
            'city' => $request->input('city'),
            'type' => $request->input('type'),
            'content' => $request->input('message')
        ];

        Mail::send('auth.emails.sendmessage', ['creds' => $creds], function($message) use ($request, $pathToFile) {
            $message->subject(trans('content.message_from').$request->server->get('SERVER_NAME'));
            $message->from(Config::get('app.mail_to'), Config::get('app.title'));
            $message->to(Config::get('app.mail_to'));
            if ($pathToFile) $message->attach($pathToFile);
        });
    }

    protected function showView($view)
    {
        $chapters = Chapter::where('active',1)->get();
        $mainMenu = [];
        foreach ($chapters as $chapter) {
            $mainMenu[] = ['href' => $chapter->slug, 'name' => $chapter['head_'.App::getLocale()]];
        }

        return view($view, [
            'mainMenu' => $mainMenu,
            'metas' => $this->metas,
            'data' => $this->data,
            'articles' => Article::where('active',1)->get()
        ]);
    }
}
