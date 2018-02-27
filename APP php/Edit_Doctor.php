<?php
    
    $con = mysqli_connect("db.soic.indiana.edu","i494f17_team37","my+sql=i494f17_team37", "i494f17_team37");
    
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
	$user_id = $_POST["user_id"];
    //$id = SELECT user_id FROM LoginPatient WHERE username = $name;
   // $password = $_POST["password"];
   //SELECT user_id FROM LoginPatient WHERE username = $username
   //9
    
    function updateUser() {
        global $con, $name, $username, $email, $user_id;
        // $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        // $emailCode = md5(rand());
        $statement = mysqli_prepare($con, "UPDATE LoginDoctor SET name = '$name', username = '$username', email = '$email' WHERE user_id = '$user_id'");
        mysqli_stmt_bind_param($statement, "sss", $name, $username, $email);
        
       // $message = "Hello $name,\n\nClick the link below to verify your account:\nhttp://cgi.soic.indiana.edu/~team37/activate_patient.php?email_code=$emailCode";
        
       // mail($email, "MedConnect Patient Registration", $message, "From: DoNotReply@soic.iu.edu");
        
        mysqli_stmt_execute($statement);	
        mysqli_stmt_close($statement); 
    }
    /*
    function usernameAvailable() {
        global $con, $username;
        $statement = mysqli_prepare($con, "SELECT * FROM LoginPatient WHERE username = ?"); 
        mysqli_stmt_bind_param($statement, "s", $username);
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);
        $count = mysqli_stmt_num_rows($statement);
        mysqli_stmt_close($statement); 
         if ($count < 1){
            return true; 
        }else {
            return false; 
        }
    }
    
    function emailAvailable() {
        global $con, $email;
        $statement = mysqli_prepare($con, "SELECT * FROM LoginPatient WHERE email = ?"); 
        mysqli_stmt_bind_param($statement, "s", $email);
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);
        $count = mysqli_stmt_num_rows($statement);
        mysqli_stmt_close($statement); 
         if ($count < 1){
            return true; 
        }else {
            return false; 
        }
    }
    
	*/
    
    $response = array();
    $response["success"] = false;  
    
  //  if (usernameAvailable() && emailAvailable()){
        updateUser();
        $response["success"] = true;  
  //  }
    
    echo json_encode($response);
?>