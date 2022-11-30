<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CentrePointController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\SpaceController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/map', function () {
    return view('map');
});

// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [MapController::class, 'index'])->name('map.index');
Route::get('/map/{slug}', [MapController::class, 'show'])->name('map.show');
Route::resource('centre-point', (CentrePointController::class));
Route::resource('space', (SpaceController::class));

// Route::resource('centre-point', (CentrePointController::class));
Route::get('/centrepoint/data', [DataController::class, 'centrepoint'])->name('centre-point.data');
Route::get('/list', [SpaceController::class, 'index'])->name('data-space');
Route::get('/create', [SpaceController::class, 'create'])->name('space.create');
// Route::get('/create', [CentrePointController::class, 'create'])->name('centrepoint.create');
Route::post('/create-new', [SpaceController::class, 'store'])->name('space.store');
Route::delete('/delete/{id}', [SpaceController::class, 'destroy'])->name('space.destroy');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
