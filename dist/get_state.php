<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<script type="text/javascript">//alert("sdfsd");</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<body>
<?php

//$db_handle = new DBController();
	$dbname = "starvelater";
    $con = mysqli_connect("localhost","root","",$dbname);
    
    //Check for DB Connection
    if(!$con){
        die("Connection Failed :" + mysqli_connect_error());
    }else{

        $query ="SELECT City_ID,Name FROM city WHERE State_ID = '" . $_POST["State_ID"] . "'";
		$results = $dbhandle->query($query);
    }

	
?>
	<option value="">Select City</option>
<?php
	while($rs=$results->fetch_assoc()) {
?>
	<option value="<?php echo $rs["City_ID"]; ?>"><?php echo $rs["Name"]; ?></option>
<?php

}
?>
</body>
</html>