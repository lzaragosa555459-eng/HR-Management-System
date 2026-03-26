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
    <img src="{{ asset('images\CoreHRlogo.png') }}" alt="logo" height="50px" style="margin-left: 10px; margin-bottom:40px;">

    <span class="close-btn" onclick="closeSidebar()">×</span>

    <a href="{{ route('employees.dashboard') }}" 
       class="{{ Route::is('employees.dashboard') ? 'active' : '' }}">
        <i class="bi bi-house-door-fill"></i> Dashboard
    </a>

    <a href="{{ route('employees.index') }}" 
       class="{{ Route::is('employees.index') ? 'active' : '' }}">
        <i class="bi bi-people-fill"></i> Employees
    </a>

    <a href="#" class="{{ Route::is('organizationAndSchedule.*') ? 'active' : '' }}">
        <i class="bi bi-building"></i> Organization and Schedule
    </a>

    <a href="#" class="{{ Route::is('attendance.*') ? 'active' : '' }}">
        <i class="bi bi-calendar-check-fill"></i> Attendance
    </a>

    <a href="#" class="{{ Route::is('payroll.*') ? 'active' : '' }}">
        <i class="bi bi-cash-stack"></i> Payroll
    </a>
<br><br><br><br><br>
    <a href="#" class="{{ Route::is('logout.*') ? 'active' : '' }}">
        <i class="bi bi-person-circle"></i> logout
    </a>
</div>

    <!-- Main content -->
    <div id="mainContent" class="main">
        <button class="toggle-btn" onclick="openSidebar()">☰ Menu</button>
          @yield('content')  
    </div>

    <script>
    // Get elements
    const sidebar = document.getElementById("mySidebar");
    const mainContent = document.getElementById("mainContent");

    // Load state from localStorage on page load
    window.addEventListener("DOMContentLoaded", () => {
        const isOpen = localStorage.getItem("sidebarOpen");
        if (isOpen === "true") {
        sidebar.classList.add("open");
        mainContent.classList.add("shift");
        }
    });

    function openSidebar() {
        sidebar.classList.add("open");
        mainContent.classList.add("shift");
        localStorage.setItem("sidebarOpen", "true"); // save state
    }

    function closeSidebar() {
        sidebar.classList.remove("open");
        mainContent.classList.remove("shift");
        localStorage.setItem("sidebarOpen", "false"); // save state
    }
    </script>

</body>
</html>