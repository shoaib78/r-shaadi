<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController;;
use App\Setting;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;
class SettingsController extends AdminController
{
    public function __construct()
    {
    }
    /*
* Display a listing of the resource.
*
* @return Response
*/
    public function index()
    {
        // Show the page
        if(!Session::has('social_setting') && !Session::has('contact_setting')){
            Session::flash('footer_setting', TRUE);
        }
        $title = 'Settings';
        $settings = Setting::get();
        $data = array();
        foreach($settings as $setting){
            $data[$setting->key] = $setting->value;
        }
        $SETTINGS = (object) $data;
        return view('admin.settings', compact('title','SETTINGS'));
    }
    /*
* Store general setting.
*
* @return Response
*/
    public function store( Storage $storage, Request $request)
    {
    
        Session::flash('footer_setting', TRUE);
        $input = $request->all();
        $settings['site_footer_text'] = ($request->has('site_footer_text')) ? $input['site_footer_text'] : NULL;
        $settings['copyright'] = ($request->has('copyright')) ? $input['copyright'] : NULL;
        foreach ($settings as $key => $val) {
            if(Setting::where('key', $key)->exists()){
                $insert = Setting::where('key', $key)->update(
                    ['key' => $key,'value' => $val,]
                );
            }else{
                $insert = Setting::create(
                    ['key' => $key,'value' => $val,]
                );
            }
        }
        if($insert){
            return redirect('admin/settings')->with('general_setting_success', 'Settings have been updated Successfully!!!');
        }else{
            return redirect('admin/settings')->with('general_setting_error', 'Sorry, some error found. please try again after sometimes.');
        }
    }
    /*
* Store general setting.
*
* @return Response
*/
    public function save_social_url(Request $request)
    {
        Session::flash('social_setting', TRUE);
        $input = $request->all();
        $settings['fb_url'] = ($request->has('fb_url')) ? $input['fb_url'] : NULL;
        $settings['twitter_url'] = ($request->has('twitter_url')) ? $input['twitter_url'] : NULL;
        $settings['linkedin_url'] = ($request->has('linkedin_url')) ? $input['linkedin_url'] : NULL;
        $settings['gplus_url'] = ($request->has('gplus_url')) ? $input['gplus_url'] : NULL;
        $settings['snapchat_url'] = ($request->has('snapchat_url')) ? $input['snapchat_url'] : NULL;
        $settings['instagram_url'] = ($request->has('instagram_url')) ? $input['instagram_url'] : NULL;
        foreach ($settings as $key => $val) {
            if(Setting::where('key', $key)->exists()){
                $insert = Setting::where('key', $key)->update(
                    ['key' => $key,'value' => $val,]
                );
            }else{
                $insert = Setting::create(
                    ['key' => $key,'value' => $val,]
                );
            }
        }
        if($insert){
            return redirect('admin/settings')->with('social_setting_success', 'Social url have been updated Successfully.');
        }else{
            return redirect('admin/settings')->with('social_setting_error', 'Sorry, some error found. please try again after sometimes.');
        }
    }

    public function save_contact_setting(Request $request)
    {
        $messages = array(
            'contact_email' => 'Please enter contact email',
            'contact_location' => 'Please enter contact location',
            'contact_phone' => 'Please enter contact phone number',
        );
        $rules = array(
            'contact_email' => 'required|email|max:255',
            'contact_location' => 'required',
            'contact_phone' => 'required',
        );
        Session::flash('contact_setting', TRUE);

        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('admin/pages')
                ->withErrors($validator)
                ->withInput();
        }
        $input = $request->all();
        $settings['contact_email'] = ($request->has('contact_email')) ? $input['contact_email'] : NULL;
        $settings['contact_location'] = ($request->has('contact_location')) ? $input['contact_location'] : NULL;
        $settings['contact_lat'] = ($request->has('contact_lat')) ? $input['contact_lat'] : NULL;
        $settings['contact_long'] = ($request->has('contact_long')) ? $input['contact_long'] : NULL;
        $settings['contact_phone'] = ($request->has('contact_phone')) ? $input['contact_phone'] : NULL;

        foreach ($settings as $key => $val) {
            if(Setting::where('key', $key)->exists()){
                $insert = Setting::where('key', $key)->update(
                    ['key' => $key,'value' => $val,]
                );
            }else{
                $insert = Setting::create(
                    ['key' => $key,'value' => $val,]
                );
            }
        }
        if($insert){
            return redirect('admin/pages')->with('contact_setting_success', 'Contact Settings have been updated Successfully!!!');
        }else{
            return redirect('admin/pages')->with('contact_setting_error', 'Sorry, some error found. please try again after sometimes.');
        }
    }
    /**
     * @param $image
     * @param $imageFullName
     * @param $storage
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function uploadImage( $image, $imageFullName, $storage )
    {
        $filesystem = new Filesystem;
        return $storage->disk( 'uploads' )->put( $imageFullName, $filesystem->get( $image ) );
    }
    /**
     * @param $timestamp
     * @param $image
     * @return string
     */
    protected function getSavedImageName( $timestamp, $image )
    {
        $ext = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
        return $timestamp .rand(0,999999).'.'.$ext;
    }
}
