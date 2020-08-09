<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    // home page request
    public function getIndex(){
        $heading = "Welcome to BlogSite";
        return view("pages.index")->with('heading',$heading);
    }
    // about page request
    public function getAbout(){
        $heading = "About";
        return view('pages.about')->with('heading',$heading);
    }
    // about page request
    public function getServices(){
        $data = Array(
            'heading' => 'Services',
            'services' => ['Adding a Post' , 'Deleting a Post' , 'Editing a Post']
        );
        return view('pages.services')->with($data);
    }
}
