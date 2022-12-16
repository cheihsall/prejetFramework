<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\UtilisateursController;
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
//Route::apiResource("users", UserController::class);
/* Route::get('/but', function () {
    return json_encode(['nom' => 'Cheikh', 'prenom' => 'Sall']);
}); */
Route::apiResource('admin', PostController::class) ;// cette permet de recuperé les donnees de l'API
Route::post('posts/edit/{id}', [PostController::class, "edit"]);// cette permet de modifier les donnees d'un Utilisateur grace a son id'

// cette permet d'afficher la formulaire de modification avec les donnees d'un Utilisateur grace a son id'
Route::group(['middleware' => ['web']], function () {
   Route::get('posts/editForm/{id}', [PostController::class, "editForm"]);
});
Route::get('posts/switchRole/{id}', [PostController::class, "switchRole"]); // cette permet de de changer le role d'un Utilisateur grace a son id'
Route::get('posts/archiv/{id}', [PostController::class, "archiv"]);// cette permet d'archiver un Utilisateur grace a son id'
Route::get('posts/desarchiv/{id}', [PostController::class, "desarchiv"]);// cette permet desarchiver un Utilisateur grace a son id'
Route::delete('posts/destroy/{id}', [PostController::class, "destroy"]);// cette permet de supprimer definitivement  un Utilisateur grace a son id'
Route::get('search', [PostController::class, "Search"]);// cette permet de rechercher un Utilisateur dans la page admin grace a son prenom
Route::get('search2', [PostController::class, "Search2"]);// cette permet de rechercher un Utilisateur dans la page user grace a son prenom
Route::get('rechinactif', [PostController::class, "rechinactif"]); // cette permet de rechercher un Utilisateur dans la liste des archivés grace a son prenom
Route::get('/listearchive', [PostController::class, "listearchive"]);// cette permet d'afficher la liste de tous les utilisateur archivés
Route::get('/usersimple', [PostController::class, "usersimple"]);// cette permet d'afficher la liste de tous les utilisateur archivé
Route::get('search3', [PostController::class, "Search3"]);
Route::post('recherche', [PostController::class, "recherche"]);
Route::get('logout', [PostController::class, 'deconnect']); // cette permet de se connecté
Route::post('posts/inscription' ,[PostController::class,'store']);// cette permet dinsere des donnees dans l'api
Route::get('/posts', [PostController::class, "data"]);
Route::get('/posts/{id}', [PostController::class, "show"]);
Route::post('/posts/create', [PostController::class, "create"]);


