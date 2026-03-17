<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
</head>
<body>

<!-- Sidebar -->
<div id="mySidebar" class="sidebar">
    <span class="close-btn" onclick="closeSidebar()">×</span>

    <a href="{{ route('employees.dashboard') }}" 
       class="{{ Route::is('employees.dashboard') ? 'active' : '' }}">
        <i class="bi bi-house-door-fill"></i> Dashboard
    </a>

    <a href="{{ route('employees.index') }}" 
       class="{{ Route::is('employees.index') ? 'active' : '' }}">
        <i class="bi bi-people-fill"></i> Employees
    </a>

    <a href="#" class="{{ Route::is('departments.*') ? 'active' : '' }}">
        <i class="bi bi-building"></i> Departments
    </a>

    <a href="#" class="{{ Route::is('positions.*') ? 'active' : '' }}">
        <i class="bi bi-person-badge"></i> Positions
    </a>

    <a href="#" class="{{ Route::is('attendance.*') ? 'active' : '' }}">
        <i class="bi bi-calendar-check-fill"></i> Attendance
    </a>

    <a href="#" class="{{ Route::is('leaves.*') ? 'active' : '' }}">
        <i class="bi bi-calendar-x-fill"></i> Leaves
    </a>

    <a href="#" class="{{ Route::is('payroll.*') ? 'active' : '' }}">
        <i class="bi bi-cash-stack"></i> Payroll
    </a>

    <a href="#" class="{{ Route::is('users.*') ? 'active' : '' }}">
        <i class="bi bi-person-circle"></i> Users
    </a>
</div>

    <!-- Main content -->
    <div id="mainContent" class="main">
        <button class="toggle-btn" onclick="openSidebar()">☰ Menu</button>
          @yield('content')  
    </div>

    <script>
        function openSidebar() {
            document.getElementById("mySidebar").classList.add("open");
            document.getElementById("mainContent").classList.add("shift");
            localStorage.setItem("sidebarOpen", "true");
        }

        function closeSidebar() {
            document.getElementById("mySidebar").classList.remove("open");
            document.getElementById("mainContent").classList.remove("shift");
            localStorage.setItem("sidebarOpen", "false");
        }

        // On page load
        window.addEventListener("DOMContentLoaded", () => {
            if(localStorage.getItem("sidebarOpen") === "true") {
                document.getElementById("mySidebar").classList.add("open");
                document.getElementById("mainContent").classList.add("shift");
            }
        });
        function openSidebar() {
            const sidebar = document.getElementById("mySidebar");
            sidebar.classList.add("open", "animate");
            document.getElementById("mainContent").classList.add("shift");
        }
    </script>

</body>
</html>