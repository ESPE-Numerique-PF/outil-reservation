<?php

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\UserResource;
use App\Material;
use App\Services\NestedService;
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

Route::middleware(['auth.basic', 'admin:api'])->group(function () {
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
        "material_instances" => "MaterialInstanceController",
    ]);

    // tmp
    Route::get('/test', function (Request $request) {
        // TODO handle empty / null categories parameter
        $categoriesId = [4];

        // get filtered materials
        $materials = Material::select('id', 'name')
            ->filterByCategoriesId($categoriesId)
            ->get();

        return $materials;
    });
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
