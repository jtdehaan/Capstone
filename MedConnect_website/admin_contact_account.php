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
            <a href="admin_homepage.php">Admin Profile</a>
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
                <h2>Contact Account</h2>
            </div>
        </div>
        <div class="admin_patient">
            <h2> Patients </h2>
            <div class="table">
                <?php
                require_once 'config.php';
                session_start();
                $sql = "SELECT *
                FROM LoginPatient";
                if($result = mysqli_query($link, $sql)){
                if(mysqli_num_rows($result) > 0){
                	echo "<form method='POST'><table><tr><th>Contact User</th><th>Patient ID</th><th>Name</th><th>Username</th><th>Email</th></tr>";
                 while($row = mysqli_fetch_array($result)){
                		echo "<tr><td>"."<input type='radio' name='patient' value=".$row['user_id']." required>"."</td><td>".$row['user_id'] ."</td><td>". $row['name']."</td><td>". $row['username']."</td><td>". $row['email']."</td></tr>"; }
                	echo"</table><input type='submit' class='button' value='Contact' name='contact_patient'></form>";
                }
                else{
                	echo "no result";
                }
                }
                else{
                echo "ERROR". mysqli_error($link);
                }
                ?>
            </div>
        </div>
        <br>
        <div class="admin_Doctor">
            <h2> Doctors </h2>
            <div class="table">
                <?php
                require_once 'config.php';
                $sql = "SELECT *
                FROM LoginDoctor";
                if($result = mysqli_query($link, $sql)){
                 if(mysqli_num_rows($result) > 0){
                		echo "<form method='POST'><table><tr><th>Contact User</th><th>Doctor ID</th><th>Name</th><th>Username</th><th>Email</th></tr>";
                     while($row = mysqli_fetch_array($result)){
                			echo "<tr><td>"."<input type='radio' name='doctor' value=".$row['user_id']." required>"."</td><td>".$row['user_id'] ."</td><td>". $row['name']."</td><td>". $row['username']."</td><td>". $row['email']."</td></tr>"; }
                		echo"</table><input class='button' type='submit' value='Contact' name='contact_doctor'></form>";
                	}
                	else{
                		echo "no result";
                	}
                }
                else{
                	echo "ERROR". mysqli_error($link);
                }
                ?>

            </div>
        </div>
        <br>
        <div class="admin_Organization">
            <h2> Organizations </h2>
            <div class="table">
                <?php
                require_once 'config.php';
                $sql = "SELECT *
                FROM LoginOrganization";
                if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
                		echo "<form method='POST'><table><tr><th>Contact User</th><th>Organization ID</th><th>Name</th><th>Username</th><th>Email</th></tr>";
                    while($row = mysqli_fetch_array($result)){
                			echo "<tr><td>"."<input type='radio' name='organization' value=".$row['user_id']." required>"."</td><td>".$row['user_id'] ."</td><td>". $row['name']."</td><td>". $row['username']."</td><td>". $row['email']."</td></tr>"; }
                		echo"</table><input class='button' type='submit' value='Contact' name='contact_organization'></form>";
                	}
                    else{
                		echo "no result";
                	}
                }
                else{
                	echo "ERROR". mysqli_error($link);
                }
                ?>

            </div>
        </div>
        <div class="contact-user">
            <div class="contact-format">
                <?php
                require_once 'config.php';
                if(isset($_POST['contact_patient'])){
                    $input = $_POST['patient'];
                    $sql = "SELECT name, email from LoginPatient WHERE user_id = '$input'";
                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){
                                    $name = $row['name'];
                                    $email = $row['email'];
                                    echo " <h2>Contact:</h2> Name: ".$name."<br> <form action='admin_contact_user_email.php' id='patient_email' method='POST'>Subject: <input type='text' name='header'><br><br>
                                    <textarea rows='4' cols='50' name='msg' form='patient_email'> Enter message here...</textarea><br>
                                    <input class='button' type='submit'>";
                            }
                        }
                        }
                        else{
                    		echo "ERROR";
                    	}
                    session_start();
                    $_SESSION['email'] = $email;
                    }
                    // else{
                    // 	echo $link->error;
                    //
                    //     // echo "ERROR". mysqli_error($link);
                    // }
                            // header("location: admin_view_users.php");
                elseif(isset($_POST['contact_doctor'])){
                    $input = $_POST['doctor'];
                    $sql = "SELECT name, email from LoginDoctor WHERE user_id = '$input'";
                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){
                                    $name = $row['name'];
                                    $email = $row['email'];
                                    echo "<h2>Contact User</h2> Contact: ".$name."<br> <form action='admin_contact_user_email.php' id='patient_email' method='POST'>Subject: <input type='text' name='header'><br><br>
                                    <textarea rows='4' cols='50' name='msg' form='patient_email'> Enter message here...</textarea><br>
                                    <input class='button' type='submit'>";
                            }
                        }
                        }
                        else{
                            echo "ERROR";
                        }
                    session_start();
                    $_SESSION['email'] = $email;
                    }
                // else{
                //     echo $link->error;
                //
                //     // echo "ERROR". mysqli_error($link);
                // }
                elseif(isset($_POST['contact_organization'])){
                    $input = $_POST['organization'];
                    $sql = "SELECT name, email from LoginOrganization WHERE user_id = '$input'";
                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){
                                    $name = $row['name'];
                                    $email = $row['email'];
                                    echo "<h2>Contact User</h2> Contact: ".$name."<br> <form action='admin_contact_user_email.php' id='patient_email' method='POST'>Subject: <input type='text' name='header'><br><br>
                                    <textarea rows='4' cols='50' name='msg' form='patient_email'> Enter message here...</textarea><br>
                                    <input class='button' type='submit'>";
                            }
                        }
                        }
                        else{
                            echo "ERROR";
                        }
                    session_start();
                    $_SESSION['email'] = $email;
                    }
                else{
                    echo $link->error;
                    // echo "ERROR". mysqli_error($link);
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
