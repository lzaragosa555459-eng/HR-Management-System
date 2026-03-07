<?php

use Dba\Connection;

session_start();

$servername = 'localhost';
$user = 'root';
$password = '';
$database = 'HRMS';

$conn = mysqli_connect($servername,$user,$password,$database);

if($conn){
    echo "database successfully connected";
} else {
    echo "error";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <a href="user.php">Back</a>
    <div class="container">
        <form action="" method="post">
            <h3>Employee/</h3>
            Name: <br>
            <input type="text" name="name" placeholder="Full name"> <br>
            Enter 6 number code: <br>
            <input type="text" name="code" placeholder="code">
        </form>
    </div>
</body>
</html>