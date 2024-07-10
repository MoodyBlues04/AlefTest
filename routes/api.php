<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\SchoolClassController;
use App\Http\Controllers\Api\StudyPlanController;
use App\Http\Controllers\Api\LectionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('student', StudentController::class);
Route::apiResource('class', SchoolClassController::class);
Route::post('/class/{class}/learn/{lection}', SchoolClassController::class . '@learn')
    ->name('class.learn');
Route::get('/class/{class}/study_plan', StudyPlanController::class . '@show')
    ->name('class.plan.show');
Route::post('/class/{class}/study_plan', StudyPlanController::class . '@update')
    ->name('class.plan.update');
Route::apiResource('lection', LectionController::class);
