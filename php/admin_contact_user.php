<!DOCTYPE html>
<html>
    <head>
        <style>
        table, th, td {
            border: 1px solid black;
        }
        </style>
    </head>
    <body>
        <div class="admin_patient">
        <?php
        require_once 'config.php';
        session_start();

        $sql = "SELECT *
        FROM LoginPatient";
        if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
        	echo "<form method='POST'><table><tr><th> Contact User </th><th>Patient ID</th><th>Name</th><th>Username</th><th>Email</th><th>Password</th></tr>";
         while($row = mysqli_fetch_array($result)){
        		echo "<tr><td>"."<input type='radio' name='patient' value=".$row['user_id']." required>"."</td><td>".$row['user_id'] ."</td><td>". $row['name']."</td><td>". $row['username']."</td><td>". $row['email']."</td><td>". $row['password']."</td></tr>"; }
        	echo"</table><input type='submit' value='Contact' name='contact_patient'></form>";
        }
        else{
        	echo "no result";
        }
        }
        else{
        echo "ERROR". mysqli_error($link);
        }
        ?>
        </div>
        <br>
        <div class="admin_Doctor">
        <?php
        require_once 'config.php';

        $sql = "SELECT *
        FROM LoginDoctor";
        if($result = mysqli_query($link, $sql)){
         if(mysqli_num_rows($result) > 0){
        		echo "<form method='POST'><table><tr><th> Contact User </th><th>Doctor ID</th><th>Name</th><th>Username</th><th>Email</th><th>Password</th></tr>";
             while($row = mysqli_fetch_array($result)){
        			echo "<tr><td>"."<input type='radio' name='doctor' value=".$row['user_id']." required>"."</td><td>".$row['user_id'] ."</td><td>". $row['name']."</td><td>". $row['username']."</td><td>". $row['email']."</td><td>". $row['password']."</td></tr>"; }
        		echo"</table><input type='submit' value='Contact' name='contact_doctor'></form>";
        	}
        	else{
        		echo "no result";
        	}
        }
        else{
        	echo "ERROR". mysqli_error($link);
        }
        ?>
        </div>
        <br>
        <div class="admin_Organization">
        <?php
        require_once 'config.php';

        $sql = "SELECT *
        FROM LoginOrganization";
        if($result = mysqli_query($link, $sql)){
         if(mysqli_num_rows($result) > 0){
        		echo "<form method='POST'><table><tr><th> Contact User </th><th>Organization ID</th><th>Name</th><th>Username</th><th>Email</th><th>Password</th></tr>";
             while($row = mysqli_fetch_array($result)){
        			echo "<tr><td>"."<input type='radio' name='organization' value=".$row['user_id']." required>"."</td><td>".$row['user_id'] ."</td><td>". $row['name']."</td><td>". $row['username']."</td><td>". $row['email']."</td><td>". $row['password']."</td></tr>"; }
        		echo"</table><input type='submit' value='Contact' name='contact_organization'></form>";
        	}
        	else{
        		echo "no result";
        	}
        }
        else{
        	echo "ERROR". mysqli_error($link);
        }
        ?>
        </div>
    </body>
</html>
<?php
require_once 'config.php';

if(isset($_POST['contact_patient'])){
    $input = $_POST['patient'];
    $sql = "SELECT name, email from LoginPatient WHERE user_id = '$input'";
        if($result = mysqli_query($link, $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    $name = $row['name'];
                    $email = $row['email'];
                    echo "Contact: ".$name."<br> <form action='admin_contact_user_email.php' id='patient_email' method='POST'>Subject: <input type='text' name='header'><br><br>
                    <textarea rows='4' cols='50' name='msg' form='patient_email'> Enter message here...</textarea><br>
                    <input type='submit'>";
            }
        }
        }
        else{
    		echo "ERROR";
    	}
    session_start();
    $_SESSION['email'] = $email;
    }
    // else{
    // 	echo $link->error;
    //
    //     // echo "ERROR". mysqli_error($link);
    // }
            // header("location: admin_view_users.php");

elseif(isset($_POST['contact_doctor'])){
    $input = $_POST['doctor'];
    $sql = "SELECT name, email from LoginDoctor WHERE user_id = '$input'";
        if($result = mysqli_query($link, $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    $name = $row['name'];
                    $email = $row['email'];
                    echo "Contact: ".$name."<br> <form action='admin_contact_user_email.php' id='patient_email' method='POST'>Subject: <input type='text' name='header'><br><br>
                    <textarea rows='4' cols='50' name='msg' form='patient_email'> Enter message here...</textarea><br>
                    <input type='submit'>";
            }
        }
        }
        else{
            echo "ERROR";
        }
    session_start();
    $_SESSION['email'] = $email;
    }
// else{
//     echo $link->error;
//
//     // echo "ERROR". mysqli_error($link);
// }

elseif(isset($_POST['contact_organization'])){
    $input = $_POST['organization'];
    $sql = "SELECT name, email from LoginOrganization WHERE user_id = '$input'";
        if($result = mysqli_query($link, $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    $name = $row['name'];
                    $email = $row['email'];
                    echo "Contact: ".$name."<br> <form action='admin_contact_user_email.php' id='patient_email' method='POST'>Subject: <input type='text' name='header'><br><br>
                    <textarea rows='4' cols='50' name='msg' form='patient_email'> Enter message here...</textarea><br>
                    <input type='submit'>";
            }
        }
        }
        else{
            echo "ERROR";
        }
    session_start();
    $_SESSION['email'] = $email;
    }
else{
    echo $link->error;

    // echo "ERROR". mysqli_error($link);
}
?>
