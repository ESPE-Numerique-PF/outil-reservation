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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

/*
|--------------------------------------------------------------------------
|                               USER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth.basic','admin:api'])->get('/users', function (Request $request) {
    return UserResource::collection(User::paginate());
});

Route::middleware(['auth.basic','admin:api'])->get('/users/{id}', function (Request $request) {
    return new UserResource(User::find($request->id));
});

/*
|--------------------------------------------------------------------------
|                              MATERIAL
|--------------------------------------------------------------------------
*/

Route::middleware('auth.basic')->get('/materials', function (Request $request) {
    return MaterialResource::collection(Material::paginate());
});

Route::middleware('auth.basic')->get('/materials/{id}', function (Request $request) {
    return new MaterialResource(Material::find($request->id));
});