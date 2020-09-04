<?php

use App\Http\Resources\User as UserResource;
use App\Material;
use App\User;
use App\Http\Resources\Material as MaterialResource;
use Illuminate\Http\Request;
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

Route::middleware(['auth.basic','admin:api'])->group(function () {
    // User
    Route::get('/users', function (Request $request) {
        return UserResource::collection(User::paginate());
    });
    Route::get('/users/{id}', function (Request $request) {
        return new UserResource(User::find($request->id));
    });
});


/*
|--------------------------------------------------------------------------
|                              USER ROLE
|--------------------------------------------------------------------------
*/

Route::middleware('auth.basic')->group(function () {
    // User
    Route::get('/user', function (Request $request) {
        return new UserResource(User::find($request->user()->id));
    });
});
