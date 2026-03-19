<?php

use App\Models\Competition;
use Illuminate\Support\Facades\Route;

// La route d'accueil reste ici car c'est une closure, pas un controller
Route::get('/', function () {
    $competitions = Competition::with(['club', 'discipline'])->get();
    return view('welcome', compact('competitions'));
});

// Pages publiques pour les visiteurs (sans authentification)
Route::get('/public/competitions', function () {
    $competitions = Competition::with(['club', 'discipline'])->get();
    return view('competitions.public_list', compact('competitions'));
});

Route::get('/public/competitions/{id}', function ($id) {
    $competition = Competition::with(['club', 'discipline', 'inscription'])->findOrFail($id);
    return view('competitions.public_show', compact('competition'));
});

// Toutes les autres routes sont gérées par les attributs Spatie
// directement dans les controllers (ClubController, AdherentController,
// CompetitionController, DisciplineController, InscriptionController)

// composer install