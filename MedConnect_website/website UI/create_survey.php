<!doctype html>
<html>
<head>
    <title>Med Connect Survey Creation Page</title>
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
				<li><a href="doctor_homepage.php">User Profile</a></li>
				<br>
				<li><a href="doctor_edit_profile.php">Edit Profile</a></li>
				<br>
				<li><a href="my_patients.php">My Patients</a></li>
				<br>
				<br>
				<li>Surveys:</li>
				<br>
				<li><a href="doctor_current_surveys.php">View Current Surveys</a></li>
				<br>
				<li><a class="selected" href="create_survey.php">Add a Survey</a></li>
		</div>
		
		<div id="main">
			<h2>Create A Survey:</h2>
			<br>			
			<form action="doctor_current_surveys.php" method="get">
			
			<div class="form-group <?php echo (!empty($survey_name_err)) ? 'has-error' : ''; ?>">
                <br>
                <label>Survey Name:</label>
                <input style="width: 300px" type="text" name="survey_name"class="form-control" value="<?php echo $survey_name; ?>">
                <span class="help-block"><?php echo $survey_name_err; ?></span>
            </div> 
			
            <div class="form-group <?php echo (!empty($q1_err)) ? 'has-error' : ''; ?>">
                <br>
                <label>Question 1:</label>
                <input style="width: 800px" type="text" name="question1"class="form-control" value="<?php echo $question1; ?>">
                <span class="help-block"><?php echo $q1_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($q2_err)) ? 'has-error' : ''; ?>">
                <br>
                <label>Question 2:</label>
                <input style="width: 800px" type="text" name="question2"class="form-control" value="<?php echo $question2; ?>">
                <span class="help-block"><?php echo $q2_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($q3_err)) ? 'has-error' : ''; ?>">
                <br>
                <label>Question 3:</label>
                <input style="width: 800px" type="text" name="question3" class="form-control" value="<?php echo $question3; ?>">
                <span class="help-block"><?php echo $q3_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($q4_err)) ? 'has-error' : ''; ?>">
                <br>
                <label>Question 4:</label>
                <input style="width: 800px" type="text" name="question4" class="form-control" value="<?php echo $question4; ?>">
                <span class="help-block"><?php echo $q4_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($q5_err)) ? 'has-error' : ''; ?>">
                <br>
                <label>Question 5:</label>
                <input style="width: 800px" type="text" name="question5"class="form-control" value="<?php echo $question5; ?>">
                <span class="help-block"><?php echo $q5_err; ?></span>
            </div>
            <div class="form-group">

            </div>
        </form>
			
			<br>
			<form method="get" action="doctor_current_surveys.php">
				<button type="submit">Create Survey</button>
			</form>
		
		</div>
       
    </div>
</div>

</body>

</html>
