<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Restaurant Login</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        <script type="text/javascript">
            function show() {
                 var name = Window.document.f1.inputEmailAddress.value;
                 alert(name);
            }
        </script>
    </head>
    <body class="bg-primary">
    <?php
           $emailErr = $passwordErr = "";
           $email = $password = "";

           $boolean = false;

           //Remove spaces, slashes and prevent XSS
          function test_input($data) {
              $data = trim($data);
             $data = stripslashes($data);
             $data = htmlspecialchars($data);
             return $data;
          } 

          if( $_SERVER["REQUEST_METHOD"] == 'POST') {

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
            } else {
               $password = test_input($_POST["password"]);
               $boolean = true;
            }

         }


       //Restaurant and Admin Login
       function SignIn(){

        $sql = "SELECT passwd FROM restaurant where email = '".$_POST["email"]."'";
        $result = mysqli_query($GLOBALS['con'],$sql) or die("Error: " . mysqli_error($con));


        $admin_email = "admin@gmail.com";
        $admin_pwd = "admin123";


         if ((strcmp('$admin_email', '$email')) && (strcmp('$admin_pwd', '$password'))) {
               header("Location: ./admin.php");
          } elseif(!$row = mysqli_fetch_array($result)){
            echo "<script>
                  alert('User does not exist !');
            </script>";
        }else{
           $password = $_POST["password"];
           if(strcmp('$password','$result')) {
               header("Location: ./password.html");
           }else{
           	   echo "<script>
                     alert('Invalid Email or Password');
           	   </script>";
           }

        }
    }


      if($boolean){
        $dbname = "starvelater";
        $con = mysqli_connect("localhost","root","",$dbname);
    
         //Check for DB Connection
         if(!$con){
            die("Connection Failed :" + mysqli_connect_error());
         }else{
            if(isset($_POST["login"])){
             SignIn();
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
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">

                                    	<!-- Form  -->
                                        <form name="f1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                                        	<!-- Email ID -->
                                            <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Email</label><input class="form-control py-4" name="email" type="email" placeholder="Enter email address" />
                                            	<span id="span"><?php echo $emailErr; ?></span>
                                            </div>

                                             <!-- Password -->
                                            <div class="form-group"><label class="small mb-1" for="inputPassword" >Password</label><input class="form-control py-4" id="inputPassword" type="password"  name="password" placeholder="Enter password" /><span id="span"><?php echo $passwordErr; ?></span></div>

                                            
                                            <div class="form-group">

                                            	<!-- Remember Password  -->
                                                <div class="custom-control custom-checkbox"><input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" /><label class="custom-control-label" for="rememberPasswordCheck">Remember password</label></div>

                                                 <!-- Forgot Password  -->
                                                <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0"><a class="small" href="password.html">Forgot Password?</a>
                                            </div>


                                           <!--   Forgot Password 
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0"><a class="small" href="password.html">Forgot Password?</a><br><br> -->

                                            <!-- Submit Button -->
                                            <p>&nbsp;</p>
                                           <input class="btn btn-primary btn-block" type="submit" name="login" id="btnsub" value="Login"/>
                                            </div>
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
