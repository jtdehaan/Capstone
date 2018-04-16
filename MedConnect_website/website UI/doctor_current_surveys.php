<!doctype html>
<html>
<head>
    <title>Med Connect Doctor Current Surveys</title>
    <link rel="stylesheet" type="text/css" href="homepage.css" >
</head>
<body>

<div id="container">
    <div id="header">
        <h1><img src="MedLogo.jpg" alt="Med Connect Logo"></h1>
		<a class="left-align" href="about_page.html">About</a>
		<a href="support_page.php">Support</a>
		<a class = "right-align" href="logout.php">Logout</a>
		
    </div>
	
    <div id="content">
		<div id="navigation">
			<h2> Navigation:</h2>
			<br>
			<ul>
				<li><a href="doctor_homepage.php">User Profile</a></li>
				<br>
				<li><a href="doctor_edit_profile.php">Edit Profile</a></li>
				<br>
				<li><a href="my_patients.php">My Patients</a></li>
				<br>
				<br>
				<li>Surveys:</li>
				<br>
				<li><a class="selected" href="doctor_current_surveys.php">View Current Surveys</a></li>
				<br>
				<li><a href="create_survey.php">Add a Survey</a></li>
		</div>
		
		<div id="main">
			<h2>Your Current Surveys:</h2>
			<br>
			<p> 
			<?php
					
require_once 'config.php';

	session_start();
	$session_user = $_SESSION['username'];
		
				echo "$session_user";
	
	$sql = "SELECT user_id FROM LoginDoctor WHERE username = '$session_user'";
		if($result = mysqli_query($link, $sql)){
			if(mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result)){
					$doctor_user_id = $row['user_id'];
				
				}
			}
			echo "Doctor ID: "."$doctor_user_id";
		}
		else {
			echo "ERROR";
			}
					 

			$sql = "SELECT name, SurveyID, Q1, Q2, Q3, Q4, Q5 FROM Survey WHERE DoctorID = $doctor_user_id";
				
				if($result = mysqli_query($link, $sql)){
					if(mysqli_num_rows($result) > 0){
						echo '<form action="survey_doctor_info_grab.php" method="POST"><table><tr><th>Choose Survey</th><th>Name</th><th>Question 1</th><th>Question 2</th><th>Question 3</th><th>Question 4</th><th>Question 5</th></tr>';
						while($row = mysqli_fetch_array($result)){
							echo "<tr><td>"."<input type='radio' name='take_survey' value=".$row['SurveyID'].">"."</td><td>".$row['name'] ."</td><td>". $row['Q1']."</td><td>". $row['Q2']."</td><td>". $row['Q3']."</td><td>". $row['Q4']."</td><td>". $row['Q5']."</td></tr>"; }
						echo "</table><input type='submit' value= 'choose this survey' name='select survey'></form>";
					}
					else{
						echo "no result";
					}
				}
				else{
					echo "ERROR";
				}
				
?>
			</p>
		</div>
       
    </div>
</div>

</body>

</html>
