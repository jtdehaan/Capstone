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
         $sql = "SELECT username, password FROM LoginDoctor WHERE username = ?";


         if($stmt = mysqli_prepare($link, $sql)){
         mysqli_stmt_bind_param($stmt, "s", $param_username);

             $param_username = $username;

             if(mysqli_stmt_execute($stmt)){
                 mysqli_stmt_store_result($stmt);

                 if(mysqli_stmt_num_rows($stmt) ==1){
                     mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                     if(mysqli_stmt_fetch($stmt)){
                         if(password_verify($password, $hashed_password)){
                             $sql = "DELETE FROM LoginDoctor WHERE username = '$username' AND password = '$hashed_password'";
                                 if ($link->query($sql) === TRUE) {
                                     header("location: login.html");
                                 }
                                 else {
                                     echo "Error deleting record: " . $link->error;
                                 }
                         } else{
                             $password_err = 'The password you entered was not valid.';
                         }
                     }
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
}
//
// $sql = "DELETE FROM LoginDoctor WHERE username = '$username' AND password = '$hashed_password'";
//     if ($link->query($sql) === TRUE) {
//
//     } else {
//         echo "Error deleting record: " . $link->error;
//     }
//     mysqli_close($link);
 ?>

 <!DOCTYPE html>
 <html>

 <head>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>MC Doctor Delete Account</title>
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
             <a href="doc_support.php">Support</a>
             <a href="logout.php">Logout</a>
             <a class="selected" href="doc_delete_account.php">Delete Account</a>
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
                 <h2>Delete Account</h2>
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
                 <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                     <br>
     				<label>Password:</label>
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
