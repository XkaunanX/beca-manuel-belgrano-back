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
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\RegistrationControllerController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\AcademicPlanController;
use App\Http\Controllers\BankBranchController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UnitCareerController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/registration', [RegistrationController::class, 'store']);
    Route::get('/scholarship', [ScholarshipController::class, 'getMyScholarData']);
});

Route::get('/provinces/{provinceId}/cities', [ProvinceController::class, 'cities']);

Route::get('/genres', [GenreController::class, 'index']);
Route::get('/nationalities', [NationalityController::class, 'index']);
Route::get('/civil-statuses', [CivilStatusController::class, 'index']);
Route::get('/vulnerable-groups', [VulnerableGroupController::class, 'index']);
Route::get('/provinces', [ProvinceController::class, 'index']);
Route::get('/academic-plans', [AcademicPlanController::class, 'index']);
Route::get('/bank-branches', [BankBranchController::class, 'index']);
Route::get('/careers', [CareerController::class, 'index']);
Route::get('/institutions', [InstitutionController::class, 'index']);
Route::get('/levels', [LevelController::class, 'index']);
Route::get('/units', [UnitController::class, 'index']);
Route::get('/unit-career', [UnitCareerController::class, 'index']);

