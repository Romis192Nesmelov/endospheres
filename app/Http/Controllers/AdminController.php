<?php

namespace App\Http\Controllers;

use App\Device;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Slide;
use App\Chapter;
use App\Video;
use App\File;
use Config;
use Session;

class AdminController extends Controller
{

    private $breadcrumbs = [];
    private $data = [];

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

    public function getChapters($slug=null, $subSlug=null)
    {
        $this->breadcrumbs = ['chapters' => trans('admin_menu.chapters')];
        if ($slug) {
            $this->data['chapter'] = Chapter::findBySlug($slug);
            $this->breadcrumbs['chapters/'.$this->data['chapter']->slug] = $this->data['chapter']['head_'.App::getLocale()];
            Session::flash('chapter',$slug);

            if ($this->data['chapter']->id == 3 && $subSlug) {
                if ($subSlug != 'add') {
                    $this->data['device'] = Device::findBySlug($subSlug);
                    $this->breadcrumbs[$this->data['device']->slug] = $this->data['device']->name;
                } else {
                    $this->breadcrumbs['add'] = trans('admin_content.add_device');
                }
                return $this->showView('device');
            } else {
                return $this->showView('chapter');
            }
        } else {
            $this->data['chapters'] = Chapter::all();
            return $this->showView('chapters');
        }
    }

    public function getFile(Request $request, $slug=null)
    {
        $this->data['type'] = 'file';
        return $this->showFile($request, $slug);
    }

    public function postLanding(Request $request)
    {
        $validateArr = ['description_ru' => 'required|min:10|max:1500'];
        if ($request->has('id')) {
            $slide = Slide::find($request->input('id'));
            if ($slide->is_image) {
                $validateArr['head_ru'] = 'required|min:1|max:20';
                $validateArr['image'] = 'image|min:100|max:1000';
            } else {
                $validateArr['video'] = 'mimes:mp4|min:10000|max:50000';
                $validateArr['poster'] = 'image|min:100|max:1000';
            }
        } else {
            $validateArr['image'] = 'required|image|min:100|max:1000';
            $validateArr['head_ru'] = 'required|min:1|max:20';
        }

        $this->validate($request, $validateArr);
        $fields = $this->processingFields($request, 'active', ['image','video','poster'], ['background_color','mouse_color']);

        $moveFiles = [];
        if ($request->has('id')) {
//            $fields['active'] = !$slide->is_image ? 1 : $fields['active'];
            $slide->update($fields);
            foreach (['image','video','poster'] as $name) {
                if ($request->hasFile($name)) {
                    $info = pathinfo($name == 'poster' ? $slide->poster : $slide->path);
                    $moveFiles[] = ['file' => $name, 'path' => $info['dirname'], 'name' => $info['basename']];
                }
            }
        } else {
            $fields['is_image'] = 1;
            $slide = Slide::create($fields);
            $moveFiles[] = ['file' => 'image','path' => '/images/landing/','name' => 'slide'.$slide->id.'.'.$request->file('image')->getClientOriginalExtension()];
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
        $this->validate($request, [
            'id' => 'required|integer|exists:chapters',
            'head_ru' => 'required|min:1|max:200',
            'content_ru' => 'min:10|max:5000'
        ]);
        
        $chapter = Chapter::find($request->input('id'));
        $fields = $this->processingFields($request, 'active', ['video_head_ru','video_url','video_description_ru']);
        $chapter->update($fields);

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

    public function postDevice(Request $request)
    {
        $validateArr = [
            'menu_logo' => 'required|in:sroface_logo.png,ak_sensorbody_logo.png,ak_sensor_logo.png',
            'name' => 'required|min:3|max:200',
            'head_ru' => 'required|min:1|max:20',
            'description_ru' => 'required|min:5|max:200',
            'content_ru' => 'required|min:10|max:5000'
        ];

        $imagesFields = ['home_page_image','image','slide'];
        $countSliders = count(glob(base_path('/public/images/chapters_slides/*'))) + 1;

        if ($request->has('id')) $validateArr['id'] = 'required|integer|exists:devices';
        else {
            $countDevices = Device::count() + 1;
            foreach ($imagesFields as $field) {
                $validateArr[$field] = 'required|image|min:10|max:1000';
            }
        }
        $this->validate($request, $validateArr);
        $fields = $this->processingFields($request, ['is_new','active'], $imagesFields);
        $fields['chapter_id'] = 3;

        if ($request->has('id')) {
            $device = Device::find($request->input('id'));
            $device->update($fields);
        } else {
            $fields['slide'] = '';
            $fields['home_page_image'] = '';
            $fields['image'] = '';
            $device = Device::create($fields);
        }

        foreach ($imagesFields as $field) {
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
                        $newFileName = $newFileName ? $newFileName : 'device'.$countSliders.'.'.$extension;
                        break;
                    default:
                        $folder = '/images/';
                        $newFileName = $request->has('id') ? $fileInfo['filename'].'.'.$extension : $request->file($field)->getClientOriginalName();
                        break;
                }
                $path = base_path('/public'.$folder);
                if ($request->has('id') && file_exists($path.$device[$field])) unlink($path.$device[$field]);
                $request->file($field)->move($path,$newFileName);
                $device->update([$field => $newFileName]);
            }
        }
        $this->saveCompleteMessage();
        return redirect('/admin/chapters/'.$device->chapter->slug);
    }
    
    public function postAddSlide(Request $request)
    {
        $this->validate($request, ['file' => 'image|min:10|max:1000']);
        $this->slider();
        $request->file('file')->move(base_path('/public/images/slider/'),'slide'.(count($this->data['slider'])+1).'.'.$request->file('file')->getClientOriginalExtension());
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
            if ($request->hasFile('file') && file_exists(base_path('/public'.$file->path))) unlink(base_path('/public'.$file->path));
            $validateArr['file'] = 'mimes:'.$file->type.'|max:3000';
        } else {
            $validateArr['file'] = 'required|min:2|max:3000';
        }

        $this->validate($request, $validateArr);

        if ($request->hasFile('file')) {
            switch ($request->file('file')->getClientMimeType()) {
                case 'application/pdf':
                    $type = 'pdf';
                    $path = '/pdfs/';
                    break;
                default:
                    $type = 'image';
                    $path = '/images/';
                    break;
            }
            $request->file('file')->move(base_path('/public'.$path),$request->file('file')->getClientOriginalName());
        }

        if ($request->has('id')) {
            $fields = $this->processingFields($request, null, 'file');
            $file->update($fields);
        } else {
            $chapter = Chapter::findBySlug(Session::get('chapter'));
            $fields['type'] = $type;
            $fields['path'] = $path.$request->file('file')->getClientOriginalName();
            $fields['chapter_id'] = $chapter->id;
            $file = File::create($fields);
        }
        $this->saveCompleteMessage();
        return redirect('/admin/chapters/'.$file->chapter->slug);
    }

    public function postDeleteSlider(Request $request)
    {
        $this->slider();
        $path = base_path('/public/images/slider/'.$this->data['slider'][$request->input('id')]);
        if (file_exists($path)) unlink($path);
        return response()->json(['success' => true]);
    }
    
    public function postDeleteSlide(Request $request)
    {
        return $this->deleteSomething($request, new Slide());
    }

    public function postDeleteFile(Request $request)
    {
        return $this->deleteSomething($request, new File());
    }

    private function slider()
    {
        $this->data['slider'] = [];
        foreach (glob(base_path('/public/images/slider/*')) as $file) {
            $this->data['slider'][] = pathinfo($file)['basename'];
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

    private function deleteSomething(Request $request, Model $model, $addValidation=null)
    {
        $this->validate($request, ['id' => 'required|integer|exists:'.$model->getTable().',id'.($addValidation ? '|'.$addValidation : '')]);
        $table = $model->find($request->input('id'));
        $table->delete();
        if (file_exists(base_path('/public'.$table->path))) unlink(base_path('/public'.$table->path));
        return response()->json(['success' => true]);
    }

    private function processingFields(Request $request, $checkboxFields = null, $ignoreFields = null, $colorFields = null, $timeFields = null)
    {
        $exceptFields = ['_token','id'];
        if ($ignoreFields) {
            if (is_array($ignoreFields)) {
                foreach ($ignoreFields as $field) {
                    $exceptFields[] = $field;
                }
            } else {
                $exceptFields[] = $ignoreFields;
            }
        }

        $fields = $request->except($exceptFields);
        if ($checkboxFields) {
            if (is_array($checkboxFields)) {
                foreach ($checkboxFields as $field) {
                    $fields[$field] = isset($fields[$field]) && $fields[$field] == 'on' ? 1 : 0;
                }
            } else {
                $fields[$checkboxFields] = isset($fields[$checkboxFields]) && $fields[$checkboxFields] == 'on' ? 1 : 0;
            }
        }

        if ($timeFields) {
            if (is_array($colorFields)) {
                foreach ($colorFields as $field) {
                    $fields[$field] = strtotime($this->convertTime($fields[$field]));
                }
            } else {
                $fields[$timeFields] = strtotime($this->convertTime($fields[$timeFields]));
            }
        }

        if ($colorFields) {
            if (is_array($colorFields)) {
                foreach ($colorFields as $field) {
                    $fields[$field] = $this->convertColor($fields[$field]);
                }
            } else {
                $fields[$colorFields] = $this->convertColor($fields[$colorFields]);
            }
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

    private function saveCompleteMessage()
    {
        Session::flash('message',trans('admin_content.save_complete'));
    }

    private function showView($view)
    {
        $slides = Slide::all();
        $landingSubmenu = [];
        foreach ($slides as $k => $slide) {
            $landingSubmenu[] = ['href' => '?id='.$slide->id, 'name' => trans('admin_content.slide', ['number' => ($k+1)])];
        }

        $chapters = Chapter::all();
        $chaptersMenu = [];
        foreach ($chapters as $chapter) {
            $chaptersMenu[] = ['href' => $chapter->slug, 'name' => $chapter['head_'.App::getLocale()]];
        }

        return view('admin.'.$view, [
            'breadcrumbs' => $this->breadcrumbs,
            'data' => $this->data,
            'menus' => [
                ['href' => 'landing', 'name' => trans('admin_menu.landing'), 'icon' => 'icon-stack-picture', 'submenu' => $landingSubmenu],
                ['href' => 'slider', 'name' => trans('admin_menu.slider'), 'icon' => 'icon-images3'],
                ['href' => 'chapters', 'name' => trans('admin_menu.chapters'), 'icon' => ' icon-bookmark', 'submenu' => $chaptersMenu]
            ]
        ]);
    }
}
