<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function index()
    {
    	//passing values to view use conpact or with
    	$title="Howdy,Welcome to the Posts System!";
    	//return view("pages.home",compact('title'));
    	return view("pages.index")->with('title',$title);

    }

    public function about()
    {
    	return view("pages.about");
    }

    public function services()
    {
    	$data=array('title'=>'Services',
                    'services'=>array('printing','hardware','software')
    		        );
    	return view("pages.services")->with($data);
    }
}



