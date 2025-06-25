<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Str;
use Masmerise\Toaster\Toaster;

class EditPolicyComponent extends Component
{

    use WithFileUploads;
    public $idReports, $filenameID, $filenameEN;
    public $publishdate, $isactive = 0, $titleID, $titleEN, $descID, $descEN, $fileID, $fileEN;

    public function mount($id){
        $data = DB::table('policyregulation')->where('id', $id)->first();
        $this->idReports = $id;
        $this->publishdate = $data->publishdate;
        $this->isactive = $data->is_active;
        $this->titleID = $data->titleID;
        $this->titleEN = $data->titleEN;
        $this->descID = $data->descID;
        $this->descEN = $data->descEN;
        $this->filenameID = $data->fileID;
        $this->filenameEN = $data->fileEN;
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

    public function storePosts(){
        if($this->manualValidation()){



            if(!$this->fileID){
                // dd($this->filenameID);
                $name1 = $this->filenameID;
            }else{
                Storage::delete('public/files/reports/'.$this->filenameID);
                $name1 = $this->uploadReports()[0];
            }
            if(!$this->fileEN){
                // dd($this->filenameEN);
                $name2 = $this->filenameEN;
            }else{
                Storage::delete('public/files/reports/'.$this->filenameEN);
                $name2 = $this->uploadReports()[1];
            }
            DB::table('policyregulation')
            ->where('id', $this->idReports)
            ->update([
                'publishdate' => $this->publishdate,
                    'descEN' => $this->descEN,
                    'descID' => $this->descID,
                    'titleEN' => $this->titleEN,
                    'titleID' => $this->titleID,
                    'fileID' => $name1,
                    'fileEN' => $name2,
                    'is_active' => $this->isactive,
                    'slug' => Str::slug($this->titleID,'-'),
                    'updated_at' => Carbon::now('Asia/Jakarta')
            ]);

            //passing to toast
            $message = 'Successfully updating policy & regulation';
            Toaster::success($message);

        }
    }
    public function render()
    {
        return view('livewire.edit-policy-component');
    }

    public function manualValidation(){
        if($this->publishdate == ''){
            $message = 'Publish date is required';
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
