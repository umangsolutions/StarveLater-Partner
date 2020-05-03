<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Restaurant Registration</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">

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
        
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Restaurant Registration Form</h3></div>
                                    <div class="card-body">
                                        <form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                                            <!-- Name of Owner -->
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputFirstName">First Name</label><input class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter First name" name="fname" />
                                                    <span id="span"><?php echo $fnameErr; ?></span>
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputLastName">Last Name</label><input class="form-control py-4" id="inputLastName" type="text" placeholder="Enter Last name" name="lname" />
                                                    <span id="span"><?php echo $lnameErr; ?></span>
                                                </div>
                                                </div>
                                            </div>

                                            <!-- Restaurant Name -->
                                            <div class="form-group"><label class="small mb-1" for="inputRestaurantName">Name of Restaurant</label><input class="form-control py-4" id="inputRestaurantName" type="text" aria-describedby="emailHelp" placeholder="Enter Name of Restaurant" name="restaurantName" />
                                                <span id="span"><?php echo $restaurantNameErr; ?></span>
                                            </div>
                                    

                                            <!-- Email Address -->
                                            <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Email</label><input class="form-control py-4" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" name="email" />
                                            <span id="span"><?php echo $emailErr; ?></span>
                                            </div>

                                            <!-- Password Section -->
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputPassword">Password</label><input class="form-control py-4" id="inputPassword" type="password" placeholder="Enter password" name="password"/><span id="span"><?php echo $passwordErr; ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">Confirm Password</label><input class="form-control py-4" id="inputConfirmPassword" type="password" placeholder="Confirm password" name="conpassword" />
                                                    <span id="span"><?php echo $conpasswordErr; ?></span>
                                                </div>
                                                </div>
                                            </div>


                                            <!-- Location Section -->
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputState">Choose State</label><br>
                                                        <select class="form-control" id="inputState" name="state" >
                                                             <option>Andhra Pradesh</option>
                                                              <option>Telangana</option>
                                                               <option>Chattisgarh</option>
                                                        </select>
                                                    </div>
                                                    <span id="span"><?php echo $stateErr; ?></span>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputCity">Choose City</label><br>
                                                        <select class="form-control" id="inputCity" name="city" >
                                                             <option>Kakinada</option>
                                                              <option>Rajam</option>
                                                               <option>Warangal</option>
                                                        </select>
                                                    </div>
                                                    <span id="span"><?php echo $cityErr; ?></span>
                                                </div>
                                            </div>

                                            <!-- GSTIN Number  -->
                                            <div class="form-group"><label class="small mb-1" for="inputGSTIN">GSTIN Number</label><input class="form-control py-4" id="inputGSTIN" type="text" aria-describedby="emailHelp" placeholder="Enter GSTIN Number (optional)" name="gstIn" />
                                            <span id="span"><?php echo $gstInErr; ?></span>
                                            </div>

                                            <!-- Upload File -->
                                            <div class="form-group">
                                                        <label class="small mb-1" for="inputCity">Upload File</label>
                                                        <input type="File" class="form-control" accept=".pdf" name="inputPDF">
                                            </div>

                                             <!-- Submit Button -->
                                            <div class="form-group mt-4 mb-0"><input class="btn btn-primary btn-block" type="submit" name="submit" id="btnsub" value="Submit"/></div>
                    
                                        </form>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; STARVE<span><b>LATER</b></span> 2020</div>
                            <div class="text-muted">Made with love by <b>Umang Solutions</b></div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
