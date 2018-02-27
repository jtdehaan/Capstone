<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<form action="unregister_event_exicute.php" method="POST">
				Course: <select name="Event_name" required>
				<?php
					require_once 'config.php';
					// Check connection
					if (!$link) {
						die("Connection failed: " . mysqli_connect_error());
					}
						$result = mysqli_query($link,"SELECT name FROM Events");
						while ($row = mysqli_fetch_assoc($result)) {
									  unset($name);
									  $name = $row['name'];
									  echo '<option value="'.$name.'">'.$name.'</option>';
				}

				?>
				</select>
				<br><br>
				<input type="submit" value="Unregister Event" >
			</form>

</body>
</html>
