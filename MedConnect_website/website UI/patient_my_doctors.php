<!doctype html>
<html>
<head>
    <title>Med Connect Patient Doctor List Page</title>
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
				<li><a href="patient_homepage.php">User Profile</a></li>
				<br>
				<li><a href="patient_edit_profile.php">Edit Profile</a></li>
				<br>
				<li><a class="selected" href="patient_my_doctors.php">My Doctors</a></li>
				<br>
				<br>
				<li>Events:</li>
				<br>
				<li><a href="patient_view_my_events.php">View Current Events</a></li>
				<br>
				<li><a href="patient_event_register.php">Register For Events</a></li>
				<br>
				<li><a href="patient_take_survey.php">Take Surveys</a></li>
		</div>
		
		<div id="main">
			<h2>Your Current Doctors:</h2>
			<p> THIS IS WHERE THE DOCTORS THAT THE PATIENT CONTACTS WILL BE SHOWN
			<br>
			<br>
			(unordered list, as many paragraphs as there are patients)
			<br>
			<br>
			
			<button type="submit">Add Doctor</button>
			
			</p>
		</div>
       
    </div>
</div>

</body>

</html>
