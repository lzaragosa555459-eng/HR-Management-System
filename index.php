<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<?php
// Database credentials
$servername = "localhost"; // XAMPP default
$username = "root";        // XAMPP default
$password = "";            // XAMPP default is empty
$database = "system";     // The database you created

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully!";

// Optional: Query example
$sql = "SELECT * FROM employees";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Start the table and add headers
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
          </tr>";

    // Loop through the data and create table rows
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["firstname"] . "</td>
                <td>" . $row["middlename"] . "</td>
                <td>" . $row["lastname"] . "</td>
              </tr>";
    }

    echo "</table>"; // End the table
} else {
    echo "No records found.";
}


if (isset($_POST['submit'])) {

    $firstname  = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname   = $_POST['lastname'];

    $sql = "INSERT INTO employees (firstname, middlename, lastname)
            VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $firstname, $middlename, $lastname);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    // 🔥 THIS LINE FIXES THE DUPLICATION
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
// Close connection
$conn->close();
?>

<div class="container">
<p>Add new employees*</p>
<form method="POST" action="">
    <input type="text" name="firstname" placeholder="First Name" required>
    <input type="text" name="middlename" placeholder="Middle Name">
    <input type="text" name="lastname" placeholder="Last Name" required>

    <button type="submit" name="submit">Submit</button>
</form>

</div>



</body>
</html>