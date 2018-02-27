<?php
require_once 'config.php';
session_start();
$session_user = $_SESSION['username'];

$username = $current_password = $password = $email = $name = $confirm_password = "";
$username_err = $current_password_err = $password_err = $email_err = $name_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
//name
    if(empty(trim($_POST['name']))){
        $sql = "SELECT name FROM LoginOrganization WHERE username = '$session_user'";
        if($result = mysqli_query($link, $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    $name = $row['name'];
                }
            }
        }
        else{
            echo "else statement";
            echo mysqli_error($link);
        }
        mysqli_close($link);
    } else{
        $name = trim($_POST['name']);
    }
//username
    if(empty(trim($_POST["username"]))){
        $username = $session_user;
    } else{
        $username = trim($_POST["username"]);
    }
//email
    if(empty(trim($_POST['email']))){
        $sql = "SELECT email FROM LoginOrganization WHERE username = '$session_user'";
        if($result = mysqli_query($link, $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    $email = $row['email'];
                }
            }
        }
        else{
            echo "else statement";
            echo mysqli_error($link);
        }
        mysqli_close($link);
    } else{
        $email = trim($_POST['email']);
    }
//current password
    if(empty(trim($_POST["current_password"]))){
        $current_password = "";
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
echo "THIS IS AN ECHO BEFORE EXICUTE: <br><br>";
echo "$name <br> $username <br> $email <br> $password";
 //exicute
    if(empty($username_err) &&  empty($email_err) && empty($name_err) && empty($password_err) && empty($confirm_password_err)){

        $sql = "UPDATE LoginOrganization SET name = ?, username = ?, email = ?, password = ? WHERE username = '$session_user'";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_username, $param_email, $param_password);

            $param_name = $name;
            $param_username = $username;
			$param_email = $email;
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
?>


<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
        <h1>Patient Edit Profile</h1>
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
            <div class="form-group <?php echo (!empty($current_password_err)) ? 'has-error' : ''; ?>">
                <br>
				<label>Current Password:</label>
                <input type="password" name="current_password" class="form-control" value="<?php echo $current_password; ?>">
                <span class="help-block"><?php echo $current_password_err; ?></span>
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
