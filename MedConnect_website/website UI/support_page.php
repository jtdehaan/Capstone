<!doctype html>
<html>

<head>
    <title>Med Connect Support Page</title>
    <link rel="stylesheet" type="text/css" href="support_page.css" >
</head>
<body>

<div id="container">
    <div id="header">
        <h1><img src="MedLogo.jpg" alt="Med Connect Logo"></h1>
		<a class="left-align" href="about_page.html">About</a>
		<a class="selected" href="support_page.php">Support</a>
		<a class = "right-align" href="login_page.html">Login</a>
		
    </div>
    <div id="content">
        <h2>Med Connect Support</h2>
		<p>Please select an account type:</p>
		
		<form action="">
		  <input type="radio" name="account_type" value="patient"> Patient
		  <input type="radio" name="account_type" value="doctor"> Doctor
		  <input type="radio" name="account_type" value="organization"> Organization
		</form>
		
       <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <br>
                <label>Inquiry:</label>
				<br>
			<div id="inquiry">
                <input type="text" style="height:175px;width:600px;" name="inquiry"class="form-control" value="<?php echo $inquiry; ?>">
				
                <span class="help-block"><?php echo $username_err; ?></span>
			</div>
				<br>
				<input type="submit" class="btn btn-primary" value="Submit">
            </div> 
            
				<br>

            </div>
        </form>
    </div>
</div>

</body>

</html>
