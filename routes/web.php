<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::get('/', [EmployeeController::class, 'dashboard'])->name('home'); // Homepage

// Employees index page
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');

// Employees dashboard page
Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->name('employees.dashboard');