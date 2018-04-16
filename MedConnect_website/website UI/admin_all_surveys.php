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
                <h2>All Surveys:</h2>
            </div>
        </div>
        <div class="contact-user">
            <div class="contact-format">
			<div class="table">
				<?php
				require_once 'config.php';
                $sql = "SELECT name, SurveyID, Q1, Q2, Q3, Q4, Q5 FROM Survey";

                if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        echo '<form action="survey_admin_info_grab.php" method="POST"><table><tr><th>View Answers</th><th>Name</th><th>Question 1</th><th>Question 2</th><th>Question 3</th><th>Question 4</th><th>Question 5</th></tr>';
                        while($row = mysqli_fetch_array($result)){
                            echo "<tr><td>"."<input type='radio' name='take_survey' value=".$row['SurveyID'].">"."</td><td>".$row['name'] ."</td><td>". $row['Q1']."</td><td>". $row['Q2']."</td><td>". $row['Q3']."</td><td>". $row['Q4']."</td><td>". $row['Q5']."</td></tr>"; }
                        echo "</table><input class='button' type='submit' value= 'select' name='select survey'></form>";
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
