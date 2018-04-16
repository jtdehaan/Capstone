<!doctype html>
<html>
<head>
    <title>Med Connect Doctor View Survey Page</title>
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
			<h2>Welcome Doctor!</h2>
			<p> 
			<h2>Your Surveys:<h2>
			

<?php
require_once 'config.php';

//docotr ID
session_start();
$session_user = $_SESSION['username'];
$survey_id_get = $_SESSION['SurveyID'];


//echo $session_user." "; 
//echo "Survey Id is: ".$survey_id_get." ";


//Pull Questions
$sql = "SELECT * FROM Survey WHERE SurveyID = '$survey_id_get'";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $Q1 = $row['q1'];
                $Q2 = $row['q2'];
                $Q3 = $row['q3'];
                $Q4 = $row['q4'];
                $Q5 = $row['q5'];
            }
        }
	}
    else {
        echo "ERROR";
        }

//echo "question 1 is: ".$Q1." "; 			
			
			
//Pull Answers

$sql = "SELECT * FROM Answers WHERE SurveyID = '$survey_id_get'";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
			echo '<form action="delete_survey_execute.php" method="POST"><table><tr><th>Select Survey</th><th>Survey ID</th><th>Answer 1</th><th>Answer 2</th><th>Answer 3</th><th>Answer 4</th><th>Answer 5</th></tr>';
            while($row = mysqli_fetch_array($result)){
                $a1 = $row['a1'];
                $a2 = $row['a2'];
                $a3 = $row['a3'];
                $a4 = $row['a4'];
                $a5 = $row['a5'];
				echo "<tr><td>"."<input type='radio' name='take_survey' value=".$row['SurveyID'].">"."</td><td>" .$row['SurveyID'] ."</td><td>". $row['a1']."</td><td>". $row['a2']."</td><td>". $row['a3']."</td><td>". $row['a4']."</td><td>". $row['a5']."</td></tr>";
				
				
				/*echo "answer 1 is: ".$a1." "; 			
				echo "answer 2 is: ".$a2." "; 			
				echo "answer 3 is: ".$a3." "; 			
				echo "answer 4 is: ".$a4." "; 			
				echo "answer 5 is: ".$a5." "; 	
				*/
            }
			echo "</table><input type='submit' value= 'delete this survey' name='delete survey'></form>";
        }
	}
    else {
        echo "ERROR";
        }
		

			?>
			
			</p>
		</div>
       
    </div>
</div>

</body>

</html>