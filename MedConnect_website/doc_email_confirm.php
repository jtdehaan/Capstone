<?php
require_once 'config.php';
echo 'logged in';
$email = mysql_escape_string($_GET['email']); // Set email variable
$email_code = mysql_escape_string($_GET['email_code']); // Set hash variable
echo $email;
echo '<br>' . $email_code;
$sql = "SELECT * FROM LoginDoctor where email = '$email' and email_code = '$email_code'";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
		mysqli_query($link, "UPDATE LoginDoctor SET active = '1' WHERE email = '$email' and email_code = '$email_code'");
        while($row = mysqli_fetch_array($result)){
			echo $row['name']; }
	mysqli_free_result($result);}
	else{
		echo "no result";
	}
}
else{
	echo "ERROR";
}
header("location: login_page.html");
?>
