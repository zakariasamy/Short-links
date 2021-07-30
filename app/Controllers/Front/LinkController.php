<?php
namespace App\Controllers\Front;

use App\Models\Link;
use Phpmng\Http\Request;
use Phpmng\Http\Response;
use Phpmng\Session\Session;
use Phpmng\Validation\Validate;

class LinkController{

    /**
     * Show home page
     * 
     * @return view
     */
    public function store(){

        $validation =  Validate::validate([
            'full_url' => 'required|min:4|url',
            
        ], true);

        if($validation){ // There's error
            return $validation;
        }

        // Get unique short link dosen't exist in links table
        $short_url = unique('links', 'short_url');

        $data = [
            'short_url' => $short_url,
            'full_url' => Request::post('full_url')
        ];

        // If the user logged in add user_id to the data
        $auth = auth('users');
        $data = $auth ? array_merge($data, ['user_id' => auth('users')->id ] ) : $data;


        $link = Link::insert($data);
        $url = url('link/' . $link->short_url); // url to be returned to the user

        return Response::json(['url' => $url]);


    }
}