<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
     public function selectPost(){
        if (App::getLocale() == 'id') {
            return 'id, titleID as title, slug, img, category, publishdate, descID as description';
        }else{
            return 'id, titleEN as title, slug, img, category, publishdate, descEN as description';
        }
    }
    public function selectReports(){
        if (App::getLocale() == 'id') {
            return 'id, titleID as title, slug, img, publishdate, descID as description, fileID as file';
        }else{
            return 'id, titleEN as title, slug, img, publishdate, descEN as description, fileEN as file';
        }
    }



    public function getPosts(){
        return DB::table('posts')
        ->selectRaw($this->selectPost())
        ->where('category', 'analysis')
        ->where('publishdate', '<', Carbon::now('Asia/Jakarta'))
        ->where('is_active', 1)
        ->orderBy('publishdate','desc')
        ->limit(4)
        ->get();
    }

    public function getNgopini(){
        return DB::table('posts')
        ->selectRaw($this->selectPost())
        ->where('category', 'ngopini')
        ->where('publishdate', '<', Carbon::now('Asia/Jakarta'))
        ->where('is_active', 1)
        ->orderBy('publishdate','desc')
        ->first();
    }

    public function getReports(){
        return DB::table('reports')
        ->selectRaw($this->selectReports())
        ->where('publishdate', '<', Carbon::now('Asia/Jakarta'))
        ->where('is_active', 1)
        ->orderBy('publishdate','desc')
        ->limit(2)
        ->get();
    }
    public function index(){
        // dd($this->getPosts());
        $posts = $this->getPosts();
        $ngopinis = $this->getNgopini();
        $reports = $this->getReports();
        $description = '';
        $title = 'Sawit Info';
        return view('frontends.index', compact('title', 'posts', 'ngopinis', 'reports', 'description'));
    }
}
