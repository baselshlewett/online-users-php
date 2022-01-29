<?php 

use Library\Router;

Router::get('/api', 'indexController@index');
Router::get('/api/user', 'UserController@get');
Router::post('/api/login', 'UserController@login');
Router::post('/api/logout', 'UserController@logout');
Router::get('/api/online', 'UserController@online');
Router::put('/api/update-online', 'UserController@updateOnline');

Router::init();