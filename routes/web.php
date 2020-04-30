<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post("/login", "AuthController@login");

$router->post("/adduser", "UsersController@adduser");
$router->post("/getallusers", "UsersController@getallusers");
$router->post("/getuser/{id}", "UsersController@getuser");
$router->post("/changepassword/{id}", "UsersController@changepassword");
$router->post("/deleteuser/{id}", "UsersController@deleteuser");

$router->post("/addbooking", "BookingController@addbooking");
$router->post("/upload", "BookingController@upload");
$router->post("/getallbooking", "BookingController@getallbooking");
$router->post("/getbooking/{id}", "BookingController@getbooking");
$router->post("/editbooking/{id}", "BookingController@editbooking");
$router->post("/deletebooking/{id}", "BookingController@deletebooking");
$router->post("/completebooking/{id}", "BookingController@completebooking");
$router->post("/getallcompletebooking", "BookingController@getallcompletebooking");
