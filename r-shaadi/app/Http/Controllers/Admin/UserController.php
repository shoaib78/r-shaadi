<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\User;
use App\Gallary;
use App\Photo;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Datatables;
use Validator;

class UserController extends AdminController
{


    public function __construct()
    {

    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.user.index');
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function manage_vendors()
    {
        view()->share('type', 'manage_vendors');
        $title = "Manage Vendors";
        // Show the page
        return view('admin.user.manage_vendors', compact('title'));
    }

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function manage_users()
    {
        view()->share('type', 'manage_users');
        $title = "Manage Normal Users";
        // Show the page
        return view('admin.user.manage_users', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.user.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(UserRequest $request)
    {

        $user = new User ($request->except('password','password_confirmation'));
        $user->password = bcrypt($request->password);
        $user->confirmation_code = str_random(32);
        $user->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(User $user)
    {
        return view('admin.user.create_edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function update(UserRequest $request, User $user)
    {
        $password = $request->password;
        $passwordConfirmation = $request->password_confirmation;

        if (!empty($password)) {
            if ($password === $passwordConfirmation) {
                $user->password = bcrypt($password);
            }
        }
        $user->update($request->except('password','password_confirmation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function user_status($id, Request $request)
    {
        $user = User::find($id);
        if($user->status == 1){
            $user->status = 0;
        }else{
            $user->status = 1;
        }
        $user->save();
        return response()->json(array('error'=>FALSE,'user'=>$user));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(User $user)
    {
        return view('admin.user.delete', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function destroy(User $user)
    {
        $user->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function gallary($id)
    {
        if($id !=''){
            $title = 'Vendor Gallary';
            $gallary = Gallary::where('user_id', $id)->get()->toArray();
            $banner = User::select('banner','id as user_id')->where('id', $id)->first()->toArray();
            return view('admin.gallary', compact('title','gallary','banner'));
        }else{
            return Redirect::back();
        }
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function remove_image($id)
    {
        if($id !=''){
            $gallary = Gallary::where('gallary_id', base64_decode($id))->first()->toArray();
            $filename = public_path().'/uploads/gallary/'.$gallary['gallary_img'];
            \File::delete($filename);
            Gallary::where('gallary_id', base64_decode($id))->delete();
            Photo::where('file',$gallary['gallary_img'])->delete();
            return response()->json(array('error'=>FALSE));
        }else{
            return Redirect::back();
        }
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function remove_banner($id)
    {
        if($id !=''){
            $user = User::where('id', base64_decode($id))->first()->toArray();
            $filename = public_path().'/uploads/banner/'.$user['banner'];
            \File::delete($filename);
            User::where('id', base64_decode($id))->update(array("banner"=>NULL));
            return response()->json(array('error'=>FALSE));
        }else{
            return Redirect::back();
        }
    }

    /**
     * Show a list of all the vendors formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function manage_vendors_data()
    {
        $users = User::select(array('users.id', 'users.firstname','users.lastname', 'users.email','users.usertype','users.status', 'users.created_at'))->where('users.usertype',2)->get()
            ->map(function ($users) {
                return [
                    'name' => ($users->firstname && $users->lastname) ? ucwords($users->firstname . " " . $users->lastname) : '',
                    'email' => $users->email,
                    'created_at' => $users->created_at->format('d.m.Y'),
                    'action' => '<a href="'.url('admin/vendor_detail/' . $users->id).'" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> View Details</a>&nbsp;&nbsp;<a href="'.url('admin/gallary/' . $users->id).'" class="btn btn-sm btn-success"><i class="fa fa-image"></i> Gallary</a>&nbsp;&nbsp;<a href="'.url('admin/review/' . $users->id).'" class="btn btn-sm btn-info"><i class="fa fa-signal"></i> <span>Reviews</span></a>&nbsp;&nbsp;<a class="btn btn-sm btn-primary status" href="'.url('admin/user_status/'  . $users->id ).'" data-status='.($users->status==0 ? '1' : '0').'" >'.($users->status==0 ? '<i class="fa fa-toggle-on"></i> Active' : '<i class="fa fa-toggle-off"></i> Deactive').'</a>',
                ];
            });

        return Datatables::of($users)
            ->remove_column('users.id')
            ->make(true);
    }

    /**
     * Show a list of all the users formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function manage_users_data()
    {
        $users = User::select(array('users.id', 'users.firstname','users.lastname', 'users.email','users.usertype','users.status', 'users.created_at'))->where('users.usertype',1)->get()
            ->map(function ($users) {
                return [
                    'name' => ($users->firstname && $users->lastname) ? ucwords($users->firstname . " " . $users->lastname) : '',
                    'email' => $users->email,
                    'created_at' => $users->created_at->format('d.m.Y'),
                    'action' => '<a href="'.url('admin/user_detail/' . $users->id).'" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> View Details</a>&nbsp;&nbsp;<a class="btn btn-primary status" href="'.url('admin/user_status/'  . $users->id ).'" data-status="'.($users->status==0 ? '1' : '0').'" >'.($users->status==0 ? '<i class="fa fa-toggle-on"></i> Active' : '<i class="fa fa-toggle-off"></i> Deactive').'</a>',
                ];
            });

        return Datatables::of($users)
            ->remove_column('id')
            ->make(true);
    }

    /**
     * Show a details of vendor.
     *
     * @return Datatables JSON
     */
    public function vendor_detail($id)
    {
        if($id !=''){
            $title = "Vendor Details";
            $vendor = User::leftjoin('vendor_inforamations as v', 'v.user_id', '=', 'users.id')
                            ->join('category', 'users.category', '=', 'category.category_id')
                            ->select('v.*','v.id as service_id' , 'users.id as user_id', 'users.firstname','users.lastname', 'users.email','users.profile_pic', 'users.banner', 'category.category_name')
                            ->where('users.id',$id)
                            ->first()->toArray();
             //echo '<pre>'; print_r($vendor);exit;
            if(!empty($vendor)){
                return view('admin.user.vendor_detail', compact('title','vendor'));
            }else{
                return Redirect::back();
            }
        }else{
            return Redirect::back();
        }
    }

    /**
     * Show a details of user.
     *
     * @return Datatables JSON
     */
    public function user_detail($id)
    {
        if($id !=''){
            $title = "User Details";
            $user_detail = User::find($id);
            if(!empty($user_detail)){
                return view('admin.user.user_detail', compact('title','user_detail'));
            }else{
                return Redirect::back();
            }
            
        }else{
            return Redirect::back();
        }
    }

}
