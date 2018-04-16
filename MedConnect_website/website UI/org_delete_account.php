  <?php
 require_once ('config.php');

 $username = $password = "";
 $username_err = $password_err = "";

 if($_SERVER["REQUEST_METHOD"] == "POST"){
 //username
     if(empty(trim($_POST['username']))){
         $username_err = "Please enter a username.";
     } else{
         $username = trim($_POST['username']);
     }
 //password
     if(empty(trim($_POST['password']))){
         $password_err = "Please enter a password.";
     } else{
         $password = trim($_POST['password']);
     }
  //exicute

     if(empty($username_err) && empty($password_err)) {
         $sql = "SELECT username, password FROM LoginOrganization WHERE username = ?";


         if($stmt = mysqli_prepare($link, $sql)){
         mysqli_stmt_bind_param($stmt, "s", $param_username);
 /*$param_password*/

             $param_username = $username;

             if(mysqli_stmt_execute($stmt)){
                 mysqli_stmt_store_result($stmt);

                 if(mysqli_stmt_num_rows($stmt) ==1){
                     mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                     if(mysqli_stmt_fetch($stmt)){
                         if(password_verify($password, $hashed_password)){
                             $sql = "DELETE FROM LoginOrganization WHERE username = '$username' AND password = '$hashed_password'";
                                 if ($link->query($sql) === TRUE) {
                                     header("location: login_page.html");
                                 } else {
                                     echo "Error deleting record: " . $link->error;
                                 }
                         } else{
                             $password_err = 'The password you entered was not valid.';
                         }
                     }
                 };
             } else{
                 $username_err = "No account found with that username.";
             }
         } else{
             echo "Oops! Something went wrong. Please try again later.";
         }

         mysqli_stmt_close($stmt);

     }


 }

    mysqli_close($link);
 ?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Delete Organization Account</title>
	<link rel="stylesheet" type="text/css" href="about_page.css" >

</head>
<body>
	<div id="container">
		<div id="header">
		
        <h1><img src="MedLogo.jpg" alt="Med Connect Logo"></h1>
		<a class="left-align" href="about_page.html">About</a>
		<a href="support_page.php">Support</a>
		<a class = "right-align" href="logout.php">Logout</a>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		</div>
		
		<div id="content">
		    <h1>Delete Organization Account</h1>

            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <br>
                <label>Username:</label>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <br>
                <label>Password:</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <br>
                <input type="submit" class="btn btn-primary" value="Submit">
				<br>
				<br>
				<br>
            </div>
		</div>
        </form>
    </div>
	</div>
</body>
</html>
