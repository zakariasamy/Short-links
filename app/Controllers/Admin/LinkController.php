<?php

namespace App\Controllers\Admin;

use App\Models\Link;
use App\Models\User;
use Phpmng\Session\Session;
use Phpmng\Database\Database;

class LinkController
{

    /**
     * Show all links
     * 
     * @ return view
     */

    public function index()
    {
        $links = Link::join('users', 'user_id', '=', 'id')->get();
        
        return view('admin.links.index', ['links' => $links]);
    }



    /**
     * Delete existing link
     *
     * @param string $id
     * @return redirect
     */
    public function delete($id) {
        $link = Link::where('id', '=', $id)->first();
        if (! $link) {
            Session::set('message', 'The link is not found');
            return redirect(url('admin/links'));
        }

        Link::where('id', '=', $id)->delete();
        Session::set('message', 'The link has been deleted successfully');
        return redirect(url('admin/links'));
    }

}
