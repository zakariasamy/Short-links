<?php
namespace App\Controllers\Front;

use App\Models\User;
use Phpmng\Http\Request;
use Phpmng\Cookie\Cookie;
use Phpmng\Session\Session;
use Phpmng\Validation\Validate;

class AuthController{

    /**
     * Show Login Form
     * 
     * @return view
     */

     public function login(){
         return view('front.auth.login');
     }


     /**
      * Check on login data
      * 
      * @return redirect
      */
     public function checkLogin(){
        Validate::validate([
            'user_name' => 'required|min:4|max:100',
            'password' => 'required|min:6|max:100',
            'remember' => 'in:on',
        ], false);
        
        $user = User::where('user_name', '=', Request::post('user_name'))->first();
        if (! $user) {
            Session::set('message', 'The user is not found');
            Session::set('old', Request::all());
            return redirect(previous());
        }

 
        if (! password_verify(Request::post('password'), $user->password)) {
            Session::set('message', 'The Password is wrong');
            Session::set('old', Request::all());
            return redirect(previous());
        }

        Request::post('remember') == 'on' ? Cookie::set('users', $user->id) : Session::set('users', $user->id);
        return redirect(url('/'));
     }
    /**
     * Show Login Form
     * 
     * @return view
     */

     public function register(){
         return view('front.auth.register');
     }


    /**
     * Check on register data
     * 
     * @return redirect
     */

     public function CheckRegister(){
        Validate::validate([
            'user_name' => 'required|min:4|max:50',
            'password' => 'required|min:6|max:50',
            'user_name' => 'required|min:6|max:50|unique:users,user_name',
            'remember' => 'in:on',
        ], false);

        $user = User::insert([
            'first_name' => Request::post('first_name'),
            'last_name' => Request::post('last_name'),
            'user_name' => Request::post('user_name'),
            'password' => password_hash(Request::post('password'), PASSWORD_BCRYPT)
        ]);

        Session::set('users', $user->id);
        return redirect('/');


     }


     public function logout(){
         Cookie::remove('users');
         Session::remove('users');
         return redirect('/');
     }
}