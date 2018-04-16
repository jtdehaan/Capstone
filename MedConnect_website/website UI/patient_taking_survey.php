
<!doctype html>

<html>
<head>
    <title>Med Connect Patient Take Surveys</title>
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
				<li><a href="patient_homepage.php">User Profile</a></li>
				<br>
				<li><a href="patient_edit_profile.php">Edit Profile</a></li>
				<br>
				<li><a href="patient_my_doctors.php">My Doctors</a></li>
				<br>
				<br>
				<li>Events:</li>
				<br>
				<li><a href="patient_view_my_events.php">View Current Events</a></li>
				<br>
				<li><a href="patient_event_register.php">Register For Events</a></li>
				<br>
				<li><a class="selected" href="patient_take_survey.php">Take Surveys</a></li>
		</div>
		
		<div id="main" style="overflow-y: scroll; height:400px;">
			<h2>Your Surveys: </h2>
		
			<p>
				<?php
				require_once 'config.php';

				$sql = "SELECT name, SurveyID, Q1, Q2, Q3, Q4, Q5
				FROM Survey";
				
				if($result = mysqli_query($link, $sql)){
					if(mysqli_num_rows($result) > 0){
						echo '<form action="survey_info_grab.php" method="POST"><table><tr><th>Take Survey?</th><th>Name</th><th>Question 1</th><th>Question 2</th><th>Question 3</th><th>Question 4</th><th>Question 5</th></tr>';
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
			</div>
			</p>
		</div>
       
    </div>
</div>

</body>

</html>
