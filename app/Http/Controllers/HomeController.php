<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.home');
    }

    public function getLayOut(Request $request)
    {
    	$index = $request->index;
    	$type = $request->type;
    	if(view()->exists('admin.repeater.row-'.$type)){
		    return view('admin.repeater.row-'.$type, compact('index'))->render();
		}
		return '404';
    }
}
