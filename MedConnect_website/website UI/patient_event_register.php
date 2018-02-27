<?php
require_once 'config.php';
session_start();
$session_user = $_SESSION['username'];

//gets patient user id based on the current session
$sql = "SELECT user_id FROM LoginPatient WHERE username = '$session_user'";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $patient_user_id = $row['user_id'];
            }
        }
    }
    else {
        echo "ERROR";
        }
//data from the form (the EventID from table Events)
$event_id = $_GET['register'];

//Inserts data into Attendance
$sql = "INSERT INTO Attendance (PatientID, EventID) VALUES ('$patient_user_id','$event_id')";
    if ($link->query($sql) === TRUE) {
    } else {
    }

//adds +1 to the attendance in Events
$sql = "UPDATE Events SET attendance = attendance + 1 WHERE EventID = $event_id";
    if ($link->query($sql) === TRUE) {
    } else {
    }
 ?>
<!doctype html>
<html>
<head>
    <title>Med Connect Patient All Events List Page</title>
    <link rel="stylesheet" type="text/css" href="homepage.css" >
</head>
<body>

<div id="container">
    <div id="header">
        <h1>Med Connect</h1>
		<a class="left-align" href="about_page.html">About</a>
		<a href="support_page.php">Support</a>
		<a class = "right-align" href="logout.php">Logout</a>
    </div>
	
    <div id="content">
		<div id="navigation">
			<h2> Navigation:</h2>
			<br>
			<ul>
				<li><a href="patient_homepage.php">User Profile</a></li>
				<br>
				<li><a href="patient_edit_profile.php">Edit Profile</a></li>
				<br>
				<li><a href="patient_my_doctors.php">My Doctors</a></li>
				<br>
				<br>
				<li>Events:</li>
				<br>
				<li><a href="patient_view_my_events.php">View Current Events</a></li>
				<br>
				<li><a class="selected" href="patient_event_register.php">Register For Events</a></li>
		</div>
		
		<div id="main" style="overflow-y: scroll; height:400px;">
			<h2>Events:</h2>
			<p> <?php
require_once 'config.php';

$sql = "SELECT EventID, name, location, date, time, price, description, attendance, payinapp
FROM Events";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo '<form ><table><tr><th>Register for this event?</th><th>Name</th><th>Location</th><th>Date</th><th>Time</th><th>Price</th><th>description</th><th>attendance</th><th>payinapp</th></tr>';
        while($row = mysqli_fetch_array($result)){
            echo "<tr><td>"."<input type='radio' name='register' value=".$row['EventID'].">"."</td><td>".$row['name'] ."</td><td>". $row['location']."</td><td>". $row['date']."</td><td>". $row['time']."</td><td>". $row['price']."</td><td>". $row['description']."</td><td>". $row['attendance']."</td><td>". $row['payinapp']."</td></tr>"; }
        echo "</table><input type='submit' value='submit'></form>";
    }
    else{
        echo "no result";
    }
}
else{
    echo "ERROR";
}
?>
			<br>
			<br>
			
			</p>
		</div>
       
    </div>
</div>

</body>

</html>
