<?php
    
    $con = mysqli_connect("db.soic.indiana.edu","i494f17_team37","my+sql=i494f17_team37", "i494f17_team37");
    
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    function registerUser() {
        global $con, $name, $username, $email, $password;
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $emailCode = md5(rand());
        $statement = mysqli_prepare($con, "INSERT INTO LoginPatient (name, username, email, password, email_code) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($statement, "sssss", $name, $username, $email, $passwordHash, $emailCode);
        
        $message = "Hello $name,\n\nClick the link below to verify your account:\nhttp://cgi.soic.indiana.edu/~team37/activate_patient.php?email_code=$emailCode";
        
        mail($email, "MedConnect Patient Registration", $message, "From: DoNotReply@soic.iu.edu");
        
        mysqli_stmt_execute($statement);	
        mysqli_stmt_close($statement); 
    }
    
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
    
    
    $response = array();
    $response["success"] = false;  
    
    if (usernameAvailable() && emailAvailable()){
        registerUser();
        $response["success"] = true;  
    }
    
    echo json_encode($response);
?>