<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user</title>
</head>
<style>
    .container{
        background-color: grey;
        padding: 50px;
    }
    h1{
        text-align: center;
    }
</style>
<body>
 <section>
    <div class="container">
       <?php 
        $username =  $_SESSION['username'];
       echo "<h1>Welcome, $username !</h1>";
       ?>
       <p>Thank you for choosing CoreHR as your orginizer for hr purposes.</p>
       <h5>To continue creating your account. Choose your role.</h5>
       <a href="HR.php">Human Resource</a><br>
       <a href="EMP.php">Employee</a>

      
 </section>

    <form action="server.php" method="post">
        <input type="submit" name="logout" value="logout">
    </form>

    
    <?php
    if(isset($_POST['logout'])){
        header("location: index.php");
        
    } 
     ?>
</body>
</html>