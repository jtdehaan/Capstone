<?php
require_once 'config.php';
session_start();
//checks to see if you are logged in. If not, doesnt allow access.
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
	header("location: login.html");
	exit;
}
?>
<?php
require_once 'config.php';

///variables
$a1 = $a2 = $a3 = $a4 = $a5 = "";
$a1_err = $a2_err = $a3_err = $a4_err = $a5_err = "";

//Organization ID
session_start();
$session_user = $_SESSION['username'];
$survey_id_get = $_SESSION['SurveyID'];


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







 //execute


	if(empty($survey_id_get_err) && empty($a1_err)){

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
		header('location: pat_survey.php');
	}
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MC Patient View Account</title>
    <!--CSS style sheets -->
    <link rel="stylesheet" type="text/css" href="css/MedConnect.css">
    <!-- Font Awesome JS -->
       <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
</head>

<body>
    <nav>
        <!--Navigation and links inside -->
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="pat_homepage.php">Home</a>
            <a class="selected" href="pat_view_profile.php">My Profile</a>
            <a href="pat_edit_profile.php">Edit Profile</a>
            <a href="event_list.php">View Events</a>
            <a href="pat_event_register.php">Register for an Event</a>
            <a href="pat_unregister_event.php">Unregister for an Event</a>
            <a href="pat_survey.php">Surveys</a>
            <a href="pat_about.html">About</a>
            <a href="pat_support.php">Support</a>
            <a href="logout.php">Logout</a>
            <a href="pat_delete_account.php">Delete Account</a>
        </div>
    </nav>
    <div class="container">
        <header>
            <!--Menu function -->
            <span class="menu" onclick="openNav()"><i class="fas fa-bars"></i> Menu</span>
            <h1>Med Connect</h1>
            <a class="left-align" href="pat_about.html">About</a>
            <a href="pat_support.php">Support</a>
            <a class="right-align" href="logout.php">Logout</a>
        </header>
    </div>
    <main>
        <div class="container">
            <div class='current-page'>
                <h2>View Profile</h2>
            </div>
        </div>
        <div class="admin_patient">
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
						<input type="submit" class="btn btn-primary" value="Submit">
					</div>
				</form>
			</div>
    </main>
    <footer>
       <div class="container">
           <div class="contact">
               <section>
                   <h2>Contact Us</h2>
                   <ul>
                       <li>Phone: 123-456-789</li>
                       <li>Address: 123 E. 10th st. Bloomington 47404</li>
                       <li>Email: medconnect@gmail.com</li>
                   </ul>
                   <div class="icon">
                       <a href="#"><i class="fab fa-facebook-square"></i></a>
                       <a href="#"><i class="fab fa-twitter"></i></a>
                   </div>
               </section>
           </div>
       </div>
   </footer>
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
</body>

</html>
