<?php 

use Library\Router;

Router::get('/', 'indexController@index');
Router::get('/user', 'UserController@get');
Router::post('/login', 'UserController@login');
Router::post('/logout', 'UserController@logout');
Router::get('/online', 'UserController@online');
Router::put('/update-online', 'UserController@updateOnline');

Router::init();

use Controllers\UserController;

$user = new UserController;