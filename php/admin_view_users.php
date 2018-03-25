
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
    <div name="admin_patient">
<?php
require_once 'config.php';

$sql = "SELECT *
FROM LoginPatient";
if($result = mysqli_query($link, $sql)){
 if(mysqli_num_rows($result) > 0){
		echo "<table><tr><th>Patient ID</th><th>Name</th><th>Username</th><th>Email</th><th>Password</th></tr>";
     while($row = mysqli_fetch_array($result)){
			echo "<tr><td>".$row['user_id'] ."</td><td>". $row['name']."</td><td>". $row['username']."</td><td>". $row['email']."</td><td>". $row['password']."</td></tr>"; }
		echo"</table>";
	}
	else{
		echo "no result";
	}
}
else{
	echo "ERROR". mysqli_error($link);
}
?>
</div>
<br>
<div name="admin_Doctor">
    <?php
    require_once 'config.php';

    $sql = "SELECT *
    FROM LoginDoctor";
    if($result = mysqli_query($link, $sql)){
     if(mysqli_num_rows($result) > 0){
    		echo "<table><tr><th>Doctor ID</th><th>Name</th><th>Username</th><th>Email</th><th>Password</th></tr>";
         while($row = mysqli_fetch_array($result)){
    			echo "<tr><td>".$row['user_id'] ."</td><td>". $row['name']."</td><td>". $row['username']."</td><td>". $row['email']."</td><td>". $row['password']."</td></tr>"; }
    		echo"</table>";
    	}
    	else{
    		echo "no result";
    	}
    }
    else{
    	echo "ERROR". mysqli_error($link);
    }
    ?>
</div>
<br>
<div name="admin_Organization">
    <?php
    require_once 'config.php';

    $sql = "SELECT *
    FROM LoginOrganization";
    if($result = mysqli_query($link, $sql)){
     if(mysqli_num_rows($result) > 0){
    		echo "<table><tr><th>Organization ID</th><th>Name</th><th>Username</th><th>Email</th><th>Password</th></tr>";
         while($row = mysqli_fetch_array($result)){
    			echo "<tr><td>".$row['user_id'] ."</td><td>". $row['name']."</td><td>". $row['username']."</td><td>". $row['email']."</td><td>". $row['password']."</td></tr>"; }
    		echo"</table>";
    	}
    	else{
    		echo "no result";
    	}
    }
    else{
    	echo "ERROR". mysqli_error($link);
    }
    ?>
</div>
</body>
</html>
