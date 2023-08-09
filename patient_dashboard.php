<?php
// Set up database connection
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'healthcare';

$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if user is logged in
session_start();
if (!isset($_SESSION['sitem'])) {
    header('Location: index.php');
    exit;
}

// Get patient information from the database
$username = $_SESSION['sitem'];
$query = "SELECT * FROM patients WHERE username = '$username'";
$result = $mysqli->query($query);
$patient = $result->fetch_assoc();

// Get appointments for the patient
$patient_id = $patient['ID'];
$query = "SELECT * FROM appointments WHERE patient_id = '$patient_id'";
$result = $mysqli->query($query);
$appointments = array();
while ($appointment = $result->fetch_assoc()) {
    $appointments[] = $appointment;
}
?>

<!-- Patient Dashboard HTML -->
<!DOCTYPE html>
<html>
<head>
    <title>Patient Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo $patient['name']; ?>!</h1>
    <h2>Your Appointments:</h2>
    <?php if (count($appointments) == 0): ?>
        <p>You have no appointments scheduled.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Doctor Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment): ?>
                    <?php
                    $doctor_id = $appointment['doctor_id'];
                    $query = "SELECT name FROM doctors WHERE id = '$doctor_id'";
                    $result = $mysqli->query($query);
                    $doctor = $result->fetch_assoc();
                    ?>
                    <tr>
                        <td><?php echo $doctor['name']; ?></td>
                        <td><?php echo $appointment['date']; ?></td>
                        <td><?php echo $appointment['time']; ?></td>
                        <td><?php echo $appointment['notes']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <br>
    <a href="book_appointment.html">Book Appointment</a><br>
    <a href="logout.php">Logout</a>
</body>
</html>