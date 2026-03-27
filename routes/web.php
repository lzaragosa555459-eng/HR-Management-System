<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::get('/', [EmployeeController::class, 'dashboard'])->name('home'); // Homepage

// Employees index page
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index'); // <a href="{{ route('employees.index')}} ><\a> its in the sidebar.blade.php

// Employees dashboard page
Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->name('employees.dashboard');
Route::get('/employees/data', [App\Http\Controllers\EmployeeController::class, 'getAll'])->name('employees.data');

Route::get('/Organization and Schedule', [EmployeeController::class, 'Organization_Schedule'])->name('employees.organization_Schedule');

// AJAX/Forms for Employees
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');         // Add
Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update'); // Update
Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy'); // Delete