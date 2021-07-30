<?php
namespace App\Middleware;

use Phpmng\URL\URL;
use App\Models\Admin;
use Phpmng\Cookie\Cookie;
use Phpmng\Session\Session;

class GuestAdmin{

    public static function handle(){
       // dd('aa');

        /**
         *  Check if there's Session with key 'admin'
         *  if there get it, IF Not get the Cookie with key 'admin'
         */
        $auth = Session::get('admins') ?: Cookie::get('admins');
        
        if($auth){
            $admin = Admin::where('id', '=', $auth)->first();

            if($admin) 
                redirect('/admin/dashboard');
            
        }
    }
}