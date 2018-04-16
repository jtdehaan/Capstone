<?php
require_once 'config.php';
session_start();
$session_user = $_SESSION['username'];

$username = $current_password = $password = $email = $name = $confirm_password = "";
$username_err = $current_password_err = $password_err = $email_err = $name_err = $confirm_password_err = "";

//Autofill in based on user information
$sql = "SELECT * FROM LoginPatient WHERE username = '$session_user'";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $name = $row['name'];
            $username = $row['username'];
            $email = $row['email'];
        }
    }
}
else{
    echo "ERROR";
    echo mysqli_error($link);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
//name
    $name = trim($_POST['name']);
//username
    $username = trim($_POST["username"]);
    $new_session_user = trim($POST['username']);
//email
    $email = trim($_POST['email']);
//current password
if(empty(trim($_POST["current_password"]))){

} else{
    $current_password = $_POST['current_password'];
    $sql = "SELECT username, password FROM LoginPatient WHERE username = ?";

    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $param_username);

        $param_username = $session_user;

        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            echo "<br>this is param_user:" . $param_username;
            if(mysqli_stmt_num_rows($stmt) == 1){
                mysqli_stmt_bind_result($stmt, $session_user, $hashed_password);
                if(mysqli_stmt_fetch($stmt)){
                    if(password_verify($current_password, $hashed_password)){
                    } else{
                        $current_password_err = 'The password you entered was not valid.';
                    }
                }
            } else{
                $password_err = 'incorrect password';
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    mysqli_stmt_close($stmt);
}

//new password
    if(empty(trim($_POST['password']))){
        // $password_err = "Please enter a password.";
    } else{
        $password = trim($_POST['password']);
    }
//confirm paaword
    if(!empty(trim($_POST["password"]))){
        // $confirm_password_err = 'Please confirm password.';
    } else{
        $confirm_password = trim($_POST['confirm_password']);
    }
    //checsk if passwords match
    if($password != $confirm_password){
        $confirm_password_err = 'Password did not match.';
    }
$current_password_err = "Incorrect Password";
 //exicute
    if(empty($username_err) &&empty($current_password) &&  empty($email_err) && empty($name_err) && empty($password_err) && empty($confirm_password_err)){

        $sql = "UPDATE LoginPatient SET name = ?, username = ?, email = ? WHERE username = '$session_user'";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_username, $param_email);

            $param_name = $name;
            $param_username = $username;
			$param_email = $email;
			$param_email_code;

            if(mysqli_stmt_execute($stmt)){
                header("location: doc_view_profile.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }
    else{

        $sql = "UPDATE LoginPatient SET name = ?, username = ?, email = ?, password = ? WHERE username = '$session_user'";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_username, $param_email, $param_password);

            $param_name = $name;
            $param_username = $username;
			$param_email = $email;
			$param_email_code;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            if(mysqli_stmt_execute($stmt)){
                header("location: pat_view_profile.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MC Patient Edit Account</title>
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
            <a class="selected" href="pat_edit_profile.php">Edit Profile</a>
            <a href="event_list.php"> View Events</a>
            <a href="pat_event_register.php">Register for an Event </a>
            <a href="pat_unregister_event.php">Unregister for an Event</a>
            <a href="pat_survey.php">Surveys</a>
            <a href="pat_about.html">About</a>
            <a href="pat_support.php">Support</a>
            <a href="logout.php">Logout</a>
            <a href="pat_delete_account">Delete Account</a>
        </div>
    </nav>
    <div class="container">
        <header>
            <!--Menu function -->
            <span class="menu" onclick="openNav()"><i class="fas fa-bars"></i> Menu</span>
            <h1>Med Connect</h1>
            <a class="left-align" href="doc_about.html">About</a>
            <a href="doc_support.php">Support</a>
            <a class="right-align" href="logout.php">Logout</a>
        </header>
    </div>
    <main>
        <div class="container">
            <div class='current-page'>
                <h2>Edit Account</h2>
            </div>
        </div>
        <div class="admin_patient">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <br>
                    <label>Username:</label>
                    <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                    <span class="help-block"><?php echo $username_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <br>
                    <label>Name:</label>
                    <input type="text" name="name"class="form-control" value="<?php echo $name; ?>">
                    <span class="help-block"><?php echo $name_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <br>
                    <label>Email:</label>
                    <input type="email" name="email"class="form-control" value="<?php echo $email; ?>">
                    <span class="help-block"><?php echo $email_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($current_password_err)) ? 'has-error' : ''; ?>">
                    <br>
                    <label>Current Password:</label>
                    <input type="password" name="current_password" class="form-control" value="<?php echo $current_password; ?>">
                    <span class="help-block"><?php echo $current_password_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <br>
                    <label>New Password:</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                    <span class="help-block"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <br>
                    <label>Confirm New Password:</label>
                    <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
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
