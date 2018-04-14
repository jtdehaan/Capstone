<?php
require_once 'config.php';
session_start();
$subject = $_POST['header'];
$message = $_POST['msg'];
$to = $_SESSION['email'];
$headers = 'From: MedConnectAdmin' . "\r\n";
mail($to, $subject, $message, $headers);
 ?>
 <!DOCTYPE html>
 <html>

 <head>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Med Connect Administrator View All Events Page</title>
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
             <a href="admin_homepage.php">Admin Profile</a>
             <a href="admin_delete_user.php">Delete User</a>
             <a href="admin_view_users.php">View Users</a>
             <a href="admin_all_surveys.php">View Surveys</a>
             <a href="admin_contact_account.php">Contact Users</a>
             <a href="logout.php">Logout</a>
         </div>
     </nav>
     <div class="container">
         <header>
             <!--Menu function -->
             <span class="menu" onclick="openNav()"><i class="fas fa-bars"></i> Menu</span>
             <h1>Med Connect</h1>
             <a class="left-align" href="about.html">About</a>
             <a href="support.php">Support</a>
             <a class="right-align" href="logout.php">Logout</a>
         </header>
     </div>
     <main>
         <div class="container">
             <div class='current-page'>
                 <h2>Contact Account</h2>
             </div>
         </div>
         <div class="admin_patient">
            <form action="admin_contact_user.php">
                Your Email has been sucessfully sent!
            <input type="submit" value="Return to Contact Users">
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
