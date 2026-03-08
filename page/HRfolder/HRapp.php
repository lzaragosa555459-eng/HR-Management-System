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
      $empname = $_SESSION['hrUsername'];

        // SQL query to check if this username exists in hr or employee
        $sql_hr = "SELECT * FROM hr WHERE hrName = '$empname'";
        $result_hr = mysqli_query($conn, $sql_hr);

        if(mysqli_num_rows($result_hr) > 0){
            echo "<h1>Welcome, Employee $empname !</h1>";
       

     
      echo " <h2>DASHBOARD</h2>";
      $sql = "SELECT hr.hrName, COUNT(employee.empID) AS totalEmployees
        FROM hr
        JOIN employee ON hr.keyID = employee.keyID
        GROUP BY hr.hrID, hr.hrName";

        $result = mysqli_query($conn, $sql);

     

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo " Total of employees: ".$row['totalEmployees']."<br>";
            }
        } else {
            echo "No HR or employees found.";
        }

         } else {
            echo "Username not found in database.";
        }
    ?>
    </div>
   
    
</body>
</html>