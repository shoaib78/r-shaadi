<?php

namespace App\Http\Controllers\Site;
use App\User;
use App\Category;
use App\Gallary;
use App\Vendor_inforamation;
use App\Services_detail_info;
use App\Review;
use App\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class ListingsController extends Controller
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
        if ((auth()->guard('user')->id())){
            $user = User::find(auth()->guard('user')->id());
            view()->share('user', $user);
        }
    }

    /**
     * Show the application all listings.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $title="Review Listings";
        $listings = User::leftJoin('services_detail_infos', 'users.id', '=', 'services_detail_infos.user_id')
            ->leftJoin('vendor_inforamations', 'vendor_inforamations.user_id', '=', 'users.id')
            ->join('category', 'users.category', '=', 'category.category_id')
            ->select('services_detail_infos.*','users.id as vendor_id' , 'users.company_name', 'users.firstname','users.lastname', 'users.email','users.profile_pic', 'users.banner', 'category.category_id','category.category_name','vendor_inforamations.country','vendor_inforamations.city','vendor_inforamations.state')
            ->where('users.usertype',2)
            ->orderBy('vendor_id', 'DESC')
            ->paginate(12);
        if(!empty($listings))
        {
            foreach ($listings as $i=>$row){
                $listings[$i]['reviews_count'] = Review::where('review_for',$row->vendor_id)->count();
                $listings[$i]['rating_average'] = Review::where('review_for',$row->vendor_id)->avg('rating');
                $listings[$i]['is_bookmarked'] = '';
                if(!empty(auth()->guard('user')->id())){
                    $listings[$i]['is_bookmarked'] = Bookmark::where('bookmark_by',auth()->guard('user')->id())->where('bookmark_for',$row->vendor_id)->count();
                }
            }
        }
             
            $cities = Vendor_inforamation::select('vendor_inforamations.city')->groupBy('vendor_inforamations.city')->get()->toArray();
            
            return view('frontend.listings', compact('title','listings','cities'));
        }

    /**
     * Show the application service listings.
     *
     * @return \Illuminate\Http\Response
     */
    public function getListings($id='')
    {
        if($id != ""){
            $title="Listings";
            $query = User::leftJoin('services_detail_infos', 'users.id', '=', 'services_detail_infos.user_id');
                $query->join('vendor_inforamations', 'vendor_inforamations.user_id', '=', 'users.id');
                $query->join('category', 'users.category', '=', 'category.category_id');
                $query->select('services_detail_infos.*','users.id as vendor_id' , 'users.company_name','users.firstname','users.lastname', 'users.email','users.profile_pic', 'users.banner', 'category.category_id','category.category_name','vendor_inforamations.country','vendor_inforamations.city','vendor_inforamations.state');
                $query->where('users.usertype',2);
                $query->where('users.category',$id);
                if($id==4){
                    $query->orWhere('services_detail_infos.videographer_photography_service_provide',1);
                }elseif($id==5){
                    $query->orWhere('services_detail_infos.photographer_vidoegraphy_service_provide',1);
                }
                
                
                $query->orderBy('vendor_id', 'DESC');
                
            $listings = $query->paginate(12);
            if(!empty($listings))
            {
                foreach ($listings as $i=>$row){
                    $listings[$i]['reviews_count'] = Review::where('review_for',$row->vendor_id)->count();
                    $listings[$i]['rating_average'] = Review::where('review_for',$row->vendor_id)->avg('rating');
                    $listings[$i]['is_bookmarked'] = '';
                    if(!empty(auth()->guard('user')->id())){
                        $listings[$i]['is_bookmarked'] = Bookmark::where('bookmark_by',auth()->guard('user')->id())->where('bookmark_for',$row->vendor_id)->count();
                    }
                }
            }
            
            $cities = Vendor_inforamation::select('vendor_inforamations.city')->groupBy('vendor_inforamations.city')->get()->toArray();

            return view('frontend.listings', compact('title','listings','cities'));
        }else{
            return redirect()->intended('/');
        }

    }

    /**
     * Show the application vendor profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function vendor_profile($id='')
    {
        if($id != ""){
            $title="Error";
            $user = User::find($id);
            //echo "<pre>"; print_r($user);exit;
            if(count($user)== 0 || $user->usertype == 1){
                return view('frontend.error', compact('title'));
            }else{
                $title="Vendor Profile";
                $lat = ''; $long = '';
                $details = User::leftJoin('services_detail_infos', 'users.id', '=', 'services_detail_infos.user_id')
                ->join('vendor_inforamations as v', 'v.user_id', '=', 'users.id')
                ->join('category', 'users.category', '=', 'category.category_id')
                ->select('services_detail_infos.*','services_detail_infos.id as service_id' , 'users.company_name', 'users.id as vendor_id', 'users.firstname','users.lastname', 'users.email','users.profile_pic', 'users.banner', 'category.category_id','category.category_name','v.address1','v.city','v.state','v.country','v.pincode','v.area_code','v.phone_number','v.website_url','v.facebook_url','v.instagram_url','v.twitter_url','v.youtube_url','v.about_me','v.contact_email')
                ->where('users.id',$id)
                ->where('users.usertype',2)
                ->orderBy('vendor_id', 'DESC')
                ->first();

                if(count($details)>0){
                    $details = $details->toArray();
                }
                $gallary = array();
                if(!empty($details)){
                    $details['is_bookmarked'] = '';
                    if(!empty(auth()->guard('user')->id())){
                        $details['is_bookmarked'] = Bookmark::where('bookmark_by',auth()->guard('user')->id())->count();
                    }
                    

                    if(!empty($details['address1']) || !empty($details['city']) || !empty($details['state']) || !empty($details['country'])){
                        $address =  (!empty($details['address1']) ?$details['address1'].', ' : '').
                                    (!empty($details['city']) ?$details['city'].', ' : '').
                                    (!empty($details['state']) ?$details['state'].', ' : '').
                                    (!empty($details['country']) ?$details['country'].', ' : '');
                        $address = str_replace(" ", "+", $address);
                        $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=".urlencode($address)."&sensor=false");
                        $json = json_decode($json);
                        
                        if(!empty($json->results)){
                            $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
                            $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
                        }
                    }

                    $gallary = Gallary::join('users', 'users.id', '=', 'gallary.user_id')
                        ->join('vendor_inforamations', 'vendor_inforamations.user_id', '=', 'users.id')
                        ->where('gallary.user_id',$details['vendor_id'])
                        ->select('gallary.*', 'users.id', 'users.firstname','users.lastname', 'users.email', 'vendor_inforamations.country','vendor_inforamations.city','vendor_inforamations.state')
                        ->orderBy('gallary_id', 'DESC')
                        ->get()->toArray();
                }
                
                $related = array();
                if(!empty($details)){
                    $related = Services_detail_info::leftJoin('users', 'users.id', '=', 'services_detail_infos.user_id')
                        ->join('vendor_inforamations', 'vendor_inforamations.user_id', '=', 'users.id')
                        ->join('category', 'services_detail_infos.vendor_category', '=', 'category.category_id')
                        ->join('category as cat', 'services_detail_infos.additional_service', '=', 'cat.category_id')
                        ->select('services_detail_infos.*','services_detail_infos.id as service_id' , 'users.company_name', 'users.firstname','users.lastname','users.email','users.id as vendor_id', 'users.profile_pic', 'users.banner', 'category.category_id','category.category_name','vendor_inforamations.country','vendor_inforamations.city','vendor_inforamations.state','cat.category_id as cat_id','cat.category_name as cat_name')
                        ->where('services_detail_infos.user_id', '<>', $details['vendor_id'])
                        ->where('services_detail_infos.vendor_category',$details['category_id'])
                        ->orWhere('services_detail_infos.additional_service',$details['additional_service'])
                        ->orderBy('vendor_id', 'DESC')
                        ->take(4)
                        ->get()->toArray();
                        if(!empty($related))
                        {
                            foreach ($related as $i=>$row){
                                $listings[$i]['reviews_count'] = Review::where('review_for',$row->vendor_id)->count();
                                $listings[$i]['rating_average'] = Review::where('review_for',$row->vendor_id)->avg('rating');
                                $listings[$i]['is_bookmarked'] = '';
                                if(!empty(auth()->guard('user')->id())){
                                    $listings[$i]['is_bookmarked'] = Bookmark::where('bookmark_by',auth()->guard('user')->id())->where('bookmark_for',$row->vendor_id)->count();
                                }
                            }
                        }
                }

                // For getting recent reviews
                $reviews  = array();
                if(!empty($details)){
                    $reviews = Review::join('users', 'users.id', '=', 'reviews.review_by')
                        ->select('reviews.*','users.id as user_id', 'users.firstname','users.lastname','users.email','users.profile_pic', 'users.banner')
                        ->where('reviews.approved',1)
                        ->where('reviews.review_for',$details['vendor_id'])
                        ->orderBy('reviews.id', 'DESC')
                        ->get()->toArray();
                }

                $is_service_available =0;
                if(!empty($details)){
                    $is_service_available = Services_detail_info::where('user_id',$details['vendor_id'])->count();
                }
                return view('frontend.listing_detail', compact('title','details','gallary','related','reviews','lat','long','is_service_available'));
            }
            
        }else{
            return redirect()->intended('/');
        }

    }

    /**
     * Show the application service listings.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        // returns "category"
        $service_category = $request->input('category');

        // returns "city"
        $service_city = $request->input('city');

        // returns "rating"
        $service_rating = $request->input('rating');

        if($service_category != '' || $service_city != '' || $service_rating != ''){
            $title="Filter";
           /* $query = User::leftJoin('services_detail_infos', 'users.id', '=', 'services_detail_infos.user_id')
                ->join('vendor_inforamations', 'vendor_inforamations.user_id', '=', 'users.id')
                ->join('category', 'users.category', '=', 'category.category_id')
                ->leftJoin('reviews', 'reviews.review_for', '=', 'users.id')
                ->select('services_detail_infos.*','services_detail_infos.id as service_id' , 'users.id as vendor_id', 'users.company_name', 'users.firstname','users.lastname','users.email','users.profile_pic', 'users.banner', 'category.category_id','category.category_name','vendor_inforamations.country','vendor_inforamations.city','vendor_inforamations.state')
                ->where('users.usertype',2);*/

                $query = User::leftJoin('services_detail_infos', 'users.id', '=', 'services_detail_infos.user_id');
                $query->join('vendor_inforamations', 'vendor_inforamations.user_id', '=', 'users.id');
                $query->join('category', 'users.category', '=', 'category.category_id');
                if($service_rating != '' && is_numeric($service_rating)){
                    $query->leftJoin('reviews', 'reviews.review_for', '=', 'users.id');
                }
                $query->select('services_detail_infos.*','services_detail_infos.id as service_id' , 'users.id as vendor_id', 'users.company_name', 'users.firstname','users.lastname','users.email','users.profile_pic', 'users.banner', 'category.category_id','category.category_name','vendor_inforamations.country','vendor_inforamations.city','vendor_inforamations.state');
                $query->where('users.usertype',2);

                if($service_category != ''){
                    $query->where('users.category',$service_category);
                    if($service_category==4){
                        $query->orWhere('services_detail_infos.videographer_photography_service_provide',1);
                    }elseif($service_category==5){
                        $query->orWhere('services_detail_infos.photographer_vidoegraphy_service_provide',1);
                    }
                }

                if($service_city != ''){
                    $results = explode(",", $service_city);
                    $loc =array();
                    $provinc = array("AB","BC","MB","NB","NL","NS","NT","NU","ON","PE","QC","SK","YT");
                    $state = array('Alberta', 'British Columbia', 'Manitoba', 'New Brunswick', 'Newfoundland and Labrador', 'Nova Scotia', 'Northwest Territories', 'Nunavut', 'Ontario', 'Prince Edward Island', 'Quebec', 'Saskatchewan', 'Yukon');
                    if(is_array($results)){
                        if(in_array(trim($results[0]), $provinc) || in_array(trim($results[0]), $state)){
                            $value = $results[0];
                            switch (trim($value)) {
                                case "AB":
                                    $value = 'Alberta';
                                    break;
                                case "BC":
                                    $value = 'British Columbia';
                                    break;
                                case "MB":
                                    $value = 'Manitoba';
                                    break;
                                case "NB":
                                    $value = 'New Brunswick';
                                    break;
                                case "NL":
                                    $value = 'Newfoundland and Labrador';
                                    break;
                                case "NS":
                                    $value = 'Nova Scotia';
                                    break;
                                case "NT":
                                    $value = 'Northwest Territories';
                                    break;
                                case "NU":
                                    $value = 'Nunavut';
                                    break;
                                case "ON":
                                    $value = 'Ontario';
                                    break;
                                case "PE":
                                    $value = 'Prince Edward Island';
                                    break;
                                case "QC":
                                    $value = 'Quebec';
                                    break;
                                case "SK":
                                    $value = 'Saskatchewan';
                                    break;
                                case "YT":
                                    $value = 'Yukon';
                                    break;
                            }
                            $query->where('vendor_inforamations.state',$value);
                        }else{
                            foreach ($results as $key => $value) {
                                if($key == 0){
                                    $query->where('vendor_inforamations.city', 'like', '%' . trim($value). '%');
                                }else{
                                    $query->orWhere('vendor_inforamations.city', 'like', '%' . trim($value). '%');
                                }
                                $loc[] = $value;
                            }
                        }
                    }else{
                        $query->where('vendor_inforamations.city', 'like', '%' . trim($service_city) . '%');
                    }
                }
                
                if($service_rating != '' && is_numeric($service_rating)){
                    $query->groupBy('reviews.review_for');
                    if($service_rating == 5){
                        //$query->where('reviews.rating', $service_rating);
                        $query->havingRaw('ROUND(AVG(reviews.rating)) = '.$service_rating);
                    }else{
                        //$query->where('reviews.rating', '>=', $service_rating);
                        $query->havingRaw('ROUND(AVG(reviews.rating)) >= '.$service_rating);
                    }
                }


                $query->orderBy('vendor_id', 'DESC');
                $listings = $query->paginate(12);
            if(count($listings)>0)
            {
                foreach ($listings as $i=>$row){   
                    $listings[$i]['reviews_count'] = Review::where('review_for',$row->vendor_id)->count();
                    $listings[$i]['rating_average'] = Review::where('review_for',$row->vendor_id)->avg('rating');
                    $listings[$i]['is_bookmarked'] = '';
                    if(!empty(auth()->guard('user')->id())){
                        $listings[$i]['is_bookmarked'] = Bookmark::where('bookmark_by',auth()->guard('user')->id())->where('bookmark_for',$row->vendor_id)->count();
                    }
                }
            }

            $cities = Vendor_inforamation::select('vendor_inforamations.city')->groupBy('vendor_inforamations.city')->get()->toArray();
            
            return view('frontend.listings', compact('title','listings','cities','service_category', 'service_city','service_rating'));
        }else{
            return redirect()->intended('/');
        }

    }

    /**
     * Show the application search service.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // returns "category"
        $search = $request->input('search');
        //echo $search;exit;
        if($search != ''){
            $title="Vendors Search";
            $query = User::leftJoin('services_detail_infos', 'users.id', '=', 'services_detail_infos.user_id')
                ->leftJoin('vendor_inforamations', 'vendor_inforamations.user_id', '=', 'users.id')
                ->join('category', 'users.category', '=', 'category.category_id')
                ->select('services_detail_infos.*','services_detail_infos.id as service_id' , 'users.id as vendor_id', 'users.company_name', 'users.firstname','users.lastname','users.email','users.profile_pic', 'users.banner', 'category.category_id','category.category_name','vendor_inforamations.country','vendor_inforamations.city','vendor_inforamations.state');
            
            if($search != ''){
                $query->where('users.company_name', 'like', '%' . trim($search) . '%');
                $query->orWhere('users.firstname', 'like', '%' . trim($search) . '%');
                $query->orWhere('users.lastname', 'like', '%' . trim($search) . '%');
                $query->orWhereRaw("concat(users.firstname, ' ', users.lastname) like '%".trim($search)."%' ");
                //$query->orWhere('users.username', 'like', '%' . trim($search) . '%');
            }

            $query->where('users.usertype',2);
            $query->orderBy('vendor_id', 'DESC');
            $listings = $query->paginate(12);

            if(count($listings)>0)
            {
                foreach ($listings as $i=>$row){
                    $listings[$i]['reviews_count'] = Review::where('review_for',$row['user_id'])->count();
                    $listings[$i]['rating_average'] = Review::where('review_for',$row['user_id'])->avg('rating');
                    $listings[$i]['is_bookmarked'] = '';
                    if(!empty(auth()->guard('user')->id())){
                        $listings[$i]['is_bookmarked'] = Bookmark::where('bookmark_by',auth()->guard('user')->id())->where('bookmark_for',$row->vendor_id)->count();
                    }
                }
            }

            $cities = Vendor_inforamation::select('vendor_inforamations.city')->groupBy('vendor_inforamations.city')->paginate(12);

            return view('frontend.listings', compact('title','listings','search'));
        }else{
            return redirect()->intended('/listings');
        }

    }
}
