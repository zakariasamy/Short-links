<?php

use Phpmng\Router\Route;

Route::prefix('admin', function(){

    /**
     * Guest ( Not Authenticated ) Admin Routes
     * these routes useful to make unauthenticated admins login
    */ 
    Route::middleware('GuestAdmin', function() {
        // Login
        Route::get('/login', 'Admin\AuthController@login');
        Route::post('/login', 'Admin\AuthController@checkLogin');
    });

    // Auth ( Authenticated ) Admin Routes
    Route::middleware('AuthAdmin', function() {
        // Dashboard
        Route::get('/dashboard', 'Admin\DashboardController@index');

        // Logout
        Route::post('/logout', 'Admin\AuthController@logout');

        // Admins resource
        Route::get('/admins', 'Admin\AdminController@index');
        Route::get('/admins/create', 'Admin\AdminController@create');
        Route::post('/admins/store', 'Admin\AdminController@store');
        Route::get('/admins/{id}/edit', 'Admin\AdminController@edit');
        Route::post('/admins/{id}/update', 'Admin\AdminController@update');
        Route::post('/admins/{id}/delete', 'Admin\AdminController@delete');

        // Users resource
        Route::get('/users', 'Admin\UserController@index');
        Route::get('/users/create', 'Admin\UserController@create');
        Route::post('/users/store', 'Admin\UserController@store');
        Route::get('/users/{id}/edit', 'Admin\UserController@edit');
        Route::post('/users/{id}/update', 'Admin\UserController@update');
        Route::post('/users/{id}/delete', 'Admin\UserController@delete');

        // Links resource
        Route::get('/links', 'Admin\LinkController@index');
        Route::post('/links/{id}/delete', 'Admin\LinkController@delete');


    });



});