<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @extends('layout.sidebar')

    @section('content')
    <h1>Employees</h1>
    <button class="btn btn-add">Add+</button>
   <table border="1" cellpadding="5" class="styled-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>DOB</th>
            <th>Gender</th>
            <th>Hire Date</th>
            <th>Department</th>
            <th>Position</th>
            <th>Manager</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($employees as $emp)
        <tr>
            <td>{{ $emp->id }}</td>
            <td>{{ $emp->first_name }} {{ $emp->last_name }}</td>
            <td>{{ $emp->email }}</td>
            <td>{{ $emp->phone }}</td>
            <td>{{ $emp->address }}</td>
            <td>{{ $emp->date_of_birth }}</td>
            <td>{{ $emp->gender }}</td>
            <td>{{ $emp->hire_date }}</td>
            <td>{{ $emp->department_id }}</td>
            <td>{{ $emp->position_id }}</td>
            <td>{{ $emp->manager_id }}</td>
            <td>{{ $emp->created_at }}</td>
            <td>{{ $emp->updated_at }}</td>
            <td>
                <button class="btn btn-edit">Edit</button>
                <button class="btn btn-delete">Delete</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
</body>
</html>