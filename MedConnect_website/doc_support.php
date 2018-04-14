<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MC Support</title>
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
            <a href="doc_view_profile.php">My Profile</a>
            <a href="doc_edit_profile.php">Edit Profile</a>
            <a href="doc_view_survey.php">View Surveys</a>
            <a href="doc_create_survey.php">Create a Survey</a>
            <a href="doc_about.html">About</a>
            <a class="selected" href="doc_support.php">Support</a>
            <a href="logout.php">Logout</a>
            <a href="doc_delete_account.php">Delete Account</a>
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
                <h2>Support</h2>
            </div>
        </div>
        <div class="admin_patient">

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <br>
                <h3>Inquiry:</h3>
                <br>
            <div id="inquiry">
                <textarea name="inquiry" class="form-control" value="<?php echo $inquiry; ?>" rows="10" cols="35">Write your message to our support team here...</textarea>

                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
                <br>
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
                <br>
                <br>
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
