<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "healthcare";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$name = $_POST['name'];
$id = $_POST['ID'];
$password = $_POST['password'];
$username = $_POST['sitem'];

// Insert the Patient into the Patients table
$sql = "INSERT INTO patients (name, username, password, ID) VALUES ('$name', '$username', '$password', '$id')";

if ($conn->query($sql) === TRUE) {
	echo "Patient registered successfully";
    header('Location: index.php');
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>