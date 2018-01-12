<?php
namespace App\Http\Controllers\Site;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
	public function __construct()
    {
        $this->middleware('guest');
        $category = Category::orderBy('category_name', 'ASC')->get();
        view()->share('category', $category);
    }
}