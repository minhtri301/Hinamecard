<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Repositories\PagesSub\PagesSubRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    protected $pages;

    public function __construct(PagesSubRepository $pages)
    {
        $this->pages = $pages;
        $this->pages->seoGeneral();
    }

    public function getLogin(){
        return view('frontend.pages.login');
    }

    public function Logout(){
        $this->pages->createSeo();
        Auth::guard('customer')->logout(); 
        return redirect()->route('home.login');
    }

    public function postLogin(Request $request){
        $code = Customer::where('login_code', $request->login_code)->where('status',1)->first();
        if(isset($code)){
            Auth::guard('customer')->login($code);
            return redirect()->route('home.page.index')->with('success','Đăng nhập thành công');
        }else{
            return redirect()->route('home.page.index')->with('error','Đăng nhập thất bại');
        };
    }
}
