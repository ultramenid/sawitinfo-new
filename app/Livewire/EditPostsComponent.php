<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Masmerise\Toaster\Toast;
use Masmerise\Toaster\Toaster;

class EditPostsComponent extends Component
{
    use WithFileUploads;
    public $photo, $uphoto, $idpost, $tags, $tag;
    public $titleID, $titleEN, $descID, $descEN, $isactive = 0, $publishdate, $category, $contentID, $contentEN;

    public function mount($id){
        $this->idpost = $id;
        $data = DB::table('posts')->where('id', $id)->first();
        $this->titleID = $data->titleID;
        $this->titleEN = $data->titleEN;
        $this->descID = $data->descID;
        $this->descEN = $data->descEN;
        $this->isactive = $data->is_active;
        $this->publishdate = $data->publishdate;
        $this->category = $data->category;
        $this->contentEN = $data->contentEN;
        $this->contentID = $data->contentID;
        $this->uphoto = $data->img;
        $this->tags = explode(',', $data->tags);
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
    public function uploadImage(){
        // Store uploaded photo and get hashed filename
        $file = $this->photo->store('public/files/photos');
        $foto = $this->photo->hashName();


        // Create thumbnail using Intervention Image
        $manager = new ImageManager(new Driver());
        $image = $manager->read('storage/public/files/photos/'.$foto)->cover(300, 150);
        $image->save('storage/public/files/photos/thumbnail/'.$foto);



        return $foto;
    }

    public function updatedPhoto($photo){
        $extension = pathinfo($photo->getFilename(), PATHINFO_EXTENSION);
        if (!in_array($extension, ['png', 'jpeg', 'bmp', 'gif','jpg','webp','mp4', 'avi', '3gp', 'mov', 'm4a'])) {
           $this->reset('photo');
           $message = 'Files not supported';
           Toaster::error($message);

        }

    }

    public function storePosts(){

            if($this->manualValidation()){
                if(!$this->photo){
                    $name = $this->uphoto;
                }else{

                        Storage::delete('public/files/photos/'.$this->uphoto);
                        Storage::delete('public/files/photos/thumbnail/'.$this->uphoto);
                         $name=  $this->uploadImage();


                }
                DB::table('posts')
                ->where('id', $this->idpost)
                ->update([
                    'publishdate' => $this->publishdate,
                        'img' => $name,
                        'tags' => $this->getTags(),
                        'descEN' => $this->descEN,
                        'descID' => $this->descID,
                        'titleEN' => $this->titleEN,
                        'titleID' => $this->titleID,
                        'is_active' => $this->isactive,
                        'contentID' => $this->contentID,
                        'contentEN' => $this->contentEN,
                        'category' => $this->category,
                        'slug' => Str::slug($this->titleID,'-'),
                        'updated_at' => Carbon::now('Asia/Jakarta')
                ]);

                //passing to toast
                $message = 'Successfully updating posts';
                Toaster::success($message);

            }


    }

    public function render()
    {
        return view('livewire.edit-posts-component');
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
