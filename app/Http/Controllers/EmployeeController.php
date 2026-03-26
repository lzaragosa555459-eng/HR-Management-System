<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Display All Employees (page)
    public function index()
    {
        $employees = Employee::with(['department', 'position'])
                             ->latest()
                             ->get();

        return view('employees.index', compact('employees'));
    }

    // Fetch all employees as JSON (for AJAX grid reload)
    public function getAll()
    {
        $employees = Employee::with(['department', 'position'])
                             ->latest()
                             ->get();

        return response()->json($employees);
    }

    // Store New Employee (Add)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'required|email|unique:employees,email',
            'phone'         => 'nullable|string|max:20',
            'department_id' => 'nullable|exists:departments,id',
            'position_id'   => 'nullable|exists:positions,id',
            'hire_date'     => 'nullable|date',
        ]);

        $employee = Employee::create($validated);

        if ($request->ajax()) {
            return response()->json($employee);
        }

        return redirect()->route('employees.index')
                         ->with('success', 'Employee added successfully!');
    }

    // Update Employee
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'required|email|unique:employees,email,' . $employee->id,
            'phone'         => 'nullable|string|max:20',
            'department_id' => 'nullable|exists:departments,id',
            'position_id'   => 'nullable|exists:positions,id',
            'hire_date'     => 'nullable|date',
        ]);

        $employee->update($validated);

        if ($request->ajax()) {
            return response()->json($employee);
        }

        return redirect()->route('employees.index')
                         ->with('success', 'Employee updated successfully!');
    }

    // Delete Employee
    public function destroy(Employee $employee, Request $request)
    {
        $employee->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('employees.index')
                         ->with('success', 'Employee deleted successfully!');
    }

    // Dashboard
    public function dashboard()
    {
        $employeesCount = Employee::count();
        $departmentsCount = Department::count();
        $positionsCount = Position::count();

        return view('employees.dashboard', compact('employeesCount', 'departmentsCount', 'positionsCount'));
    }

    // Optional methods (you can leave them empty or remove if not needed)
    public function create() {}
    public function show(Employee $employee) {}
    public function edit(Employee $employee) {}
}