<?php

use App\Http\Controllers\DeepLinkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('wallpaper/{subEssenceId}/{productId}', [DeepLinkController::class, 'base'])->name('deep-link');
Route::get('livewallpaper/{productId}', [DeepLinkController::class, 'live'])->name('live-deep-link');
