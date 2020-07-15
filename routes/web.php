<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post("login", "AuthController@login");

$router->post("adduser", "UsersController@adduser");

$router->group(['middleware' => 'login'], function () use ($router) {
    $router->post("getallusers", "UsersController@getallusers");
    $router->post("getuser/{id}", "UsersController@getuser");
    $router->post("changepassword/{id}", "UsersController@changepassword");
    $router->post("deleteuser/{id}", "UsersController@deleteuser");

    $router->post("addbooking", "BookingController@addbooking");
    $router->post("upload", "BookingController@upload");
    $router->get("getallbooking", "BookingController@getallbooking");
    $router->get("getbooking/{id}", "BookingController@getbooking");
    $router->post("editbooking/{id}", "BookingController@editbooking");
    $router->post("deletebooking/{id}", "BookingController@deletebooking");
    $router->post("completebooking/{id}", "BookingController@completebooking");
    $router->get("getallcompletebooking", "BookingController@getallcompletebooking");
    $router->post("report", "BookingController@report");
});
