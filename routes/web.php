<?php

use App\CacheInterface;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\Category as CategoryResource;
use App\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// Auth routes
Route::middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/reservation', 'ReservationController@view');
    Route::get('/material', 'MaterialController@view');
});

// Auth and Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/material', 'MaterialController@adminView');
});

/*
|--------------------------------------------------------------------------
| Resource Routes
|--------------------------------------------------------------------------
| Restful API
|
*/

// Auth routes
Route::prefix('resources')->middleware('auth')->group(function () {
    // user
    Route::get('/me', function () {
        return Auth::user();
    });

    // categories
    Route::get('/categories', 'CategoryController@index');

    // materials
    Route::get('/materials', 'MaterialController@index');
});

// Auth and Admin routes
Route::prefix('resources')->middleware(['auth', 'admin:api'])->group(function () {
    Route::apiResources([
        'categories' => 'CategoryController',
        'materials' => 'MaterialController',
    ]);

    // Test route
    Route::post('/test', function(Request $request) {
        Controller::debug($request);
    });
});