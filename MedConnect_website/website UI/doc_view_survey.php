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

/*
echo "This is the name: ".$name;
echo "this is question 1: ".$Q1;
echo "this is question 2: ".$Q2;
echo "this is question 3: ".$Q3;
echo "this is question 4: ".$Q4;
echo "this is question 5: ".$Q5;
echo "this is doctor ID: ".$DoctorID;
*/
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MC Doctor View Account</title>
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
            <a href="doc_homepage.php">Home</a>
            <a href="doc_view_profile.php">My Profile</a>
            <a href="doc_edit_profile.php">Edit Profile</a>
            <a class="selected" href="doc_view_survey.php">View Surveys</a>
            <a href="doc_create_survey.php">Create a Survey</a>
            <a href="doc_about.html">About</a>
            <a href="doc_support.php">Support</a>
            <a href="logout.php">Logout</a>
            <a href="doc_delete_account.php">Delete Account</a>
        </div>
    </nav>
    <div class="container">
        <header>
            <!--Menu function -->
            <span class="menu" onclick="openNav()"><i class="fas fa-bars"></i> Menu</span>
            <h1>Med Connect</h1>
            <a class="left-align" href="about.html">About</a>
            <a href="support.php">Support</a>
            <a class="right-align" href="logout.php">Logout</a>
        </header>
    </div>
    <main>
        <div class="container">
            <div class='current-page'>
                <h2>View Account</h2>
            </div>
        </div>
        <div class="admin_patient">
			<div class"table">
				<?php
				require_once 'config.php';

				session_start();
				$session_user = $_SESSION['username'];

					//echo "$session_user";

				$sql = "SELECT user_id FROM LoginDoctor WHERE username = '$session_user'";
				if($result = mysqli_query($link, $sql)){
				if(mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_array($result)){
						$doctor_user_id = $row['user_id'];
					}
				}
				//echo "Doctor ID: "."$doctor_user_id";
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
							echo "</table><input class='button' type='submit' value= 'Select' name='select survey'></form>";
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
        </div>
    </main>
    <footer>
       <div class="container">
           <div class="contact">
               <section>
                   <h2>Contact Us</h2>
                   <ul>
                       <li>Phone: 123-456-7890</li>
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
