<?php
namespace App\Controllers\API;
use Firebase\JWT\JWT;
use App\Models\User;


class UserController{

    public function index(){
        //dd("aa");
        // dd(getenv('APP_SECRET_KEY'));
        header('Content-Type: application/json'); 
      //  header('Access-Control-Allow-Origin:http://siteA.com'); 
        $users = User::get();
        return ["status" => 200, "data" => $users];
        return $users;
    }
}