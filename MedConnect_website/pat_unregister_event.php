<?php
require_once 'config.php';
session_start();
$session_user = $_SESSION['username'];

//gets patient user id based on the current session
$sql = "SELECT user_id FROM LoginPatient WHERE username = '$session_user'";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $patient_user_id = $row['user_id'];
            }
        }
    }
    else {
        echo "ERROR";
        }
//data from the form (the EventID from table Events)
if(isset($_GET['register_event'])){
    $event_id = $_GET['register'];

//Exicute
    //Checks if pat has registered for an event
        $sql = "SELECT EventID FROM Attendance WHERE PatientID = ? AND EventID = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_patient_user_id, $param_event_id);
            $param_patient_user_id = $patient_user_id;
            $param_event_id = $event_id;
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $sql = "UPDATE Events SET attendance = attendance - 1 WHERE EventID = $event_id";
                        if ($link->query($sql) === TRUE) {
                            //Inserts data into Attendance
                            $sql = "DELETE FROM Attendance WHERE PatientID ='$patient_user_id' AND EventID = '$event_id'";
                                if ($link->query($sql) === TRUE) {
                                    header('location= event_list.php');
                                }
                        }
                } else{
                    $username_err = "You are not registered for this event.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
        // For developer
        // else {
        //     echo "Error: " . $sql . "<br>" . $link->error;
        // }
}
 ?>

 <!DOCTYPE html>
 <html>

 <head>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>MC Patient Register for Event</title>
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
             <a href="pat_view_profile.php">My Profile</a>
             <a href="pat_edit_profile.php">Edit Profile</a>
             <a href="event_list.php">View Events</a>
             <a class="selected" href="pat_event_register.php">Register for an Event</a>
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
                 <h2>Register for Event</h2>
             </div>
         </div>
         <div class="admin_patient">
             <div class="table">
                 <?php
                 require_once 'config.php';

                 $sql = "SELECT EventID, name, location, date, time, price, description, attendance, payinapp
                 FROM Events NATURAL JOIN Attendance WHERE PatientID = '$patient_user_id'";
                 if($result = mysqli_query($link, $sql)){
                     if(mysqli_num_rows($result) > 0){
                 		echo '<form ><table><tr><th>Register fo this event?</th><th>Name</th><th>Location</th><th>Date</th><th>Time</th><th>Price</th><th>description</th><th>attendance</th><th>payinapp</th></tr>';
                        while($row = mysqli_fetch_array($result)){
                 			echo "<tr><td>"."<input type='radio' name='register' value=".$row['EventID'].">"."</td><td>".$row['name'] ."</td><td>". $row['location']."</td><td>". $row['date']."</td><td>". $row['time']."</td><td>". $row['price']."</td><td>". $row['description']."</td><td>". $row['attendance']."</td><td>". $row['payinapp']."</td></tr>"; }
                 		    echo "</table><input class='button' type='submit' value='submit' name='register_event'></form>";
                 	}
                 	else{
                 		echo "no result";
                 	}
                 }
                 else{
                 	echo "ERROR";
                 }
                 ?>
             <div>
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
