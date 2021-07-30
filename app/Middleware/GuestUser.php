<?php
namespace App\Middleware;

use Phpmng\URL\URL;
use App\Models\User;
use Phpmng\Cookie\Cookie;
use Phpmng\Session\Session;

class GuestUser{

    public static function handle(){
        /**
         *  Check if there's Session with key 'admin'
         *  if there get it, IF Not get the Cookie with key 'admin'
         */
        $auth = Session::get('users') ?: Cookie::get('users');

        if($auth){
            $user = User::where('id', '=', $auth)->first();
            if($user)
                redirect(URL::redirect('/'));
        }
        

    }
}