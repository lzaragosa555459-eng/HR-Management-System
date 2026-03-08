<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
      $empname = $_SESSION['username'];
      echo "<h1>Welcome, Employee $empname !</h1>";
    ?>

  
</body>
</html>