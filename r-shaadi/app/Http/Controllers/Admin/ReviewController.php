<?php

namespace App\Http\Controllers\Admin;
use App\Review;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Datatables;

class ReviewController extends AdminController
{

    public function __construct()
    {
        view()->share('type', 'reviews');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $title = "Manage Slider Review";
        return view('admin.review',  compact('title'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function reviews($id)
    {
        if($id !=''){
            $title = "Manage Slider Review";
            $reviewId = $id;
            return view('admin.review',  compact('title','reviewId'));
        }else{
            return Redirect::back();
        }
    }

    public function delete($id,Request $request)
    {
        $review = Review::find($id);
        if($request->isXmlHttpRequest() && !empty($id)){
            $review->delete();
            return json_encode(array('error'=>FALSE));
        }else{
            return json_encode(array('error'=>TRUE,'msg'=>'Sorry, some error are found.'));
        }
        exit;
    }

    /**
     * Change review status.
     *
     * @param $review $id
     * @return Response
     */
    public function status($id, Request $request)
    {
        $review = Review::find($id);
        if($review->approved == 1){
            $review->approved = 0;
        }else{
            $review->approved = 1;
        }
        $review->save();
        return response()->json(array('error'=>FALSE,'review'=>$review->approved));
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data($id)
    {
        if($id !=''){
            $reviews =  Review::join('users as u', 'u.id', '=', 'reviews.review_by')
                ->join('users as vendor', 'vendor.id', '=', 'reviews.review_for')
                ->select(array('reviews.*','u.id as user_id', 'u.firstname','u.lastname','vendor.id as vendor_id', 'vendor.firstname as vendor_firstname','vendor.lastname as vendor_lastname'))
                ->where('reviews.review_for',$id)
                ->orderBy("reviews.id",'DESC')
                ->get()
                ->map(function ($reviews) {
                    return [
                        'review_by' => ($reviews->firstname && $reviews->lastname) ? ucwords($reviews->firstname . " " . $reviews->lastname) : '',
                        'vendor' => ($reviews->vendor_firstname && $reviews->vendor_lastname) ? ucwords($reviews->vendor_firstname . " " . $reviews->vendor_lastname) : '',
                        'anonymous' => (!empty($reviews->anonymous)) ? ucwords($reviews->anonymous): 'NA',
                        'review' => (strlen($reviews->description) > 30) ? substr($reviews->description,0,30).'...' : $reviews->description,
                        'rating' => $reviews->rating,
                        'action' => '<a class="btn btn-primary status" href="'.url('admin/review_status/'  . $reviews->id ).'" data-status='.($reviews->approved==0 ? '1' : '0').'" >'.($reviews->approved==0 ? "Active" : "Deactive").'</a>&nbsp;&nbsp;<a href="'.url('admin/review_delete/' . $reviews->id).'" class="btn btn-sm btn-danger delete_review"><span class="glyphicon glyphicon-trash"></span> Delete</a>',
                        'id' => $reviews->id,
                    ];
                });
            return Datatables::of($reviews)
                ->remove_column('id')
                ->make(true);
        }else{
            return redirect()->intended('/admin/manage_vendors');
        }
    }

    /**
     * Reorder items
     *
     * @param items list
     * @return items from @param
     */
    public function PostReorder(Request $request)
    {
        $lists = $request->orderval;
        $order = 1;
        foreach ($lists as $value) {
            if ($value != '') {
                Review::where('id', '=', $value)->update(array('order' => $order));
                $order++;
            }
        }
        return json_encode($lists);
        exit;
    }

}
