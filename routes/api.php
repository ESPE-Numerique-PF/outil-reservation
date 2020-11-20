<?php

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

/*
|--------------------------------------------------------------------------
|                               ADMIN ROLE
|--------------------------------------------------------------------------
*/

Route::middleware(['auth.basic', 'admin:api'])->group(function () {
    // User
    Route::get('/users', function () {
        return UserResource::collection(User::paginate());
    });
    Route::get('/users/{id}', function ($id) {
        return new UserResource(User::find($id));
    });

    // additionnal routes
    Route::post('/materials/filter', 'MaterialController@index');
    Route::post('/material_instances/filter', 'MaterialInstanceController@index');

    // api resource routes
    Route::apiResources([
        "categories" => "CategoryController",
        "materials" => "MaterialController",
        "material_instances" => "MaterialInstanceController",
    ]);
});


/*
|--------------------------------------------------------------------------
|                              USER ROLE
|--------------------------------------------------------------------------
*/

Route::middleware('auth.basic')->group(function () {
    Route::get('/me', function () {
        return Auth::user();
    });
});
