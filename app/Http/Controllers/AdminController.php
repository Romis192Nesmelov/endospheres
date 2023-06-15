<?php

namespace App\Http\Controllers;

use App\Device;
use App\SubChapter;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Slide;
use App\Chapter;
use App\Video;
use App\File;
use App\Question;
use App\NewsHeading;
use App\News;
use App\Magic;
use App\Review;
use App\PhotoResult;
use App\MassMedia;
use App\Resource;
use App\Truth;
use App\Sheet;
use App\Article;
use Config;
use Session;
use Settings;

class AdminController extends Controller
{
    use HelperTrait;

    private $breadcrumbs = [];
    private $data = [];
    private $tagsValidator = [
        'title' => 'max:255',
        'meta_description' => 'max:4000',
        'meta_keywords' => 'max:4000',
        'meta_twitter_card' => 'max:255',
        'meta_twitter_size' => 'max:255',
        'meta_twitter_creator' => 'max:255',
        'meta_og_url' => 'max:255',
        'meta_og_type' => 'max:255',
        'meta_og_title' => 'max:255',
        'meta_og_description' => 'max:4000',
        'meta_og_image' => 'max:255',
        'meta_robots' => 'max:255',
        'meta_googlebot' => 'max:255',
        'meta_google_site_verification' => 'max:255',
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex(Request $request)
    {
        return redirect('/admin/landing');
    }

    public function getLanding(Request $request, $slug=null)
    {
        $this->breadcrumbs = ['landing' => trans('admin_menu.landing')];
        if ($request->has('id')) {
            $this->breadcrumbs['landing/add'] = trans('admin_content.slide',['number' => $request->input('id')]);
            $this->data['slide'] = Slide::find($request->input('id'));
            return $this->showView('slide');
        } elseif ($slug && $slug == 'add') {
            $this->breadcrumbs['landing/add'] = trans('admin_content.add_slide');
            return $this->showView('slide');
        } else {
            $this->data['metas'] = $this->metas;
            $this->data['slides'] = Slide::all();
            return $this->showView('landing');
        }
    }

    public function getSlider()
    {
        $this->breadcrumbs = ['slider' => trans('admin_menu.slider')];
        $this->slider();
        return $this->showView('slider');
    }

    public function getChapters($slug=null, $subSlug=null, $subSubSlug=null)
    {
        $this->breadcrumbs = ['chapters' => trans('admin_menu.chapters')];
        if ($slug) {
            $this->data['chapter'] = Chapter::findBySlug($slug);
            if (!$this->data['chapter']) abort(404,'Page not found');
            $this->breadcrumbs['chapters/'.$this->data['chapter']->slug] = $this->data['chapter']['head_'.App::getLocale()];
            Session::put('chapter',$slug);

            if ($this->data['chapter']->id == 3 && $subSlug) {
                $this->data['metas'] = $this->metas;
                if ($subSlug != 'add') {
                    $this->data['device'] = Device::findBySlug($subSlug);
                    $this->breadcrumbs[$this->data['device']->slug] = $this->data['device']->name;
                } else {
                    $this->breadcrumbs['add'] = trans('admin_content.add_device');
                }
                return $this->showView('device');
            } else if ($this->data['chapter']->id == 6) {
                $this->data['news_heading'] = NewsHeading::all();
                return $this->showView('chapter');
            } else {
                if ($this->data['chapter']->id != 3 && $this->data['chapter']->id != 5 && $this->data['chapter']->id != 8) $this->data['metas'] = $this->metas;
                return $this->showView('chapter');
            }
        } else {
            $this->data['chapters'] = Chapter::all();
            return $this->showView('chapters');
        }
    }

    public function getSubChapter($slug)
    {
        $this->breadcrumbs = ['chapters' => trans('admin_menu.chapters')];
        $this->data['metas'] = $this->metas;
        $this->data['sub_chapter'] = SubChapter::findBySlug($slug);
        if (!$this->data['sub_chapter']) abort(404,'Page not found');
        $this->breadcrumbs['chapters/'.$this->data['sub_chapter']->chapter->slug] = $this->data['sub_chapter']->chapter['head_'.App::getLocale()];
        $this->breadcrumbs['sub-chapter/'.$this->data['sub_chapter']->slug] = $this->data['sub_chapter']['head_'.App::getLocale()];
        if (count($this->data['sub_chapter']->massMedia)) $this->data['mass_media'] = MassMedia::orderBy('year','desc')->orderBy('id','desc')->paginate(10);
        Session::put('sub_chapter',$this->data['sub_chapter']->id);
        return $this->showView('sub-chapter');
    }
    
    public function getNews(Request $request, $slug=null, $subSlug=null)
    {
        $chapter = Chapter::find(6);
        $this->breadcrumbs = ['chapters' => trans('admin_menu.chapters'), 'chapters/news' => $chapter['head_'.App::getLocale()]];
        $this->data['metas'] = $this->metas;
        $this->data['news_heading'] = NewsHeading::all();
        if ($request->has('id') && !$slug) {
            $this->validate($request, ['id' => 'required|integer|exists:news']);
            $this->data['news'] = News::find($request->input('id'));
            $this->breadcrumbs['news/?id='.$this->data['news']->id] = $this->data['news']['head_'.App::getLocale()];
            return $this->showView('news');
        } else if ($slug == 'add-news') {
            $this->breadcrumbs['news/add-news'] = trans('admin_content.add_news');
            return $this->showView('news');
        } else if ($slug == 'news-heading-add') {
            $this->breadcrumbs['news/news-heading-add'] = trans('admin_content.add_heading_news');
            return $this->showView('news_heading');
        } else {
            $this->data['heading'] = NewsHeading::findBySlug($slug);
            $this->breadcrumbs['news/'.$this->data['heading']->slug] = $this->data['heading']['head_'.App::getLocale()];
//            if ($this->data['heading']->id == 4) {
//
//                if ($request->has('id')) {
//                    $this->data['magic'] = Magic::find($request->input('id'));
//                    $this->breadcrumbs['news/'.$this->data['heading']->slug.'/?id='.$this->data['magic']->id] = $this->data['magic']['head_'.App::getLocale()];
//                    return $this->showView('magic');
//                } else if ($subSlug && $subSlug == 'add') {
//                    $this->breadcrumbs['news/'.$this->data['heading']->slug.'/add'] = trans('admin_content.add_articles');
//                    return $this->showView('magic');
//                } else {
//                    $this->data['slug'] = $this->data['heading']->slug;
//                    $this->data['magic'] = Magic::orderBy('id','desc')->get();
//                }
//            }
            return $this->showView('news_heading');
        }
    }

    public function getFile(Request $request, $slug=null)
    {
        $this->data['type'] = 'file';
        return $this->showFile($request, $slug);
    }
    
    public function getUserFiles()
    {
        $this->breadcrumbs = ['user_files' => trans('admin_menu.user_files')];
        $this->data['files'] = glob(base_path('/public/user_files/*'));
        return $this->showView('user_files');
    }

    public function getQuestion(Request $request, $slug=null)
    {
        $this->breadcrumbs = [
            'chapters' => trans('admin_menu.chapters'),
            'chapters/faq' => trans('admin_content.chapter_questions')
        ];
        if ($slug && $slug == 'add') {
            $this->breadcrumbs['question/add'] = trans('admin_content.add_question');
        } else {
            $this->validate($request, ['id' => 'required|integer|exists:questions']);
            $this->data['question'] = Question::find($request->input('id'));
            $this->breadcrumbs['question/?id='.$this->data['question']->id] = $this->data['question']['question_'.App::getLocale()];
        }
        return $this->showView('question');
    }

    public function getReview(Request $request, $slug=null)
    {
        $this->breadcrumbs = [
            'chapters' => trans('admin_menu.chapters'),
            'chapters/results-on-real-patients' => trans('admin_content.chapter_results'),
            'sub-chapter/reviews' => trans('admin_content.sub_chapters_reviews'),
        ];
        if ($slug && $slug == 'add') {
            $this->breadcrumbs['review/add'] = trans('admin_content.add_review');
        } else {
            $this->validate($request, ['id' => 'required|integer|exists:reviews']);
            $this->data['review'] = Review::find($request->input('id'));
            $this->breadcrumbs['review/?id='.$this->data['review']->id] = $this->data['review']['name_'.App::getLocale()];
        }
        return $this->showView('review');
    }

    public function getPhotoResult(Request $request, $slug=null)
    {
        $this->breadcrumbs = [
            'chapters' => trans('admin_menu.chapters'),
            'chapters/results-on-real-patients' => trans('admin_content.chapter_results'),
            'sub-chapter/photo-before-and-after' => trans('admin_content.sub_chapters_photo_results'),
        ];
        if ($slug && $slug == 'add') {
            $this->breadcrumbs['photo-result/add'] = trans('admin_content.add_photo_result');
        } else {
            $this->validate($request, ['id' => 'required|integer|exists:photo_results']);
            $this->data['result'] = PhotoResult::find($request->input('id'));
            $this->breadcrumbs['photo-result/?id='.$this->data['result']->id] = $this->data['result']['head_'.App::getLocale()];
        }
        return $this->showView('photo-result');
    }

    public function getMassMedia(Request $request, $slug=null)
    {
        $this->breadcrumbs = [
            'chapters' => trans('admin_menu.chapters'),
            'chapters/mass-media-about-us' => trans('admin_content.chapter_mass_media')
        ];
        $this->getYears();
        if ($slug && $slug == 'add') {
            $this->breadcrumbs['mass-media/add'] = trans('admin_content.add_mass_media');
        } else {
            $this->validate($request, ['id' => 'required|integer|exists:mass_media']);
            $this->data['media'] = MassMedia::find($request->input('id'));
            $this->breadcrumbs['mass-media/?id='.$this->data['media']->id] = $this->data['media']['description_'.App::getLocale()];
        }
        return $this->showView('mass-media');
    }

    public function getResource(Request $request, $slug=null)
    {
        $this->breadcrumbs = [
            'chapters' => trans('admin_menu.chapters'),
            'sub-chapter/internet' => trans('admin_content.chapter_internet')
        ];
        if ($slug && $slug == 'add') {
            $this->breadcrumbs['resource/add'] = trans('admin_content.add_resource');
        } else {
            $this->validate($request, ['id' => 'required|integer|exists:resources']);
            $this->data['resource'] = Resource::find($request->input('id'));
            $this->breadcrumbs['resource/?id='.$this->data['resource']->id] = $this->data['resource']['description_'.App::getLocale()];
        }
        return $this->showView('resource');
    }

    public function getAllTruth(Request $request, $slug=null)
    {
        $this->breadcrumbs = ['all-truth' => trans('admin_menu.all-truth')];
        $this->data['suffix'] = 'all-truth';
        return $this->sheet($request, new Truth(), $slug, 'all-truth');
    }

    public function getArticles(Request $request, $slug=null)
    {
        $this->breadcrumbs = ['articles' => trans('admin_menu.articles')];
        $this->data['suffix'] = 'articles';
        $this->data['metas'] = $this->metas;
        return $this->sheet($request, new Article(), $slug, 'articles');
    }
    
    public function getRecommendation(Request $request, $slug=null)
    {
        $this->breadcrumbs = [
            'chapters' => trans('admin_menu.chapters'),
            'chapters/recommendations' => trans('admin_menu.recommendations')
        ];
        $this->data['suffix'] = 'recommendation';
        return $this->sheet($request, new Sheet(), $slug);
    }
    
    public function getFake(Request $request, $slug=null)
    {
        $this->breadcrumbs = [
            'chapters' => trans('admin_menu.chapters'),
            'chapters/fakes' => trans('admin_menu.fakes')
        ];
        $this->data['suffix'] = 'fakes';
        return $this->sheet($request, new Sheet(), $slug);
    }

    public function postLanding(Request $request, $slug=null)
    {
        $moveFiles = [];   
        if ($request->has('id')) {
            $validateArr = ['description_ru' => 'required|min:10|max:1500'];
            $slide = Slide::find($request->input('id'));
            if ($slide->is_image) {
                $validateArr['head_ru'] = 'required|min:1|max:20';
                $validateArr['image'] = 'image|min:100|max:1000';
            } else {
                $validateArr['video'] = 'mimes:mp4|min:10000|max:10000';
                $validateArr['poster'] = 'image|min:100|max:1000';
            }

            $this->validate($request, $validateArr);
            $fields = $this->processingFields($request, 'active', ['image','video','poster'], ['background_color','mouse_color']);
            $slide->update($fields);
            foreach (['image','video','poster'] as $name) {
                if ($request->hasFile($name)) {
                    $info = pathinfo($name == 'poster' ? $slide->poster : $slide->path);
                    $moveFiles[] = ['file' => $name, 'path' => $info['dirname'], 'name' => $info['basename']];
                }
            }
            
        } elseif ($slug && $slug == 'add') {
            $validateArr = [
                'description_ru' => 'required|min:10|max:1500',
                'image' => 'required|image|min:100|max:1000',
                'head_ru' => 'required|min:1|max:20'
            ];

            $this->validate($request, $validateArr);
            $fields = $this->processingFields($request, 'active', ['image','video','poster'], ['background_color','mouse_color']);
            $fields['is_image'] = 1;
            $slide = Slide::create($fields);
            $moveFiles[] = ['file' => 'image','path' => '/images/landing/','name' => 'slide'.$slide->id.'.'.$request->file('image')->getClientOriginalExtension()];
        } else {
            $this->validate($request, $this->tagsValidator);
            Settings::saveLandingTags($request);
        }

        if (count($moveFiles)) {
            foreach ($moveFiles as $file) {
                $request->file((string)$file['file'])->move(base_path('/public'.(string)$file['path']),$file['name']);
                if (!$request->has('id')) $slide->update(['path' => (string)$file['path'].$file['name']]);
            }
        }
        $this->saveCompleteMessage();
        return redirect('/admin/landing');
    }

    public function postChapter(Request $request)
    {
        $validateArr = [
            'id' => 'required|integer|exists:chapters',
            'head_ru' => 'required|min:1|max:200',
            'content_ru' => 'min:10|max:2000',
            'slide' => 'image|min:10|max:200'
        ];
        $this->validate($request, array_merge($validateArr, $this->tagsValidator));
        
        $chapter = Chapter::find($request->input('id'));
        $fields = $this->processingFields($request, 'active', ['slide','video_head_ru','video_url','video_description_ru']);
        $chapter->update($fields);
        $this->processingFile($request, $chapter);

        if ($request->has('video_url') && count($request->input('video_url'))) {
            $videosHeads = $request->input('video_head_ru');
            $videosUrl = $request->input('video_url');
            $videosDescriptions = $request->input('video_description_ru');

            for($i=0;$i<count($videosUrl);$i++) {
                $video = [
                    'url' => $videosUrl[$i],
                    'head_ru' => $videosHeads[$i],
                    'description_ru' => $videosDescriptions[$i]
                ];

                if ($chapter->videos && $i < count($chapter->videos)) {
                    if (!$video['url']) $chapter->videos[$i]->delete();
                    else $chapter->videos[$i]->update($video);

                } elseif ($video['url']) {
                    $video['chapter_id'] = $chapter->id;
                    Video::create($video);
                }
            }
        }
        $this->saveCompleteMessage();
        return redirect('/admin/chapters');
    }

    public function postSubChapter(Request $request)
    {
        $validateArr = [
            'id' => 'required|integer|exists:sub_chapters',
            'head_ru' => 'required|min:1|max:200',
            'content_ru' => 'min:10|max:2000',
            'slide' => 'image|min:10|max:200'
        ];
        $this->validate($request, array_merge($validateArr, $this->tagsValidator));

        $fields = $this->processingFields($request, null, 'slide');
        $subChapter = SubChapter::find($request->input('id'));
        $subChapter->update($fields);
        $this->processingFile($request, $subChapter);

        $this->saveCompleteMessage();
        return redirect('/admin/chapters/'.$subChapter->chapter->slug);
    }

    public function postDevice(Request $request)
    {
        $validateArr = [
            'menu_logo' => 'required|in:sroface_logo.png,ak_sensorbody_logo.png,ak_sensor_logo.png',
            'name' => 'required|min:3|max:200',
            'head_ru' => 'required|min:1|max:20',
            'description_ru' => 'required|min:5|max:200',
            'content_ru' => 'required|min:10|max:2000'
        ];

        $filesFields = ['home_page_image','image','slide'];
        if ($request->has('id')) {
            $validateArr['id'] = 'required|integer|exists:devices';
            foreach ($filesFields as $field) {
                $validateArr[$field] = 'image|min:10|max:1000';
//                $validateArr['booklet'] = 'pdf|min:10|max:10000';
//                $validateArr['catalogue'] = 'pdf|min:10|max:10000';
            }
        } else {
            $countDevices = Device::count() + 1;
            foreach ($filesFields as $field) {
                $validateArr[$field] = 'required|image|min:10|max:1000';
//                $validateArr['booklet'] = 'required|pdf|min:10|max:10000';
//                $validateArr['catalogue'] = 'required|pdf|min:10|max:10000';
            }
        }
        $filesFields[] = 'booklet';
        $filesFields[] = 'catalogue';

        $this->validate($request, array_merge($validateArr, $this->tagsValidator));
        $fields = $this->processingFields($request, ['is_new','active'], $filesFields);
        $fields['chapter_id'] = 3;

        if ($request->has('id')) {
            $device = Device::find($request->input('id'));
            $device->update($fields);
        } else {
            $fields['slide'] = '';
            $fields['home_page_image'] = '';
            $fields['image'] = '';
            $fields['booklet'] = '';
            $fields['catalogue'] = '';
            $device = Device::create($fields);
        }

        foreach ($filesFields as $field) {
            if ($request->hasFile($field)) {
                $extension = $request->file($field)->getClientOriginalExtension();
                if ($request->has('id')) {
                    $fileInfo = pathinfo($device[$field]);
                    $newFileName = $fileInfo['filename'].'.'.$extension;
                } else $newFileName = null;

                switch ($field) {
                    case 'image':
                        $folder = '/images/devices/';
                        $newFileName = $newFileName ? $newFileName : 'device'.$countDevices.'.'.$extension;
                        break;
                    case 'slide':
                        $folder = '/images/chapters_slides/';
                        $newFileName = $newFileName ? $newFileName : 'device'.$countDevices.'.'.$extension;
                        break;
                    case 'booklet':
                        $folder = '/pdfs/';
                        $newFileName = $request->has('id') ? $folder.$newFileName : $folder.$request->file($field)->getClientOriginalName();
                        break;
                    case 'catalogue':
                        $folder = '/pdfs/';
                        $newFileName = $request->has('id') ? $folder.$newFileName : $folder.$request->file($field)->getClientOriginalName();
                        break;
                    default:
                        $folder = '/images/';
                        $newFileName = $request->has('id') ? $newFileName : $request->file($field)->getClientOriginalName();
                        break;
                }

                $device->update([$field => $newFileName]);
                $this->processingFile($request, $device, $field, $folder);
            }
        }
        $this->saveCompleteMessage();
        return redirect('/admin/chapters/devices/'.$device->slug);
    }

    public function postNewsHeading(Request $request)
    {
        $validateArr = [
            'head_ru' => 'required|min:1|max:100',
            'subscribe_ru' => 'required|min:5|max:1000',
            'slide' => (!$request->has('id') ? 'required|' : '').'mimes:jpeg|min:10|max:200'
        ];
        if ($request->has('id')) $validateArr['id'] = 'required|integer|exists:news_headings';

        $this->validate($request, array_merge($validateArr, $this->tagsValidator));
        $headingCount = NewsHeading::count()+1;
        $fields = $this->processingFields($request, null, 'slide');

        if ($request->has('id')) {
            $heading = NewsHeading::find($request->input('id'));
            $heading->update($fields);
        } else {
            $fields['slide'] = 'news_heading'.$headingCount.'.jpg';
            $heading = NewsHeading::create($fields);
        }

        $this->processingFile($request, $heading);
        $this->saveCompleteMessage();
        return redirect('/admin/news/'.$heading->slug);
    }

    public function postNews(Request $request)
    {
        $validateArr = [
            'news_heading_id' => 'required|integer|exists:news_headings,id',
            'head_ru' => 'required|min:1|max:100',
            'description_ru' => 'required|min:5|max:1000',
            'content_ru' => 'required|min:10|max:20000',
            'slide' => 'mimes:jpeg|min:10|max:2000'
        ];

        if ($request->has('id')) $validateArr['id'] = 'required|integer|exists:news';

        $this->validate($request, array_merge($validateArr, $this->tagsValidator));

        $fields = $this->processingFields($request, 'active', 'slide', null, 'time');
        $fields['chapter_id'] = 6;

        if ($request->has('id')) {
            $news = News::find($request->input('id'));
            $news->update($fields);
        } else {
            $newsCount = News::orderBy('id','desc')->limit(1)->pluck('id');
            $newsCount = $newsCount[0] + 1;
            $fields['slide'] = 'news'.$newsCount.'.jpg';
            $news = News::create($fields);
        }

        $this->processingFile($request, $news);
        $this->saveCompleteMessage();
        return redirect('/admin/news/'.$news->heading->slug);
    }

//    public function postMagic(Request $request)
//    {
//        $validateArr = [
//            'head_ru' => 'required|min:1|max:100',
//            'content_ru' => 'required|min:10|max:20000',
//            'image' => 'mimes:jpeg|min:10|max:2000'
//        ];
//
//        if ($request->has('id')) $validateArr['id'] = 'required|integer|exists:magics';
//
//        $this->validate($request, array_merge($validateArr, $this->tagsValidator));
//
//        $fields = $this->processingFields($request, 'active', 'image');
//        $heading = NewsHeading::find(4);
//
//        if ($request->has('id')) {
//            $magic = Magic::find($request->input('id'));
//            $magic->update($fields);
//        } else {
//            $magicCount = Magic::orderBy('id','desc')->limit(1)->pluck('id');
//            $magicCount = $magicCount[0] + 1;
//            $fields['image'] = 'magic'.$magicCount.'.jpg';
//            $magic = Magic::create($fields);
//        }
//
//        $this->processingFile($request, $magic, 'image', '/images/magics/');
//        $this->saveCompleteMessage();
//        return redirect('/admin/news/'.$heading->slug);
//    }
    
    public function postAddSlide(Request $request)
    {
        $this->validate($request, ['file' => 'mimes:jpeg|min:10|max:1000']);
        $this->slider();
        if (count($this->data['slider'])) {
            $lastSlide = pathinfo($this->data['slider'][count($this->data['slider'])-1])['filename'];
            $lastNumber = (int)str_replace('slide','', $lastSlide);
            $number = $lastNumber + 1;
        } else $number = 1;

        $request->file('file')->move(base_path('/public/images/slider/'),'slide'.$number.'.jpg');
        $this->saveCompleteMessage();
        return redirect()->back();
    }
    
    public function postFile(Request $request)
    {
        $validateArr = [
            'head_ru' => 'min:1|max:200',
            'description_ru' => 'min:10|max:1500'
        ];
        if ($request->has('id')) {
            $file = File::find($request->input('id'));
            $validateArr['path'] = 'mimes:'.$file->type.'|max:3000';
        } else {
            $validateArr['path'] = 'required|min:2|max:3000';
        }

        $this->validate($request, $validateArr);

        if ($request->hasFile('path')) {
            switch ($request->file('path')->getClientMimeType()) {
                case 'application/pdf':
                    $type = 'pdf';
                    $path = '/pdfs/';
                    break;
                default:
                    $type = 'image';
                    $path = '/images/';
                    break;
            }
        }

        if ($request->has('id')) {
            $fields = $this->processingFields($request, null, 'path');
            $file->update($fields);
        } else {
            $chapter = Chapter::findBySlug(Session::get('chapter'));
            $fields['type'] = $type;
            $fields['path'] = $path.$request->file('path')->getClientOriginalName();
            $fields['chapter_id'] = $chapter->id;
            if (File::where('path',$fields['path'])->first()) return redirect()->back()->withErrors(['path' => trans('validation.file_already_exist')]);
            $file = File::create($fields);
        }
        $this->processingFile($request, $file, 'path');

        $this->saveCompleteMessage();
        return redirect('/admin/chapters/'.$file->chapter->slug);
    }

    public function postUserFile(Request $request)
    {
        $this->validate($request, ['file' => 'required|max:10000']);
        $request->file('file')->move(base_path('/public/user_files'),$request->file('file')->getClientOriginalName());
        $this->saveCompleteMessage();
        return redirect('/admin/user-files/');
    }

    public function postQuestion(Request $request)
    {
        $validateArr = [
            'question_ru' => 'min:1|max:700',
            'answer_ru' => 'min:2|max:2000'
        ];
        if ($request->has('id')) $validateArr['id'] = 'required|integer|exists:questions';
        $this->validate($request, $validateArr);
        $fields = $this->processingFields($request);
        $fields['chapter_id'] = 4;
        if ($request->has('id')) {
            $question = Question::find($request->input('id'));
            $question->update($fields);
        } else {
            $question = Question::create($fields);
        }
        $this->saveCompleteMessage();
        return redirect('/admin/chapters/'.$question->chapter->slug);
    }

    public function postReview(Request $request)
    {
        $validateArr = [
            'name_ru' => 'min:1|max:100',
            'review_ru' => 'min:2|max:3000'
        ];
        if ($request->has('id')) $validateArr['id'] = 'required|integer|exists:reviews';
        $this->validate($request, $validateArr);
        $fields = $this->processingFields($request);
        $fields['sub_chapter_id'] = 3;
        if ($request->has('id')) {
            $review = Review::find($request->input('id'));
            $review->update($fields);
        } else {
            Review::create($fields);
        }
        $this->saveCompleteMessage();
        return redirect('/admin/sub-chapter/reviews');
    }

    public function postPhotoResult(Request $request)
    {
        $validateArr = [
            'head_ru' => 'required|min:1|max:100',
            'description_ru' => 'required|min:2|max:10000',
            'path' => (!$request->has('id') ? 'required|' : '').'mimes:jpeg|min:10|max:500'
        ];
        if ($request->has('id')) $validateArr['id'] = 'required|integer|exists:photo_results';
        $this->validate($request, $validateArr);
        $fields = $this->processingFields($request);
        $fields['sub_chapter_id'] = 4;

        if ($request->has('id')) {
            $result = PhotoResult::find($request->input('id'));
            $result->update($fields);
        } else {
            $fields['path'] = '';
            $result = PhotoResult::create($fields);
            $path = '/images/photo_results/result'.$result->id.'.jpg';
            $result->update(['path' => $path]);
        }

        $this->processingFile($request, $result, 'path');
        $this->saveCompleteMessage();
        return redirect('/admin/sub-chapter/photo-before-and-after');
    }

    public function postMassMedia(Request $request)
    {
        $this->getYears();
        $years = '';
        foreach ($this->data['years'] as $k => $year) {
            $years .= ($k ? ',' : '').$year;
        }
        $validateArr = [
            'description_ru' => 'required|min:2|max:100',
            'preview' => (!$request->has('id') ? 'required|' : '').'mimes:jpeg|min:10|max:10000',
            'full' => (!$request->has('id') ? 'required|' : '').'mimes:jpeg,pdf|min:10|max:100000',
            'year' => 'required|in:'.$years
        ];
        if ($request->has('id')) $validateArr['id'] = 'required|integer|exists:mass_media';
        $this->validate($request, $validateArr);
        $filesFields = ['preview','full'];
        $fields = $this->processingFields($request, null, $filesFields);
        $fields['sub_chapter_id'] = 5;

        if ($request->hasFile('full')) {
            $fields['is_pdf'] = $request->file('full')->getClientOriginalExtension() == 'pdf';
        }

        if ($request->has('id')) {
            $media = MassMedia::find($request->input('id'));

            if ($media->year != $request->input('year') && !$request->file('preview')) {
                $fields['preview'] = $this->checkingFileExist('/mm/mm_prev_'.$request->input('year').'_', 'jpg');
                rename(base_path('/public'.$media->preview), base_path('/public'.$fields['preview']));
            } elseif ($request->file('preview')) {
                if (file_exists(base_path('/public'.$media->preview))) unlink(base_path('/public'.$media->preview));
                $fields['preview'] = $media->year != $request->input('year') ? $this->checkingFileExist('/mm/mm_prev_'.$request->input('year').'_', 'jpg') : $media->preview;
            }

            if ($media->year != $request->input('year') && !$request->file('full')) {
                $info = pathinfo($media->full);
                $fields['full'] = $this->checkingFileExist('/mm/mm_'.$request->input('year').'_', $info['extension']);
                rename(base_path('/public'.$media->full), base_path('/public'.$fields['full']));
            } elseif ($request->file('full')) {
                if (file_exists(base_path('/public'.$media->full))) unlink(base_path('/public'.$media->full));
                $fileName = str_replace(['.pdf','.jpg'], '', $media->full).'.'.$request->file('full')->getClientOriginalExtension();
                $fields['full'] = $media->year != $request->input('year') ? str_replace($media->year, $request->input('year'), $fileName) : $fileName;
                $fields['full'] = $this->checkingFileExist('/mm/mm_'.$request->input('year').'_', $request->file('full')->getClientOriginalExtension());
            }

            $media->update($fields);

        } else {
            $fields['preview'] = $this->checkingFileExist('/mm/mm_prev_'.$fields['year'].'_', 'jpg');
            $fields['full'] = $this->checkingFileExist('/mm/mm_'.$fields['year'].'_', $request->file('full')->getClientOriginalExtension());
            $media = MassMedia::create($fields);
        }

        foreach ($filesFields as $field) {
            $this->processingFile($request, $media, $field);
        }

        $this->saveCompleteMessage();
        return redirect('/admin/sub-chapter/print-mass-media');
    }

    public function postResource(Request $request)
    {
        $validateArr = [
            'description_ru' => 'required|min:2|max:100',
            'logo' => 'mimes:jpeg|min:10|max:200',
            'url' => 'required|min:4'
        ];
        if ($request->has('id')) $validateArr['id'] = 'required|integer|exists:resources';
        $this->validate($request, $validateArr);
        $fields = $this->processingFields($request, null, 'logo');

        if ($request->has('id')) {
            $resource = Resource::find($request->input('id'));
            $resource->update($fields);
        } else {
            $fields['sub_chapter_id'] = Session::get('sub_chapter');
            if ($request->hasFile('logo')) $fields['logo'] = '/resources_logos/'.$request->file('logo')->getClientOriginalName();
            $resource = Resource::create($fields);
        }
        $this->processingFile($request, $resource, 'logo');

        $this->saveCompleteMessage();
        return redirect('/admin/sub-chapter/'.$resource->subChapter->slug);
    }

    public function postRecommendation(Request $request)
    {
        return $this->saveSheet($request, new Sheet(), 'chapters/recommendations');
    }

    public function postFakes(Request $request)
    {
        return $this->saveSheet($request, new Sheet(), 'chapters/fakes');
    }
    
    public function postAllTruth(Request $request)
    {
        return $this->saveSheet($request, new Truth(), 'all-truth');
    }

    public function postArticles(Request $request)
    {
        return $this->saveSheet($request, new Article(), 'articles');
    }

    public function postDeleteSlider(Request $request)
    {
        $path = '';
        $sliderFolder = '/public/images/slider/';
        foreach (glob(base_path($sliderFolder.'*')) as $file) {
            $currentName = 'slide'.$request->input('id').'.jpg';
            if (pathinfo($file)['basename'] == $currentName) {
                $path = $sliderFolder.$currentName;
                break;
            }
        }
        if ($path && file_exists(base_path($path))) {
            unlink(base_path($path));
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
    
    public function postDeleteSlide(Request $request)
    {
        return $this->deleteSomething($request, new Slide(), 'path');
    }

    public function postDeleteFile(Request $request)
    {
        return $this->deleteSomething($request, new File(), 'path');
    }

    public function postDeleteUserFile(Request $request)
    {
        $this->validate($request, ['id' => 'required|integer']);
        $id = $request->input('id')-1;
        $files = glob(base_path('/public/user_files/*'));
        if (file_exists($files[$id])) unlink($files[$id]);
        return response()->json(['success' => true]);
    }

    public function postDeleteDeviceBooklet(Request $request)
    {
        $this->validate($request, ['id' => 'required|integer|exists:devices']);
        $device = Device::find($request->input('id'));
        $this->unlinkFile($device, 'booklet');
        $device->booklet = '';
        $device->save();
        return response()->json(['success' => true]);
    }

    public function postDeleteQuestion(Request $request)
    {
        return $this->deleteSomething($request, new Question());
    }

    public function postDeleteNews(Request $request)
    {
        return $this->deleteSomething($request, new News(), 'slide', '/images/chapters_slides/');
    }

    public function postDeleteMagic(Request $request)
    {
        return $this->deleteSomething($request, new Magic(), 'image', '/images/magics/');
    }

    public function postDeleteReview(Request $request)
    {
        return $this->deleteSomething($request, new Review());
    }

    public function postDeleteResult(Request $request)
    {
        return $this->deleteSomething($request, new PhotoResult(), 'path');
    }

    public function postDeleteMedia(Request $request)
    {
        return $this->deleteSomething($request, new MassMedia(), ['preview','full']);
    }

    public function postDeleteResource(Request $request)
    {
        return $this->deleteSomething($request, new Resource(), 'logo');
    }

    public function postDeleteTruth(Request $request)
    {
        return $this->deleteSomething($request, new Truth());
    }

    public function postDeleteArticle(Request $request)
    {
        return $this->deleteSomething($request, new Article());
    }

    public function postDeleteSheet(Request $request)
    {
        return $this->deleteSomething($request, new Sheet());
    }

    private function sheet(Request $request, Model $model, $slug, $alterView=null)
    {
        $fields = $model->getFillable();
        $this->data['show_time'] = in_array('time',$fields);
        if ($slug) {
            $this->breadcrumbs[$this->data['suffix'].'/add'] = trans('admin_content.add_'.$this->data['suffix']);
            return $this->showView('sheet');
        } else if ($request->has('id')) {
            $this->validate($request, ['id' => 'required|integer|exists:'.$model->getTable()]);
            $this->data['content'] = $model->find($request->input('id'));
            $this->breadcrumbs[$this->data['suffix'].'/?id='.$this->data['content']->id] = $this->data['content']->head;
            return $this->showView('sheet');
        } else {
            $this->data['content'] = $this->data['show_time'] ? $model->orderBy('time','desc')->get() : $model->all();
            return $alterView ? $this->showView($alterView) : redirect()->back();
        }
    }

    private function saveSheet(Request $request, Model $model, $redirect)
    {
        $validateArr = ['head' => 'required|min:3|max:700','content' => 'required|min:10|max:10000'];
        if ($request->has('id')) $validateArr['id'] = 'required|integer|exists:'.$model->getTable();
        $this->validate($request, $validateArr);
        $fields = $this->processingFields($request, 'active', null, null, ($request->has('time') ? 'time': null));

        if ($request->has('id')) {
            $truth = $model->find($request->input('id'));
            $truth->update($fields);
        } else {
            if (Session::has('chapter')) {
                $chapter = Chapter::findBySlug(Session::get('chapter'));
                $fields['chapter_id'] = $chapter->id;
            }
            $model->create($fields);
        }
        $this->saveCompleteMessage();
        return redirect('/admin/'.$redirect);
    }
    
    private function slider()
    {
        $this->data['slider'] = [];
        foreach (glob(base_path('/public/images/slider/*')) as $file) {
            $this->data['slider'][] = pathinfo($file)['basename'];
        }
    }

    private function processingFile(Request $request, $object, $field='slide', $path='/images/chapters_slides/')
    {
        if ($request->hasFile($field)) {
            $fileInfo = pathinfo($object[$field]);
            $path = $fileInfo['dirname'] != '.' ? $fileInfo['dirname'] : $path;
            $path = base_path('/public'.$path);
            if (file_exists($path.$object[$field])) unlink($path.$fileInfo['basename']);
            $request->file($field)->move($path,$fileInfo['basename']);
        }
    }
    
    private function showFile(Request $request, $slug)
    {
        $this->breadcrumbs = ['chapters' => trans('admin_menu.chapters')];
        if ($slug && $slug == 'add') {
            $this->breadcrumbs['file/add'] = trans('admin_content.add_file');
            return $this->showView('file');
        } elseif ($request->has('id')) {
            $this->data['file'] = File::find($request->input('id'));
            $this->data['name'] = pathinfo($this->data['file']->path)['basename'];
            $this->breadcrumbs['file/?id='.$this->data['file']->id] = $this->data['name'];
            return $this->showView('file');
        } else return false;
    }

    private function deleteSomething(Request $request, Model $model, $files=null, $pathToFiles='', $addValidation=null)
    {
        $this->validate($request, ['id' => 'required|integer|exists:'.$model->getTable().',id'.($addValidation ? '|'.$addValidation : '')]);
        $table = $model->find($request->input('id'));
        $table->delete();
        
        if ($files) {
            if (is_array($files)) {
                foreach ($files as $file) {
                    $this->unlinkFile($table, $file, $pathToFiles);
                }
            } else $this->unlinkFile($table, $files, $pathToFiles);
        }
        return response()->json(['success' => true]);
    }
    
    private function unlinkFile($table, $file, $path='')
    {
        $fullPath = $file != base_path('/public'.$path.$table[$file]);
        if (isset($table[$file]) && $table[$file] && file_exists($fullPath)) unlink($fullPath);
    }

    private function processingFields(Request $request, $checkboxFields=null, $ignoreFields=null, $colorFields=null, $timeFields=null)
    {
        $exceptFields = ['_token','id'];
        if ($ignoreFields) {
            if (is_array($ignoreFields)) {
                foreach ($ignoreFields as $field) {
                    $exceptFields[] = $field;
                }
            } else $exceptFields[] = $ignoreFields;
        }

        $fields = $request->except($exceptFields);
        if ($checkboxFields) {
            if (is_array($checkboxFields)) {
                foreach ($checkboxFields as $field) {
                    $fields[$field] = isset($fields[$field]) && $fields[$field] == 'on' ? 1 : 0;
                }
            } else $fields[$checkboxFields] = isset($fields[$checkboxFields]) && $fields[$checkboxFields] == 'on' ? 1 : 0;
        }

        if ($timeFields) {
            if (is_array($colorFields)) {
                foreach ($colorFields as $field) {
                    $fields[$field] = strtotime($this->convertTime($fields[$field]));
                }
            } else $fields[$timeFields] = strtotime($this->convertTime($fields[$timeFields]));
        }

        if ($colorFields) {
            if (is_array($colorFields)) {
                foreach ($colorFields as $field) {
                    $fields[$field] = $this->convertColor($fields[$field]);
                }
            } else $fields[$colorFields] = $this->convertColor($fields[$colorFields]);
        }
        return $fields;
    }

    private function convertColor($color)
    {
        if (preg_match('/^(hsv\(\d+\, \d+\%\, \d+\%\))$/',$color)) {
            $hsv = explode(',',str_replace(['hsv','(',')','%',' '],'',$color));
            $color = $this->fGetRGB($hsv[0],$hsv[1],$hsv[2]);
        }
        return $color;
    }

    private function fGetRGB($iH, $iS, $iV)
    {
        if($iH < 0)   $iH = 0;   // Hue:
        if($iH > 360) $iH = 360; //   0-360
        if($iS < 0)   $iS = 0;   // Saturation:
        if($iS > 100) $iS = 100; //   0-100
        if($iV < 0)   $iV = 0;   // Lightness:
        if($iV > 100) $iV = 100; //   0-100
        $dS = $iS/100.0; // Saturation: 0.0-1.0
        $dV = $iV/100.0; // Lightness:  0.0-1.0
        $dC = $dV*$dS;   // Chroma:     0.0-1.0
        $dH = $iH/60.0;  // H-Prime:    0.0-6.0
        $dT = $dH;       // Temp variable
        while($dT >= 2.0) $dT -= 2.0; // php modulus does not work with float
        $dX = $dC*(1-abs($dT-1));     // as used in the Wikipedia link
        switch(floor($dH)) {
            case 0:
                $dR = $dC; $dG = $dX; $dB = 0.0; break;
            case 1:
                $dR = $dX; $dG = $dC; $dB = 0.0; break;
            case 2:
                $dR = 0.0; $dG = $dC; $dB = $dX; break;
            case 3:
                $dR = 0.0; $dG = $dX; $dB = $dC; break;
            case 4:
                $dR = $dX; $dG = 0.0; $dB = $dC; break;
            case 5:
                $dR = $dC; $dG = 0.0; $dB = $dX; break;
            default:
                $dR = 0.0; $dG = 0.0; $dB = 0.0; break;
        }
        $dM  = $dV - $dC;
        $dR += $dM; $dG += $dM; $dB += $dM;
        $dR *= 255; $dG *= 255; $dB *= 255;
        return 'rgb('.round($dR).', '.round($dG).', '.round($dB).')';
    }

    private function convertTime($time)
    {
        $time = explode('/', $time);
        return $time[1].'/'.$time[0].'/'.$time[2];
    }

    private function getYears()
    {
//        $this->data['years'] = MassMedia::distinct()->orderBy('id','desc')->pluck('year')->toArray();
        $this->data['years'] = [];
        for ($i=(int)date('Y');$i>=2014;$i--) {
            $this->data['years'][] = $i;
        }
    }

    private function checkingFileExist($baseName, $extension)
    {
        $counter = 1;
        while (file_exists(base_path('/public'.$baseName.$counter.'.'.$extension))) {
            $counter++;
        }
        return $baseName.$counter.'.'.$extension;
    }

    private function saveCompleteMessage()
    {
        Session::flash('message',trans('admin_content.save_complete'));
    }

    private function makeSubMenu(Model $model, $desc=false)
    {
        $items = $desc ? $model->orderBy('time','desc')->get() : $model->all();
        $itemsMenu = [];
        foreach ($items as $item) {
            $itemsMenu[] = ['id' => $item->id,'href' => $item->slug, 'name' => isset($item['head_'.App::getLocale()]) ? $this->subStr($item['head_'.App::getLocale()], 20) : $this->subStr($item->head, 20)];
        }
        return $itemsMenu;
    }

    private function showView($view)
    {
        $slides = Slide::all();
        $landingSubmenu = [];
        foreach ($slides as $k => $slide) {
            $landingSubmenu[] = ['href' => '?id='.$slide->id, 'name' => trans('admin_content.slide', ['number' => ($k+1)])];
        }

        return view('admin.'.$view, [
            'breadcrumbs' => $this->breadcrumbs,
            'data' => $this->data,
            'menus' => [
                ['href' => 'landing', 'name' => trans('admin_menu.landing'), 'icon' => 'icon-stack-picture', 'submenu' => $landingSubmenu],
                ['href' => 'slider', 'name' => trans('admin_menu.slider'), 'icon' => 'icon-images3'],
                ['href' => 'chapters', 'name' => trans('admin_menu.chapters'), 'icon' => ' icon-bookmark', 'submenu' => $this->makeSubMenu(new Chapter)],
                ['href' => 'all-truth', 'name' => trans('admin_menu.all-truth'), 'icon' => 'icon-warning2', 'submenu' => $this->makeSubMenu(new Truth, true)],
                ['href' => 'articles', 'name' => trans('admin_menu.articles'), 'icon' => 'icon-magazine', 'submenu' => $this->makeSubMenu(new Article)],
                ['href' => 'user-files', 'name' => trans('admin_menu.user_files'), 'icon' => 'icon-files-empty']
            ]
        ]);
    }
}
