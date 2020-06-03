<?php

	$connect = mysqli_connect('localhost','root','','starvelater');

	$sql = "select sum(Net_Bill) from orders where Order_Id='201' ";

	$result = mysqli_query($connect,$sql);

	$resultarr = mysqli_fetch_array($result);

 
   echo $resultarr[0];
?>