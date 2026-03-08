<?php
session_start();

$servername = 'localhost';
$user = 'root';
$password = '';
$database = 'HRMS';

$conn = mysqli_connect($servername,$user,$password,$database);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <?php 
        $sql = "SELECT hrname from hr where";

        echo "<h1>Wecome, $HRname !</h1>";
        ?>
    </div>
    <h2>DASHBOARD</h2>
    Employees: 0
</body>
</html>