<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Masmerise\Toaster\Toaster;
use Illuminate\Support\Str;


class AddPolicyComponent extends Component
{
    use WithFileUploads;
    public $photo, $publishdate, $isactive = 0, $titleID, $titleEN, $descID, $descEN,$fileID, $fileEN;

    public function uploadReports(){
        $name1 = Carbon::now('Asia/Jakarta').'-'.$this->fileID->getClientOriginalName();
        $name2 = Carbon::now('Asia/Jakarta').'-'.$this->fileEN->getClientOriginalName();
        $file1 = $this->fileID->storeAs('public/files/reports', $name1);
        $file2 = $this->fileEN->storeAs('public/files/reports', $name2);
        // $file1 = 1;
        // $file2 = 2;

        return [$name1, $name2];
    }

    public function storeReports(){
        if($this->manualValidation()){
            DB::table('policyregulation')->insert([
                'publishdate' => $this->publishdate,
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
            redirect()->to('/cms/cmspolicy');
        }
    }

    public function render()
    {
        return view('livewire.add-policy-component');
    }

    public function manualValidation(){
        if($this->publishdate == ''){
            $message = 'Publish date is required';
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
