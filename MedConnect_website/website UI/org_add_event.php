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
}
 //exicute
    if(empty($location_err) &&  empty($date_err) && empty($time_err) && empty($price_err) && empty($description_err)){

        $sql = "INSERT INTO Events (location, time, name, price, payinapp, description, date) VALUES (?, ?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sssssss", $param_location,  $param_time, $param_name, $param_price, $param_payinapp, $param_description, $param_date);

            $param_location = $location;
            $param_date = $date;
            $param_time = $time;
            $param_name = $name;
            $param_price = $price;
            $param_payinapp = $payinapp;
            $param_description = $description;

            if(mysqli_stmt_execute($stmt)){
                //header("location: yahoo.com");
                
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);

/* ADD THIS IF WE ARE SENDING THE USER CONFORMATION. NEED TO HAVE DB COMPLETELY SET UP BEFORE
$msg = 'Your event has been made! <br> please click the link to verify your account';
$to = $_POST["price"];
$subject = 'Signup | Verification';
$headers = 'From:noreply@calculator.php' . "\r\n";
$message = "
Your account has been created.
Please click this link to activate your account:
http://http://cgi.soic.indiana.edu/~jmodugno/price_confirm.php?price=$to&price_code=$price_code.'
";
mail($to, $subject, $message, $headers);
*/
?>

<!doctype html>
<html>
<head>
    <title>Med Connect Organization Add an Event Page</title>
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
			<h2>Add An Event:</h2>
			<p> 
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($org_name_err)) ? 'has-error' : ''; ?>">
                <br>
                <label>Organization Name:</label>
                <input type="text" name="org_name"class="form-control" value="<?php echo $org_name; ?>">
                <span class="help-block"><?php echo $name_err; ?></span>
            </div> 
			 <div class="form-group <?php echo (!empty($event_name_err)) ? 'has-error' : ''; ?>">
                <br>
                <label>Event Name:</label>
                <input type="text" name="name"class="form-control" value="<?php echo $event_name; ?>">
                <span class="help-block"><?php echo $event_name_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($event_capacity_err)) ? 'has-error' : ''; ?>">
                <br>
                <label>Event Capacity:</label>
                <input type="text" name="event_capacity" class="form-control" value="<?php echo $event_capacity; ?>">
                <span class="help-block"><?php echo $event_capacity_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($cost_err)) ? 'has-error' : ''; ?>">
                <br>
                <label>Cost of Entry:</label>
                <input type="text" name="cost"class="form-control" value="<?php echo $cost; ?>">
                <span class="help-block"><?php echo $cost_err; ?></span>
            </div>
			<div class="form-group <?php echo (!empty($description_err)) ? 'has-error' : ''; ?>">
                <br>
                <label>Event Description:</label>
				<br>
                <input style="height: 80px; width: 800px;" type="text" name="description" class="form-control" value="<?php echo $description; ?>">
                <span class="help-block"><?php echo $description_err; ?></span>
            </div>
            <div class="form-group">
                <br>
				<form method="get" action="org_current_events.php">
					<button type="submit">Create Event</button>
				</form>				
				<br>
				<br>
				<br>

            </div>
        </form>
			</p>
		</div>
       
    </div>
</div>

</body>

</html>
