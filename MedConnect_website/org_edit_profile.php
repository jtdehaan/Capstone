<?php
require_once 'config.php';
session_start();
$session_user = $_SESSION['username'];

$username = $current_password = $password = $email = $name = $confirm_password = "";
$username_err = $current_password_err = $password_err = $email_err = $name_err = $confirm_password_err = "";

//Autofill in based on user information
$sql = "SELECT * FROM LoginOrganization WHERE username = '$session_user'";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $name = $row['name'];
            $username = $row['username'];
            $email = $row['email'];
            $description = $row['description'];
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
//email
    $email = trim($_POST['email']);
//description
    $description = trim($_POST['description']);
//current password
    if(empty(trim($_POST["current_password"]))){

    } else{
        $current_password = $_POST['current_password'];
        $sql = "SELECT username, password FROM LoginOrganization WHERE username = ?";

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
                            echo "<br> PASSWORD VERIFY WORKING!!!";
                        } else{
                            echo "<br>this is hashed_password_user:" . $hashed_password;
                            echo "<br>this is hashed_current_password_user:" . $hashed_current_password;
                            echo "<br>this is current_password:" . $current_password;
                            $current_password_err = 'The password you entered was not valid.';
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
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }
$current_password_err = "Incorrect Password";
 //exicute
    if(empty($username_err) &&  empty($email_err) && empty($name_err) && empty($current_password) && empty($password_err) && empty($confirm_password_err)){

        $sql = "UPDATE LoginOrganization SET name = ?, username = ?, email = ?, description = ? WHERE username = '$session_user'";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_username, $param_email, $param_description);

            $param_name = $name;
            $param_username = $username;
			$param_email = $email;
            $param_description = $description;
			$param_email_code;

            if(mysqli_stmt_execute($stmt)){
                header("location: org_view_profile.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }
    else{

        $sql = "UPDATE LoginOrganization SET name = ?, username = ?, email = ?, description = ?, password = ? WHERE username = '$session_user'";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sssss", $param_name, $param_username, $param_email, $param_description, $param_password);

            $param_name = $name;
            $param_username = $username;
			$param_email = $email;
            $param_description = $description;
			$param_email_code;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            if(mysqli_stmt_execute($stmt)){
                header("location: org_view_profile.php");
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
    <title>MC Organization Edit Account</title>
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
            <a href="org_view_profile.php">My Profile</a>
            <a class="selected" href="#">Edit Profile</a>
            <a href="org_view_event.php">View My Events</a>
            <a href="register_event.php">Add Event</a>
            <a href="org_view_edit_event.php">Edit Event</a>
            <a href="unregister_event.php">Delete Event</a>
            <a href="org_about.html">About</a>
            <a href="org_support.php">Support</a>
            <a href="logout.php">Logout</a>
            <a href="org_delete_account.php">Delete Account</a>
        </div>
    </nav>
    <div class="container">
        <header>
            <!--Menu function -->
            <span class="menu" onclick="openNav()"><i class="fas fa-bars"></i> Menu</span>
            <h1>Med Connect</h1>
            <a class="left-align" href="org_about.html">About</a>
            <a href="org_support.php">Support</a>
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
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <br>
                    <label>Description:</label><br>
                    <textarea name="description" rows="8" cols="30" class="form-control"><?php echo $description; ?></textarea>
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
