<?php
namespace App\Controllers\Front;

use Phpmng\Session\Session;

class HomeController{

    /**
     * Show home page
     * 
     * @return view
     */
    public function index(){
        return view('front.home.index');
    }
}