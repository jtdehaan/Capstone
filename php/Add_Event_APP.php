<?php
	$con = mysqli_connect("db.soic.indiana.edu","i494f17_team37","my+sql=i494f17_team37", "i494f17_team37");
	$eventname = $_POST["Eventname"];
	$location = $_POST["Location"];
	$email = $_POST["Email"];
	$times = $_POST["Times"];
	$phone = $_POST["Phone"];
	$price = $_POST["Price"];
	$FID = $_POST["ID"];
	$ID = (int)$FID;

	function addEvent() {
		global $con, $eventname, $location, $email, $times, $phone, $price, $ID;
		$statement = mysqli_prepare($con, "INSERT INTO Events (name, location, date, price, OrganizationID) VALUES (?, ?, ?, ?, ?)");
		mysqli_stmt_bind_param($statement, "ssssi", $eventname, $location, $times,  $price, $ID);
        
		mysqli_stmt_execute($statement);
		mysqli_stmt_close($statement);
	}

	$response = array();
	addEvent();
	$response["success"] = true;
	echo json_encode($response);
?>