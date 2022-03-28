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
    $router->get('/', ['as' => 'book.list', 'uses' => 'BooksController@listBooks']);
    $router->get('/{bookId}/getComments', ['as' => 'book.getComments', 'uses' => 'BooksController@getComments']);
    $router->get('/{bookId}/getCharacters', ['as' => 'book.getCharacters', 'uses' => 'BooksController@getCharacters']);
    $router->post('/{bookId}/addComment', ['as' => 'book.addComment', 'uses' => 'BooksController@addComment']);
});
