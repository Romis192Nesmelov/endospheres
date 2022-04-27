<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Config;

class SettingsController extends Controller
{
    use HelperTrait;

    private $settings;

    public function __construct()
    {
        $this->settings = simplexml_load_file(Config::get('app.settings_xml'));
    }

    public function getLandingTags()
    {
        $tags = ['title' => ''];
        if ($this->settings->landing->title) $tags['title'] = (string)$this->settings->landing->title;
        foreach ($this->metas as $meta => $params) {
            $tags[$meta] = (string)$this->settings->landing->$meta;
        }
        return $tags;
    }

    public function saveLandingTags(Request $request)
    {
        if ($request->has('title')) $this->settings->landing->title = $request->input('title');
        foreach ($this->metas as $meta => $params) {
            $this->settings->landing->$meta = $request->input($meta);
        }
        $this->settings->asXML(Config::get('app.settings_xml'));
    }
}
