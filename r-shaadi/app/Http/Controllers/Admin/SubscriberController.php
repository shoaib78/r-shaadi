<?php

namespace App\Http\Controllers\Admin;
use App\Subscriber;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Datatables;

class SubscriberController extends AdminController
{

    public function __construct()
    {
        view()->share('type', 'subscribers');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $title = "Manage Subscribers";
        return view('admin.subscribers',  compact('title'));
    }

    public function delete($id,Request $request)
    {
        $subscriber = Subscriber::find($id);
        if($request->isXmlHttpRequest() && !empty($id)){
            $subscriber->delete();
            return json_encode(array('error'=>FALSE));
        }else{
            return json_encode(array('error'=>TRUE,'msg'=>'Sorry, some error are found.'));
        }
        exit;
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $subscriber =  Subscriber::select(array('subscribers.*'))->get()
                ->map(function ($subscriber) {
                return [
                    'subscriber' => !empty($subscriber->email) ? $subscriber->email : 'NA',
                    'created_at' => $subscriber->created_at->format('d-F-Y'),
                    'action' => '<a href="'.url('admin/subscriber_delete/' . $subscriber->id).'" class="btn btn-sm btn-danger delete_subscriber"><span class="glyphicon glyphicon-trash"></span> Delete</a>',
                    'id' => $subscriber->id,
                ];
            });
        return Datatables::of($subscriber)
            ->remove_column('id')
            ->make(true);
    }
}
