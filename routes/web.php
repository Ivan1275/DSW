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


// Punto 1
Route::get('/user/{name?}', function ($name = null) {
    return $name;
});
 
Route::get('/user2/{name?}', function ($name = 'John') {
    return $name;
});

Route::any('/user21', function () {
    return 'bom dia';
});

Route::get('/user3/{id}', function ($id) {
    return 'Este es el id numero: ' . $id;
})->where('id', '[0-9]+');

Route::get('/user4/{id}/{name}', function ($id, $name) {
    return 'Este es el id numero: ' . $id . ' y su usuario es ' . $name;
})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);


// Punto 2
Route::get('/host', function () {    
    $env = env('DB_HOST');
    return $env;
});

Route::get('/timezone', function () {    
    $config = config('app.timezone');
    return $config;
});


// Punto 3
Route::view('/inicio ', 'home');

Route::view('/fecha', 'fecha', ['day' => '23', 'month' => '11', 'year' => '2012']);

Route::get('/fecha2', function () {    
    return view('fecha')
            ->with('day', '23')
            ->with('month', '11')
            ->with('year', '2012');
});

Route::view('/404 ', 'error404');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Act A32
Route::get('community', [App\Http\Controllers\CommunityLinkController::class, 'index']);
Route::post('community', [App\Http\Controllers\CommunityLinkController::class, 'store']);


require __DIR__.'/auth.php';


