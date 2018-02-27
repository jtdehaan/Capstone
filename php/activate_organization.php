<?php
	
	$con = mysqli_connect("db.soic.indiana.edu","i494f17_team37","my+sql=i494f17_team37", "i494f17_team37");
	
	$email_code = $_GET['email_code'];
	
    $sql = "SELECT * FROM LoginOrganization WHERE email_code = '$email_code'";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

    while ($row = mysqli_fetch_assoc($result)) {
		$db_code = $row['email_code'];
	}
	
	if($email_code === $db_code)
	{
		mysqli_query($con, "UPDATE LoginOrganization SET email_code = '0'");
		mysqli_query($con, "UPDATE LoginOrganization SET active = 1");
		echo "Successfully registered. You may now log in!";
	}
	else
	{
		echo "Username & Code don't match";
	}
    
?>