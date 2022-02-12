<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Dusterio\LumenPassport\Http\Controllers\AccessTokenController;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;

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

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function($api) {
    $api->group(['prefix' => 'oauth'], function ($api){
        $api->post('token', AccessTokenController::class . '@issueToken');
    });

    $api->group(['namespace' => 'App\Http\Controllers', 'middleware' => ['auth:api', 'cors']], function ($api){
        $api->get('users', 'UserController@index');
        $api->post('users', 'UserController@create');
        $api->get('users/me', 'UserController@currentUser');

        $api->get('news', 'NewsController@index');
        $api->get('complaints', 'ComplaintController@index');
    });
});
