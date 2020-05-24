<?php
     
    $dbname = "starvelater";
    $con = mysqli_connect("localhost","root","",$dbname);

    if(!$con){
        die("Connection Failed :" + mysqli_connect_error());
    }

    $query = "DELETE FROM items WHERE item_id='".$_POST['id']."'";
    mysqli_query($con,$query);
    
?>