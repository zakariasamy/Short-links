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


    /**
     * Redirect short-url to the original url
     * 
     * @return redirect
     */
    public function redirect($shortLink){

        $link = Link::where('short_url', '=', $shortLink)->first();

        if(!$link) // The link dosen't exist
            return view('errors.404');
        
        // Update the number of clicks
        Link::where('id', '=', $link->id)->update(['clicks' => ++$link->clicks]);
        redirect($link->full_url);
    }


    /**
     * Show all links
     * 
     * @return view
     */
    public function myLinks(){
        $auth = auth('users');
        $links = Link::where('user_id', '=', $auth->id)->paginate(1);
        return view('front.links.index', ['links' => $links]);
    }

    /**
     * Delete Link by id
     * 
     * @param id
     * @return redirect
     */
    public function delete($id){

        $auth = auth('users');
        $link = Link::where('id', '=', $id)->where('user_id', '=', $auth->id)->first();

        if(!$link){
            Session::set('message', 'The link is Not Found');
            return redirect('/my-links');
        }
        Link::where('id', '=', $link->id)->delete();
        Session::set('message', 'The link has been deleted successfully');
        return redirect('/my-links');

    }
}