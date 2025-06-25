<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Masmerise\Toaster\Toast;
use Masmerise\Toaster\Toaster;

class AddReportsComponent extends Component
{
    use WithFileUploads;
    public $photo, $tags = [], $tag, $publishdate, $isactive = 0, $titleID, $titleEN, $descID, $descEN,$fileID, $fileEN;

    public function uploadImage()
    {
       // Store uploaded photo and get hashed filename
        $file = $this->photo->store('public/files/photos');
        $foto = $this->photo->hashName();


        // Create thumbnail using Intervention Image
        $manager = new ImageManager(new Driver());
        $image = $manager->read('storage/public/files/photos/'.$foto)->cover(300, 150);
        $image->save('storage/public/files/photos/thumbnail/'.$foto);



        return $foto;
    }

    public function uploadReports(){
        $name1 = Carbon::now('Asia/Jakarta').'-'.$this->fileID->getClientOriginalName();
        $name2 = Carbon::now('Asia/Jakarta').'-'.$this->fileEN->getClientOriginalName();
        $file1 = $this->fileID->storeAs('public/files/reports', $name1);
        $file2 = $this->fileEN->storeAs('public/files/reports', $name2);
        // $file1 = 1;
        // $file2 = 2;

        return [$name1, $name2];
    }

    public function addTags(){
        array_push($this->tags, $this->tag);
        $this->tag = '';
    }
    public function deleteTags($id){
        unset($this->tags[$id]);
    }
    public function getTags(){
        return implode(',', $this->tags);
    }

    public function storeReports(){
        if($this->manualValidation()){
            DB::table('reports')->insert([
                'img' => $this->uploadImage(),
                'publishdate' => $this->publishdate,
                'tags' => $this->getTags(),
                'titleID' => $this->titleID,
                'titleEN' => $this->titleEN,
                'descID' => $this->titleID,
                'descEN' => $this->titleEN,
                'fileID' => $this->uploadReports()[0],
                'fileEN' => $this->uploadReports()[1],
                'is_active' => $this->isactive,
                'slug' => Str::slug($this->titleID,'-'),
                'created_at' => Carbon::now('Asia/Jakarta')
            ]);
            redirect()->to('/cms/cmsreports');
        }
    }

    public function render()
    {
        return view('livewire.add-reports-component');
    }

    public function manualValidation(){
        if($this->publishdate == ''){
            $message = 'Publish date is required';
            Toaster::error($message);
            return;
        }elseif($this->tags == []){
            $message = 'Tags is required';
            Toaster::error($message);
            return;
        }elseif($this->fileID == ''){
            $message = 'File is required';
            Toaster::error($message);
            return;
        }elseif($this->fileEN == ''){
            $message = 'File is required';
            Toaster::error($message);
            return;
        }elseif($this->titleEN == ''){
            $message = 'Title english is required';
            Toaster::error($message);
            return;
        }elseif(strlen($this->titleEN) > 120){
            $message = 'Title english max limit 120 character';
            Toaster::error($message);
            return;
        }elseif($this->titleID == ''){
            $message = 'Title indonesia is required';
            Toaster::error($message);
            return;
        }elseif(strlen($this->titleID) > 120){
            $message = 'Title indonesia max limit 120 character';
            Toaster::error($message);
            return;
        }elseif($this->descEN == ''){
            $message = 'Description english is required';
            Toaster::error($message);
            return;
        }elseif(strlen($this->descEN) > 160){
            $message = 'Description english max limit 160 character';
            Toaster::error($message);
            return;
        }elseif($this->descID == ''){
            $message = 'Description indonesia is required';
            Toaster::error($message);
            return;
        }elseif(strlen($this->descID) > 160){
            $message = 'Description indonesia max limit 160 character';
            Toaster::error($message);
            return;
        }
        return true;
    }
}
