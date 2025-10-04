<?php

# Importaciones
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\NationalityController;
use App\Http\Controllers\CivilStatusController;
use App\Http\Controllers\VulnerableGroupController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\InscripcionController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/inscripciones', [InscripcionController::class, 'store']);
});

Route::get('/provinces/{provinceId}/cities', [ProvinceController::class, 'cities']);

Route::get('/genres', [GenreController::class, 'index']);
Route::get('/nationalities', [NationalityController::class, 'index']);
Route::get('/civil-statuses', [CivilStatusController::class, 'index']);
Route::get('/vulnerable-groups', [VulnerableGroupController::class, 'index']);
Route::get('/provinces', [ProvinceController::class, 'index']);
Route::get('/institutions', [InstitutionController::class, 'index']);
