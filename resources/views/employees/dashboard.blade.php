<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @extends('layout.sidebar')

    @section('content')
    <h1>Dashboard</h1>
    <div class="cards-container">
    <div class="card">
        <h3>Total Employees</h3>
        <p>{{ $employeesCount }}</p>
    </div>

    <div class="card">
        <h3>Total Departments</h3>
        <p>{{ $departmentsCount }}</p>
    </div>

    <div class="card">
        <h3>Total Positions</h3>
        <p>{{ $positionsCount }}</p>
    </div>
</div>
    @endsection
</body>
</html>