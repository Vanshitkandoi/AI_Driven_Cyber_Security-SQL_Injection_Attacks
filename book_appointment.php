<?php
// Start the session
session_start();

// Check if user is logged in as patient
if (!isset($_POST['patient_id'])) {
	header('Location: index.php');
	exit;
}

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
$patient_id = $_POST['patient_id'];
$doctor_id = $_POST['doctor_id'];
$date = $_POST['date'];
$time = $_POST['time'];
$notes = $_POST['notes'];

// Insert the appointment into the appointments table
$sql = "INSERT INTO appointments (patient_id, doctor_id, date, time, notes) VALUES ('$patient_id', '$doctor_id', '$date', '$time', '$notes')";

if ($conn->query($sql) === TRUE) {
	echo "Appointment booked successfully";
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>