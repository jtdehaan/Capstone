<?php
require_once 'config.php';
session_start();
$session_user
//grabs info from doctor_viewing_surveys
$variable = mysqli_real_escape_string($link,$_POST['delete_survey']);
//gets the Survey ID from the Survey

$result = mysqli_query($link,"SELECT SurveyID FROM Survey WHERE SurveyID = '$variable'");
$survey_id_get = mysqli_fetch_row($result);


/*
$sql = "SELECT SurveyID FROM Survey WHERE SurveyID = '$variable'";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $survey_id_get = $row['SurveyID'];
            }
        }
    }
    else {
        echo "ERROR";
        }
*/
echo "Your Survey ID: "."$survey_id_get";
echo "Your variable: "."$variable";


//Delete statements
$sql = "DELETE FROM Survey WHERE SurveyID = '$survey_id_get'";
if ($link->query($sql) === TRUE) {
    echo "<br><br>";
} else {
    echo "Error deleting survey: " . $link->error;
}

$sql = "DELETE FROM Answers WHERE SurveyID = '$survey_id_get'";

if ($link->query($sql) === TRUE) {
    echo "Record deleted successfully";
		  //header("location: doctor_viewing_surveys.php");
} else {
    echo "Error deleting record: " . $link->error;
}

echo "<br> <a href='doctor_viewing_surveys.php'> Return to Events</a>";

?>
