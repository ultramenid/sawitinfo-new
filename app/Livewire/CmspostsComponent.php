<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class CmspostsComponent extends Component
{
    use WithPagination;
    public $deleteName, $deleteID, $deleter;
    public  $paginate = 10, $search = '';

     public function getPosts(){
        $sc = '%' . $this->search . '%';
        try {
            return  DB::table('posts')
                        ->select('id', 'titleID', 'category', 'img', 'is_active', 'publishdate')
                        ->where('titleID', 'like', $sc)
                        ->orderByDesc('publishdate')
                        ->paginate($this->paginate);
        } catch (\Throwable $th) {
            return [];
        }
    }
     // refresh page on search
     public function updatedSearch(){
        $this->resetPage();
    }
    public function closeDelete(){
        $this->deleter = false;
        $this->deleteName = null;
        $this->deleteID = null;
    }
    public function delete($id){

        //load data to delete function
        $dataDelete = DB::table('posts')->where('id', $id)->first();
        $this->deleteName = $dataDelete->titleID;
        $this->deleteID = $dataDelete->id;

        $this->deleter = true;
    }
    public function deleting($id){
        DB::table('posts')->where('id', $id)->delete();

        $message = 'Successfully deleting posts ';
        $type = 'success'; //error, success
        $this->emit('toast',$message, $type);


        $this->closeDelete();
    }
    public function render()
    {
        $posts = $this->getPosts();
        return view('livewire.cmsposts-component', compact('posts'));
    }
}
