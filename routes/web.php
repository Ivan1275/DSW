<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::get('/profile/pepe', [App\Http\Controllers\ProfileController::class, 'index']);
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/community', [App\Http\Controllers\CommunityLinkController::class, 'store']);
    Route::get('/community', [App\Http\Controllers\CommunityLinkController::class, 'index']);
    Route::get('/community/{channel}', [App\Http\Controllers\CommunityLinkController::class, 'index']);
});


require __DIR__.'/auth.php';


