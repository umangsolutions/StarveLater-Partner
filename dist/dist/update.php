<?php 

 $con = mysqli_connect('localhost','saikirankkd1','Gmrit@224','starvelater');
 
 

 	/*$price = $_POST['price'];
 	$availability = $_POST['availability'];
 	$id = $_POST['id'];
*/
 	$sql = "UPDATE items set price='".$_POST['price']."',availability='".$_POST['availability']."',Discount='".$_POST['discount']."',Final_Price='".$_POST['final_price']."' where item_id='".$_POST['id']."'";

 	$result = mysqli_query($con,$sql);

 	if($result) {
 		echo 'Data Updated ';
 	}



?>