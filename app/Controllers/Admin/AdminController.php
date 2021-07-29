<?php

namespace App\Controllers\Admin;

use App\Models\Admin;
use Phpmng\Http\Request;
use Phpmng\Session\Session;
use Phpmng\Validation\Validate;

class AdminController
{

    /**
     * Show all admins
     * 
     * @ return view
     */

    public function index()
    {

        $admins = Admin::get();

        return view('admin.admins.index', ['admins' => $admins]);
    }

    /**
     * Create new Admin
     * 
     * @return view
     */

    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * Store new admin
     *
     * @return redirect
     */
    public function store()
    {
        Validate::validate([
            'first_name' => 'required|min:3|max:30',
            'last_name' => 'required|min:3|max:30',
            'user_name' => 'required|min:3|max:30|unique:admins,user_name',
            'password' => 'required|min:6|max:50',
        ], false);

        Admin::insert([
            'first_name' => Request::post('first_name'),
            'last_name' => Request::post('last_name'),
            'user_name' => Request::post('user_name'),
            'password' => password_hash(Request::post('password'), PASSWORD_BCRYPT)
        ]);

        Session::set('message', "The admin is created successfully");
        return redirect(url('admin/admins'));
    }

    /**
     * Edit admin by the given id
     *
     * @param string $id
     * @return view
     */
    public function edit($id) {
        $admin = Admin::where('id', '=', $id)->first();
        if (! $admin) {
            Session::set('message', 'The admin is not found');
            return redirect(url('admin/admins'));
        }

        $title = "Edit " . $admin->first_name;
        return view('admin.admins.edit', ['admin' => $admin, 'title' => $title]);
    }

    /**
     * Update current admin
     *
     * @param string $id
     * @return redirect
     */
    public function update($id) {
        $admin = Admin::where('id', '=', $id)->first();
        if (! $admin) {
            Session::set('message', 'The admin is Not found');
            return redirect(url('admin/admins'));
        }

        Validate::validate([
            'first_name' => 'required|min:3|max:30',
            'last_name' => 'required|min:3|max:30',
            'user_name' => 'required|min:3|max:30|unique:admins,user_name,'.$admin->user_name,
            'password' => 'min:6|max:50',
        ], false);

        $data = [
            'first_name' => Request::post('first_name'),
            'last_name' => Request::post('last_name'),
            'user_name' => Request::post('user_name')
        ];
        $data = (Request::post('password')) ? array_merge($data, ['password' => password_hash(Request::post('password'), PASSWORD_BCRYPT)]) : $data;

        Admin::where('id', '=', $id)->update($data);

        Session::set('message', "The admin has been updated successfully");
        return redirect(url('admin/admins'));
    }

    /**
     * Delete existing admin
     *
     * @param string $id
     * @return redirect
     */
    public function delete($id) {
        $admin = Admin::where('id', '=', $id)->first();
        if (! $admin) {
            Session::set('message', 'The admin is not found');
            return redirect(url('admin/admins'));
        }

        Admin::where('id', '=', $id)->delete();
        Session::set('message', 'The admin has been deleted successfully');
        return redirect(url('admin/admins'));
    }

}
