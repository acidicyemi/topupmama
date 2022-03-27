<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\BooksController;

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
    return response()->json([
        "version" => $router->app->version()
    ]);
});

$router->group(["prefix" => "/api/v1/books"], function () use ($router) {
    $router->get('/', ['as' => 'listBooks', 'uses' => 'BooksController@listBooks']);
    $router->post('/addComment', ['as' => 'listBooks', 'uses' => 'BooksController@addComment']);
});
