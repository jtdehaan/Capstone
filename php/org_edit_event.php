<?php
require_once 'config.php';
session_start();
$session_user = $_SESSION['username'];
$event_id = $_SESSION['event_id'];

$location = $date = $time = $price = $description = $payinapp = "";
$location_err = $date_err = $time_err = $price_err = $description_err = $payinapp_err = "";


if(empty(trim($_POST["name"]))){
    $sql = "SELECT * FROM Events WHERE EventID = '$event_id'";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $name = $row['name'];
                $location = $row['location'];
                $date = $row['date'];
                $time = $row['time'];
                $price = $row['price'];
                $description = $row['description'];
            }
        }
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
//payinapp
    $payinapp = trim($_POST['payinapp']);
//name
    $name = trim($_POST['name']);
//location
    $location = trim($_POST['location']);
//date
    $date = trim($_POST['date']);
//time
    $time = trim($_POST['time']);
//price
    $price = trim($_POST['price']);
//description
    $description = trim($_POST['description']);

 //exicute
    if(empty($location_err) &&  empty($date_err) && empty($time_err) && empty($price_err) && empty($description_err)){

        $sql = "UPDATE Events SET location = ?, time = ?, name = ?, price = ?, payinapp = ?, description = ?, date = ? WHERE EventID = '$event_id'";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sssssss", $param_location,  $param_time, $param_name, $param_price, $param_payinapp, $param_description, $param_date);

            $param_location = $location;
            $param_time = $time;
            $param_name = $name;
            $param_price = $price;
            $param_payinapp = $payinapp;
			$param_description = $description;
            $param_date = $date;

            if(mysqli_stmt_execute($stmt)){
                header('location:org_view_edit_event.php');

            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);
}
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

<!DOCTYPE html>
<html>
<head>
    <title>Edit Event</title>
</head>
<body>
        <h1>Edit Event</h1>
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
            <div class="form-group">
				<br>
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>
