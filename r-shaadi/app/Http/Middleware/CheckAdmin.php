<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckAdmin
{
    public function handle($request, Closure $next)
    {
        
       
        if(!empty(auth()->guard('admin')->id()))
        {
            $data = DB::table('admin')
                    ->select('admin.isAdmin','admin.id')
                    ->where('admin.id',auth()->guard('admin')->id())
                    ->get();
            
            if (!$data[0]->id  && $data[0]->usertype != 'W')
            {
                return redirect()->intended('admin/login/')->with('status', 'You do not have access to admin side');
            }
            return $next($request);
        }
        else 
        {
            return redirect()->intended('admin/login/')->with('status', 'Please Login to access admin area');
        }
        
         
    }
}
