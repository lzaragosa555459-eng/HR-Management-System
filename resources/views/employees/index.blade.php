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

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .search-container {
            position: relative;
            flex: 1;
            max-width: 460px;
        }

        .search-container input {
            width: 100%;
            padding: 14px 20px 14px 50px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1.02rem;
        }

        .search-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 1.35rem;
        }

        .employees-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
            gap: 24px;
        }

        .employee-card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            display: flex;
            gap: 18px;
            min-height: 172px;
        }

        .employee-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 35px rgba(139, 92, 246, 0.18);
        }

        .profile-pic {
            width: 92px;
            height: 92px;
            border-radius: 50%;
            background: #e0e7ff;
            flex-shrink: 0;
            border: 4px solid #f8fafc;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: #6366f1;
            overflow: hidden;
        }

        .profile-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-content { flex: 1; min-width: 0; }

        .card-header h3 { 
            margin: 0; 
            font-size: 1.25rem; 
            font-weight: 700; 
            color: #1e293b; 
        }

        .employee-id {
            background: #f1f5f9;
            color: #64748b;
            padding: 4px 10px;
            border-radius: 9999px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .position {
            font-size: 0.95rem;
            color: #6366f1;
            font-weight: 500;
            margin-top: 4px;
        }

        .card-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
            gap: 12px 20px;
            font-size: 0.875rem;
            flex: 1;
        }

        .info-item strong {
            display: block;
            font-size: 0.73rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            margin-bottom: 2px;
        }

        .info-item span {
            color: #334155;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-actions button {
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            flex: 1;
        }

        .btn-edit  { background: #e0f2fe; color: #0369a1; }
        .btn-delete { background: #fee2e2; color: #b91c1c; }
    </style>
</head>
<body>

@extends('layout.sidebar')

@section('content')
<div class="main-content">
    <div class="page-header">
        <h1 style="margin: 0;">Employees</h1>
        
        <div class="search-container">
            <i class="bi bi-search search-icon"></i>
            <input type="text" id="searchInput" 
                   placeholder="Search by name, email, department, position or ID..." 
                   onkeyup="searchEmployees()">
        </div>

        <button class="btn" style="background: #6366f1; color: white; padding: 11px 26px; border-radius: 9999px;">
            + Add Employee
        </button>
    </div>

    <div class="employees-grid" id="employeesGrid">
        @foreach($employees as $emp)
            <div class="employee-card" 
                 data-name="{{ strtolower($emp->first_name . ' ' . $emp->last_name) }}"
                 data-email="{{ strtolower($emp->email ?? '') }}"
                 data-id="{{ $emp->id }}"
                 data-department="{{ strtolower($emp->department?->name ?? '') }}"
                 data-position="{{ strtolower($emp->position?->title ?? '') }}">

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
                            <div class="position">
                                {{ $emp->position?->title ?? 'Staff' }}
                            </div>
                        </div>
                        <div class="employee-id">#{{ $emp->id }}</div>
                    </div>

                    <div class="card-info">
                        <div class="info-item">
                            <strong>Email</strong>
                            <span>{{ $emp->email }}</span>
                        </div>
                        <div class="info-item">
                            <strong>Phone</strong>
                            <span>{{ $emp->phone ?? '—' }}</span>
                        </div>
                        <div class="info-item">
                            <strong>Department</strong>
                            <span>{{ $emp->department?->name ?? '—' }}</span>
                        </div>
                        <div class="info-item">
                            <strong>Position</strong>
                            <span>{{ $emp->position?->title ?? 'Staff' }}</span>
                        </div>
                        <div class="info-item">
                            <strong>Hire Date</strong>
                            <span>{{ $emp->hire_date ?? '—' }}</span>
                        </div>
                    </div>

                    <div class="card-actions">
                        <button class="btn btn-edit">Edit</button>
                        <button class="btn btn-delete">Delete</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

<script>
function searchEmployees() {
    const input = document.getElementById('searchInput').value.toLowerCase().trim();
    const cards = document.querySelectorAll('.employee-card');

    cards.forEach(card => {
        const name       = card.dataset.name || '';
        const email      = card.dataset.email || '';
        const id         = card.dataset.id || '';
        const department = card.dataset.department || '';
        const position   = card.dataset.position || '';

        if (name.includes(input) || 
            email.includes(input) || 
            id.includes(input) || 
            department.includes(input) || 
            position.includes(input)) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>

</body>
</html>