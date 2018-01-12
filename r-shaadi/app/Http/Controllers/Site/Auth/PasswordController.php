<?php
namespace App\Http\Controllers\Site\Auth;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use Validator;
use Hash;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
class PasswordController extends Controller
{
    /*
|--------------------------------------------------------------------------
| Password Reset Controller
|--------------------------------------------------------------------------
|
| This controller is responsible for handling password reset requests
| and uses a simple trait to include this behavior. You're free to
| explore this trait and override any methods you wish to tweak.
|
*/
    use ResetsPasswords;
    /**
* Create a new controller instance.
*
* @return void
*/
    public function __construct()
    {
        //$this->middleware('guest');
        $this->middleware('guest', ['except' => 'logout']);
        $category = Category::orderBy('category_name', 'ASC')->get();
        view()->share('category', $category);
    }
    public function index()
    {
        $title = 'Password Reset';
        return view('frontend.reset',compact('title'));
    }
    public function reset(Request $request)
    {
        Session::flash('changepass', TRUE);
        $user = User::find(auth()->guard('user')->id());
        $messages = array(
            'old_password.required' => 'Please enter old password',
            'new_password.required' => 'Please enter new password',
            'new_password_confirmation.required' => 'Please enter valid new password confirmation',
        );
        $rules = array(
            'old_password' => 'required|min:6',
            'new_password' => 'required|min:6',
            'new_password_confirmation' => 'required|min:6|same:new_password'
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {

            if(!empty($user->usertype) && $user->usertype == 1){
                return redirect('user/dashboard')
                ->withErrors($validator)
                ->withInput();
            }else{
                return redirect('vendor/dashboard')
                ->withErrors($validator)
                ->withInput();
            }
        }
        
        if(!Hash::check($request->input('old_password'), $user->password)){
            return back()
                ->with('password_error','Sorry, your old password is not incorrect!!');
        }else{
            $user->password = bcrypt($request->input('new_password'));
            $user->save();
            if($user->id){

                if(!empty($user->usertype) && $user->usertype == 1){
                    return redirect('user/dashboard')->with('password_success', 'User password has been successfully update.');
                }else{
                    return redirect('vendor/dashboard')->with('password_success', 'Vendor password has been successfully update.');
                }
            }else{
                if(!empty($user->usertype) && $user->usertype == 1){
                    return redirect('user/dashboard')->with('password_error', 'Sorry, some error found. please try again after sometimes.');
                }else{
                    return redirect('vendor/dashboard')->with('password_error', 'Sorry, some error found. please try again after sometimes.');
                }
            }
        }
    }
}
