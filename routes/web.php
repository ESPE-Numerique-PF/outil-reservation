<?php

use App\Http\Controllers\Controller;
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
    Route::get('/admin/category', 'CategoryController@adminView');

    // Test route
    Route::get('/admin/test', function() {
        return view('admin.test');
    });
});

/*
|--------------------------------------------------------------------------
| Resource Routes
|--------------------------------------------------------------------------
| Restful API
|
*/

// Auth routes
Route::prefix('resources')->middleware(['auth'])->group(function () {
    // user
    Route::get('/me', function () {
        return Auth::user();
    });

    Route::get('/categories', 'CategoryController@index');
    Route::get('/materials', 'MaterialController@index');
});

// Auth and Admin routes    
Route::prefix('resources')->middleware(['auth', 'admin:api'])->group(function () {

    // additionnal routes that Route::apiResources() does not include (see below)
    Route::post('categories/move', 'CategoryController@move');

    // routes including controller methods index, store, show, update and destroy
    Route::apiResources([
        'categories' => 'CategoryController',
        'materials' => 'MaterialController',
    ]);
});