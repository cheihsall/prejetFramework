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
/* Route::middleware('auth')->group(function () { */
Route::get('/', function () {

    return view('login');
}) ->name('login');
/* Route::middleware('/')->group(function () {
    return view('welcome');
})->name('welcome'); */

//Route::get('/login', [App\Http\Controllers\TestController::class,'index'])->name('login');


//creation

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/user', function () {
    return view('user');
});

////////////////////////////////////////////////////////////////////////////




////////////////////////////////////////////////////////////////////////

/* });
require __DIR__.'/auth.php'; */



Route::get('inscription', function () {


    return view('inscription');
});

Route::get('pupop', function () {
    return view('pupop');
});






Route::post('/inscription', [utilisateurs::class, 'inscription']);




Route::post('/inscription' ,[PostController::class,'store']);





Route::get('/login', function () {
    return view('login');
});
//Route::post("/utilisateur/login",[Utilisateurs::class,'login']);

Route::post('/inscription', [PostController::class, 'store']);

/* Route::post('/inscription' ,[PostController::class,'inscription']); */
Route::post('/login' ,[PostController::class,'login']);


/* Route::get('lgin', [AuthenticatedSessionController::class, 'create']);
/* ->name('lagin'); 

Route::post('lgin', [AuthenticatedSessionController::class, 'store']); */

Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

//Route::post('/login/save', [App\Http\Controllers\TestController::class,'store'])->name('login.store');




Route::post('/login/save', [App\Http\Controllers\TestController::class, 'store'])->name('login.store');

/*
Route::get('/recherche', function () {
    return view('recherche');
});
 */
