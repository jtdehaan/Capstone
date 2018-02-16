<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'db.soic.indiana.edu');
define('DB_USERNAME', 'i494f17_team37');
define('DB_PASSWORD', 'my+sql=i494f17_team37');
define('DB_NAME', 'i494f17_team37');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
