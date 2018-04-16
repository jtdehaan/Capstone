<?php

require_once 'config.php';

$Q1 = $Q2 = $Q3 = $Q4 = $Q5 = "";
$Q1_err = $Q2_err = $Q3_err = $Q4_err = $Q5_err = "";

	
if($_SERVER["REQUEST_METHOD"] == "POST"){

	
//question1
    if(empty(trim($_POST["Q1"]))){
        $Q1_err = "Please enter a question.";
    } else{
        $Q1 = trim($_POST['Q1']);
        }

//question2
    if(empty(trim($_POST["Q2"]))){
        $Q2_err = "Please enter a question.";
    } else{
        $Q2 = trim($_POST['Q2']);
        }
//question3
    if(empty(trim($_POST['Q3']))){
        $Q3_err = "Please enter a question.";
    } else{
        $Q3 = trim($_POST['Q3']);
    }
//question4
    if(empty(trim($_POST['Q4']))){
        $Q4_err = "Please enter a question.";
    } else{
        $Q4 = trim($_POST['Q4']);
    }
//question5
    if(empty(trim($_POST['Q5']))){
        $Q5_err = "Please enter a question.";
    } else{
        $Q5 = trim($_POST['Q5']);
    }

//Survey ID
session_start();
$session_user = $_SESSION['Survey_ID'];
$sql = "SELECT Survey_ID FROM Survey WHERE Survey_ID = '$session_user'";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $Survey_ID = $row['Survey_ID'];
            }
        }
    }
    else {
        echo "ERROR";
        }
}
// echo $session_user;
// echo $org_user_id;
 //execute

?>