<!doctype html>
<html>
<head>
    <title>Med Connect Organization Add an Event Page</title>
    <link rel="stylesheet" type="text/css" href="homepage.css" >
</head>
<body>

<div id="container">
    <div id="header">
        <h1><img src="MedLogo.jpg" alt="Med Connect Logo"></h1>
		<a class="left-align" href="about_page.html">About</a>
		<a href="support_page.php">Support</a>
		<a class = "right-align" href="logout.php">Logout</a>
    </div>
	
    <div id="content">
		<div id="navigation">
			<h2> Navigation:</h2>
			<br>
			<ul>
				<li><a href="org_homepage.php">Organization Profile</a></li>
				<br>
				<li><a href="org_edit_profile.php">Edit Profile</a></li>
				<br>
				<br>
				<li>Events:</li>
				<br>
				<li><a href="org_current_events.php">My Current Events</a></li>
				<br>
				<li><a class="selected" href="org_add_event.php">Add an Event</a></li>
		</div>
		
		<div id="main">
			<h1>Delete Event</h1>
			<p>
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
				</p>
                <br><br>
                <input type="submit" value="Unregister Event" >
            </form>
		</div>

    </div>
        </form>
			</p>
		</div>
       
    </div>
</div>

</body>

</html>
