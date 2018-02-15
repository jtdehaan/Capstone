<!-- NEEDS TO BE organization specific -->
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

$sql = "SELECT name, location, date, time, price, description, attendance, payinapp
FROM Events";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
		echo "<table><tr><th>Name</th><th>Location</th><th>Date</th><th>Time</th><th>Price</th><th>description</th><th>attendance</th><th>payinapp</th></tr>";
        while($row = mysqli_fetch_array($result)){
			echo "<tr><td>".$row['name'] ."</td><td>". $row['location']."</td><td>". $row['date']."</td><td>". $row['time']."</td><td>". $row['price']."</td><td>". $row['description']."</td><td>". $row['attendance']."</td><td>". $row['payinapp']."</td></tr>"; }
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
