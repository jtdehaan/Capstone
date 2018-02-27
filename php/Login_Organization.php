<?php
    //require("password.php");
    
    $connect = mysqli_connect("db.soic.indiana.edu","i494f17_team37","my+sql=i494f17_team37", "i494f17_team37");
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $statement = mysqli_prepare($connect, "SELECT * FROM LoginOrganization WHERE username = ?");
    mysqli_stmt_bind_param($statement, "s", $username);
    mysqli_stmt_execute($statement);
    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $colUserID, $colName, $colUsername, $colEmail, $colPassword, $colEmail_Code, $colActive, $colDescription, $colAccountType);
    
    $response = array();
    $response["success"] = false;  
    
    while(mysqli_stmt_fetch($statement)){
        if (password_verify($password, $colPassword)) {
			if ($colActive < 1){
				$response["success"] = false;
			} else {
            $response["success"] = true;
            $response["name"] = $colName;
            $response["email"] = $colEmail;
            $response["username"] = $colUsername;
			$response["user_id"] = $colUserID;
			}
        }
    }
    
    echo json_encode($response);
?>