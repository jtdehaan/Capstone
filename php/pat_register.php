<?php
require_once 'config.php';

$username = $password = $email = $name = $confirm_password = "";
$username_err = $password_err = $email_err = $name_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
//username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        $sql = "SELECT user_id FROM LoginPatient WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = trim($_POST["username"]);

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }
//email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
    } else{
        $sql = "SELECT user_id FROM LoginPatient WHERE email = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            $param_email = trim($_POST["email"]);

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }
//name
    if(empty(trim($_POST['name']))){
        $name_err = "Please enter a name.";
    } else{
        $name = trim($_POST['name']);
    }
//hash
	$email_code = md5( rand(0,1000) );
//password
    if(empty(trim($_POST['password']))){
        $password_err = "Please enter a password.";
    } else{
        $password = trim($_POST['password']);
    }
//confirm paaword
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'Please confirm password.';
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }
 //exicute
    if(empty($username_err) &&  empty($email_err) && empty($name_err) && empty($password_err) && empty($confirm_password_err)){

        $sql = "INSERT INTO LoginPatient (name, username, email, password, email_code) VALUES (?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sssss", $param_name, $param_username, $param_email, $param_password,  $email_code);

            $param_username = $username;
			$param_email = $email;
			$param_name = $name;
			$param_email_code;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            if(mysqli_stmt_execute($stmt)){
                header("location: med_connect_login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);
}

$msg = 'Your account has been made <br> please click the link to verify your account';
$to = $_POST["email"];
$subject = 'Signup | Verification';
$headers = 'From:noreply@calculator.php' . "\r\n";
$message = "
Your account has been created.
Please click this link to activate your account:
http://http://cgi.soic.indiana.edu/~jmodugno/pat_email_confirm.php?email=$to&email_code=$email_code.'
";
mail($to, $subject, $message, $headers);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
        <h1>Patient Register for MedConnect</h1>
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
			<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <br>
				<label>Email:</label>
                <input type="email" name="email"class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
				<br>
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>
