<?php //header("refresh:5")?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MC Admin DeleteUser</title>
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
            <a class="selected" href="#">Delete User</a>
            <a href="admin_view_users.php">View Users</a>
            <a href="admin_all_surveys.php">View Surveys</a>
            <a href="admin_contact_account.php">Contact Users</a>
            <a href="about_page.html">About</a>
            <a href="support_page.php">Support</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>
    <div class="container">
        <header>
            <!--Menu function -->
            <span class="menu" onclick="openNav()"><i class="fas fa-bars"></i> Menu</span>
            <h1>Med Connect</h1>
            <a class="left-align" href="about_page.html">About</a>
            <a href="support_page.php">Support</a>
            <a class="right-align" href="logout.php">Logout</a>
        </header>
    </div>
    <main>
        <div class="container">
            <div class='current-page'>
                <h2>Delete Account</h2>
            </div>
        </div>
        <div class="admin_patient">
            <h2> Patients </h2>
            <div class="table">
                <?php
                require_once 'config.php';

                $sql = "SELECT *
                FROM LoginPatient";
                if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
                		echo "<form method='POST'><table><tr><th>Delete this user?</th><th>Patient ID</th><th>Name</th><th>Username</th><th>Email</th><th>Password</th></tr>";
                     while($row = mysqli_fetch_array($result)){
                			echo "<tr><td>"."<input type='radio' name='patient' value=".$row['user_id']." required>"."</td><td>".$row['user_id'] ."</td><td>". $row['name']."</td><td>". $row['username']."</td><td>". $row['email']."</td><td>". $row['password']."</td></tr>"; }
                		echo"</table><input type='submit' value='Delete' name='delete_patient'></form>";
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
                		echo "<form method='POST'><table><tr><th> Delete this user?</th><th>Doctor ID</th><th>Name</th><th>Username</th><th>Email</th><th>Password</th></tr>";
                     while($row = mysqli_fetch_array($result)){
                			echo "<tr><td>"."<input type='radio' name='doctor' value=".$row['user_id']." required>"."</td><td>".$row['user_id'] ."</td><td>". $row['name']."</td><td>". $row['username']."</td><td>". $row['email']."</td><td>". $row['password']."</td></tr>"; }
                		echo"</table><input type='submit' value='Delete' name='delete_doctor'></form>";
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
                		echo "<form method='POST'><table><tr><th>Delete this user?</th><th>Organization ID</th><th>Name</th><th>Username</th><th>Email</th><th>Password</th></tr>";
                     while($row = mysqli_fetch_array($result)){
                			echo "<tr><td>"."<input type='radio' name='organization' value=".$row['user_id']." required>"."</td><td>".$row['user_id'] ."</td><td>". $row['name']."</td><td>". $row['username']."</td><td>". $row['email']."</td><td>". $row['password']."</td></tr>"; }
                		echo"</table><input type='submit' value='Delete' name='delete_organization'></form>";
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
<?php
require_once 'config.php';

if(isset($_POST['delete_patient'])){
    $input = $_POST['patient'];
    $sql = "DELETE FROM LoginPatient WHERE user_id = '$input'";
        if ($link->query($sql) === TRUE) {
            header("refresh:0");
        }
        else {
            echo "PATIENT DELETE DIDNT GO THROUGH...";
        }
}

elseif(isset($_POST['delete_doctor'])){
    $input = $_POST['doctor'];
    $sql = "DELETE FROM LoginDoctor WHERE user_id = '$input'";
    if ($link->query($sql) === TRUE) {
        header("refresh:0");
    }
    else{
        echo "doc delete didnt go through....";
    }
}

elseif(isset($_POST['delete_organization'])){
    $input = $_POST['organization'];
    $sql = "DELETE FROM LoginOrganization WHERE user_id = '$input'";
    if ($link->query($sql) === TRUE) {
        header("Cache-Control: no-cache, no-store, must-revalidate");
    }
}
else {
    echo $link->error;
}
?>
</html>
