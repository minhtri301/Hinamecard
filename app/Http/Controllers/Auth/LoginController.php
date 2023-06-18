<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Repositories\PagesSub\PagesSubRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    protected $pages;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PagesSubRepository $pages)
    {
        $this->middleware('guest')->except('logout');

        $this->pages = $pages;
        $this->pages->seoGeneral();
    }

    public function username()
    {
        return 'user_name';
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->pages->createSeo();
        
        $this->validate($request, [
            'user_name' => 'required',
            'password' => 'required',
        ]);

        $remember = $request->remember == 1 ? true : false;

        if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if (auth()->attempt(['user_name' => $request->input('user_name'), 'password' => $request->input('password'), 'status' => 1], $remember))
        {
            return redirect()->route('admin.home');
        }else{
            $this->incrementLoginAttempts($request);
            return redirect('admin/login')->withErrors([
                // $this->username() => __('auth.failed'),
                'loginfail' => ('Sai thông tin đăng nhập hoặc chưa kích hoạt tài khoản'),
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
