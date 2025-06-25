<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class PageReportsComponent extends Component
{
    use WithPagination;
    public function selectPosts(){
        if(App::getLocale() == 'id'){
            return ('slug, titleID as title, descID as description, img, publishdate, fileID as file');
        }else{
            return ('slug, titleEN as title, descEN as description, img, publishdate, fileEN as file');
        }
    }
    public function getPosts(){
        return DB::table('reports')->selectRaw($this->selectPosts())
        ->where('publishdate', '<', Carbon::now('Asia/Jakarta'))
        ->where('is_active', 1)
        ->orderByDesc('publishdate')
        ->paginate(6);
    }
    public function render()
    {
        $data = $this->getPosts();
        return view('livewire.page-reports-component', compact('data'));
    }
}
