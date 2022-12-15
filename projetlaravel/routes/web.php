<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Utilisateurs;
use App\Models\utilisateur;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
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
        return redirect('login');
    });// cette permet d'afficher par defaut la page de connexion

///

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/user', function () {
    return view('user');// cette permet d'afficher la page utilisateur simple
});

Route::get('inscription', function () {
    return view('inscription'); // cette permet d'afficher le formulaire de connection
});

Route::get('pupop', function () {
    return view('pupop');
});// cette permet d'afficher le popup
Route::post('/inscription' ,[PostController::class,'store']);// cette permet linsertion dans la base de donnee
Route::get('/login', function () {
    return view('login');
});// cette permet d'afficher le formulaire de connection
Route::post('/inscription', [PostController::class, 'store']);
Route::post('/login' ,[PostController::class,'login']);// cette permet lautentification
Route::post('/login/save', [App\Http\Controllers\TestController::class, 'store'])->name('login.store');

