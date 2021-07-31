<?php

use Phpmng\Router\Route;

// Home page
Route::get('/', 'Front\HomeController@index');

// Save link
Route::post('/links/store', 'Front\LinkController@store');

// Redirect link to the original url
Route::get('/link/{link}', 'Front\LinkController@redirect');


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

    // Delete link
    Route::post('/link/{id}/delete', 'Front\LinkController@delete');

    // Logout
    Route::post('/logout','Front\AuthController@logout');

});