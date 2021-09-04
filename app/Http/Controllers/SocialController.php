<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Socialite;
use App\Models\Customer;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->user();
        //dd($getInfo);
        $user = $this->createUser($getInfo,$provider); 
        auth('customer')->login($user); 
        session_start();
        /*session is started if you don't write this line can't use $_Session  global variable*/
        $_SESSION["id"]=$user['id'];
        $_SESSION["name"]=$user['name'];
        
        return redirect()->route('home.profile')->with([ 'level' => 'success',
            'toastr' => 'Đăng nhập thành công'
        ]);
    }
    function createUser($getInfo,$provider){
        $user = Customer::where('provider_id', $getInfo->id)->first();
        if (!$user) {
            $users_id = Customer::where('provider_id', $getInfo->id)->first();
        } 
        if(empty($user) && empty($users_id))
        {
            $user = Customer::create([
                'user_name'     => $getInfo->name,
                'email_social'    => $getInfo->email,
                'provider' => $provider,
                'provider_id' => $getInfo->id,
                'image' => $getInfo->avatar,
                'status' => 1
            ]);
        }
        return $user;

    }
}