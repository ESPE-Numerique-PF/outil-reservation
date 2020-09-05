<?php

use App\Http\Resources\User as UserResource;
use App\Http\Resources\Admin\User as AdminUserResource;
use App\Http\Resources\Category as CategoryResource;
use App\Category;
use App\User;
use Illuminate\Http\Request;
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

Route::middleware(['auth.basic','admin:api'])->group(function () {
    // User
    Route::get('/users', function () {
        return AdminUserResource::collection(User::paginate());
    });
    Route::get('/users/{id}', function ($id) {
        return new AdminUserResource(User::find($id));
    });

    // Category
    Route::post('/categories', function () {
        return [Auth::user()];
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
        return new UserResource($request->user());
    });

    // categories
    Route::get('/categories', function () {
        return CategoryResource::collection(Category::paginate());
    });
});
