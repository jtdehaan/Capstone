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
        $sql = "SELECT username, password FROM LoginDoctor WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = $username;

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            $_SESSION['username'] = $username;
                            header("location: https://www.google.com/");
                        } else{
                            $password_err = 'The password you entered was not valid.';
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

    mysqli_close($link);
}
//Used so that username can be displayed on the calculator page
session_start();
$_SESSION['username'] = $_POST['username']
?>

<!doctype html>
<html>

<head>
    <title>Med Connect Doctor Login</title>
    <link rel="stylesheet" type="text/css" href="registerpage.css" >
</head>
<body>

<div id="container">
    <div id="header">
        <h1>Med Connect</h1>
        <!--PUT LINK TO FINISHED LOGO HERE TOO AS WELL AS LINKS TO OTHER PAGES (about, login, support)-->
		<a class="left-align" href="about_page.html">About</a>
		<a href="support_page.php">Support</a>
		<a class = "right-align" href="login_page.html">Login</a>
		
    </div>

    <div id="content">
        <h2>Doctor Login</h2>
		
       <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <br>
                <label>Username:</label>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div> 
          
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <br>
                <label>Password:</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <br>
                <label>Confirm Password:</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div> 
            
            <div class="form-group">
                <br>
                <input type="submit" class="btn btn-primary" value="Submit">
				<br>
				<br>
				<a href="doctor_registerpage.php">Register Here</a>
				<br>
				<br>

            </div>
        </form>
    </div>
</div>

</body>

</html>
