<?php 

 $con = mysqli_connect('localhost','root','','starvelater');
 
 

 	/*$price = $_POST['price'];
 	$availability = $_POST['availability'];
 	$id = $_POST['id'];
*/
 	$sql = "UPDATE category set Name='".$_POST['name']."' where Category_ID='".$_POST['id']."'";

 	$result = mysqli_query($con,$sql);

 	if($result) {
 		echo 'Data Updated ';
 	}



?>