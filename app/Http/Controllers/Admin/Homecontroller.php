<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use App\Models\Information_icon;
use Illuminate\Http\Request;

class Homecontroller extends Controller
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
        $user = User::orderBy('id','desc')->get(); 
        $customer = Customer::all();
        $app = Information_icon::all();
        return view('admin.home',compact('user','customer','app'));
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
