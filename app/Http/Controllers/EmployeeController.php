<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Position;

class EmployeeController extends Controller
{
    //Read page
  public function index()
{
    $employees = Employee::with(['department', 'position'])
                         ->latest()
                         ->get();

    return view('employees.index', compact('employees'));
}
        public function dashboard() {
        $employeesCount = Employee::count();
        $departmentsCount = Department::count();
        $positionsCount = Position::count(); // correct model
        return view('employees.dashboard', compact('employeesCount', 'departmentsCount', 'positionsCount'));
    }

    public function create() {}
    public function store(Request $request) {}
    public function show(Employee $employee) {}
    public function edit(Employee $employee) {}
    public function update(Request $request, Employee $employee) {}
    public function destroy(Employee $employee) {}
}
