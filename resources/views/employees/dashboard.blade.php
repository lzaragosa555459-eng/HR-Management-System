<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
    <style>
        .main-content {
            padding: 30px 24px;
            transition: padding-left 0.4s ease;
        }

        .sidebar-collapsed .main-content {
            padding-left: 90px;
        }

        .mainCardContainer {
            margin: 0;
        }

        /* Horizontal Cards Container */
        .cards-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 32px;
        }

        /* Modern Horizontal Stat Cards */
        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 24px 22px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            flex: 1;
            min-width: 260px;
        }

        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 35px rgba(139, 92, 246, 0.18);
        }

        .stat-card h3 {
            color: #64748b !important;
            font-size: 1.05rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .stat-card p {
            font-size: 2.6rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        /* Chart Cards - Horizontal Friendly */
        .chart-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            flex: 1;
            min-width: 320px;
        }

        .chart-container {
            position: relative;
            height: 260px;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 18px;
        }

        /* Accent borders for stat cards */
        .stat-card.employees { border-top: 6px solid #8b5cf6; }
        .stat-card.departments { border-top: 6px solid #6366f1; }
        .stat-card.positions { border-top: 6px solid #a855f7; }
    </style>
</head>
<body>

    @extends('layout.sidebar')
    
    @section('content')
    <div class="main-content">
        <h1 style="margin-bottom: 32px; font-weight: 700; color: #1e293b;">Dashboard</h1>

        <div class="mainCardContainer">

            <!-- Horizontal Stat Cards -->
            <div class="cards-container">
                <div class="stat-card employees">
                    <h3>Total Employees</h3>
                    <p>{{ $employeesCount ?? 0 }}</p>
                </div>

                <div class="stat-card departments">
                    <h3>Total Departments</h3>
                    <p>{{ $departmentsCount ?? 0 }}</p>
                </div>

                <div class="stat-card positions">
                    <h3>Total Positions</h3>
                    <p>{{ $positionsCount ?? 0 }}</p>
                </div>
            </div>

            <!-- Horizontal Charts Row -->
            <div class="cards-container">
                <!-- Total Present -->
                <div class="chart-card">
                    <h3 class="section-title">Total Present</h3>
                    <div class="chart-container">
                        <canvas id="totalPresentChart"></canvas>
                    </div>
                </div>

                <!-- Total Leave -->
                <div class="chart-card">
                    <h3 class="section-title">Total Leave</h3>
                    <div class="chart-container">
                        <canvas id="totalLeaveChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Bottom Horizontal Section -->
            <div class="cards-container">
                <!-- Attendance Overview -->
                <div class="chart-card" style="flex: 2;">
                    <h3 class="section-title">Attendance Overview</h3>
                    <div class="chart-container">
                        <canvas id="attendanceChart"></canvas>
                    </div>
                </div>

                <!-- Total Net -->
                <div class="chart-card" style="flex: 1; min-width: 280px;">
                    <h3 class="section-title text-center">Total Net</h3>
                    <div class="d-flex flex-column justify-content-center align-items-center h-100" style="min-height: 260px;">
                        <h2 style="font-size: 3.8rem; font-weight: 800; color: #10b981; margin: 0;">0</h2>
                        <p class="text-muted fs-5 mt-2">This Month</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'];

        // Total Present Bar Chart
        new Chart(document.getElementById('totalPresentChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Present',
                    data: [28, 32, 25, 30, 35],
                    backgroundColor: '#8b5cf6',
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });

        // Total Leave Bar Chart
        new Chart(document.getElementById('totalLeaveChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'On Leave',
                    data: [3, 2, 5, 1, 4],
                    backgroundColor: '#f59e0b',
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });

        // Attendance Overview Line Chart
        new Chart(document.getElementById('attendanceChart'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Present',
                    data: [28, 32, 25, 30, 35],
                    borderColor: '#8b5cf6',
                    backgroundColor: 'rgba(139, 92, 246, 0.18)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });
    </script>

    @endsection
</body>
</html>