<?php

namespace App\Http\Controllers;
use App\Category;
use App\Slider;
use App\User;
use App\Setting;
use App\Featured_vendors;
use App\Local_vendor_content;
use App\User_comment;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        $title="Home";
        $category = Category::orderBy('category_name', 'ASC')->get();
        $slider = Slider::orderBy('order', 'ASC')->pluck('image');
        $local_vendors =  Local_vendor_content::select('*')->take(6)->get()->toArray();
        $featured_vendors =  Featured_vendors::select('*')->take(6)->get()->toArray();
        $user_comments =  User_comment::select('*')->take(3)->get()->toArray();
        return view('home', compact('title', 'category','slider','local_vendors','featured_vendors','user_comments'));
    }
}
