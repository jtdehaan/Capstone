<?php
require_once 'config.php';
session_start();
//checks to see if you are logged in. If not, doesnt allow access.
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
	header("location: login.html");
	exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Med Connect Administrator View All Events Page</title>
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
            <a href="admin_homepage.php">Admin Home</a>
            <a href="admin_delete_user.php">Delete User</a>
            <a href="admin_view_users.php">View Users</a>
            <a href="admin_all_surveys.php">View Surveys</a>
            <a class="selected" href="admin_contact_account.php">Contact Users</a>
            <a href="logout.php">Logout</a>
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
                <h2>Survey Answers:</h2>
            </div>
        </div>
        <div class="contact-user">
            <div class="contact-format">
			<div class="table">
				<?php
				
					require_once 'config.php';

					//admin ID
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
					            echo '<table><tr><th>Survey ID</th><th>Answer 1</th><th>Answer 2</th><th>Answer 3</th><th>Answer 4</th><th>Answer 5</th></tr>';
					            while($row = mysqli_fetch_array($result)){
					                $a1 = $row['a1'];
					                $a2 = $row['a2'];
					                $a3 = $row['a3'];
					                $a4 = $row['a4'];
					                $a5 = $row['a5'];
					                echo "<tr><td>". $row['SurveyID'] ."</td><td>". $row['a1']."</td><td>". $row['a2']."</td><td>". $row['a3']."</td><td>". $row['a4']."</td><td>". $row['a5']."</td></tr>";


					                /*echo "answer 1 is: ".$a1." ";
					                echo "answer 2 is: ".$a2." ";
					                echo "answer 3 is: ".$a3." ";
					                echo "answer 4 is: ".$a4." ";
					                echo "answer 5 is: ".$a5." ";
					                */
					            }
					            echo "</table>";
					        }
					    }
					    else {
					        echo "ERROR";
					        }
						
            ?>
			</div>
            </div>
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
