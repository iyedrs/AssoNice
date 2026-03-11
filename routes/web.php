<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClubController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clubs', [ClubController::class, 'index']);
Route::post('/clubs', [ClubController::class, 'store']);
Route::get('/clubs/create', [ClubController::class, 'create']);
Route::get('/clubs/{id}/edit', [ClubController::class, 'edit']);
Route::post('/clubs/{id}/update', [ClubController::class, 'update']);
Route::get('/clubs/{id}/delete', [ClubController::class, 'destroy']);
