<?php
namespace App\Http\Controllers\Site;
use App\User;
use App\Category;
use App\Vendor_inforamation;
use App\Gallary;
use App\Services_detail_info;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
class VendorController extends Controller
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
        $title = 'Vendor Information';
        $categories = array();
        if(!Session::has('changepass') && !Session::has('vdetails') && !Session::has('vgallary')){
            Session::flash('vcontact', TRUE);
        }
        $user = User::find(auth()->guard('user')->id());
        $vendor = Vendor_inforamation::where('user_id', auth()->guard('user')->id())->first();
        
        $gallary = Gallary::where('user_id', auth()->guard('user')->id())->pluck('gallary_img');

        if(!empty($user->category)){
            $categories = Category::where('category_id',$user->category)->pluck('category_name')->toArray();
        }
        
        $service_detail = Services_detail_info::where('user_id', auth()->guard('user')->id())->first();
        if(!empty($service_detail)){
            $service_detail = $service_detail->toArray();
        }
        $service_category = Services_detail_info::where('user_id', auth()->guard('user')->id())->pluck('vendor_category')->toArray();

        if($user->usertype == 2){
            $reviews = Review::join('users', 'users.id', '=', 'reviews.review_by')
                ->select('reviews.*','users.id as user_id', 'users.firstname','users.lastname','users.email','users.profile_pic', 'users.banner')
                ->where('reviews.approved',1)
                ->where('reviews.review_for',$user->id)
                ->orderBy('reviews.id', 'DESC')
                ->get()->toArray();
            //echo '<pre>'; print_r($service_detail);exit;
            return view('frontend.vendor_profile',compact('title','user','vendor','gallary','service_detail','categories','service_category','reviews'));
        }else{
            return redirect()->intended('user/dashboard');
        }
    }
    public function store(Request $request)
    {
        $messages = array(
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'company_name.required' => 'Please enter company name',
            'about_me.required' => 'Please enter your about me',
            'category.required' => 'Please select valid category',
        );
        $rules = array(
            'firstname' => 'required',
            'lastname' => 'required',
            'company_name' => 'required',
            'about_me' => 'required|max:1200',
            'category' => 'required',
        );
        if($request->has('city') && !empty($request->get('city'))){
            $rules['city'] = 'alpha_spaces';
        }
        Session::flash('vcontact', TRUE);
        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('vendor/dashboard')
                ->withErrors($validator)
                ->withInput();
        }
        $input = $request->all();
        $vendor_info1 = array(
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'company_name' => $input['company_name'],
            'category' => isset($input['category']) ? $input['category'] : NULL,
        );
        $vendor_info2 = array(
            'user_id'=> auth()->guard('user')->id(),
            'contact_email' => $input['contact_email'] ? $input['contact_email'] : NULL,
            'address1' => $input['address1'] ? $input['address1'] : NULL,
            'address2' => $input['address2'] ? $input['address2'] : NULL,
            'city' => $input['city'] ? $input['city'] : NULL,
            'state' => $input['state'] ? $input['state'] : NULL,
            'country' => $input['country'] ? $input['country'] : NULL,
            'pincode' => $input['pincode'] ? $input['pincode'] : NULL,
            'area_code' => $input['area_code'] ? $input['area_code'] : NULL,
            'phone_number' => $input['phone_number'] ? $input['phone_number'] : NULL,
            'website_url' => $input['website_url'] ? $input['website_url'] : NULL,
            'facebook_url' => $input['facebook_url'] ? $input['facebook_url'] : NULL,
            'instagram_url' => $input['instagram_url'] ? $input['instagram_url'] : NULL,
            'twitter_url' => $input['twitter_url'] ? $input['twitter_url'] : NULL,
            'youtube_url' => $input['youtube_url'] ? $input['youtube_url'] : NULL,
            'about_me' => $input['about_me'] ? $input['about_me'] : NULL,
            'category' => isset($input['category']) ? $input['category'] : NULL,
        );
        User::where('id', '=', auth()->guard('user')->id())->update($vendor_info1);
        $vendor = Vendor_inforamation::where('user_id', auth()->guard('user')->id())->first();
        if(!empty($vendor)){
            Vendor_inforamation::where('user_id', '=', auth()->guard('user')->id())->update($vendor_info2);
        }else{
            $vendor = Vendor_inforamation::create($vendor_info2);
        }
        if($vendor){
            return redirect('vendor/dashboard')->with('status_success', 'Vendor information has been successfully saved.');
        }else{
            return redirect('vendor/dashboard')->with('status_error', 'Sorry, some error found. please try again after sometimes.');
        }
    }
    public function gallary(Request $request)
    {
        Session::flash('vgallary', TRUE);
        $messages = array(
            'banner.required' => 'Please upload banner image',
            'gallary.required' => 'Please upload gallary images',
        );
        $rules = array(
            'banner' => 'required',
            'gallary' => 'required',
        );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('vendor/dashboard')
                ->withErrors($validator)
                ->withInput();
        }
        //$input = $request->all();
        //echo '<pre>'; print_r($input);exit;
    }
    public function store_service_values(Request $request)
    {
        $input = $request->all();
        \Session::flash('vdetails', TRUE );
        $messages['vendor_category.required'] = 'Please select vendor category';
        if ($request->has('cat1')) {
            $messages['vanue_type.required'] = 'Please select wedding vanue type';
            $messages['vanue_settings.required'] = 'Please choose valid wedding vanue setting';
            $rules['vanue_type'] = 'required';
            $rules['vanue_settings'] = 'required';
            $services['vanue_type'] = ($request->has('vanue_type')) ? json_encode($input['vanue_type']) : NULL;
            $services['vanue_settings'] = ($request->has('vanue_settings')) ? json_encode($input['vanue_settings']) : NULL;
            $services['vanue_min_price'] = ($request->has('vanue_min_price')) ? $input['vanue_min_price'] : NULL;
            $services['vanue_max_price'] = ($request->has('vanue_max_price')) ? $input['vanue_max_price'] : NULL;
        }
        if ($request->has('cat6')) {
            $messages['bridal_makeup_offer.required'] = 'Please choose wedding bridal makeup offsite services';
            $rules['bridal_makeup_offer'] = 'required';
            $services['bridal_makeup_offer'] = ($request->has('bridal_makeup_offer')) ? $input['bridal_makeup_offer'] : NULL;
            $services['bridal_makeup_starting_price'] = ($request->has('bridal_makeup_starting_price')) ? $input['bridal_makeup_starting_price'] : NULL;
        }
        if ($request->has('cat5')) {
            $messages['videographer_photography_service_provide.required'] = 'Please choose videographer providing photography services';
            $rules['videographer_photography_service_provide'] = 'required';
            $services['videographer_photography_service_provide'] = ($request->has('videographer_photography_service_provide')) ? $input['videographer_photography_service_provide'] : NULL;
            $services['videographer_starting_price'] = ($request->has('videographer_starting_price')) ? $input['videographer_starting_price'] : NULL;
        }
        if ($request->has('cat4')) {
            $messages['photographer_vidoegraphy_service_provide.required'] = 'Please choose photographer providing videography services';
            $messages['photographer_photo_booth_service_provide.required'] = 'Please choose photographer providing booth services';
            $rules['photographer_vidoegraphy_service_provide'] = 'required';
            $rules['photographer_photo_booth_service_provide'] = 'required';
            $services['photographer_photo_booth_service_provide'] = ($request->has('photographer_photo_booth_service_provide')) ? $input['photographer_photo_booth_service_provide'] : NULL;
            $services['photographer_vidoegraphy_service_provide'] = ($request->has('photographer_vidoegraphy_service_provide')) ? $input['photographer_vidoegraphy_service_provide'] : NULL;
            $services['photographer_starting_price'] = ($request->has('photographer_starting_price')) ? $input['photographer_starting_price'] : NULL;
        }
        if ($request->has('cat8')) {
            $messages['music_geners.required'] = 'Please choose wedding dj musinc geners';
            $rules['music_geners'] = 'required';
            $services['wedding_dj_music_offer'] = ($request->has('music_geners')) ? json_encode($input['music_geners']) : NULL;
        }
        if ($request->has('cat9')) {
            $services['wedding_entertainment_sub_category'] = ($request->has('entertainment_sub_cat')) ? $input['entertainment_sub_cat'] : NULL;
        }
        if ($request->has('cat15')) {
            $services['officiant_religion'] = ($request->has('relegion')) ? $input['relegion'] : NULL;
        }
        if ($request->has('cat17')) {
            $messages['vehicles.required'] = 'Please choose valid transportataion vhicles';
            $rules['vehicles'] = 'required';
            $services['transportation_vechile_available'] = ($request->has('vehicles')) ? json_encode($input['vehicles']) : NULL;
        }
        $rules['vendor_category'] = 'required';
        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('vendor/dashboard')
                ->withErrors($validator)
                ->withInput();
        }
        $services['user_id'] = auth()->guard('user')->id();
        $services['additional_service'] = ($request->has('additional_cat')) ? $input['additional_cat'] : NULL;
        
        if($request->has('vcat') && !empty($input['vcat'])){
            $services['vendor_category'] = $input['vcat'];
            $vendor = Services_detail_info::where('vendor_category',$input['vcat'])->where('user_id', auth()->guard('user')->id())->first();
            if(!empty($vendor)){
                Services_detail_info::where('vendor_category', $input['vcat'])->where('user_id', '=', auth()->guard('user')->id())->update($services);
            }else{
                $vendor = Services_detail_info::create($services);
            }

            if($vendor){
                return redirect('vendor/dashboard')->with('service_success', 'Service information has been successfully saved.');
            }else{
                return redirect('vendor/dashboard')->with('service_error', 'Sorry, some error found. please try again after sometimes.');
            }
        }else{
            return redirect('vendor/dashboard')->with('service_error', 'Sorry, some error found. please try again after sometimes.');
        }
    }
    public function store_review(Request $request)
    {
        if ( $request->isXmlHttpRequest() )
        {
            $user = User::find(auth()->guard('user')->id());
            if($user->usertype == 2){
                return response()->json([
                    'error' => TRUE,
                    'msg' => 'Sorry, This action cannot be performed by a vendor.',
                ]);
                exit;
            }
            $messages = array(
                'review.required' => 'Please write something in review field',
            );
            $rules = array(
                'review' => 'required',
            );
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    'error' => TRUE,
                    'msg' => $validator->messages(),
                ]);
            }else{
                $input = $request->all();
                $reviews['anonymous'] = ($request->has('anonymous')) ? $input['anonymous'] : 0;
                $reviews['rating'] = ($request->has('rating-input')) ? $input['rating-input'] : NULL;
                $reviews['description'] = ($request->has('review')) ? nl2br($input['review']) : NULL;
                $reviews['review_by'] = auth()->guard('user')->id();
                $reviews['review_for'] = ($request->has('review_for')) ? $input['review_for'] : NULL;
                $review = Review::create($reviews);
                if($review->id){
                    return response()->json([
                        'error' => FALSE,
                        'msg' => 'Review has been successfully sent.',
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

    public function sortReviews(Request $request)
    {
        $input = $request->all();
        if($request->ajax() && !empty($input['rating']) && !empty($input['vendor_id'])){
            $reviews = Review::join('users', 'users.id', '=', 'reviews.review_by')
                        ->select('reviews.*','users.id as user_id', 'users.firstname','users.lastname','users.email','users.profile_pic', 'users.banner')
                        ->where('reviews.approved',1);
            if($input['rating'] != 'All'){
                $reviews->where('reviews.rating',$input['rating']);
            }
            
            $reviews->where('reviews.review_for',$input['vendor_id']);
            $reviews->orderBy('reviews.id', 'DESC');
            $reviews = $reviews->get();
            if(count($reviews)>0){
                $reviews = $reviews->toArray();
            }

            $html = view('frontend._reviewList', compact('reviews'))->render();
            return response()->json([
                'error' => FALSE,
                'html' => $html,
            ]);
        }else{
            return response()->json([
                'error' => TRUE,
                'msg' => 'Sorry, some error found. please try again after sometimes.',
            ]);
        }
        exit;
    }

    public function userSortReviews(Request $request)
    {
        $input = $request->all();
        if($request->ajax() && !empty($input['rating']) && !empty($input['vendor_id'])){
            $reviews = Review::join('users', 'users.id', '=', 'reviews.review_for')
                        ->select('reviews.*','users.id as user_id', 'users.company_name','users.firstname','users.lastname', 'users.email','users.profile_pic', 'users.banner')
                        ->where('reviews.approved',1);
            if($input['rating'] != 'All'){
                $reviews->where('reviews.rating',$input['rating']);
            }
            
            $reviews->where('reviews.review_by',auth()->guard('user')->id());
            $reviews->orderBy('reviews.id', 'DESC');
            $reviews = $reviews->get();
            if(count($reviews)>0){
                $reviews = $reviews->toArray();
            }

            $html = view('frontend._userReviewList', compact('reviews'))->render();
            return response()->json([
                'error' => FALSE,
                'html' => $html,
            ]);
        }else{
            return response()->json([
                'error' => TRUE,
                'msg' => 'Sorry, some error found. please try again after sometimes.',
            ]);
        }
        exit;
    }
}
