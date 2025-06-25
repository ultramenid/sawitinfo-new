<?php

namespace App\Http\Controllers;

use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB as FacadesDB;

class NgopiniController extends Controller
{
    public function selectData(){
        if(App::getLocale() == 'id'){
            return 'id,titleID as title, descID as description, category, contentID as content, tags, slug, img, publishdate';
        }else{
            return 'id, titleEN as title, descEN as description, category, contentEN as content, tags, slug, img, publishdate';
        }
    }
    public function getdataSlug($slug){
        try {
            return FacadesDB::table('posts')->selectRaw($this->selectData())->where('slug' , $slug)->first();
        } catch (\Throwable $th) {
            return [];
        }

    }

    public function index($lang, $slug){
        if(!$this->getdataSlug($slug)){return redirect('/');}
        $data = $this->getdataSlug($slug);
        $title = $data->title;
        $desc = $data->description;
        $tags = explode(',', $data->tags);
        return view('frontends.ngopini', compact('data', 'title', 'desc', 'tags'));
    }

    public function ngopinis(){
        $title = 'Sawit - Posts';
        $description = '';
        return view('frontends.ngopinis', compact('title', 'description'));
    }
}
