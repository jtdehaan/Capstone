<?php
require_once 'config.php';


$location = $date = $time = $price = $description = $payinapp = "";
$location_err = $date_err = $time_err = $price_err = $description_err = $payinapp_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
//payinapp
    if(empty(trim($_POST["payinapp"]))){

    } else{
        $payinapp = trim($_POST['payinapp']);
    }
//name
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter a name for your event.";
    } else{
        $name = trim($_POST['name']);
        }

//location
    if(empty(trim($_POST["location"]))){
        $location_err = "Please enter a location.";
    } else{
        $location = trim($_POST['location']);
        }
//date
    if(empty(trim($_POST['date']))){
        $date_err = "Please enter a date for your event.";
    } else{
        $date = trim($_POST['date']);
    }
//time
    if(empty(trim($_POST['time']))){
        $time_err = "Please enter a time for your event.";
    } else{
        $time = trim($_POST['time']);
    }
//price
    if(empty(trim($_POST['price']))){
        $price_err = "Please enter a price for your event.";
    } else{
        $price = trim($_POST['price']);
    }

//description
    if(empty(trim($_POST["description"]))){
        $description_err = 'Please add a description for your event.';
    } else{
            $description = trim($_POST['description']);
        }

//Organization ID
session_start();
$session_user = $_SESSION['username'];
$sql = "SELECT user_id FROM LoginOrganization WHERE username = '$session_user'";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $org_user_id = $row['user_id'];
            }
        }
    }
    else {
        echo "ERROR";
        }
// echo $session_user;
// echo $org_user_id;
 //exicute
    if(empty($location_err) &&  empty($date_err) && empty($time_err) && empty($price_err) && empty($description_err)){


        $sql = "INSERT INTO Events (location, time, name, price, payinapp, description, date, OrganizationID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ssssssss", $param_location,  $param_time, $param_name, $param_price, $param_payinapp, $param_description, $param_date, $param_org_user_id);

            $param_location = $location;
            $param_date = $date;
            $param_time = $time;
            $param_name = $name;
            $param_price = $price;
            $param_payinapp = $payinapp;

            $param_description = $description;
            $param_org_user_id = $org_user_id;

            if(mysqli_stmt_execute($stmt)){
                header("location: org_current_events.php");

            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);
}
/* ADD THIS IF WE ARE SENDING THE USER CONFIRMATION. NEED TO HAVE DB COMPLETELY SET UP BEFORE
$msg = 'Your event has been made! <br> please click the link to verify your account';
$to = $_POST["price"];
$subject = 'Signup | Verification';
$headers = 'From:noreply@calculator.php' . "\r\n";
$message = "
Your account has been created.
Please click this link to activate your account:

http://http://cgi.soic.indiana.edu/~team37/Med_Connect_add_event.php?price=$to&price_code=$price_code.'
";
mail($to, $subject, $message, $headers);
*/
?>



<!doctype html>
<html>
<head>
    <title>Register</title>
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
			<h1>Create Event</h1>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <br>
                <label>Event Name:</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                <span class="help-block"><?php echo $name_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($location_err)) ? 'has-error' : ''; ?>">

                <br>
                <label>Location:</label>
                <input type="text" name="location" class="form-control" value="<?php echo $location; ?>">
                <span class="help-block"><?php echo $location_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($date_err)) ? 'has-error' : ''; ?>">
                <br>
                <label>Date:</label>
                <input type="text" name="date" class="form-control" value="<?php echo $date; ?>">
                <span class="help-block"><?php echo $date_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($time_err)) ? 'has-error' : ''; ?>">
                <br>
                <label>Time:</label>
                <input type="text" name="time" class="form-control" value="<?php echo $time; ?>">
                <span class="help-block"><?php echo $time_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($location_err)) ? 'has-error' : ''; ?>">
                <br>

                <label>Price:</label>
                <input type="text" name="price" class="form-control" value="<?php echo $price; ?>">
                <span class="help-block"><?php echo $price_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($payinapp)) ? 'has-error' : ''; ?>">
                <br>
                <label>Check the box to enable In-app pay:</label>
                <input type="checkbox" name="payinapp"class="form-control" value="1">
            </div>
            <div class="form-group <?php echo (!empty($description_err)) ? 'has-error' : ''; ?>">
                <br>
                <label>Description:</label>
                <input type="text" name="description" class="form-control" value="<?php echo $description; ?>">
                <span class="help-block"><?php echo $description_err; ?></span>
            </div>

                <br>
                <input type="submit" class="btn btn-primary" value="Create Event">
				<br>
				<br>
            </div>
        </form>
			</div>

            </div>
        </form>
    </div>
</body>
</html>
