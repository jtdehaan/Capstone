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
    </head>
    <body>
        <p>
            <form action="admin_contact_user.php">
                Your Email has been sucessfully sent!
            <input type="submit" value="Return to Contact Users">
            </form>
        </p>
    </body>
</html>
