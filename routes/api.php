<?php

use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use App\User;
use Illuminate\Http\Client\Request as ClientRequest;
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
    Route::get('/users', function () {
        return UserResource::collection(User::paginate());
    });
    Route::get('/users/{id}', function ($id) {
        return new UserResource(User::find($id));
    });

    Route::apiResources([
        "categories" => "CategoryController",
        "materials" => "MaterialController",
    ]);

    Route::post('/test', function(Request $request) {
        Controller::debug('test');
        Controller::debug($request->all());
    });
});


/*
|--------------------------------------------------------------------------
|                              USER ROLE
|--------------------------------------------------------------------------
*/

Route::middleware('auth.basic')->group(function () {

});
