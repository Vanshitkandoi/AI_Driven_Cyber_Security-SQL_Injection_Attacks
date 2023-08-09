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

// Check if user is logged in as an admin
session_start();
if (!isset($_SESSION['sitem'])) {
    header('Location: index.php');
    exit;
}

// Get total number of patients from the database
$query = "SELECT COUNT(*) AS total_patients FROM patients";
$result = $mysqli->query($query);
$patient_count = $result->fetch_assoc()['total_patients'];

// Get total number of doctors from the database
$query = "SELECT COUNT(*) AS total_doctors FROM doctors";
$result = $mysqli->query($query);
$doctor_count = $result->fetch_assoc()['total_doctors'];

// Get latest appointments from the database
$query = "SELECT appointments.*, patients.name AS patient_name, doctors.name AS doctor_name
          FROM appointments
          INNER JOIN patients ON appointments.patient_id = patients.id
          INNER JOIN doctors ON appointments.doctor_id = doctors.id
          ORDER BY appointments.date DESC, appointments.time DESC
          LIMIT 5";
$result = $mysqli->query($query);
$appointments = array();
while ($appointment = $result->fetch_assoc()) {
    $appointments[] = $appointment;
}
?>

<!-- Admin Dashboard HTML -->
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome, Admin!</h1>
    <h2>Statistics:</h2>
    <p>Total Patients: <?php echo $patient_count; ?></p>
    <p>Total Doctors: <?php echo $doctor_count; ?></p>
    <h2>Latest Appointments:</h2>
    <?php if (count($appointments) == 0): ?>
        <p>No appointments found.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Patient Name</th>
                    <th>Doctor Name</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment): ?>
                    <tr>
                        <td><?php echo $appointment['date']; ?></td>
                        <td><?php echo $appointment['time']; ?></td>
                        <td><?php echo $appointment['patient_name']; ?></td>
                        <td><?php echo $appointment['doctor_name']; ?></td>
                        <td><?php echo $appointment['notes']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <br>
    <a href="logout.php">Logout</a>
</body>
</html>