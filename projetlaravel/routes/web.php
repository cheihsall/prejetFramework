<?php
use App\Http\Controllers\Utilisateurs;
use App\Models\utilisateur;
use App\Http\Controllers\login;
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
}) ->name('welcome');
Route::get('/login', [App\Http\Controllers\TestController::class,'index'])->name('login');

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/user', function () {
    return view('user');
});

Route::get('/inscription', function () {
    return view('inscription');
});

Route::post('/inscription',[utilisateurs::class,'inscription']);

Route::post('/login/save', [App\Http\Controllers\TestController::class,'store'])->name('login.store');



