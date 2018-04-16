
<?php
require_once 'config.php';

///variables 
$a1 = $a2 = $a3 = $a4 = $a5 = "";
$a1_err = $a2_err = $a3_err = $a4_err = $a5_err = "";

//Organization ID
session_start();
$session_user = $_SESSION['username'];
$survey_id_get = $_SESSION['SurveyID'];

echo "print session user: ".$session_user;
echo "print survey ID: ".$survey_id_get;

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

echo "question 1 is: ".$Q1; 


if($_SERVER["REQUEST_METHOD"] == "POST"){

	
//answer1
    if(empty(trim($_POST['a1']))){
        $a1_err = "Please enter an answer.";
    } else{
        $a1 = trim($_POST['a1']);
        }

//answer2
    if(empty(trim($_POST['a2']))){
        $a2_err = "Please enter an answer.";
    } else{
        $a2 = trim($_POST['a2']);
        }
//answer3
    if(empty(trim($_POST['a3']))){
        $a3_err = "Please enter an answer.";
    } else{
        $a3 = trim($_POST['a3']);
    }
//answer4
    if(empty(trim($_POST['a4']))){
        $a4_err = "Please enter an answer.";
    } else{
        $a4 = trim($_POST['a4']);
    }
//answer5
    if(empty(trim($_POST['a5']))){
        $a5_err = "Please enter an answer.";
    } else{
        $a5 = trim($_POST['a5']);
    }

echo "answer 1: ".$a1;
echo "answer 2: ".$a2;
echo "answer 3: ".$a3;
//echo "answer 4: ".$a4;
//echo "answer 5: ".$a5;





 //execute
 

    if(empty($survey_id_get_err) && empty($a1_err) &&  empty($a2_err) && empty($a3_err) && empty($a4_err) && empty($a5_err)){

        $sql = "INSERT INTO Answers (SurveyID, a1, a2, a3, a4, a5) VALUES (?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ssssss", $param_survey_id_get, $param_a1, $param_a2, $param_a3, $param_a4, $param_a5);

			$param_survey_id_get = $survey_id_get;
            $param_a1 = $a1;
            $param_a2 = $a2;
            $param_a3 = $a3;
            $param_a4 = $a4;
            $param_a5 = $a5;
          

            if(mysqli_stmt_execute($stmt)){

            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }
}

?>

<!doctype html>
<html>
<head>
    <title>Med Connect Patient Take Surveys Page</title>
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
		
		<div id="main">
			<h2>Your Surveys:</h2>
		
			<p>
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
					
					<div class="form-group <?php echo (!empty($a1_err)) ? 'has-error' : ''; ?>">
						<br>
						<label><?php echo $Q1; ?></label>
						<input type="text" name="a1" class="form-control" value="<?php echo $a1; ?>">
						<span class="help-block"><?php echo $a1_err; ?></span>
					</div>
					<div class="form-group <?php echo (!empty($a2_err)) ? 'has-error' : ''; ?>">
						<br>
						<label><?php echo $Q2; ?></label>
						<input type="text" name="a2" class="form-control" value="<?php echo $a2; ?>">
						<span class="help-block"><?php echo $a2_err; ?></span>
					</div>
					<div class="form-group <?php echo (!empty($a3_err)) ? 'has-error' : ''; ?>">
						<br>
						<label><?php echo $Q3; ?></label>
						<input type="text" name="a3" class="form-control" value="<?php echo $a3; ?>">
						<span class="help-block"><?php echo $a3_err; ?></span>
					</div>
					<div class="form-group <?php echo (!empty($a4_err)) ? 'has-error' : ''; ?>">
						<br>
						<label><?php echo $Q4; ?></label>
						<input type="text" name="a4" class="form-control" value="<?php echo $a4; ?>">
						<span class="help-block"><?php echo $a4_err; ?></span>
					</div>
					<div class="form-group <?php echo (!empty($a5)) ? 'has-error' : ''; ?>">
						<br>
						<label><?php echo $Q5; ?></label>
						<input type="text" name="a5" class="form-control" value="<?php echo $a5; ?>">
						<span class="help-block"><?php echo $a5_err; ?></span>
					</div>
					<div class="form-group">
						<br>
						<input type="submit" class="btn btn-primary" value="Submit Answers">
					</div>
				</form>
			</div>
			</p>
		</div>
       
    </div>
</div>

</body>

</html>

