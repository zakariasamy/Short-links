<?php
namespace App\Middleware;

use Phpmng\URL\URL;
use App\Models\Admin;
use Phpmng\Cookie\Cookie;
use Phpmng\Session\Session;

class AuthAdmin{

    public static function handle(){
        /**
         *  Check if there's Session with key 'admin'
         *  if there get it, IF Not get the Cookie with key 'admin'
         */
        $auth = Session::get('admin') ?: Cookie::get('admin');
        
        if(! $auth){
            redirect(URL::redirect('/admin/login'));
        }
        $admin = Admin::where('id', '=', $auth)->first();

        if(!$admin)
            redirect(URL::redirect('/admin/login'));

    }
}