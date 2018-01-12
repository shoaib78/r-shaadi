<?php
namespace App\Http\Controllers\Site;
use App\Page;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
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
     * Show the pages content.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $slug = $slug;
        if($slug != ""){
            $content = Page::where('slug', $slug)->first();
            $title = isset($content->title) &&  !empty($content->title)? $content->title : '';
            return view('frontend.page', compact('content','title'));
        }else{

        }
    }
}
