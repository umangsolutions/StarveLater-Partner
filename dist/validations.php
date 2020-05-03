<!-- PHP Validation -->
<?php

// define variables and set to empty values
$fnameErr = $lnameErr =  $restaurantNameErr = $emailErr = $passwordErr = $conpasswordErr = $stateErr = $cityErr = $gstInErr = "";
$fname = $lname = $restaurantName = $email = $password = $conpassword = $state = $city = $gstIn = "";
$boolean=false;

//Remove spaces, slashes and prevent XSS
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

//First Name Validation
  if (empty($_POST["fname"])) {
    $fnameErr = "First Name required";
    $boolean = false;
  } else {
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
      $fnameErr = "Only letters and white space allowed";
    }else{
        $fname = test_input($_POST["fname"]);
        $boolean = true;
    }
    }
  
  //Last Name Validation
  if (empty($_POST["lname"])) {
    $lnameErr = "Last Name required";
    $boolean = false;
  } else {
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
      $lnameErr = "Only letters and white space allowed";
    }else{
        $lname = test_input($_POST["lname"]);
        $boolean = true;
    }
  }

  //Restaurant Name Validation
  if (empty($_POST["restaurantName"])) {
    $restaurantNameErr = "Restaurant Name required";
    $boolean = false;
  } else {
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$restaurantName)) {
      $restaurantNameErr = "Only letters and white space allowed";
    }else{
        $restaurantName = test_input($_POST["restaurantName"]);
        $boolean = true;
    } 
  }
  
  //Email Id Validation
  if (empty($_POST["email"])) {
    $emailErr = "Email required";
    $boolean = false;
  } else {
    // check if e-mail address is well-formed
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }else{
        $email = test_input($_POST["email"]);
        $boolean = true;
    }
  }
  
    //Password Validation
    //$length = strlength($_POST["password"]);
    if(empty($_POST["password"])){
        $passwordErr = "Password required";
        $boolean = false;
    }else {

    $ln= strlen($_POST["password"]);
    if($ln > 15){
        $passwordErr = "Password should be less than 15 characters";
        $boolean = false;
    } elseif($ln < 5 && $ln >=1) {
        $passwordErr = "Password should be greater than 3 characters";
        $boolean=false;
    } /*elseif(!preg_match("#[0-9]+#",$password)) {
        $passwordErr = "Password must Contain At Least 1 Number!";
        $boolean = false;
    } elseif(!preg_match("#[A-Z]+#",$password)) {
        $passwordErr = "Password must Contain At Least 1 Capital Letter!";
        $boolean = false;
    } elseif(!preg_match("#[a-z]+#",$password)) {
        $passwordErr = "Password must Contain At Least 1 Lowercase Letter!";
        $boolean = false;
    }*/ else {
        $password = test_input($_POST["password"]);
        $boolean = true;
    }

    }

    //Confirm Password Validation
    if(empty($_POST["conpassword"])){
        $conpasswordErr = "Confirm Password required";
        $boolean = false;
    } elseif($_POST["conpassword"]!=$_POST["password"]){
        $conpasswordErr = "Passwords not matching";
        $boolean = false;
    } else{
        $boolean = true;
    }
  
  //GST IN Validation
    if (empty($_POST["gstIn"])) {
    $gstInErr = "GSTIN is required";
    $boolean = false;
  } else {
      $gstIn = test_input($_POST["gstIn"]);
      $boolean = true;
    }

  //State Validation
    /*if(isset($_POST['state']) && $_POST['state'] == '0') { 
        $stateErr = "Please select a State"; 
    }else {
        //$state = test_input($_POST["state"]);
        $boolean = true;
    }*/

  //City Validation
    /*if(isset($_POST['city']) && $_POST['city'] == '0') { 
        $cityErr = "Please select a City"; 
    }else {
        //$city = test_input($_POST["city"]);
        $boolean = true;
    }*/     


//Length of Password
/*function strlength($str)
{
    $ln= strlen($str);
    if($ln > 15){
        return "Password should be less than 15 characters";
    }elseif ($ln < 5 && $ln >=1){
        return "Password should be greater than 3 characters";
    }
    return;
}*/

//Create New Restaurant
function NewUser(){

    $sql = "INSERT INTO reg(fname,lname,restaurantname,email,passwd,state,city,gstin) Values
    ('".$_POST["fname"]."','".$_POST["lname"]."','".$_POST["restaurantName"]."','".$_POST["email"]."','".$_POST["password"]."','".$_POST["state"]."','".$_POST["city"]."','".$_POST["gstIn"]."')";
    $query = mysqli_query($GLOBALS['con'], $sql);
    if($query){
        echo "<script>
                    alert('Registered Successfully');
        </script>";
    }
}

//Check whether restaurant name and Email Id exists in DB
function SignUp(){

        $sql = "SELECT * FROM reg where restaurantname = '".$_POST["restaurantName"]."' AND email = '".$_POST["email"]."'";
        $result = mysqli_query($GLOBALS['con'],$sql) or die("Error: " . mysqli_error($con));

        if(!$row = mysqli_fetch_array($result)){
            NewUser();
        }else{
            echo "<script>
                  alert('Restaurant is already registered!');
            </script>";
        }
    }

if($boolean){
    $dbname = "restaurant_registration";
    $con = mysqli_connect("localhost","root","",$dbname);
    
    //Check for DB Connection
    if(!$con){
        die("Connection Failed :" + mysqli_connect_error());
    }else{

        if(isset($_POST["submit"])){
           SignUp();
           mysqli_close($GLOBALS["con"]);
           $boolean = false;
    }
    }
    }
}

?>