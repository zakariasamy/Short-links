<?php
namespace App\Controllers\Admin;

use Phpmng\Cookie\Cookie;


class DashboardController{

    public function index(){

        return view('admin.dashboard.index');
        return auth('admins');
        return "Dashboard";
    }
}