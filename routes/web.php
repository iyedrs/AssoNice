<?php

use App\Models\Competition;
use Illuminate\Support\Facades\Route;

// La route d'accueil reste ici car c'est une closure, pas un controller
Route::get('/', function () {
    $competitions = Competition::with(['club', 'discipline'])->get();
    return view('welcome', compact('competitions'));
});


// Toutes les autres routes sont gérées par les attributs Spatie
// directement dans les controllers (ClubController, AdherentController,
// CompetitionController, DisciplineController, InscriptionController)

// composer install