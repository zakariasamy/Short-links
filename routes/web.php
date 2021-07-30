<?php

use Phpmng\Router\Route;

// Home page
Route::get('/', 'Front\HomeController@index');

// Save link
Route::post('/links/store', 'Front\LinkController@store');

Route::middleware('GuestUser', function(){
    // Login
    Route::get('/login', 'Front\AuthController@login'); // Show form
    Route::post('/login', 'Front\AuthController@checkLogin');

    // Register
    Route::get('/register', 'Front\AuthController@register'); // Show form
    Route::post('/register', 'Front\AuthController@checkRegister');
});

Route::middleware('AuthUser', function(){
    // Show user links
    Route::get('/my-links', 'Front\LinkController@myLinks');

    // Logout
    Route::post('/logout','Front\AuthController@logout');

});