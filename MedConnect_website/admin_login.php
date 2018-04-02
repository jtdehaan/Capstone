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
        $sql = "SELECT username, password FROM AdminLogin WHERE username = ? AND password = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            $param_username = $username;
            $param_password = $password;

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_result($stmt, $username, $password);
                    if(mysqli_stmt_fetch($stmt)){
                        session_start();
                        $_SESSION['username'] = $username;
                        header("location: https://www.google.com/");
                    }
                } else{
                    $username_err = 'Incorrect administrative credentials';
                    $password_err = 'Incorrect administrative credentials';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);
}

//Starts the session
session_start();
$_SESSION['username'] = $_POST['username']
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MC Admin Login</title>
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
                <h2>Admin Login</h2>
            </div>
        </div>
        <div class="admin_patient">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <label>User Name:</label><br>
                    <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                    <span class="help-block"><?php echo $username_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label>Password:</label><br>
                    <input type="password" name="password" class="form-control">
                    <span class="help-block"><?php echo $password_err; ?></span>
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
