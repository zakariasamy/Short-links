<?php
namespace App\Controllers\Admin;

class DashboardController{

    public function index(){
        return auth('admins');
        return "Dashboard";
    }
}