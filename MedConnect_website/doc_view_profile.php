<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MC Doctor View Account</title>
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
            <a class="selected" href="#">My Profile</a>
            <a href="doc_edit_profile.php">Edit Profile</a>
            <a href="doc_view_survey.php">View Surveys</a>
            <a href="doc_create_survey.php">Create a Survey</a>
            <a href="doc_about.html">About</a>
            <a href="doc_support.php">Support</a>
            <a href="logout.php">Logout</a>
            <a href="doc_delete_account">Delete Account</a>
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
                <h2>View Account</h2>
            </div>
        </div>
        <div class="admin_patient">
            <div class='table'>
                <?php
                require_once 'config.php';
                session_start();
                $session_user = $_SESSION['username'];

                $sql = "SELECT name, username, email
                FROM LoginDoctor WHERE username = '$session_user'";
                if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
                		echo "<table><tr><th>Name</th><th>Username</th><th>Email</th></tr>";
                        while($row = mysqli_fetch_array($result)){
                			echo "<tr><td>".$row['name'] ."</td><td>". $row['username']."</td><td>". $row['email']."</td></tr>"; }
                		echo"</table>";
                	}
                	else{
                		echo "no result";
                	}
                }
                else{
                	echo "ERROR";
                }
                ?>
            </div>
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
