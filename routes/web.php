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
use App\Http\Controllers\GoalController;
use App\Http\Controllers\HiringManagerController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\PerformanceReviewController;
use App\Http\Controllers\RecruitmentController;
use App\Models\HiringManager;

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


    //Hiring Managers
    Route::get('/hiring-manager/view',[HiringManagerController::class,'hiringView']);
    Route::post('/update-hiring-manager',[HiringManagerController::class,'updateHiringManager']);
    Route::get('/hiring-manager/employee',[EmployeeController::class,'list']);
    Route::get('/recruitments',[RecruitmentController::class,'list']);
    Route::post('/create-recruitment',[RecruitmentController::class,'create']);

    Route::get('/performance-reviews', [PerformanceReviewController::class,'list']);
    Route::get('/update-recruitment-status', [RecruitmentController::class,'updateRecruitmentStatus']);

    //Employee

    Route::get('/employee/goals',[GoalController::class,'employeeList']);
    Route::get('/employee/organisations',[OrganisationController::class,'employeeOrganisationList']);
    Route::get('/employee/recruitments',[RecruitmentController::class,'employeeRecruitmentList']);
    Route::get('/employee/performance-reviews',[PerformanceReviewController::class,'employeePerformanceList']);
    Route::post('/employee/self-review',[PerformanceReviewController::class,'handleSelfReview']);
});

Route::middleware(['role:admin,organisation'])->group(function () {
    // specifically to admin and organisation go here
    Route::post('/create-hiring-manager',[HiringManagerController::class,'createHiringManager']);
    Route::post('/create-employee',[EmployeeController::class,'createEmployee']);
    Route::post('/create-goal',[GoalController::class,'createGoal']);
    Route::post('/create-review', [PerformanceReviewController::class,'createReview']);

    Route::get('/employees',[EmployeeController::class,'list']);
    Route::get('/hiring-managers',[HiringManagerController::class,'list']);
    Route::get('/goals',[GoalController::class,'list']);
    Route::get('/get-employees/{organizationId}', [EmployeeController::class,'getEmployees']);

    // Route::get('/performance-reviews', [PerformanceReviewController::class,'list']);
   


});




Route::middleware(['role:admin'])->group(function () {
    //specifically for admin goes here
    Route::post('/update-organisation-status',[OrganisationController::class, 'updateOrganisationStatus']);

    Route::get('/organisations',[OrganisationController::class,'list']);

});


