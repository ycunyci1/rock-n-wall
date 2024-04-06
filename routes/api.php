<?php

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

Route::get('/main', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('/feed', [\App\Http\Controllers\FeedController::class, 'show']);
Route::get('/feed/paginate', [\App\Http\Controllers\FeedController::class, 'paginate']);
Route::get('/search', [\App\Http\Controllers\FeedController::class, 'search']);



Route::get('essences/paginate', [\App\Http\Controllers\EssenceController::class, 'paginate']);
Route::get('essences/{essence}', [\App\Http\Controllers\EssenceController::class, 'show']);
Route::get('essences/{essence}/sub-essences/paginate', [\App\Http\Controllers\SubEssenceController::class, 'paginate']);
Route::get('essences/{essence}/sub-essences/{subEssence}', [\App\Http\Controllers\SubEssenceController::class, 'show']);
Route::get('essences/{essence}/sub-essences/{subEssence}/paginate', [\App\Http\Controllers\ProductController::class, 'paginate']);
Route::get('essences/{essence}/sub-essences/{subEssence}/{product}', [\App\Http\Controllers\ProductController::class, 'show']);




Route::get('categories/paginate', [\App\Http\Controllers\EssenceController::class, 'paginate']);
