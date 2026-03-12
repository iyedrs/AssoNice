<?php

use Illuminate\Support\Facades\Route;

// La route d'accueil reste ici car c'est une closure, pas un controller
Route::get('/', function () {
    return view('welcome');
});

// Toutes les autres routes sont gérées par les attributs Spatie
// directement dans les controllers (ClubController, AdherentController,
// CompetitionController, DisciplineController)
