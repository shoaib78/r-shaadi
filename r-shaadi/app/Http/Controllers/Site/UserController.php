<?php

namespace App\Http\Controllers\Site;
use App\User;
use App\Category;
use App\Review;
use App\Bookmark;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $category = Category::orderBy('category_name', 'ASC')->get();
        view()->share('category', $category);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "User Detail";
        $user = User::find(auth()->guard('user')->id());
        if(!Session::has('changepass')){
            Session::flash('uprofile', TRUE);
        }
        if($user->usertype == 1){
            $reviews = Review::join('users', 'users.id', '=', 'reviews.review_for')
                    ->select('reviews.*','users.id as user_id', 'users.company_name','users.firstname','users.lastname', 'users.email','users.profile_pic', 'users.banner')
                    ->where('reviews.approved',1)
                    ->where('reviews.review_by',$user->id)
                    ->orderBy('reviews.id', 'DESC')
                    ->get()->toArray();
            $bookmarks = Bookmark::join('users', 'users.id', '=', 'bookmarks.bookmark_for')
                    ->select('bookmarks.*','users.id as user_id','users.company_name', 'users.firstname','users.lastname', 'users.email','users.profile_pic', 'users.banner')
                    ->where('bookmarks.bookmark_by',$user->id)
                    ->orderBy('bookmarks.id', 'DESC')
                    ->get()->toArray();

            return view('frontend.user_profile',compact('title','user','reviews','bookmarks'));
        }else{
            return redirect()->intended('vendor/dashboard');
        }
    }

    public function store(Request $request)
    {
        Session::flash('uprofile', TRUE);

        $messages = array(
            'firstname.required' => 'Please enter firstname',
            'lastname.required' => 'Please enter lastname',
            'gender.required' => 'Please select your gender',
        );

        $rules = array(
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('user/dashboard')
                ->withErrors($validator)
                ->withInput();
        }

        $input = $request->all();

        $user_info['firstname'] = ($request->has('firstname')) ? $input['firstname'] : NULL;

        $user_info['lastname'] = ($request->has('lastname')) ? $input['lastname'] : NULL;

        $user_info['gender'] = ($request->has('gender')) ? $input['gender'] : NULL;

        $user_info['birthdate'] = ($request->has('birthdate')) ? date('Y-m-d H:i:s', strtotime(trim($input['birthdate']))) : NULL;

        $user = User::where('id', '=', auth()->guard('user')->id())->update($user_info);

        if($user){
            return redirect('user/dashboard')->with('status_success', 'User information has been successfully saved.');
        }else{
            return redirect('user/dashboard')->with('status_error', 'Sorry, some error found. please try again after sometimes.');
        }
    }

    public function change_profile_pic( Storage $storage, Request $request )
    {
        if (!empty($_FILES['profile_pic']['name']))
        {
            $image = $request->file( 'profile_pic' );
            $timestamp = time();
            $savedImageName = $this->getSavedImageName( $timestamp, $image );

            $imageUploaded = $this->uploadImage( $image, $savedImageName, $storage );

            if ( $imageUploaded )
            {
                $user = User::find(auth()->guard('user')->id());
                $user->profile_pic = $savedImageName;
                $user->save();
            }

            if($user->usertype == 1){
                return redirect()->intended('user/dashboard');
            }else{
                return redirect()->intended('vendor/dashboard');
            }
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
        return $timestamp .'.'.$ext;
    }

    public function bookmark_vendor($id, Request $request)
    {

        if ( $request->isXmlHttpRequest() && $id !='')
        {
            $user = User::find(auth()->guard('user')->id());
            if($user->usertype == 2){
                return response()->json([
                    'error' => TRUE,
                    'msg' => 'Sorry, This action cannot be performed by a vendor.',
                ]);
                exit;
            }

            
            $input = $request->all();
            $bookmark['bookmark_by'] = auth()->guard('user')->id();
            $bookmark['bookmark_for'] = $id;

            $isExist = Bookmark::where('bookmark_by', $bookmark['bookmark_by'])->where('bookmark_for', $id)->count();
            if($isExist>0)
            {
                return response()->json([
                    'error' => TRUE,
                    'msg' => 'Sorry, This vendor already bookmark by you earlier.',
                ]);
            }else{
                $bookmark = Bookmark::create($bookmark);
                if($bookmark->id){
                    return response()->json([
                        'error' => FALSE,
                        'url' =>url('vendor/unbookmark').'/'.$id,
                        'id'=> $id
                    ]);
                }else{
                    return response()->json([
                        'error' => TRUE,
                        'msg' => 'Sorry, some error found. please try again after sometimes.',
                    ]);
                }
            }
        }
        exit;
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */

    public function unbookmark_vendor($id,Request $request)
    {
        if ( $request->isXmlHttpRequest() && $id !='')
        {
            $user = User::find(auth()->guard('user')->id());
            if($user->usertype == 2){
                return response()->json([
                    'error' => TRUE,
                    'msg' => 'Sorry, This action cannot be performed by a vendor.',
                ]);
                exit;
            }
            
            Bookmark::where('bookmark_by', auth()->guard('user')->id())->where('bookmark_for', $id)->delete();
            return response()->json([
                'error' => FALSE,
                'url' =>url('vendor/bookmark').'/'.$id,
                'id'=> $id
            ]);
        }else{
            return json_encode(array('error'=>TRUE,'msg'=>'Sorry, some error are found.'));
        }
        exit;
    }
}
