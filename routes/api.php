<?php

use App\Http\Controllers\FavoriteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//todo: Временные методы до интеграции с мобильным разработчиком
Route::get('login', [\App\Http\Controllers\TempController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('main', [\App\Http\Controllers\HomeController::class, 'index']);
    Route::get('feed', [\App\Http\Controllers\FeedController::class, 'show']);
    Route::get('feed/paginate', [\App\Http\Controllers\FeedController::class, 'paginate']);
    Route::get('search', [\App\Http\Controllers\FeedController::class, 'search']);


    Route::get('essences/paginate', [\App\Http\Controllers\EssenceController::class, 'paginate']);
    Route::get('essences/{essence}', [\App\Http\Controllers\EssenceController::class, 'show']);
    Route::get('essences/{essence}/sub-essences/paginate', [\App\Http\Controllers\SubEssenceController::class, 'paginate']);
    Route::get('essences/{essence}/sub-essences/{subEssence}', [\App\Http\Controllers\SubEssenceController::class, 'show']);
    Route::get('essences/{essence}/sub-essences/{subEssence}/paginate', [\App\Http\Controllers\ProductController::class, 'paginate']);
    Route::get('essences/{essence}/sub-essences/{subEssence}/{product}', [\App\Http\Controllers\ProductController::class, 'show']);


    Route::get('categories/paginate', [\App\Http\Controllers\EssenceController::class, 'paginate']);


    Route::prefix('favorites')->group(function () {
        Route::get('', [FavoriteController::class, 'index']);
        Route::post('products/{product}', [FavoriteController::class, 'storeProduct']);
        Route::post('sub-essences/{subEssence}', [FavoriteController::class, 'storeSubEssence']);
        Route::delete('products/{product}', [FavoriteController::class, 'destroyProduct']);
        Route::delete('sub-essences/{subEssence}', [FavoriteController::class, 'destroySubEssence']);
    });
});
