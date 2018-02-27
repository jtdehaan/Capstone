<?php

    $con = mysqli_connect("db.soic.indiana.edu","i494f17_team37","my+sql=i494f17_team37", "i494f17_team37") or die ('Unable to connect');
    
    if(mysqli_connect_error($con))
    {
        echo "Failed to connect";
    }
    
    $query = mysqli_query($con, "SELECT * FROM LoginPatient");
    
    if($query)
    {
        while ($row=mysqli_fetch_array($query))
        {
            $flag[] = $row;
        }
        
        print(json_encode($flag));
    }
    
    mysqli_close ($con)

?>