<?php

require_once 'config.php';

$Q1 = $Q2 = $Q3 = $Q4 = $Q5 = $name = $DoctorID = "";
$Q1_err = $Q2_err = $Q3_err = $Q4_err = $Q5_err = $name_err = "";

//Doctor ID
session_start();
$session_user = $_SESSION['username'];
//echo "print session user: ".$session_user;

$sql = "SELECT user_id FROM LoginDoctor WHERE username = '$session_user'";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $DoctorID = $row['user_id'];
            }
        }
    }
    else {
        echo "ERROR";
        }
		
if($_SERVER["REQUEST_METHOD"] == "POST"){



//survey_name
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter a survey name.";
    } else{
        $name = trim($_POST['name']);
        }
	
//question1
    if(empty(trim($_POST['Q1']))){
        $Q1_err = "Please enter a question.";
    } else{
        $Q1 = trim($_POST['Q1']);
        }

//question2
    if(empty(trim($_POST['Q2']))){
        $Q2_err = "Please enter a question.";
    } else{
        $Q2 = trim($_POST['Q2']);
        }
//question3
    if(empty(trim($_POST['Q3']))){
        $Q3_err = "Please enter a question.";
    } else{
        $Q3 = trim($_POST['Q3']);
    }
//question4
    if(empty(trim($_POST['Q4']))){
        $Q4_err = "Please enter a question.";
    } else{
        $Q4 = trim($_POST['Q4']);
    }
//question5
    if(empty(trim($_POST['Q5']))){
        $Q_err = "Please enter a question.";
    } else{
        $Q5 = trim($_POST['Q5']);
    }




    if(empty($name_err) && empty($Q1_err) &&  empty($Q2_err) && empty($Q3_err) && empty($Q4_err) && empty($Q_err)){

        $sql = "INSERT INTO Survey (DoctorID, name, q1, q2, q3, q4, q5) VALUES (?, ?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sssssss", $param_DoctorID, $param_name,  $param_Q1, $param_Q2, $param_Q3, $param_Q4, $param_Q5);

			$param_DoctorID = $DoctorID;
            $param_name = $name;
            $param_Q1 = $Q1;
            $param_Q2 = $Q2;
            $param_Q3 = $Q3;
            $param_Q4 = $Q4;
            $param_Q5 = $Q5;
          

            if(mysqli_stmt_execute($stmt)){

            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }
}

echo "This is the name: ".$name; 
echo "this is question 1: ".$Q1;
echo "this is question 2: ".$Q2;
echo "this is question 3: ".$Q3;
echo "this is question 4: ".$Q4;
echo "this is question 5: ".$Q5;
echo "this is doctor ID: ".$DoctorID;

?>

<!doctype html>
<html>
<head>
    <title>Med Connect Survey Creation Page</title>
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
				<li><a href="doctor_current_surveys.php">View Current Surveys</a></li>
				<br>
				<li><a class="selected" href="create_survey.php">Add a Survey</a></li>
		</div>
		
		<div id="main">
			<h2>Create A Survey:</h2>
			<br>			
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
			
			<div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <br>
                <label>Survey Name:</label>
                <input style="width: 300px" type="text" name="name"class="form-control" value="<?php echo $name; ?>">
                <span class="help-block"><?php echo $name_err; ?></span>
            </div> 
			
            <div class="form-group <?php echo (!empty($Q1_err)) ? 'has-error' : ''; ?>">
                <br>
                <label>Question 1:</label>
                <input style="width: 800px" type="text" name="Q1"class="form-control" value="<?php echo $Q1; ?>">
                <span class="help-block"><?php echo $Q1_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($Q2_err)) ? 'has-error' : ''; ?>">
                <br>
                <label>Question 2:</label>
                <input style="width: 800px" type="text" name="Q2"class="form-control" value="<?php echo $Q2; ?>">
                <span class="help-block"><?php echo $Q2_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($Q3_err)) ? 'has-error' : ''; ?>">
                <br>
                <label>Question 3:</label>
                <input style="width: 800px" type="text" name="Q3" class="form-control" value="<?php echo $Q3; ?>">
                <span class="help-block"><?php echo $Q3_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($Q4_err)) ? 'has-error' : ''; ?>">
                <br>
                <label>Question 4:</label>
                <input style="width: 800px" type="text" name="Q4" class="form-control" value="<?php echo $Q4; ?>">
                <span class="help-block"><?php echo $Q4_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($Q5_err)) ? 'has-error' : ''; ?>">
                <br>
                <label>Question 5:</label>
                <input style="width: 800px" type="text" name="Q5"class="form-control" value="<?php echo $Q5; ?>">
                <span class="help-block"><?php echo $Q5_err; ?></span>
            </div>
            <div class="form-group">
			<br>
				<input type="submit" class="btn btn-primary" value="Create Survey">

            </div>
        </form>
		
		
		</div>
       
    </div>
</div>

</body>

</html>
