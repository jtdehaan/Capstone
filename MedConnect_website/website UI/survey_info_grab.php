<?php
require_once 'config.php';
session_start();
$survey_id_get = mysqli_real_escape_string($link,$_POST['take_survey']);
$_SESSION['SurveyID'] = $survey_id_get;

//echo "Survey ID: ".$survey_id_get;

header('location: pat_take_survey.php');

?>