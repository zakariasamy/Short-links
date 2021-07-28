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


    });



});