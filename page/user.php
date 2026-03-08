<?php

use Dba\Connection;

ob_start(); // <-- Added to allow header() to work
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
       <form action="" method="post">
         <input type="submit" value="Human Resource" name="hr">
         <input type="submit" value="Employee" name="employee">
       </form>
        <?php

// HR button logic
if(isset($_POST['hr'])){

    if(!isset($_POST['yesHR']) && !isset($_POST['noHR'])){
        ?>
        <div style="border:1px solid black; padding:20px; width:250px; margin-top:10px;">
            <p>Are you sure you want to register as Human Resource?</p>
            <form method="post">
                <input type="hidden" name="name" value="<?php echo $_SESSION['username']; ?>">
                <button name="yesHR">Yes</button>
                <button name="noHR">No</button>
            </form>
        </div>
        <?php
    }

    else if(isset($_POST['yesHR'])){
        $name = $_SESSION['username'];

        $sqlV1 = "SELECT count(keyCode) as total from passkey"; 
        $result = mysqli_query($conn, $sqlV1);
        $row = mysqli_fetch_assoc($result);

        $random = rand(1,$row['total']);
        $sqlV2 = "INSERT INTO hr (hrName, keyID) VALUES ('$name', '$random')";
        mysqli_query($conn, $sqlV2);

        header("Location: HRfolder/HRapp.php");
        exit();
    }

    else if(isset($_POST['noHR'])){
        echo "You canceled the HR registration.";
    }
}

// Employee button logic
else if(isset($_POST['employee'])){

    // Step 1: Display Yes/No panel if not clicked
    if(!isset($_POST['yesEMP']) && !isset($_POST['noEMP'])){
        ?>
        <div style="border:1px solid black; padding:20px; width:250px; margin-top:10px;">
            <p>Are you sure you want to register as Employee?</p>
            <form method="post">
                <input type="hidden" name="name" value="<?php echo $_SESSION['username']; ?>">
                <button name="yesEMP">Yes</button>
                <button name="noEMP">No</button>
            </form>
        </div>
        <?php
    }

    // Step 2: Show 6-digit code input **after Yes is clicked**
    else if(isset($_POST['yesEMP']) && !isset($_POST['submitCode'])){
        ?>
        <div style="border:1px solid black; padding:20px; width:300px; margin-top:10px;">
            <p>Enter your 6-digit code:</p>
            <form method="post">
                <input type="hidden" name="name" value="<?php echo $_SESSION['username']; ?>">
                <input type="text" name="code" placeholder="6-digit code" required><br><br>
                <input type="submit" name="submitCode" value="Submit">
            </form>
        </div>
        <?php
    }

    // Step 3: Process the code submission
    else if(isset($_POST['submitCode'])){
        $name = $_POST['name'];
        $code = $_POST['code'];

        $sqlv1 = "SELECT keyid FROM passkey WHERE keycode = '$code'";
        $result = mysqli_query($conn, $sqlv1);

        if($row = mysqli_fetch_assoc($result)){
            $keyID = $row['keyid'];

            $sqlv2 = "INSERT INTO employee (empName, KeyID) VALUES ('$name', '$keyID')";
            mysqli_query($conn, $sqlv2);

            header("location: EMPfolder/EMPapp.php");
            exit();
        } else {
            echo "Invalid key code.";
        }
    }

    else if(isset($_POST['noEMP'])){
        echo "You canceled the Employee registration.";
    }
}
?>
      
 </section>

    <form action="server.php" method="post">
        <input type="submit" name="logout" value="logout">
    </form>

    
    <?php
    if(isset($_POST['logout'])){
        header("location: index.php");
        exit();
    } 
     ?>

     
</body>
</html>