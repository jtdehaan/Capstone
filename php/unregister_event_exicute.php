<?php
require_once 'config.php';
//grabs info from unregister_event
$variable = mysqli_real_escape_string($link,$_POST['Event_name']);
//gets the event ID from the event
$result = mysqli_query($link,"SELECT EventID
FROM Events WHERE name = '$variable'");
$event_id_list = mysqli_fetch_row($result);
$event_id = $event_id_list[0];
//Delete statements
$sql = "DELETE FROM Attendance WHERE EventID = '$event_id'";
if ($link->query($sql) === TRUE) {
    echo "<br><br>";
} else {
    echo "Error deleting record: " . $link->error;
}

$sql = "DELETE FROM Events WHERE name = '$variable'";

if ($link->query($sql) === TRUE) {
    echo "Record deleted successfully(put header here)";
} else {
    echo "Error deleting record: " . $link->error;
}

echo "<br> <a href='/(put location here)'> Return to Unregister</a>";

?>
