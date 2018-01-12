<?php

namespace App\Providers;
use App\User;
use App\Setting;
use App\Vendor_inforamation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('alpha_spaces', function($attribute, $value)
        {
            return preg_match('/^[\pL\s]+$/u', $value);
        });

        view()->composer('*', function ($view) {
            $user = User::find(auth()->guard('user')->id());
            $user2 = '';
            if(!empty(auth()->guard('user')->id()) && $user->usertype == 2){
                $user2 = Vendor_inforamation::where('user_id', auth()->guard('user')->id())->first();
            }
            $settings = Setting::get();
            $site_settings = array();
            foreach($settings as $setting){
                $site_settings[$setting->key] = $setting->value;
            }
            $view->with(compact('user', 'user2','site_settings'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
