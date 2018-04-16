<?php

require_once 'config.php';


$username = $password = "";
$username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["username"]);
    }

    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }

    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT username, password FROM LoginDoctor WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = $username;

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            $_SESSION['username'] = $username;
                            header("location: https://www.google.com/");
                        } else{
                            $password_err = 'The password you entered was not valid.';
                        }
                    }
                } else{
                    $username_err = 'No account found with that username.';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);
}
//Used so that username can be displayed on the calculator page
session_start();
$_SESSION['username'] = $_POST['username']
?>

<!doctype html>
<html>
<head>
    <title>Med Connect Doctor Patient List Page</title>
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
				<li><a class="selected" href="patient_my_doctors.php">My Patients</a></li>
				<br>
				<br>
				<li>Surveys:</li>
				<br>
				<li><a href="doctor_current_surveys.php">View Current Surveys</a></li>
				<br>
				<li><a href="create_survey.php">Add a Survey</a></li>
		</div>
		
		<div id="main">
			<h2>Your Current Patients:</h2>
			<p> THIS IS WHERE THE PATIENTS THE DOCTOR HAS AT THAT TIME WILL BE DISPLAYED 
			<br>
			<br>
			(unordered list, as many paragraphs as there are patients)
			<br>
			<br>
			
			<button type="submit">Add Patient</button>
			
			</p>
		</div>
       
    </div>
</div>

</body>

</html>
