<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <!-- Sidebar -->
    <div id="mySidebar" class="sidebar">
        <span class="close-btn" onclick="closeSidebar()">×</span>
       <a href="{{ route('employees.dashboard') }}">Dashboard</a>
        <a href="{{ route('employees.index') }}">Employees</a>
        <a href="#">Departments</a>
        <a href="#">Positions</a>
        <a href="#">Attendance</a>
        <a href="#">Leaves</a>
        <a href="#">Payroll</a>
        <a href="#">Users</a>
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
        }

        function closeSidebar() {
            document.getElementById("mySidebar").classList.remove("open");
            document.getElementById("mainContent").classList.remove("shift");
        }
    </script>

</body>
</html>