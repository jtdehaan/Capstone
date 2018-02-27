<!doctype html>
<html>
<head>
    <title>Med Connect Organization Current Events</title>
    <link rel="stylesheet" type="text/css" href="homepage.css" >
</head>
<body>

<div id="container">
    <div id="header">
        <h1>Med Connect</h1>
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
				<li><a class="selected" href="org_current_events.php">View Current Events</a></li>
				<br>
				<li><a href="org_add_event.php">Add an Event</a></li>
		</div>
		
		<div id="main" style="overflow-y: scroll; height:400px;">
			<h2>Your Current Events:</h2>
			<br>
			<p>  <?php
				require_once 'config.php';

				$sql = "SELECT name, location, date, time, price, description, attendance, payinapp
				FROM Events";
				if($result = mysqli_query($link, $sql)){
					if(mysqli_num_rows($result) > 0){
						echo "<table><tr><th>Name</th><th>Location</th><th>Date</th><th>Time</th><th>Price</th><th>description</th><th>attendance</th><th>payinapp</th></tr>";
						while($row = mysqli_fetch_array($result)){
							echo "<tr><td>".$row['name'] ."</td><td>". $row['location']."</td><td>". $row['date']."</td><td>". $row['time']."</td><td>". $row['price']."</td><td>". $row['description']."</td><td>". $row['attendance']."</td><td>". $row['payinapp']."</td></tr>"; }
						echo"</table>";
					}
					else{
						echo "no result";
					}
				}
				else{
					echo "ERROR";
				}
				?>
			<br>
			<br>
			</p>
		</div>
       
    </div>
</div>

</body>

</html>
