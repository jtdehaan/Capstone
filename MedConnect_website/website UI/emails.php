<?php
//email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
    } else{
        $sql = "SELECT user_id FROM LoginOrganization WHERE email = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            $param_email = trim($_POST["email"]);

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }
	
$msg = 'You Can Do THIS';
$to = $_POST["email"];
$subject = 'WHAT YOU CAN DO';
$headers = 'From:noreply@Med_Connect_WHAT_THIS_DOES.php' . "\r\n";
$message = "PULL THIS FROM THE PAGE THIS CONNECTS TO: WHAT THEY TYPE IN"
mail($to, $subject, $message, $headers);
	?>
	
