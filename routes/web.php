<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\AdherentController;
use App\Http\Controllers\CompetitionController;

Route::get('/', function () {
    return view('welcome');
});

// Routes Clubs
Route::get('/clubs', [ClubController::class, 'index']);
Route::post('/clubs', [ClubController::class, 'store']);
Route::get('/clubs/create', [ClubController::class, 'create']);
Route::get('/clubs/{id}/edit', [ClubController::class, 'edit']);
Route::post('/clubs/{id}/update', [ClubController::class, 'update']);
Route::get('/clubs/{id}/delete', [ClubController::class, 'destroy']);

// Routes Compétitions
Route::get('/competitions', [CompetitionController::class, 'index'])->name('competitions.index');
Route::get('/competitions/{id}', [CompetitionController::class, 'show'])->name('competitions.show');
Route::get('/competitions/create', [CompetitionController::class, 'create'])->name('competitions.create');
Route::post('/competitions', [CompetitionController::class, 'store'])->name('competitions.store');
Route::get('/competitions/{id}/edit', [CompetitionController::class, 'edit'])->name('competitions.edit');
Route::post('/competitions/{id}/update', [CompetitionController::class, 'update'])->name('competitions.update');
Route::get('/competitions/{id}/delete', [CompetitionController::class, 'destroy'])->name('competitions.destroy');

// Routes Adhérents
Route::get('/inscription', [AdherentController::class, 'inscriptionForm']);
Route::post('/inscription', [AdherentController::class, 'inscription']);
Route::get('/connexion', [AdherentController::class, 'connexionForm']);
Route::post('/connexion', [AdherentController::class, 'connexion']);
Route::get('/deconnexion', [AdherentController::class, 'deconnexion']);
