<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\EmployeeReportController;



Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
   
    Route::resource('employees', EmployeeController::class);
    Route::resource('bonuses', BonusController::class);
});
});
Route::middleware(['auth', 'employee'])->group(function () {
    Route::get('/employee/dashboard', [EmployeeController::class, 'dashboard'])->name('employee.dashboard');
});
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/getEmployeesReport', [EmployeeReportController::class, 'getEmployeeBonusReport']);
    Route::post('/calculate-bonus', [BonusController::class, 'calculateAndAssignBonus']);
});

