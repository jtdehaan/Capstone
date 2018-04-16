<?php
require_once 'config.php';
session_start();
$event_id_get = mysqli_real_escape_string($link,$_POST['edit']);
$_SESSION['event_id'] = $event_id_get;
// echo $event_id_get;
header('location: org_edit_event.php');
?>
