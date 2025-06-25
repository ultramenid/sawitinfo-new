<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PolicyRegulationContoller extends Controller
{
     public function cmsPolicy(){
        $title = 'policy & regulation - sawitinfo';
        $nav = 'policyregulation';
        $description = '';
        return view('backends.cmspolicy', compact('title', 'nav', 'description'));
    }

    public function addPolicy(){
        $title = 'add policy & regulation - sawitinfo';
        $nav = 'policyregulation';
        $description = '';
        return view('backends.addpolicy', compact('title', 'nav', 'description'));
    }
    public function edit($id){
        $id = $id;
        $title = 'edit policy & regulation - sawitinfo';
        $nav = 'policyregulation';
        return view('backends.editpolicy', compact('title', 'nav', 'id'));
    }
    public function index(){
        $title = 'policy & regulation - Posts';
        $description = '';
        return view('frontends.policyregulation', compact('title', 'description'));
    }
}
