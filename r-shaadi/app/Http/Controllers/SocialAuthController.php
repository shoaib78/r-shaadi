<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SocialAccountService;
use Socialite;
use Auth;
class SocialAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(SocialAccountService $service)
    {
        $facebookUser = Socialite::driver('facebook')->user();
        $email = $facebookUser->getEmail();
        $username = $facebookUser->getNickname();
        $name = $facebookUser->getName();
        $img = $facebookUser->getAvatar();
        $iD = $facebookUser->getId();

        if(!empty($name)){
            $res = explode( ' ', $name );
            $firstname = $res[0];
            $lastname = $res[1];
            $username = $res[0];
        }

        if(!empty($facebookUser)) {

            /*if(!empty($img)){
                $arrContextOptions=['ssl'=>['verify_peer'=>false,'verify_peer_name'=>false]];
                $fbUrl = 'https://graph.facebook.com/'.$facebookUser->getId().'/picture?type=small';
                $file = time().rand(0,99999).'.jpg';
                $profile_pic = Image::make(file_get_contents($file, false, stream_context_create($arrContextOptions)))->save('public/uploads/profile'.$file);
            }*/
            
            $profile['email'] = isset($email) ? $email : NULL;

            $profile['username'] = isset($username) ? strtolower($username).rand(0,99999) : "xyz".rand(0,99999);

            $profile['password'] = isset($firstname) ? bcrypt($firstname): bcrypt(rand(0,99999));

            $profile['usertype'] = 1;

            $profile['firstname'] = isset($firstname) ? $firstname : NULL;

            $profile['lastname'] = isset($lastname) ? $lastname : NULL;

            if(!empty($facebookUser->user['gender']) && $facebookUser->user['gender'] == 'male'){
                $profile['gender'] = 1;
            }elseif(!empty($profile['gender']) && $profile['gender'] == 'femail'){
                $profile['gender'] = 2;
            }

            $user = User::where('email', '=', $email)->first();
            if(count($user)>0){
                User::where('email', '=', $email)->update($profile);
            }else{
                $user = User::create($profile);
            }
            //$user = $service->createOrGetUser(Socialite::driver('facebook')->user());
            Auth::guard('user')->login($user);

            return redirect()->to('user/dashboard');
        }else{
            return redirect()->intended('');
        }
    }
}