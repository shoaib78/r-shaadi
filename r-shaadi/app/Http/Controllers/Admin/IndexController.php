<?php
namespace App\Http\Controllers\Admin;
use App\Setting;
use App\Featured_vendors;
use App\Local_vendor_content;
use App\User_comment;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;
use Datatables;
use Validator;

class IndexController extends AdminController
{
    public function __construct()
    {
        view()->share('type', 'featured_vendors');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function section4_index()
    {
        $title = "Homa Featured_vendors Section 4";
        $settings = Setting::get();
        $data = array();
        foreach($settings as $setting){
            $data[$setting->key] = $setting->value;
        }

        $SETTINGS = (object) $data;
        return view('admin.home_section4',  compact('title','SETTINGS'));
    }

    /*
    * Store general setting.
    *
    * @return Response
    */
    public function home_section4_store(Request $request)
    {
        $messages = array(
        	'home_section4_inbox_text' => 'Please enter inbox_ text',
            'home_section4_collaborate_text' => 'Please enter collaborate text',
            'home_section4_finalize_vendors_text' => 'Please enter finalize vendors text',
            'home_section4_checklist_text' => 'Please enter checklist text',
            
        );
        $rules = array(
        	'home_section4_inbox_text' => 'required',
            'home_section4_collaborate_text' => 'required',
            'home_section4_finalize_vendors_text' => 'required',
            'home_section4_checklist_text' => 'required',
        );
       
        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('admin/home_Featured_vendors_section4')
                ->withErrors($validator)
                ->withInput();
        }

        $input = $request->all();
        $settings['home_section4_inbox_text'] = ($request->has('home_section4_inbox_text')) ? $input['home_section4_inbox_text'] : NULL;

        $settings['home_section4_collaborate_text'] = ($request->has('home_section4_collaborate_text')) ? $input['home_section4_collaborate_text'] : NULL;

        $settings['home_section4_finalize_vendors_text'] = ($request->has('home_section4_finalize_vendors_text')) ? $input['home_section4_finalize_vendors_text'] : NULL;

        $settings['home_section4_checklist_text'] = ($request->has('home_section4_checklist_text')) ? $input['home_section4_checklist_text'] : NULL;

        foreach ($settings as $key => $val) {
            if(Setting::where('key', $key)->exists()){
                $insert = Setting::where('key', $key)->update(
                     ['key' => $key,'value' => $val,]
                );
            }else{
                $insert = Setting::create(
                    ['key' => $key,'value' => $val,]
                );
            }
        }

    
        if($insert){
            return redirect('admin/home_page_section4')->with('home_section4_success', 'Testimonial settings have been updated Successfully!!!');
        }else{
            return redirect('admin/home_page_section4')->with('home_section4_error', 'Sorry, some error found. please try again after sometimes.');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function featured_vendors_index()
    {
    	view()->share('type', 'featured_vendors');
        $settings = Setting::get();
        $data = array();
        foreach($settings as $setting){
            $data[$setting->key] = $setting->value;
        }

        $SETTINGS = (object) $data;

        $title = "Manage Featured_vendors";
        return view('admin.featured_vendors_gallery',  compact('title','SETTINGS'));
    }

    /**
     * Show the form for creating a new Featured_vendors.
     *
     * @return Response
     */
    public function featured_vendors_create()
    {
    	view()->share('type', 'featured_vendors');
        $title = 'Add New Featured_vendors';
        return view('admin.featured_vendors_create', compact('title'));
    }

    /**
     * Store a newly created Featured_vendors content in storage.
     *
     * @return Response
     */

    public function featured_vendors_store(Storage $storage,Request $request)
    {
    	view()->share('type', 'featured_vendors');
        $title = 'Add New Featured_vendors';
        $messages = array(
            'company_name.required' => 'Please enter vendor company name.',
            'category.required' => 'Please enter vendor category.',
            'vendor_profile_link.required' => 'Please enter vendor profile link.',
            'featured_image.required' => 'Please upload vendor featured image.',
            'featured_image.image' => 'Only jpeg, jpg, png and gif format are Supported',
        );

        $rules = array(
            'company_name' => 'required',
            'category' => 'required',
            'vendor_profile_link' => 'required',
            'featured_image' => 'required|image',
        );



        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('admin/featured_vendors_create/create')
                ->withErrors($validator)
                ->withInput();
        }

        $input = $request->all();

        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] != 4) {
            $image = $request->file( 'featured_image' );
            $timestamp = time();
            $savedImageName = $this->getSavedImageName( $timestamp, $image );

            $imageUploaded = $this->uploadImage( $image, $savedImageName, $storage );

            if ( $imageUploaded )
            {
                 $featured_image = $savedImageName;
            }
        }

        $attr['company_name'] = ($request->has('company_name')) ? $input['company_name'] : NULL;
        $attr['category'] = ($request->has('category')) ? $input['category'] : NULL;
        $attr['featured_image'] = isset($featured_image) ? $featured_image : NULL;
        $attr['vendor_profile_link'] = ($request->has('vendor_profile_link')) ? $input['vendor_profile_link'] : NULL;

        $featured_ = Featured_vendors::create($attr);
        if($featured_->id){
            return redirect('admin/featured_vendors')->with('featured_vendor_error', 'Featured vendors gallery content has been successfully saved.');
        }else{
            return redirect('admin/featured_vendors_create/create')->with('status', 'Featured_vendors content not save. Please try again');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function featured_vendors_edit($id)
    {
        $featured_vendor = Featured_vendors::find($id);
        if(count($featured_vendor)>0){
            $title = 'Edit Featured_vendors';
            return view('admin.featured_vendors_create', compact('title','featured_vendor'));
        }else{
            return redirect('admin/featured_vendors');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */

    public function featured_vendors_update(Storage $storage,Request $request)
    {
    	
        $title = 'Add New Featured_vendors';
        $input = $request->all();
        $messages = array(
            'company_name.required' => 'Please enter vendor company name.',
            'category.required' => 'Please enter vendor category.',
            'vendor_profile_link.required' => 'Please enter vendor profile link.',
        );

        $rules = array(
            'company_name' => 'required',
            'category' => 'required',
            'vendor_profile_link' => 'required',
        );


        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] != 4) {
            $messages['featured_image.required'] = 'Please upload vendor featured image.';
            $messages['featured_image.image'] = 'Only jpeg, jpg, png and gif format are Supported';
            $rules['featured_image'] = 'required|image';
        } 

        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('admin/featured_vendors/'.$input['id'].'/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $featured_vendor = Featured_vendors::find($input['id']);
        
        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] != 4) {
            $image = $request->file( 'featured_image' );
            $timestamp = time();
            $savedImageName = $this->getSavedImageName( $timestamp, $image );

            $imageUploaded = $this->uploadImage( $image, $savedImageName, $storage );

            if ( $imageUploaded )
            {
            	if(count($featured_vendor)>0){
            		$filename = public_path().'/uploads/'.$featured_vendor->featured_image;
            		if(\File::exists($filename)) {
			            \File::delete($filename);
			        }
        		}
                $attr['featured_image'] = $savedImageName;
            }
        }

        $attr['company_name'] = ($request->has('company_name')) ? $input['company_name'] : NULL;
        $attr['category'] = ($request->has('category')) ? $input['category'] : NULL;
        $attr['vendor_profile_link'] = ($request->has('vendor_profile_link')) ? $input['vendor_profile_link'] : NULL;
        $featured_vendor = Featured_vendors::where('id', $input['id'])->update($attr);

        if($featured_vendor){
            return redirect('admin/featured_vendors')->with('status', 'Featured vendor gallery content has been successfully updated.');
        }else{
            return redirect('admin/featured_vendors/'.$input['id'].'/edit')->with('status', 'Featured vendor gallery content not updated. Please try again');
        }
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function featured_vendors_data()
    {
    	view()->share('type', 'featured_vendors');
        $featured_vendor =  Featured_vendors::select(array('id','company_name','category','featured_image','vendor_profile_link'))->get()
            ->map(function ($featured_vendor) {
                return [
                    'company_name' => $featured_vendor->company_name,
                    'category' => $featured_vendor->category,
                    'featured_image' => '<img src="'. url('public/uploads/').'/'.$featured_vendor->featured_image.'" width="100" />',
                    'vendor_profile_link' => $featured_vendor->vendor_profile_link,
                    'action' => '<a href="'.url('admin/featured_vendors/'  . $featured_vendor->id . '/edit' ).'" class="btn btn-success btn-sm edit_category" ><span class="glyphicon glyphicon-pencil"></span>  Edit</a>',
                    'id' => $featured_vendor->id,
                ];
            });
        return Datatables::of($featured_vendor)
            ->remove_column('id')
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function local_vendors_index()
    {
    	view()->share('type', 'local_vendors');
        $settings = Setting::get();
        $data = array();
        foreach($settings as $setting){
            $data[$setting->key] = $setting->value;
        }

        $SETTINGS = (object) $data;

        $title = "Manage Local Vendors";
        return view('admin.local_vendors',  compact('title','SETTINGS'));
    }

    /**
     * Show the form for creating a new local_vendors.
     *
     * @return Response
     */
    public function local_vendors_create()
    {
    	view()->share('type', 'local_vendors');
        $title = 'Add New local_vendors';
        return view('admin.local_vendors_create', compact('title'));
    }

    /**
     * Store a newly created local_vendors content in storage.
     *
     * @return Response
     */

    public function local_vendors_store(Storage $storage,Request $request)
    {
    	view()->share('type', 'local_vendors');
        $title = 'Add New local_vendors';
        $messages = array(
            'title.required' => 'Please enter title.',
            'description.required' => 'Please enter description.',
            'link.required' => 'Please enter redirect url.',
            'image.required' => 'Please upload local vendor image.',
            'image.image' => 'Only jpeg, jpg, png and gif format are Supported',
            'image.dimensions' => 'Only 300x300 dimensions image are Supported',
        );

        $rules = array(
            'title' => 'required',
            'description' => 'required',
            'link' => 'required',
            'image' => 'required|image|dimensions:min_width=300,max_width=500,min_height=300,max_height=500',
        );



        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('admin/local_vendors/create')
                ->withErrors($validator)
                ->withInput();
        }

        $input = $request->all();

        if (isset($_FILES['image']) && $_FILES['image']['error'] != 4) {
            $image = $request->file( 'image' );
            $timestamp = time();
            $savedImageName = $this->getSavedImageName( $timestamp, $image );

            $imageUploaded = $this->uploadImage( $image, $savedImageName, $storage );

            if ( $imageUploaded )
            {
                 $image = $savedImageName;
            }
        }

		$attr['title'] = ($request->has('title')) ? $input['title'] : NULL;
		$attr['description'] = ($request->has('description')) ? $input['description'] : NULL;
        $attr['link'] = ($request->has('link')) ? $input['link'] : NULL;
        $attr['image'] = isset($image) ? $image : NULL;
        

        $featured_ = Local_vendor_content::create($attr);
        if($featured_->id){
            return redirect('admin/local_vendors')->with('local_vendor_error', 'Local vendors content has been successfully saved.');
        }else{
            return redirect('admin/local_vendors_create/create')->with('status', 'Local vendors content not save. Please try again');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function local_vendors_edit($id)
    {
        $local_vendor = Local_vendor_content::find($id);
        if(count($local_vendor)>0){
            $title = 'Edit local_vendors';
            return view('admin.local_vendors_create', compact('title','local_vendor'));
        }else{
            return redirect('admin/local_vendor');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */

    public function local_vendors_update(Storage $storage,Request $request)
    {
        $title = 'Edit Local Vendors';
        $input = $request->all();
        $messages = array(
            'title.required' => 'Please enter title.',
            'description.required' => 'Please enter description.',
            'link.required' => 'Please enter redirect url.',
        );

        $rules = array(
            'title' => 'required',
            'description' => 'required',
            'link' => 'required',
        );

        if (isset($_FILES['image']) && $_FILES['image']['error'] != 4) {
            $messages['image.required'] = 'Please upload local vendor image.';
            $messages['image.image'] = 'Only jpeg, jpg, png and gif format are Supported';
            $messages['image.dimensions'] = 'Only 300x300 dimensions image are Supported';
            $rules['image'] = 'required|image|dimensions:min_width=300,max_width=500,min_height=300,max_height=500';
        }

        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('admin/local_vendors/'.$input['id'].'/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $local_vendor = Local_vendor_content::find($input['id']);
        
        if (isset($_FILES['image']) && $_FILES['image']['error'] != 4) {
            $image = $request->file( 'image' );
            $timestamp = time();
            $savedImageName = $this->getSavedImageName( $timestamp, $image );

            $imageUploaded = $this->uploadImage( $image, $savedImageName, $storage );

            if ( $imageUploaded )
            {
            	if(count($local_vendor)>0){
            		$filename = public_path().'/uploads/'.$local_vendor->image;
            		if(\File::exists($filename)) {
			            \File::delete($filename);
			        }
        		}
                $attr['image'] = $savedImageName;
            }
        }

        
        $attr['title'] = ($request->has('title')) ? $input['title'] : NULL;
		$attr['description'] = ($request->has('description')) ? $input['description'] : NULL;
        $attr['link'] = ($request->has('link')) ? $input['link'] : NULL;
        $local_vendor = Local_vendor_content::where('id', $input['id'])->update($attr);

        if($local_vendor){
            return redirect('admin/local_vendors')->with('status', 'Local vendors content has been successfully updated.');
        }else{
            return redirect('admin/local_vendors/'.$input['id'].'/edit')->with('status', 'Local vendors content not updated. Please try again');
        }
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function local_vendors_data()
    {
    	view()->share('type', 'local_vendors');
        $local_vendor =  Local_vendor_content::select(array('id','title','description','image','link'))->get()
            ->map(function ($local_vendor) {
                return [
                	'title' => $local_vendor->title,
                	'description' => $local_vendor->description,
                    'image' => '<img src="'. url('public/uploads/').'/'.$local_vendor->image.'" width="100" />',
                    'link' => $local_vendor->link,
                    'action' => '<a href="'.url('admin/local_vendors/'  . $local_vendor->id . '/edit' ).'" class="btn btn-success btn-sm edit_category" ><span class="glyphicon glyphicon-pencil"></span>  Edit</a>',
                    'id' => $local_vendor->id,
                ];
            });
        return Datatables::of($local_vendor)
            ->remove_column('id')
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function user_comments_index()
    {
    	view()->share('type', 'user_comments');
        $settings = Setting::get();
        $data = array();
        foreach($settings as $setting){
            $data[$setting->key] = $setting->value;
        }

        $SETTINGS = (object) $data;

        $title = "Manage Local Vendors";
        return view('admin.user_comments',  compact('title','SETTINGS'));
    }

    /**
     * Show the form for creating a new user_comments.
     *
     * @return Response
     */
    public function user_comments_create()
    {
    	view()->share('type', 'user_comments');
        $title = 'Add user_comments';
        return view('admin.user_comments_create', compact('title'));
    }

    /**
     * Store a newly created user_comments content in storage.
     *
     * @return Response
     */

    public function user_comments_store(Storage $storage,Request $request)
    {
    	view()->share('type', 'user_comments');
        $title = 'Add New user_comments';
        $messages = array(
            'name.required' => 'Please enter name.',
            'description.required' => 'Please enter description.',
            'profile_pic.required' => 'Please upload user profile pic.',
            'profile_pic.image' => 'Only jpeg, jpg, png and gif format are Supported',
            'profile_pic.dimensions' => 'Only 250x250 dimensions image are Supported',
        );

        $rules = array(
            'name' => 'required',
            'description' => 'required',
            'profile_pic' => 'required|image|dimensions:min_width=200,max_width=400,min_height=200,max_height=400',
        );



        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('admin/user_comments/create')
                ->withErrors($validator)
                ->withInput();
        }

        $input = $request->all();

        if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] != 4) {
            $profile_pic = $request->file( 'profile_pic' );
            $timestamp = time();
            $savedprofile_picName = $this->getSavedImageName( $timestamp, $profile_pic );

            $profile_picUploaded = $this->uploadImage( $profile_pic, $savedprofile_picName, $storage );

            if ( $profile_picUploaded )
            {
                 $profile_pic = $savedprofile_picName;
            }
        }

		$attr['name'] = ($request->has('name')) ? $input['name'] : NULL;
		$attr['description'] = ($request->has('description')) ? $input['description'] : NULL;
        $attr['profile_pic'] = isset($profile_pic) ? $profile_pic : NULL;
        

        $featured_ = User_comment::create($attr);
        if($featured_->id){
            return redirect('admin/user_comments')->with('local_vendor_error', 'Local vendors content has been successfully saved.');
        }else{
            return redirect('admin/user_comments_create/create')->with('status', 'Local vendors content not save. Please try again');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function user_comments_edit($id)
    {
        $user_comment = User_comment::find($id);
        if(count($user_comment)>0){
            $title = 'Edit user_comments';
            return view('admin.user_comments_create', compact('title','user_comment'));
        }else{
            return redirect('admin/user_comments');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */

    public function user_comments_update(Storage $storage,Request $request)
    {
        $title = 'Edit Local Vendors';
        $input = $request->all();
        $messages = array(
            'name.required' => 'Please enter name.',
            'description.required' => 'Please enter description.',
        );

        $rules = array(
            'name' => 'required',
            'description' => 'required',
        );

        if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] != 4) {
            $messages['profile_pic.required'] = 'Please upload user profile picture';
            $messages['profile_pic.image'] = 'Only jpeg, jpg, png and gif format are Supported';
            $messages['profile_pic.image'] = 'Only 250x250 dimensions image are Supported';
            $rules['profile_pic'] = 'required|image|dimensions:min_width=200,max_width=400,min_height=200,max_height=400';
        }

        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('admin/user_comments/'.$input['id'].'/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $user_comment = User_comment::find($input['id']);
        
        if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] != 4) {
            $profile_pic = $request->file( 'profile_pic' );
            $timestamp = time();
            $savedprofile_picName = $this->getSavedImageName( $timestamp, $profile_pic );

            $profile_picUploaded = $this->uploadImage( $profile_pic, $savedprofile_picName, $storage );

            if ( $profile_picUploaded )
            {
            	if(count($user_comment)>0){
            		$filename = public_path().'/uploads/'.$user_comment->profile_pic;
            		if(\File::exists($filename)) {
			            \File::delete($filename);
			        }
        		}
                $attr['profile_pic'] = $savedprofile_picName;
            }
        }

        
        $attr['name'] = ($request->has('name')) ? $input['name'] : NULL;
		$attr['description'] = ($request->has('description')) ? $input['description'] : NULL;
        $user_comment = User_comment::where('id', $input['id'])->update($attr);

        if($user_comment){
            return redirect('admin/user_comments')->with('status', 'User comments has been successfully updated.');
        }else{
            return redirect('admin/user_comments/'.$input['id'].'/edit')->with('status', 'Local vendors content not updated. Please try again');
        }
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function user_comments_data()
    {
    	view()->share('type', 'user_comments');
        $user_comment =  User_comment::select(array('id','name','description','profile_pic'))->get()
            ->map(function ($user_comment) {
                return [
                	'name' => $user_comment->name,
                	'description' => $user_comment->description,
                    'profile_pic' => '<img src="'. url('public/uploads/').'/'.$user_comment->profile_pic.'" width="100" />',
                    'action' => '<a href="'.url('admin/user_comments/'  . $user_comment->id . '/edit' ).'" class="btn btn-success btn-sm edit_category" ><span class="glyphicon glyphicon-pencil"></span>  Edit</a>',
                    'id' => $user_comment->id,
                ];
            });
        return Datatables::of($user_comment)
            ->remove_column('id')
            ->escapeColumns([])
            ->make(true);
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
        return $storage->disk( 'uploads' )->put( $imageFullName, $filesystem->get( $image ) );
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

}