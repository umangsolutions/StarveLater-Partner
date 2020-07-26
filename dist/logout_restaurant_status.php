<?php

   $con = mysqli_connect('localhost','saikirankkd1','Gmrit@224','starvelater');
 
   
 
   $sql = "UPDATE restaurants SET sessionID='".$_POST['status']."' where Email_ID='".$_POST['email']."'";

 	$result = mysqli_query($con,$sql);

 	if($result) {
 		echo 'Data Updated ';
 		session_destroy();
 	}



?>