<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
    
    <style>
        .main-content { padding: 24px; transition: padding-left 0.4s ease; }
        .sidebar-collapsed .main-content { padding-left: 90px; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; flex-wrap: wrap; gap: 16px; }
        .search-container { position: relative; flex: 1; max-width: 460px; }
        .search-container input { width: 100%; padding: 14px 20px 14px 50px; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 1.02rem; }
        .search-icon { position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: #64748b; font-size: 1.35rem; }
        .employees-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 24px; }
        .employee-card { background: white; border-radius: 16px; padding: 20px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08); transition: all 0.3s ease; display: flex; gap: 18px; min-height: 172px; }
        .employee-card:hover { transform: translateY(-6px); box-shadow: 0 15px 35px rgba(139, 92, 246, 0.18); }
        .profile-pic { width: 92px; height: 92px; border-radius: 50%; background: #e0e7ff; flex-shrink: 0; border: 4px solid #f8fafc; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); display: flex; align-items: center; justify-content: center; font-size: 32px; color: #6366f1; overflow: hidden; }
        .profile-pic img { width: 100%; height: 100%; object-fit: cover; }
        .card-content { flex: 1; min-width: 0; }
        .card-header h3 { margin: 0; font-size: 1.25rem; font-weight: 700; color: #1e293b; }
        .employee-id { background: #f1f5f9; color: #64748b; padding: 4px 10px; border-radius: 9999px; font-size: 0.8rem; font-weight: 600; }
        .position { font-size: 0.95rem; color: #6366f1; font-weight: 500; margin-top: 4px; }
        .card-info { display: grid; grid-template-columns: repeat(auto-fit, minmax(130px, 1fr)); gap: 12px 20px; font-size: 0.875rem; flex: 1; }
        .info-item strong { display: block; font-size: 0.73rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; margin-bottom: 2px; }
        .info-item span { color: #334155; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .card-actions { display: flex; gap: 10px; margin-top: 15px; }
        .card-actions button { padding: 8px 16px; border: none; border-radius: 8px; font-weight: 600; font-size: 0.875rem; cursor: pointer; flex: 1; }
        .btn-edit { background: #e0f2fe; color: #0369a1; }
        .btn-delete { background: #fee2e2; color: #b91c1c; }
        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.65); z-index: 2000; align-items: center; justify-content: center; }
        .modal-content { background: white; border-radius: 16px; width: 90%; max-width: 520px; max-height: 92vh; overflow-y: auto; }
        .modal-header { padding: 20px 24px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; }
        .form-group { margin-bottom: 18px; padding: 0 24px; }
        .form-group label { display: block; margin-bottom: 6px; font-weight: 600; color: #475569; }
        .form-group input, .form-group select { width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 1rem; }
    </style>
</head>
<body>

@extends('layout.sidebar')

@section('content')
<div class="main-content">
    <div class="page-header" style="margin-top: -20px;">
        <h1>Employees</h1>
        
        <div class="search-container" style="margin-left: -180px;">
            <i class="bi bi-search search-icon"></i>
            <input type="text" id="searchInput" placeholder="Search..." onkeyup="searchEmployees()">
        </div>

        <button class="btn" style="background: #6366f1; color: white; padding: 11px 26px; border-radius: 9999px;" onclick="showAddModal()">
            + Add Employee
        </button>
    </div>

  <div class="employees-grid" id="employeesGrid">
    @foreach($employees as $emp) <!--came from the contoller compact('employees')-->
        <div class="employee-card" data-id="{{ $emp->id }}">
            <div class="profile-pic">
                @if(isset($emp->photo) && $emp->photo)
                    <img src="{{ asset($emp->photo) }}" alt="{{ $emp->first_name }}">
                @else
                    {{ strtoupper(substr($emp->first_name ?? 'U', 0, 1)) }}
                @endif
            </div>

            <div class="card-content">
                <div class="card-header">
                    <div>
                        <h3>{{ $emp->first_name }} {{ $emp->last_name }}</h3>
                        <div class="position">{{ $emp->position?->title ?? 'Staff' }}</div>
                    </div>
                    <div class="employee-id">#{{ $emp->id }}</div>
                </div>

                <div class="card-info">
                    <div class="info-item"><strong>Email</strong><span>{{ $emp->email }}</span></div>
                    <div class="info-item"><strong>Phone</strong><span>{{ $emp->phone ?? '—' }}</span></div>
                    <div class="info-item"><strong>Dept</strong><span>{{ $emp->department?->name ?? '—' }}</span></div>
                </div>

                <div class="card-actions">
                    <button class="btn btn-edit" onclick="editEmployee('{{ $emp->id }}')">Edit</button>
                    <button class="btn btn-delete" onclick="deleteEmployee('{{ $emp->id }}')">Delete</button>
                </div>
            </div>
        </div>
    @endforeach
</div>
</div>
@endsection

<div id="employeeModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">Add New Employee</h3>
            <span style="font-size:28px; cursor:pointer;" onclick="closeModal()">×</span>
        </div>
<!--
EMPLOYEE FORM (ADD)      
Check this/ no tel no.
update new stuff
-->
        <form id="employeeForm">
            <div class="form-group"><label>First Name</label><input type="text" id="first_name" required></div>
            <div class="form-group"><label>Last Name</label><input type="text" id="last_name" required></div>
            <div class="form-group"><label>Email</label><input type="email" id="email" required></div>
            <div class="form-group"><label>Phone</label><input type="text" id="phone" required></div>
            <div class="form-group"><label>Address</label><input type="text" id="address" required></div>
            <div class="form-group"><label>Gender</label><input type="text" id="gender" required></div>
            <div class="form-group"><label>Birth Date</label><input type="date" id="date_of_birth" required></div>
            <div class="form-group">
                <label>Department</label>
                <select id="department_id">
                    <option value="">Select Department</option>
                    @foreach(\App\Models\Department::all() as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                    @endforeach
                </select>
           
            </div>
            <div class="form-group">
                <label>Position</label>
                <select id="position_id">
                    <option value="">Select Position</option>
                    @foreach(\App\Models\Position::all() as $pos)
                        <option value="{{ $pos->id }}">{{ $pos->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group"><label>Hire Date</label><input type="date" id="hire_date"></div>

            <div style="padding: 20px 24px; text-align: right;">
                <button type="button" onclick="closeModal()">Cancel</button>
                <button type="button" onclick="saveEmployee()" style="background:#6366f1; color:white; padding:10px 28px; border:none; border-radius:8px;">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
let currentEditId = null;

// --- 1. THE REFRESH FUNCTION (No browser reload!) ---
function refreshGrid() {
    fetch("{{ route('employees.data') }}")
        .then(res => res.json())
        .then(employees => {
            const grid = document.getElementById('employeesGrid');
            grid.innerHTML = ''; // Clear current view

            employees.forEach(emp => {
                const cardHtml = generateCardHtml(emp);
                grid.insertAdjacentHTML('beforeend', cardHtml);
            });
        })
        .catch(err => console.error('Refresh Error:', err));
}

// --- 2. HTML GENERATOR (Matches your CSS) ---
function generateCardHtml(emp) {
    const name = `${emp.first_name} ${emp.last_name}`;
    const initial = emp.first_name ? emp.first_name.charAt(0).toUpperCase() : 'U';
    const photo = emp.photo ? `<img src="/${emp.photo}">` : initial;

    return `
        <div class="employee-card" data-id="${emp.id}">
            <div class="profile-pic">${photo}</div>
            <div class="card-content">
                <div class="card-header">
                    <div>
                        <h3>${name}</h3>
                        <div class="position">${emp.position?.title || 'Staff'}</div>
                    </div>
                    <div class="employee-id">#${emp.id}</div>
                </div>
                <div class="card-info">
                    <div class="info-item"><strong>Email</strong><span>${emp.email}</span></div>
                    <div class="info-item"><strong>Phone</strong><span>${emp.phone}</span></div>
                    <div class="info-item"><strong>Phone</strong><span>${emp.address}</span></div>
                    <div class="info-item"><strong>Dept</strong><span>${emp.department?.name}</span></div>
                </div>
                <div class="card-actions">
                    <button class="btn btn-edit" onclick="editEmployee('${emp.id}')">Edit</button>
                    <button class="btn btn-delete" onclick="deleteEmployee('${emp.id}')">Delete</button>
                </div>
            </div>
        </div>`;
} 

// --- 3. SAVE LOGIC ---
function saveEmployee() {
    const formData = {
        first_name: document.getElementById('first_name').value,
        last_name: document.getElementById('last_name').value,
        email: document.getElementById('email').value,
        phone: document.getElementById('phone').value,
        address: document.getElementById('address').value,
        gender: document.getElementById('gender').value,
        date_of_birth: document.getElementById('date_of_birth').value,
        department_id: document.getElementById('department_id').value,
        position_id: document.getElementById('position_id').value,
        hire_date: document.getElementById('hire_date').value
    };

    const url = currentEditId ? `/employees/${currentEditId}` : '/employees';
    const method = currentEditId ? 'PUT' : 'POST';

    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify(formData)
    })
    .then(res => res.json())
    .then(() => {
        closeModal();
        refreshGrid(); // Trigger the silent update
    });
}

// --- 4. DELETE LOGIC ---
function deleteEmployee(id) {
    if(confirm("Delete this employee?")) {
        fetch(`/employees/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(() => refreshGrid()); // Trigger silent update
    }
}

// --- 5. SEARCH LOGIC (Instant Filter) ---
function searchEmployees() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const cards = document.querySelectorAll('.employee-card');
    cards.forEach(card => {
        const text = card.innerText.toLowerCase();
        card.style.display = text.includes(input) ? 'flex' : 'none';
    });
}

function showAddModal() {
    currentEditId = null;
    document.getElementById('employeeForm').reset();
    document.getElementById('modalTitle').textContent = "Add New Employee";
    document.getElementById('employeeModal').style.display = 'flex';
}

function closeModal() { document.getElementById('employeeModal').style.display = 'none'; }

function editEmployee(id) {
    // For editing, you'd usually fetch the specific employee data here then open modal
    currentEditId = id;
    document.getElementById('modalTitle').textContent = "Edit Employee";
    document.getElementById('employeeModal').style.display = 'flex';
}
</script>

</body>
</html>