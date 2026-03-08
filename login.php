<?php

use Dba\Connection;

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
         <a href="index.php">Back</a>
    <section>
        <div class="container">
            <h2>Login</h2>
            <form action="" method="post">
                username: <br>
                <input type="text" placeholder="Enter Username" name="loginName" required> <br>
                email: <br>
                <input type="email" placeholder="Enter email" name="loginEmail" required><br>
                password: <br>
                <input type="password" placeholder="Enter password" name="LoginPassword" required>
                <input type="submit" value="Submit" name="submit">
            </form>

      <?php
       
    if(isset($_POST['submit'])){
    
    $username = $_POST['loginName'];

    // Check in HR table
    $sql_hr = "SELECT 'HR' AS user_type FROM hr WHERE hrName = '$username'";
    $result_hr = mysqli_query($conn, $sql_hr);

    // Check in Employee table
    $sql_emp = "SELECT 'Employee' AS user_type FROM employee WHERE empName = '$username'";
    $result_emp = mysqli_query($conn, $sql_emp);

    if(mysqli_num_rows($result_hr) > 0){
         $_SESSION['hrUsername'] = $_POST['loginName'];
         header("Location: page/HRfolder/HRapp.php");
    } elseif(mysqli_num_rows($result_emp) > 0){
        $_SESSION['empUsername'] = $_POST['loginName'];
         header("Location: page/EMPfolder/EMPapp.php");
    } else {
          
            $_SESSION['username'] = $_POST['loginName'];
            $name = $_POST['loginName'];
            $email = $_POST['loginEmail'];
            $password = $_POST['LoginPassword'];

            $sql = "SELECT * FROM users WHERE name='$name' AND email='$email'";
            $result = mysqli_query($conn,$sql);


            if(mysqli_num_rows($result) == 1){

                $row = mysqli_fetch_assoc($result);

                // verify hashed password
                if(password_verify($password, $row['password'])){
                   header("location: page/user.php");
                } else {
                    echo "Incorrect password";
                }

            } else {
                echo "User not found";
            }

        }
    }


           ?>
        </div>
    </section>
</body>
</html>