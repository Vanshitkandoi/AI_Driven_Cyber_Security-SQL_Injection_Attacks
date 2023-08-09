<?php
//header("location: login.php");
?>

<?php
// Set up database connection
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'healthcare';

$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);
session_start();
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if doctor login form is submitted
if (isset($_POST['doctor_login'])) {
    $username = $_POST['sitem'];
    $password = $_POST['password'];

    // Check if username and password match in doctors table
    $query = "SELECT * FROM doctors WHERE username = '$username' AND password = '$password'";
    $result = $mysqli->query($query);

    // If matching credentials found
    if ($result->num_rows == 1) {
        // Redirect to doctor dashboard page
        $_SESSION['sitem'] = $username;
        header('Location: doctor_dashboard.php');
        exit;
    } else {
        // Display error message if credentials don't match
        echo "Invalid username or password DOCTOR.";
    }
}

// Check if patient login form is submitted
if (isset($_POST['patient_login'])) {
    $username = $_POST['sitem'];
    $password = $_POST['password'];

    // Check if username and password match in patients table
    $query = "SELECT * FROM patients WHERE username = '$username' AND password = '$password'";
    $result = $mysqli->query($query);

    // If matching credentials found
    if ($result->num_rows == 1) {
        // Redirect to patient dashboard page
        $_SESSION['sitem'] = $username;
        header('Location: patient_dashboard.php');
        exit;
    } else {
        // Display error message if credentials don't match
        echo "Invalid username or password PATIENT.";
        // echo "'$username'";
    }
}

// Check if admin login form is submitted
if (isset($_POST['admin_login'])) {
    $username = $_POST['sitem'];
    $password = $_POST['password'];

    // Check if username and password match in admins table
    $query = "SELECT * FROM admins WHERE username = '$username' AND password = '$password'";
    $result = $mysqli->query($query);

    // If matching credentials found
    if ($result->num_rows == 1) {
        // Redirect to admin dashboard page
        $_SESSION['sitem'] = $username;
        header('Location: admin_dashboard.php');
        exit;
    } else {
        // Display error message if credentials don't match
        echo "Invalid username or password ADMIN.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<title>Healthcare</title>
</head>
<style>
body {
background-image: url('example_img_girl.jpg');
background-repeat: no-repeat;
}
</style>
<body>
<?php
if ( !file_exists('blocked.txt') ) {
$deny_ips = array('-1');
 } else {
$deny_ips = file('blocked.txt');
 }
$ip = getenv("REMOTE_ADDR") ;
if ( (array_search($ip, $deny_ips))!== FALSE ) {
header("Location: hecker.php?msg=".$ip);
die;
 }
?>
<nav class="sticky w-full h-auto bg-gray-900 px-8 sm:px-0">
<div class="container flex justify-between py-4 mx-auto">
<label class="text-2xl font-light text-white font-bold" >
    Healthcare Saviour
 <!-- SQLInjection Testing -->
</label>
<ul class="flex text-gray-100 items-center">
<li class="uppercase font-semibold mr-6">
<a href='#' class='hover:text-blue-600 transition'>
 Home
</a>
</li>
<li class="uppercase font-semibold mr-6">
<a href='#' class='hover:text-blue-600 transition'>
 About
</a>
</li>
<li class="uppercase font-semibold mr-6">
<a href='#' class='hover:text-blue-600 transition'>
 Services
</a>
</li>
</ul>
</div>
</nav>
<div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6
lg:px-8" >
<div class="max-w-md w-full space-y-8">
<div>
<h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
 Healthcare Application
</h2>
<p class="font-medium text-center text-indigo-600
hover:text-indigo-500">
Swasthya
</p>

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Doctor</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Patient</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Admin</button>
  </li>
  <!-- <li class="nav-item" role="presentation">
    <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false" disabled>Disabled</button>
  </li> -->
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
    <!-- Doctor login form -->
    <!-- <input class="border-2 border-gray-300 bg-white h-10 w-full px-5 pr-16 rounded-lg text-sm focus:outline-none"
            type="search" name="username" placeholder="Username:"> -->
        <div>
            <!-- <button class="group relative w-full flex justify-center py-2 px-4
            border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600
            hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2
            focus:ring-indigo-500">
                Login
            </button> -->
        </div>
    </form>

    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="search" name="sitem" id="sitem" class="border-2 border-gray-300 bg-white h-10 w-full px-5 pr-16 rounded-lg text-sm focus:outline-none"
            placeholder="Username:">
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" class="border-2 border-gray-300 bg-white h-10 w-full px-5 pr-16 rounded-lg text-sm focus:outline-none"
            placeholder="Password:">
        <br><br>
        <input type="submit" name="doctor_login" value="Login"  class="group relative w-full flex justify-center py-2 px-4
            border border-transparent text-sm font-medium rounded-md text-white bg-green-600
            hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2
            focus:ring-green-500"><br>
    </form>
    <form action="register_doctor.html">
        <button type = "submit"  class="group relative w-full flex justify-center py-2 px-4
            border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600
            hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2
            focus:ring-indigo-500">Register</button>
    </form>

  </div>
  <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
    <!-- Patient login form -->
    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="search" name="sitem" id="sitem" class="border-2 border-gray-300 bg-white h-10 w-full px-5 pr-16 rounded-lg text-sm focus:outline-none"
            placeholder="Username:">
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" class="border-2 border-gray-300 bg-white h-10 w-full px-5 pr-16 rounded-lg text-sm focus:outline-none"
            placeholder="Password:">
        <br><br>
        <input type="submit" name="patient_login" value="Login"  class="group relative w-full flex justify-center py-2 px-4
            border border-transparent text-sm font-medium rounded-md text-white bg-green-600
            hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2
            focus:ring-green-500"><br>
    </form>
    <form action="register_patient.html">
        <button type = "submit"  class="group relative w-full flex justify-center py-2 px-4
                border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600
                hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2
                focus:ring-indigo-500">Register</button>
    </form>
  </div>
  <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
    <!-- Login form for admin -->
    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="search" name="sitem" id="sitem" class="border-2 border-gray-300 bg-white h-10 w-full px-5 pr-16 rounded-lg text-sm focus:outline-none"
            placeholder="Username:">
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" class="border-2 border-gray-300 bg-white h-10 w-full px-5 pr-16 rounded-lg text-sm focus:outline-none"
            placeholder="Password:">
        <br><br>
        <input type="submit" name="admin_login" value="Login"  class="group relative w-full flex justify-center py-2 px-4
            border border-transparent text-sm font-medium rounded-md text-white bg-green-600
            hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2
            focus:ring-green-500"><br>
    </form>
    <form action="register_admin.html">
        <button type = "submit"  class="group relative w-full flex justify-center py-2 px-4
                border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600
                hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2
                focus:ring-indigo-500">Register</button>
    </form>
  </div>
  <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">

  </div>
</div>


</div>
<!-- <form class="mt-8 space-y-6" action="">
<input class="border-2 border-gray-300 bg-white h-10 w-full px-5 pr-16
rounded-lg text-sm focus:outline-none"
type="search" name="username" placeholder="Enter Username here ">
<div>
<button class="group relative w-full flex justify-center py-2 px-4
border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600
hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2
focus:ring-indigo-500">
Search For Users
</button>
</div>
</form> -->
</div>
</div>
<h3 class="mt-3 text-center text-2xl font-bold text-indigo-700">
<?php
if(isset($_REQUEST['sitem'])){
$item = $_REQUEST['sitem'];
if($item !=""){
echo "Showing Result(s) For : " . $item ;
 }
 }
?>
</h3>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6
mt-10 ml-20 mr-20 ">
<?php
$obj = new stdClass();
if(isset($_REQUEST['sitem'])){
    $item = $_REQUEST['sitem'];
    if($item !=""){
        $curl = curl_init();
        $obj->sqli = $item;
        $resBody = json_encode($obj);
        //echo $resBody."<br>";
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://172.17.60.20:8008/main', //192.168.79.151 //172.17.63.65
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>$resBody,
        CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
        ),
        ));
        $response = curl_exec($curl);
        //echo "Hello2 $response";
        curl_close($curl);
        $res = json_decode($response);
        //echo "<br>Hello $res<br>";
        error_reporting(E_ERROR | E_PARSE); // For removing the error.
        if($res->result!=1){
            $sp = fopen('logs.txt', 'a');
            fwrite($sp,"\n".$item ." plain");
            fclose($sp);
            //include('connection.php');
            if (!$conn) {
            die("Connection failed: " .
            mysqli_connect_error());
            }
            $sql =" SELECT * from user where name = '$item' ;";
            $res = mysqli_query($conn,$sql);
            if(mysqli_num_rows($res)!=0){
                while($row = mysqli_fetch_assoc($res)){
                echo "<div class='w-full bg-gray-100
                rounded-lg p-12 flex flex-col justify-center items-center hover:transition
                duration-500 ease-in-out cursor-pointer transform hover:scale-110'>
                <div class='text-center'>
                <p class=' mb-2 text-xl font-black
                tracking-tighter text-gray-900 md:text-4xl title-font'> $row[name] </p>
                <p class='mb-2 text-base font-medium
                leading-relaxed text-left text-blue-500 '> $row[email] </p>
                <button type='submit' class='group
                relative w-full flex justify-center py-2 px-4 border border-transparent text-sm
                font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700
                focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500'>
                Get More Details
                </button>
                </div>
                </div>";
                } //while ends here
            }
            mysqli_close($conn);
        }else{
            echo "<h1 class='mt-3 text-center text-4xl font-bold
            text-red-700'>Sql Injection Detected!!</h1>\n";
            $ip = getenv("REMOTE_ADDR") ;
            $fp = fopen('blocked.txt', 'a');
            // $hip= sha1($ip);
            fwrite($fp,"\n".$ip);
            fclose($fp);
            $sp = fopen('logs.txt', 'a');
            fwrite($sp,"\n".$item. "healthcare");
            fclose($sp);
            if ( !file_exists('blocked.txt') ) {
            $deny_ips = array('-1');
            } else {
            $deny_ips = file('blocked.txt');
            }
            if ( (array_search($ip, $deny_ips))!== FALSE ) {
            header("Location: hecker.php?msg=".$ip);
            die;
            }
        }
    }
}
    ?>
    </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</html>