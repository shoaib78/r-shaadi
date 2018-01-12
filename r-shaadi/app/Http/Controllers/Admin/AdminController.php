<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\User;
use App\Admin;
use App\Category;
use App\Gallary;
use App\Review;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if ( !Auth::guard('admin')->check() ){
            return redirect('admin/login');
        }else{
            return redirect('admin/dashboard');
        }

    }
    
    public function dashboard()
    {
        $title = "Dashboard";
        $users = User::where('usertype',1)->count();
        $vendors = User::where('usertype',2)->count();
        $albums = Gallary::count();
        $reviews = Review::where('approved',1)->count();
        return view('admin.dashboard',  compact('title','users','vendors','reviews','albums'));
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function change_password()
    {
        $title = "Change Password";
        if(!Session::has('password')){
            Session::flash('password', TRUE);
        }
        $admin = Admin::find(auth()->guard('admin')->id());
        return view('admin.change_password',  compact('title','admin'));
    }

    public function edit_profile(Request $request)
    {
        $messages = array(
            'firstname.required' => 'Please enter firstname',
            'lastname.required' => 'Please enter lastname',
            'email.required' => 'Please enter email',
        );

        $rules = array(
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255',
        );

        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('admin/profile')
                ->withErrors($validator)
                ->withInput();
        }

        $input = $request->all();

        $admin_info['firstname'] = ($request->has('firstname')) ? $input['firstname'] : NULL;
        $admin_info['lastname'] = ($request->has('lastname')) ? $input['lastname'] : NULL;
        $admin_info['email'] = ($request->has('email')) ? $input['email'] : NULL;
        $admin_info['profession'] = ($request->has('profession')) ? $input['profession'] : NULL;
        $admin_info['about_me'] = ($request->has('about_me')) ? $input['about_me'] : NULL;

        $user = Admin::where('id', '=', auth()->guard('admin')->id())->update($admin_info);

        if($user){
            return redirect('admin/profile')->with('profile_success', 'Admin information has been successfully updated.');
        }else{
            return redirect('admin/profile')->with('profile_error', 'Sorry, some error found. please try again after sometimes.');
        }
    }

    public function change_profile_pic( Storage $storage, Request $request )
    {
        if (!empty($_FILES['image-input']['name']))
        {
            $image = $request->file( 'image-input' );
            $timestamp = time();
            $savedImageName = $this->getSavedImageName( $timestamp, $image );

            $imageUploaded = $this->uploadImage( $image, $savedImageName, $storage );

            if ( $imageUploaded )
            {
                $admin = Admin::find(auth()->guard('admin')->id());
                if(!empty($admin->profile_pic)){
                    $filename = public_path().'/uploads/profile/'.$admin->profile_pic;
        
                    if(\File::exists($filename)) {
                        \File::delete($filename);
                    }
                }
                $admin->profile_pic = $savedImageName;
                $admin->save();
            }

            return redirect()->intended('admin/profile');
        }

    }

    /**
     * @param $image
     * @param $imageFullName
     * @param $storage
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function uploadImage( $image, $imageFullName, $storage )
    {
        $filesystem = new Filesystem;
        return $storage->disk( 'profile' )->put( $imageFullName, $filesystem->get( $image ) );
    }

    /**
     * @param $timestamp
     * @param $image
     * @return string
     */
    protected function getSavedImageName( $timestamp, $image )
    {
        $ext = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
        return $timestamp .rand(0,999999).'.'.$ext;
    }

    public function reset(Request $request)
    {
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
        Session::flash('password', TRUE);
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('admin/profile')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find(auth()->guard('user')->id());

        if(!\Hash::check($request->input('old_password'), $user->password)){
            return redirect('admin/profile')
                ->with('password_error','Sorry, your old password is not incorrect!!');
        }else{
            $user->password = bcrypt($request->input('new_password'));
            $user->save();

            if($user->id){
                return redirect('admin/profile')->with('password_success', 'User password has been successfully update.');
            }else{
                return redirect('admin/profile')->with('password_error', 'Sorry, some error found. please try again after sometimes.');
            }
        }
    }
}
