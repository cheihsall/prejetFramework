<?php

use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::apiResource("users", UserController::class);
/* Route::get('/but', function () {
    return json_encode(['nom' => 'Cheikh', 'prenom' => 'Sall']);
}); */
/* Route::delete('posts/{id}', [PostController::class, "dest"]); */
Route::post('posts/edit/{id}', [PostController::class, "edit"]);
Route::get('posts/switchRole/{id}', [PostController::class, "switchRole"]);
Route::get('posts/archiv/{id}', [PostController::class, "archiv"]);
Route::get('posts/desarchiv/{id}', [PostController::class, "desarchiv"]);
Route::apiResource('posts', PostController::class);
Route::get('posts/editForm/{id}', [PostController::class, "editForm"]);
Route::post('recherche', [PostController::class, "recherche"]);



/* Route::post('posts/inscription' ,[PostController::class,'store']); */


