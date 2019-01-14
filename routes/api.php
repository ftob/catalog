<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/** @var Dingo\Api\Routing\Router $api */
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function (Dingo\Api\Routing\Router $api) {
    $api->resource('categories', App\Http\Controllers\CategoriesController::class,['only' => ['index', 'show']]);
    $api->resource('items', App\Http\Controllers\ItemsController::class, ['only' => ['index', 'show']]);


    $api->group(['middleware' => 'auth:api', 'bindings'], function (Dingo\Api\Routing\Router $api) {
        $api->resource('categories', \App\Http\Controllers\CategoriesController::class, ['except' => ['index', 'edit', 'show']]);
        $api->resource('items', \App\Http\Controllers\ItemsController::class, ['except' => ['index', 'edit', 'show']]);
        $api->get('user', \App\Http\Controllers\UserController::class . '@index');

    });
});
