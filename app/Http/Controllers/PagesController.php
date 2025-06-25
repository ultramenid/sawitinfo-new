<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
     public function getSelect(){
        if (App::getLocale() == 'id') {
            return 'id, contentID as content';
        }else{
            return 'id, contentEN as content';
        }
    }

     public function getData($name){
        return DB::table('pages')
                ->selectRaw($this->getSelect())
                ->where('name', $name)
                ->first();
    }

    public function pageSawitinfo(){
        $title = 'sawitinfo';
        $data = $this->getData('sawitinfo');
        $description = '';
        return view('frontends.sawitinfo', compact('title', 'data', 'description'));
    }

    public function pageWhoweare(){
        $title = 'sawitinfo';
        $data = $this->getData('whoweare');
        $description = '';
        return view('frontends.whoweare', compact('title', 'data', 'description'));
    }

     public function whoweare(){
        $title = 'who we are - sawitinfo';
        $nav = 'pages';
        return view('backends.whoweare', compact('title', 'nav'));
    }
    public function sawitinfo(){
        $title = 'sawitinfo - sawitinfo';
        $nav = 'pages';
        return view('backends.sawitinfo', compact('title', 'nav'));
    }
}
