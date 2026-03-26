<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
    
    <style>
        /* Main content - Clean & Flexible with collapsible sidebar */
        .main-content {
            padding: 24px;
            transition: padding-left 0.4s ease;
        }

        /* When sidebar is collapsed, reduce left padding slightly */
        .sidebar-collapsed .main-content {
            padding-left: 80px;   /* Adjust this value based on your collapsed sidebar width */
        }

        /* Employee Grid - Fully flexible */
        .employees-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
            gap: 24px;
        }

        .employee-card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: row;
            gap: 18px;
            min-height: 172px;
        }

        .employee-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 30px rgba(99, 102, 241, 0.25);
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

        .card-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

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
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .card-actions {
            display: flex;
            gap: 10px;
            margin-top: auto;
            padding-top: 12px;
            border-top: 1px solid #f1f5f9;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s;
            flex: 1;
        }

        .btn-edit  { background: #e0f2fe; color: #0369a1; }
        .btn-edit:hover  { background: #bae6fd; }

        .btn-delete { background: #fee2e2; color: #b91c1c; }
        .btn-delete:hover { background: #fecaca; }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .main-content {
                padding: 16px;
            }
            
            .employees-grid {
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 18px;
            }
            
            .employee-card {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            
            .profile-pic {
                align-self: center;
            }
        }
    </style>
</head>
<body>

    @extends('layout.sidebar')
   
    @section('content')
    <div class="main-content">
        <!-- Header -->
        <div style="justify-content: space-between; align-items: center; margin-bottom: 32px;">
            <h1 style="margin: 0;">Employees</h1>
            <button class="btn" style="background: #6366f1; color: white; padding: 10px 24px; border-radius: 9999px;">
                + Add Employee
            </button>
        </div>

        <!-- Employee Cards Grid -->
        <div class="employees-grid">
            @foreach($employees as $emp)
                <div class="employee-card">
                    <div class="profile-pic">
                        @if(isset($emp->photo) && $emp->photo)
                            <img src="{{ asset($emp->photo) }}" alt="{{ $emp->first_name }}">
                        @else
                            {{ strtoupper(substr($emp->first_name ?? '', 0, 1)) }}
                        @endif
                    </div>

                    <div class="card-content">
                        <div class="card-header">
                            <div>
                                <h3>{{ $emp->first_name }} {{ $emp->last_name }}</h3>
                                <div class="position">{{ $emp->position_id ?? 'Staff' }}</div>
                            </div>
                            <div class="employee-id">#{{ $emp->id }}</div>
                        </div>

                        <div class="card-info">
                            <div class="info-item">
                                <strong>Email</strong>
                                <span title="{{ $emp->email }}">{{ $emp->email }}</span>
                            </div>
                            <div class="info-item">
                                <strong>Phone</strong>
                                <span>{{ $emp->phone ?? '—' }}</span>
                            </div>
                            <div class="info-item">
                                <strong>Department</strong>
                                <span>{{ $emp->department_id ?? '—' }}</span>
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

</body>
</html>