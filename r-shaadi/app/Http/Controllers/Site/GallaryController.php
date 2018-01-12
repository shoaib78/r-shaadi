<?php

namespace App\Http\Controllers\Site;
use App\Category;
use App\User;
use App\Gallary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class GallaryController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title="Gallery";
        $gallary = Gallary::join('users', 'users.id', '=', 'gallary.user_id')
                            ->join('vendor_inforamations', 'vendor_inforamations.user_id', '=', 'users.id')
                            ->select('gallary.*', 'users.id as vendor_id', 'users.company_name', 'users.firstname','users.lastname','users.email', 'users.profile_pic', 'users.banner','vendor_inforamations.country')
                            ->where('users.usertype',2)
                            ->groupBy('gallary.user_id')
                            ->orderBy('gallary_id', 'DESC')
                            ->paginate(16);
        if (!$gallary->isEmpty()){
            foreach ($gallary as $i=>$row){
                $gallary[$i]['albums'] = Gallary::where('user_id',$row->user_id)->pluck('gallary_img');
            }
        }
        
        if ($request->ajax()) {
            $html = view('frontend._gallery', compact('gallary'))->render();
            return response()->json([
                'count' => $gallary->count(),
                'html' => $html,
            ]);
            exit;
        }
        return view('frontend.gallary', compact('title','gallary'));
    }

    /**
     * Show the application service listings.
     *
     * @return \Illuminate\Http\Response
     */
    public function getServicesPhotos()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getListingDetail($id = '')
    {
        $title="Listing Detail";
        return view('frontend.listing_detail', compact('title'));
    }
}
