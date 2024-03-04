<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculaController;
use Illuminate\Support\Facades\Auth;

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
    return view('auth.login');
});
// Route::get('/pelicula', function () {
//     return view('pelicula.index');
// });

// Route::get('pelicula/create',[PeliculaController::class,'create']);
Route::resource('pelicula', PeliculaController::class)->middleware('auth');
Auth::routes(['reset'=>false,'register'=>false]);

Route::get('/home', [PeliculaController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function(){
Route::get('/', [PeliculaController::class,'index'])->name('home');
});
