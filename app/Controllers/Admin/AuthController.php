<?php
namespace App\Controllers\Admin;

use App\Models\Admin;
use Phpmng\Http\Request;
use Phpmng\Cookie\Cookie;
use Phpmng\Session\Session;
use Phpmng\Validation\Validate;

class AuthController{
    
    // Show login view
    public function login(){
        return view('admin.auth.login');
    }
    
    // check if login data is correct
    public function checkLogin(){

        Validate::validate([
            'user_name' => 'required|min:4|max:100',
            'password' => 'required|min:6|max:100',
            'remember' => 'in:on',
        ], false);
        
        $admin = Admin::where('user_name', '=', Request::post('user_name'))->first();
        if (! $admin) {
            Session::set('message', 'The user is not found');
            Session::set('old', Request::all());
            return redirect(previous());
        }

 
        if (! password_verify(Request::post('password'), $admin->password)) {
            Session::set('message', 'The Password is wrong');
            Session::set('old', Request::all());
            return redirect(previous());
        }

        Request::post('remember') == 'on' ? Cookie::set('admin', $admin->id) : Session::set('admin', $admin->id);
        return redirect(url('/admin/dashboard'));
    }

}