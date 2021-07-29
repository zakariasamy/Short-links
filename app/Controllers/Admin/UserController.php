<?php

namespace App\Controllers\Admin;

use App\Models\User;
use Phpmng\Http\Request;
use Phpmng\Session\Session;
use Phpmng\Validation\Validate;

class UserController
{

    /**
     * Show all users
     * 
     * @ return view
     */

    public function index()
    {

        $users = User::get();

        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Create new User
     * 
     * @return view
     */

    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store new user
     *
     * @return redirect
     */
    public function store()
    {
        Validate::validate([
            'first_name' => 'required|min:3|max:30',
            'last_name' => 'required|min:3|max:30',
            'user_name' => 'required|min:3|max:30|unique:users,user_name',
            'password' => 'required|min:6|max:50',
        ], false);

        User::insert([
            'first_name' => Request::post('first_name'),
            'last_name' => Request::post('last_name'),
            'user_name' => Request::post('user_name'),
            'password' => password_hash(Request::post('password'), PASSWORD_BCRYPT)
        ]);

        Session::set('message', "The user is created successfully");
        return redirect(url('admin/users'));
    }

    /**
     * Edit user by the given id
     *
     * @param string $id
     * @return view
     */
    public function edit($id) {
        $user = User::where('id', '=', $id)->first();
        if (! $user) {
            Session::set('message', 'The user is not found');
            return redirect(url('admin/users'));
        }

        $title = "Edit " . $user->first_name;
        return view('admin.users.edit', ['user' => $user, 'title' => $title]);
    }

    /**
     * Update current user
     *
     * @param string $id
     * @return redirect
     */
    public function update($id) {
        $user = User::where('id', '=', $id)->first();
        if (! $user) {
            Session::set('message', 'The user is Not found');
            return redirect(url('admin/users'));
        }

        Validate::validate([
            'first_name' => 'required|min:3|max:30',
            'last_name' => 'required|min:3|max:30',
            'user_name' => 'required|min:3|max:30|unique:users,user_name,'.$user->user_name,
            'password' => 'min:6|max:50',
        ], false);

        $data = [
            'first_name' => Request::post('first_name'),
            'last_name' => Request::post('last_name'),
            'user_name' => Request::post('user_name')
        ];
        $data = (Request::post('password')) ? array_merge($data, ['password' => password_hash(Request::post('password'), PASSWORD_BCRYPT)]) : $data;

        User::where('id', '=', $id)->update($data);

        Session::set('message', "The user has been updated successfully");
        return redirect(url('admin/users'));
    }

    /**
     * Delete existing user
     *
     * @param string $id
     * @return \Phplite\Url\Url
     */
    public function delete($id) {
        $user = User::where('id', '=', $id)->first();
        if (! $user) {
            Session::set('message', 'The user is not found');
            return redirect(url('admin/users'));
        }

        User::where('id', '=', $id)->delete();
        Session::set('message', 'The user has been deleted successfully');
        return redirect(url('admin/users'));
    }

}
