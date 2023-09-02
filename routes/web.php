<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OrganisationController;

Route::get('/', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/signout', [AuthController::class, 'logout']);
Route::post('/login', [AuthController::class, 'handleLogin']);
Route::get('/organisation-sign-up', [AuthController::class, 'organisationSignup']);
Route::post('/organisation-signup', [AuthController::class, 'handleOrganisationSignup']);


Route::middleware(['auth'])->group(function () {
    // Authenticated routes go here
    Route::get('/dashboard',[DashboardController::class,'index']);
    Route::post('/organisation-signup-step2', [AuthController::class, 'handleOrganisationSignup2']);

    Route::get('/organisations',[OrganisationController::class,'list']);
    Route::post('/update-organisation-status',[OrganisationController::class, 'updateOrganisationStatus']);

    Route::get('/employees',[EmployeeController::class,'list']);

    
});


