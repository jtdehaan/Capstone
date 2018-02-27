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
session_start();
$session_user = $_SESSION['username'];

$sql = "SELECT name, username, email
FROM LoginPatient WHERE username = '$session_user'";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
		echo "<table><tr><th>Name</th><th>Username</th><th>Email</th></tr>";
        while($row = mysqli_fetch_array($result)){
			echo "<tr><td>".$row['name'] ."</td><td>". $row['username']."</td><td>". $row['email']."</td></tr>"; }
		echo"</table>";
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
