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
    <div class="admin_patient">
<?php
require_once 'config.php';

$sql = "SELECT *
FROM LoginPatient";
if($result = mysqli_query($link, $sql)){
 if(mysqli_num_rows($result) > 0){
		echo "<form method='POST'><table><tr><th>Contact this user?</th><th>Patient ID</th><th>Name</th><th>Username</th><th>Email</th><th>Password</th></tr>";
     while($row = mysqli_fetch_array($result)){
			echo "<tr><td>"."<input type='radio' name='patient' value=".$row['user_id']." required>"."</td><td>".$row['user_id'] ."</td><td>". $row['name']."</td><td>". $row['username']."</td><td>". $row['email']."</td><td>". $row['password']."</td></tr>"; }
		echo"</table><input type='submit' value='Delete' name='delete_patient'></form>";
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
<div class="admin_Doctor">
    <?php
    require_once 'config.php';

    $sql = "SELECT *
    FROM LoginDoctor";
    if($result = mysqli_query($link, $sql)){
     if(mysqli_num_rows($result) > 0){
    		echo "<form method='POST'><table><tr><th> Contact this user?</th><th>Doctor ID</th><th>Name</th><th>Username</th><th>Email</th><th>Password</th></tr>";
         while($row = mysqli_fetch_array($result)){
    			echo "<tr><td>"."<input type='radio' name='doctor' value=".$row['user_id']." required>"."</td><td>".$row['user_id'] ."</td><td>". $row['name']."</td><td>". $row['username']."</td><td>". $row['email']."</td><td>". $row['password']."</td></tr>"; }
    		echo"</table><input type='submit' value='Delete' name='delete_doctor'></form>";
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
<div class="admin_Organization">
    <?php
    require_once 'config.php';

    $sql = "SELECT *
    FROM LoginOrganization";
    if($result = mysqli_query($link, $sql)){
     if(mysqli_num_rows($result) > 0){
    		echo "<form method='POST'><table><tr><th>Contact this user?</th><th>Organization ID</th><th>Name</th><th>Username</th><th>Email</th><th>Password</th></tr>";
         while($row = mysqli_fetch_array($result)){
    			echo "<tr><td>"."<input type='radio' name='organization' value=".$row['user_id']." required>"."</td><td>".$row['user_id'] ."</td><td>". $row['name']."</td><td>". $row['username']."</td><td>". $row['email']."</td><td>". $row['password']."</td></tr>"; }
    		echo"</table><input type='submit' value='Delete' name='contact_organization'></form>";
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
<?php
require_once 'config.php';

if(isset($_POST['contact_patient'])){
    $input = $_POST['patient'];
    $sql = "DELETE FROM LoginPatient WHERE user_id = '$input'";
        if ($link->query($sql) === TRUE) {
            header("location: admin_view_users.php");
        }
        else {
            echo "PATIENT DELETE DIDNT GO THROUGH...";
        }
}

elseif(isset($_POST['contact_doctor'])){
    $input = $_POST['doctor'];
    $sql = "DELETE FROM LoginDoctor WHERE user_id = '$input'";
    if ($link->query($sql) === TRUE) {
        header("location: admin_view_users.php");
    }
    else{
        echo "doc delete didnt go through....";
    }
}

elseif(isset($_POST['contact_organization'])){
    $input = $_POST['organization'];
    $sql = "DELETE FROM LoginOrganization WHERE user_id = '$input'";
    if ($link->query($sql) === TRUE) {
        header("location: admin_view_users.php");
    }
}
else {
    echo $link->error;
}
?>
