<?php
require_once 'config.php';
session_start();
echo $_SESSION['username'];
$session_user = $_SESSION['username'];

//gets patient user id based on the current session
echo "<br>this is the session_user<br>";
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
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }

//adds +1 to the attendance in Events
$sql = "UPDATE Events SET attendance = attendance + 1 WHERE EventID = $event_id";
    if ($link->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }
 ?>

<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
</head>
<body>
<?php
require_once 'config.php';

$sql = "SELECT EventID, name, location, date, time, price, description, attendance, payinapp
FROM Events";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
		echo '<form ><table><tr><th>Register fo this event?</th><th>Name</th><th>Location</th><th>Date</th><th>Time</th><th>Price</th><th>description</th><th>attendance</th><th>payinapp</th></tr>';
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
</body>
</html>
