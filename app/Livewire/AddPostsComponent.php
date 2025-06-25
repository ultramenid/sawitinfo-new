<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Masmerise\Toaster\Toaster;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Laravel\Facades\Image;


class AddPostsComponent extends Component
{
    use WithFileUploads;
    public $photo, $titleID, $titleEN, $descID, $descEN, $contentID, $contentEN, $publishdate, $isactive = 0, $category, $tags =[], $tag;

    public function storePosts(){
        if($this->manualValidation()){
            DB::table('posts')->insert([
                'publishdate' => $this->publishdate,
                'titleID' => $this->titleID,
                'titleEN' => $this->titleEN,
                'descEN' => $this->descEN,
                'descID' => $this->descID,
                'contentID' => $this->contentID,
                'contentEN' => $this->contentEN,
                'is_active' => $this->isactive,
                'category' => $this->category,
                'img' => $this->uploadImage(),
                'tags' => $this->getTags(),
                'slug' => Str::slug($this->titleID,'-'),
                'created_at' => Carbon::now('Asia/Jakarta')
            ]);
            redirect()->to('/cms/cmsposts');
        }
    }
    public function render()
    {
        return view('livewire.add-posts-component');
    }

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

    public function updatedPhoto($photo){
        $extension = pathinfo($photo->getFilename(), PATHINFO_EXTENSION);
        if (!in_array($extension, ['png', 'jpeg', 'bmp', 'gif','jpg','webp','mp4', 'avi', '3gp', 'mov', 'm4a'])) {
           $this->reset('photo');
           $message = 'Files not supported';
           Toaster::error($message);
        }



    }

    public function manualValidation(){
        if(strlen($this->titleID) > 120){
            $message = 'Title indonesia max limit 120 character';
            Toaster::error($message);
            return;
        }elseif($this->titleID == '' ){
            $message = 'Title indonesia is required';
            Toaster::error($message);
            return;
        }elseif(strlen($this->titleEN) > 120){
            $message = 'Title english max limit 120 character';
            Toaster::error($message);
            return;
        }elseif($this->titleEN == '' ){
            $message = 'Title english is required';
            Toaster::error($message);
            return;
        }elseif($this->descID == '' ){
            $message = 'Description indonesia is required';
            Toaster::error($message);
            return;
        }elseif(strlen($this->descID) > 160 ){
            $message = 'Description Indonesia max limit 160 character';
            Toaster::error($message);
            return;
        }elseif($this->descEN == '' ){
            $message = 'Description english is required';
            Toaster::error($message);
            return;
        }elseif(strlen($this->descEN) > 160 ){
            $message = 'Description english max limit 160 character';
            Toaster::error($message);
            return;
        }elseif($this->contentID == '' ){
            $message = 'Content indonesia is required';
            Toaster::error($message);
            return;
        }elseif($this->contentEN == '' ){
            $message = 'Content english is required';
            Toaster::error($message);
            return;
        }elseif($this->publishdate == '' ){
            $message = 'Publish date  is required';
            Toaster::error($message);
            return;
        }elseif($this->category == '' ){
            $message = 'Category is required';
            Toaster::error($message);
            return;
        }elseif($this->tags == [] ){
            $message = 'Tags is required';
            Toaster::error($message);
            return;
        }
        return true;
    }
}
