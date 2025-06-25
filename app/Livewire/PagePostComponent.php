<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class PagePostComponent extends Component
{
    use WithPagination;
    public function selectPosts(){
        if(App::getLocale() == 'id'){
            return ('slug, titleID as title, descID as description, img, category, publishdate');
        }else{
            return ('slug, titleEN as title, descEN as description, img, category, publishdate');
        }
    }
    public function getPosts(){
        return DB::table('posts')->selectRaw($this->selectPosts())
        ->where('category', 'analysis')
        ->where('publishdate', '<', Carbon::now('Asia/Jakarta'))
        ->where('is_active', 1)
        ->orderByDesc('publishdate')
        ->paginate(6);
    }
    public function render()
    {
        $data = $this->getPosts();
        return view('livewire.page-post-component', compact('data'));
    }
}
