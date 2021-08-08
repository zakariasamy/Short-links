<?php

use Phpmng\Router\Route;

Route::get('/api/users', 'API\UserController@index');