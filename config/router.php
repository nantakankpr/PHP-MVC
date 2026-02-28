<?php

use App\Core\Router;

//Dashboard routes
Router::get('/', 'DashboardController@index');
Router::get('/dashboard', 'DashboardController@index');
Router::get('/management', 'ManagementController@index');
Router::get('/service', 'ServiceController@index');
Router::get('/setting', 'SettingController@index');


//Auth routes
Router::get('/login', 'AuthController@index');
Router::post('/api/login', 'AuthController@login');
Router::get('/api/logout', 'AuthController@logout');
Router::post('/api/addMember', 'AuthController@addMember');