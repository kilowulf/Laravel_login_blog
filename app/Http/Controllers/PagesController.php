<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome To CodeIQ';
        // return view('pages.index', compact('title')); -one way to pass variables 
        return view('pages.index')->with('title', $title);
    }

    public function about(){
        $title = 'About CodeIQ';
        return view('pages.about')->with('title', $title);
    }

    public function services(){
        //using assoc. array to pass data
        $data = array(
            'title' => 'CodeIQ Services',
            'services' => ['Web Design', 'Programming', 'SEO']
        );
        return view('pages.services')->with($data);
    }
}
