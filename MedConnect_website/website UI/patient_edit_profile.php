<!doctype html>
<html>
<head>
    <title>Med Connect Patient Edit Profile Page</title>
    <link rel="stylesheet" type="text/css" href="homepage.css" >
</head>
<body>

<div id="container">
    <div id="header">
        <h1>Med Connect</h1>
		<a class="left-align" href="about_page.html">About</a>
		<a href="support_page.php">Support</a>
		<a class = "right-align" href="login_page.html">Login</a>
    </div>
	
    <div id="content">
		<div id="navigation">
			<h2> Navigation:</h2>
			<br>
			<ul>
				<li><a href="patient_homepage.php">User Profile</a></li>
				<br>
				<li><a class="selected" href="patient_edit_profile.php">Edit Profile</a></li>
				<br>
				<li><a href="patient_my_doctors.php">My Doctors</a></li>
				<br>
				<br>
				<li>Events:</li>
				<br>
				<li><a href="patient_view_my_events.php">View Current Events</a></li>
				<br>
				<li><a href="patient_event_register.php">Register For Events</a></li>
		</div>
		
		<div id="main">
			<h2>Edit Your Profile:</h2>
			<p> 
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
                <input type="text" name="email"class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <br>
                <input type="submit" class="btn btn-primary" value="Submit">
				<br>
				<br>
				<a href="patient_delete_account.php">Delete Account</a>
				<br>
				<br>

            </div>
        </form>
			</p>
		</div>
       
    </div>
</div>

</body>

</html>
