<!doctype html>
<html>
<head>
    <title>Med Connect Administrator View All Users Page</title>
    <link rel="stylesheet" type="text/css" href="homepage.css" >
</head>
<body>

<div id="container">
    <div id="header">
        <h1><img src="MedLogo.jpg" alt="Med Connect Logo"></h1>
		<a class="left-align" href="about_page.html" style="color: #e61919;">About</a>
		<a href="support_page.php" style="color: #e61919;">Support</a>
		<a class = "right-align" href="logout.php" style="color: #e61919;">Logout</a>
    </div>
	
    <div id="content">
		<div id="navigation">
			<h2> Navigation:</h2>
			<br>
			<ul>
				<li><a href="admin_homepage.php">Admin Profile</a></li>
				<br>
				<li><a href="admin_edit_profile.php">Edit Profile</a></li>
				<br>
				<li><a class="selected" href="admin_all_users.php">View Users</a></li>
				<br>
				<li><a href="admin_all_events.php">View Events</a></li>
				<br>
				<li><a href="admin_all_surveys.php">View Surveys</a></li>
				<br>
		</div>
		
		<div id="main">
			<h2>Welcome Administrator!</h2>
			<p>      
			    <div id="admin_patient" style="width: 90%">
<?php
require_once 'config.php';

$sql = "SELECT *
FROM LoginPatient";
if($result = mysqli_query($link, $sql)){
 if(mysqli_num_rows($result) > 0){
        echo "<form method='POST'><table><tr><th>Delete this user?</th><th>Patient ID</th><th>Name</th><th>Username</th><th>Email</th><th>Password</th></tr>";
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
<div id="admin_Doctor" style="table-layout:fixed; width: 90%;">
    <?php
    require_once 'config.php';

    $sql = "SELECT *
    FROM LoginDoctor";
    if($result = mysqli_query($link, $sql)){
     if(mysqli_num_rows($result) > 0){
            echo "<form method='POST'><table><tr><th> Delete this user?</th><th>Doctor ID</th><th>Name</th><th>Username</th><th>Email</th><th>Password</th></tr>";
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
<div id="admin_Organization" style="table-layout:fixed; width: 90%;">
    <?php
    require_once 'config.php';

    $sql = "SELECT *
    FROM LoginOrganization";
    if($result = mysqli_query($link, $sql)){
     if(mysqli_num_rows($result) > 0){
            echo "<form method='POST'><table><tr><th>Delete this user?</th><th>Organization ID</th><th>Name</th><th>Username</th><th>Email</th><th>Password</th></tr>";
         while($row = mysqli_fetch_array($result)){
                echo "<tr><td>"."<input type='radio' name='organization' value=".$row['user_id']." required>"."</td><td>".$row['user_id'] ."</td><td>". $row['name']."</td><td>". $row['username']."</td><td>". $row['email']."</td><td>". $row['password']."</td></tr>"; }
            echo"</table><input type='submit' value='Delete' name='delete_organization'></form>";
        }
        else{
            echo "no result";
        }
    }
    else{
        echo "ERROR". mysqli_error($link);
    }
?>
			</p>
		</div>
       
    </div>
</div>

</body>

</html>

<?php
require_once 'config.php';

if(isset($_POST['delete_patient'])){
    $input = $_POST['patient'];
    $sql = "DELETE FROM LoginPatient WHERE user_id = '$input'";
        if ($link->query($sql) === TRUE) {
            header("location: admin_all_users.php");
        }
        else {
            echo "PATIENT DELETE DIDNT GO THROUGH...";
        }
}

elseif(isset($_POST['delete_doctor'])){
    $input = $_POST['doctor'];
    $sql = "DELETE FROM LoginDoctor WHERE user_id = '$input'";
    if ($link->query($sql) === TRUE) {
        header("location: admin_all_users.php");
    }
    else{
        echo "doc delete didnt go through....";
    }
}

elseif(isset($_POST['delete_organization'])){
    $input = $_POST['organization'];
    $sql = "DELETE FROM LoginOrganization WHERE user_id = '$input'";
    if ($link->query($sql) === TRUE) {
        header("location: admin_all_users.php");
    }
}
else {
    echo $link->error;
}
?>


