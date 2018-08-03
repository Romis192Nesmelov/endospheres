<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Session;

class AdminController extends Controller
{

    private $breadcrumbs = [];
    private $data = [];

    public function __construct()
    {
        $this->middleware('auth');
    }

//    public function getIndex(Request $request)
//    {
//        $id = $request->has('id') ? $request->input('id') : 1;
//        $this->data = Chapter::find($id);
//        $this->breadcrumbs = ['?id='.$id => $this->data['head_'.App::getLocale()]];
//        return $this->showView('chapter',['href' => '?id='.$id, 'name' => $this->data['head_'.App::getLocale()]]);
//    }
//
//    private function showView($view)
//    {
//        $chapters = Chapter::all();
//        $menus = [];
//        foreach ($chapters as $chapter) {
//            $menus[] = ['id' => $chapter->id, 'href' => '?id='.$chapter->id, 'name' => $chapter['head_'.App::getLocale()], 'icon' => $chapter->icon];
//        }
//
//        return view('admin.'.$view, [
//            'breadcrumbs' => $this->breadcrumbs,
//            'data' => $this->data,
//            'menus' => $menus,
//        ]);
//    }
}
