<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class PagesSawitinfoComponent extends Component
{
    public $contentID, $contentEN;

    public function mount(){
        $data = DB::table('pages')->where('name', 'sawitinfo')->first();
        if($data){
            $this->contentEN = $data->contentEN;
            $this->contentID = $data->contentID;
        }else{
            $this->contentEN = '';
            $this->contentID = '';
        }
    }
    public function storeGroups(){
        if($this->manualValidation()){
            DB::table('pages')
            ->updateOrInsert(
                ['name' => 'sawitinfo',],
                [
                    'contentEN' => $this->contentEN,
                    'contentID' => $this->contentID,
                ]
            );
        //passing to toast

        Toaster::success('Successfully updating page sawitinfo');

        }
    }
    public function render()
    {
        return view('livewire.pages-sawitinfo-component');
    }
    public function manualValidation(){
        if($this->contentEN == ''){
            Toaster::error('Content english is required');
            return;

        }elseif($this->contentID == ''){
            Toaster::error('Content indonesia is required');
            return;
        }
        return true;
    }
}
