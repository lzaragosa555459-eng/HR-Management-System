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
             <h3>HR/</h3>
            Name: <br>
            <input type="text" name="name" placeholder="Full name"> <br>
            <input type="submit" value="Button" name="save">
        </form>
        <?php 
         if(isset($_POST['save'])){
            if(!empty($_POST['name'])){
                $_SESSION['HRname'] = $_POST['name'];
                $name = $_POST['name'];

                $sqlV1 = "SELECT count(keyCode) from passkey"; 
                mysqli_query($conn, $sqlV1);

                $random = rand(1,(int)$sqlV1);
                $sqlV2 = "INSERT INTO hr (hrName, keyID) VALUES ('$name', '$random')";
                mysqli_query($conn, $sqlV2);
                
                header("Location: HRapp.php");
            }
         }
        ?>
    </div>
</body>
</html>