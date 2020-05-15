<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Customer Registration | STARVELATER</title>
        <link rel='shortcut icon' href='assets/img/sample.png' type='image/x-icon' />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"
          integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
          crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">

<!-- PHP Validation -->
<?php

// define variables and set to empty values


//for files



$customerNameErr = $emailErr = $passwordErr = $conpasswordErr = $phoneErr = $addressErr = "" ;
$customerName = $email = $password = $conpassword = $phone = $address = "";
$boolean=false;

//Remove spaces, slashes and prevent XSS
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  
  //Customer Name Validation
  if (empty($_POST["customerName"])) {
    $customerNameErr = "Customer Name required";
    $boolean = false;
  } else {
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$customerName)) {
      $customerNameErr = "Only letters and white space allowed";
    }else{
        $customerName = test_input($_POST["customerName"]);
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
      $boolean = false;
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
        $passwordErr = "Password should be greater than 4 characters";
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



    //Phone number Validation
        if(empty($_POST["phone"])){
        $phoneErr = "Phone number Required";
        $boolean = false;
    } elseif($_POST["phone"] < 10 && $_POST["phone"] > 10){
        $phoneErr = "Invalid Phone Number";
        $boolean = false;
    } else{
        $boolean = true;
    }
  


    //Address Validation
    if (empty($_POST["address"])) {
    $addressErr = "Address is required";
    $boolean = false;
  } else {
      $address = test_input($_POST["address"]);
      $boolean = true;
    }


    //File Validation


/*
    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }*/

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

    //Master Database 

       $customerID = uniqid();


    $sql = "INSERT INTO customer Values ('$customerID','".$_POST["customerName"]."','".$_POST["email"]."','".$_POST["password"]."','".$_POST["phone"]."','".$_POST["address"]."','0')";


        $query = mysqli_query($GLOBALS['con'], $sql);


        if($query) {
        echo "<script>
                    alert('Customer Registered Successfully');
        </script>";
        header('Location: ./admin.php');
        } 
        else {
            echo "<script>alert('Error in Registration xTB0001'); </script>";
        }
}

//Check whether restaurant name and Email Id exists in DB
function SignUp(){

        $sql = "SELECT * FROM customer where Name = '".$_POST["customerName"]."' AND Email_ID = '".$_POST["email"]."'";
        $result = mysqli_query($GLOBALS['con'],$sql) or die("Error: " . mysqli_error($con));

        if(!$row = mysqli_fetch_array($result)){
            NewUser();
        }else{
            echo "<script>
                  alert('Customer is already registered!');
            </script>";
        }
    }

if($boolean){
    $dbname = "starvelater";
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Customer Registration Form</h3></div>
                                    <div class="card-body">
                                        <form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                                            <!-- Name of Customer -->
                                            <div class="form-group"><label class="small mb-1" for="inputCustomerName">Name of Customer</label><input class="form-control py-4" id="inputCustomerName" type="text" aria-describedby="emailHelp" placeholder="Enter Name of Customer" name="customerName" />
                                                <span id="span"><?php echo $customerNameErr; ?></span>
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


                                              <!-- Phone Number  -->
                                            <div class="form-group"><label class="small mb-1" for="inputPhone">Phone Number</label><input class="form-control py-4" id="inputPhone" type="text"  placeholder="Enter Phone Number" name="phone" />
                                            <span id="span"><?php echo $phoneErr; ?></span>
                                            </div>


                                            <!-- Address  -->
                                            <div class="form-group"><label class="small mb-1" for="inputRestaurantAddress">Address</label><input class="form-control py-4" id="inputRestaurantAddress" type="text" aria-describedby="emailHelp" placeholder="Enter your address" name="address" />
                                            <span id="span"><?php echo $addressErr; ?></span>
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
