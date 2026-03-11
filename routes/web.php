<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\AdherentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clubs', [ClubController::class, 'index']);
Route::post('/clubs', [ClubController::class, 'store']);
Route::get('/clubs/create', [ClubController::class, 'create']);
Route::get('/clubs/{id}/edit', [ClubController::class, 'edit']);
Route::post('/clubs/{id}/update', [ClubController::class, 'update']);
Route::get('/clubs/{id}/delete', [ClubController::class, 'destroy']);

Route::get('/inscription', [AdherentController::class, 'inscriptionForm']);
Route::post('/inscription', [AdherentController::class, 'inscription']);
Route::get('/connexion', [AdherentController::class, 'connexionForm']);
Route::post('/connexion', [AdherentController::class, 'connexion']);
Route::get('/deconnexion', [AdherentController::class, 'deconnexion']);
