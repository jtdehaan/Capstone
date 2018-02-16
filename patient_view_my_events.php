<!doctype html>
<html>
<head>
    <title>Med Connect Patient My Events List Page</title>
    <link rel="stylesheet" type="text/css" href="homepage.css" >
</head>
<body>

<div id="container">
    <div id="header">
        <h1>Med Connect</h1>
		<a class="left-align" href="about_page.html">About</a>
		<a href="support_page.php">Support</a>
		<a class = "right-align" href="login_page.html">Login</a>
    </div>
	
    <div id="content">
		<div id="navigation">
			<h2> Navigation:</h2>
			<br>
			<ul>
				<li><a href="patient_homepage.php">User Profile</a></li>
				<br>
				<li><a href="patient_edit_profile.php">Edit Profile</a></li>
				<br>
				<li><a href="patient_my_doctors.php">My Doctors</a></li>
				<br>
				<br>
				<li>Events:</li>
				<br>
				<li><a class="selected" href="patient_view_my_events.php">View Current Events</a></li>
				<br>
				<li><a href="patient_event_register.php">Register For Events</a></li>
		</div>
		
		<div id="main">
			<h2>Your Current Events:</h2>
			<p> THIS IS WHERE THE LIST OF EVENTS THE PATIENT SIGNED UP FOR IS SHOWN
			<br>
			<br>
			(unordered list, as many paragraphs as there are patients)
			<br>
			<br>
			
		<form method="get" action="patient_event_register.php">
			<button type="submit">Add Events</button>
		</form>
			</p>
		</div>
       
    </div>
</div>

</body>

</html>
