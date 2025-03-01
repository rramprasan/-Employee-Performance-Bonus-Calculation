<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeReportController;


Route::get('/getEmployeesReport', [EmployeeReportController::class, 'getEmployeeBonusReport']);
Route::post('/calculate-bonus', [BonusController::class, 'calculateAndAssignBonus']);