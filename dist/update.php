<?php 

 $con = mysqli_connect('localhost','root','','starvelater');
 
 

 	/*$price = $_POST['price'];
 	$availability = $_POST['availability'];
 	$id = $_POST['id'];
*/
 	$sql = "UPDATE items set price='".$_POST['price']."',availability='".$_POST['availability']."' where item_id='".$_POST['id']."'";

 	$result = mysqli_query($con,$sql);

 	if($result) {
 		echo 'Data Updated ';
 	}



?>