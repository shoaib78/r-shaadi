<?php

namespace App\Http\Controllers\Site\Auth;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
        $category = Category::orderBy('category_name', 'ASC')->get();
        view()->share('category', $category);
    }
    
    public function getLoginForm()
    {
        return view('frontend/auth/login');
    }	
    
    public function authenticate(Request $request)
    {
        
        $email = $request->input('email');
        $password = $request->input('password');
        $type = $request->input('type');
        if (auth()->guard('user')->attempt(['email' => $email, 'password' => $password, 'usertype' => $type ]))
        {
            $user = User::find(auth()->guard('user')->id());
            if($user->usertype == 1){
                //return redirect()->intended('user/dashboard');
                $msg="User has been successfully login";
                $url = url('user/dashboard');
            }elseif($user->usertype == 2){
                //return redirect()->intended('vendor/dashboard');
                $msg="Vendor has been successfully login";
                $url = url('vendor/dashboard');
            } else{
                //return redirect()->intended('login');
                $msg="";
                $url = url('');
            }
            return response()->json([
                'error' => FALSE,
                'msg' => $msg,
                'url'=> $url,
            ]);
        }
        else
        {
            //return redirect()->intended('login')->with('status', 'Invalid Login Credentials !');
            return response()->json([
                'error' => TRUE,
                'msg' => 'Invalid Login Credentials.'
            ]);
        }
        exit;
    }
    
    
    public function getLogout() 
    {
        auth()->guard('user')->logout();
        return redirect()->intended('');
    }
    
}
