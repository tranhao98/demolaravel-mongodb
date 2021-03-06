<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Branch;
use Illuminate\Support\Facades\Session;
use App\Models\Blog;
use Illuminate\Http\Request;

class LoginController extends Controller
{
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
    //protected $redirectTo = RouteServiceProvider::HOME;

    protected function authenticated()
    {
        // $dt = DB::collection('dienthoai');
        // $dt = $dt->paginate(6);
        // $branch = Branch::all();
        // $posts = Blog::all();
        if (Auth::user()->role_as == '1') {
            return redirect('/admin')->with('status', 'Welcome to your Admin!');
        } elseif (Auth::user()->role_as == '0' && Auth::user()->status == '1' && Auth::user()->is_verify == '1') {
            // Session::flash('status', 'Logged in successfully!');
            return redirect('/home')->with('status', 'Logged in successfully!');
            // return view('/home', compact('dt', 'branch', 'posts'));
        } elseif (Auth::user()->status == '0') {
            Session::flush();
            Session::flash('notactive', 'Your account is not activated yet!');
        } elseif (Auth::user()->is_verify == '0') {
            Session::flush();
            Session::flash('notverify', 'Please confirm your email to verify!');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
