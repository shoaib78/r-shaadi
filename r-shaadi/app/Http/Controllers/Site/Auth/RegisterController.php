<?php

namespace App\Http\Controllers\Site\Auth;

use App\User;
use App\Category;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
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
        $this->middleware('guest');
        $category = Category::orderBy('category_name', 'ASC')->get();
        view()->share('category', $category);
    }

    public function getRegisterForm()
    {
        return view('frontend/auth/register');
    }	
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  request  $request
     * @return User
     */
    protected function saveRegisterForm(Request $request)
    {
        $input = $request->all();
        if($input['type'] == 2){
            $messages['vendor_firstname.required'] = 'Please enter firstname';
            $messages['vendor_lastname.required'] = 'Please enter lastname.';
            $messages['email.required'] = 'Please enter your email';
            $messages['email.unique'] = 'This email is already taken. Please input a another email.';
            $messages['vendor_company_name.required'] = 'Please enter company name.';
            $messages['vpassword.required'] = 'Please enter password.';
            $messages['category.required'] = 'Please select valid category.';

            $rules['vendor_firstname'] = 'required|max:255';
            $rules['vendor_lastname'] = 'required|max:255';
            $rules['email'] = 'required|email|max:255|unique:users';
            $rules['vendor_company_name'] = 'required';
            $rules['vpassword'] = 'required|min:6|confirmed';
            $rules['category'] = 'required';

            $post['firstname'] = $input['vendor_firstname'];
            $post['lastname'] = $input['vendor_lastname'];
            $post['email'] = $input['email'];
            $post['company_name'] = $input['vendor_company_name'];
            $post['password'] = bcrypt($input['vpassword']);
            $post['usertype'] = $input['type'];
            $post['category'] = $input['category'];
        }else{
            $messages = array(
                'firstname.required' => 'Please enter firstname',
                'lastname.required' => 'Please enter lastname',
                'email.required' => 'Please enter email',
                'email.unique' => 'This email is already taken. Please input a another email',
                'password.required' => 'Please enter password',
            );

            $rules = array(
                'firstname' => 'required|max:255',
                'lastname' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
            );

            $post = array(
                'firstname' => $input['firstname'],
                'lastname' => $input['lastname'],
                'email' => $input['email'],
                'usertype' => $input['type'],
            );

            $messages['upassword.required'] = 'Please enter password.';
            $rules['upassword'] = 'required|min:6|confirmed';
            $post['password'] = bcrypt($input['upassword']);
        }

        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(array('validator_error' => TRUE,'error'=>TRUE, 'msg'=>$validator->messages()));
            exit;
        }
        $user = User::registeruser($post);

        if ($user->id)
        {
            Auth::guard('user')->login($user);
            $res = User::find(auth()->guard('user')->id());
            if($res->usertype == 1){
                //return redirect()->intended('user/dashboard');
                $url = url('user/dashboard');
                $msg='User register successfully';
            }elseif($res->usertype == 2){
                //return redirect()->intended('vendor/dashboard');
                $url = url('vendor/dashboard');
                $msg='Vendor register successfully';
            }else{
                //return redirect()->intended('login');
                $url = url('');
                $msg='';
            }
            return response()->json([
                'error' => FALSE,
                'msg' => $msg,
                'url'=> $url,
            ]);
            //return redirect('user/login')->with('status', 'User register successfully');
        }else{
            //return redirect('user/register')->with('status', 'User not register. Please try again');
            return response()->json(array('error'=>TRUE, 'msg'=>'User not register. Please try again'));
        }
        exit;
    }
}
