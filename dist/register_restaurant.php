<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Restaurant Registration | STARVELATER</title>
        <link rel='shortcut icon' href='assets/img/sample.png' type='image/x-icon' />
        <style type="text/css">
          .white-text {
            text-decoration: none;
            color: white;
          }
        </style>
      
      <link href="css/styles.css" rel="stylesheet" />
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        


          <!-- The core Firebase JS SDK is always required and must be listed first -->
          <script src="https://www.gstatic.com/firebasejs/4.3.1/firebase.js"></script>
<!-- <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script> -->

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-analytics.js"></script>

<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyAk0RIr5O7VUH3isq1QX-CVXryPO9Eol9M",
    authDomain: "starvelater-3d72b.firebaseapp.com",
    databaseURL: "https://starvelater-3d72b.firebaseio.com",
    projectId: "starvelater-3d72b",
    storageBucket: "starvelater-3d72b.appspot.com",
    messagingSenderId: "587996931031",
    appId: "1:587996931031:web:d9d1ab45da69b753af6192",
    measurementId: "G-2NW92CJSFG"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>

<script type="text/javascript">
            window.onload=function () {

  render();

};
function render() {
    //alert('Loaded');
    window.recaptchaVerifier=new firebase.auth.RecaptchaVerifier('recaptcha-container');
    recaptchaVerifier.render();

}
function phoneAuth() {
    //get the number
    //alert('Called');
    var number=document.getElementById('inputPhone').value;
  //alert(window.recaptchaVerifier);
    //phone number authentication function of firebase
    //it takes two parameter first one is number,,,second one is recaptcha
    firebase.auth().signInWithPhoneNumber(number,window.recaptchaVerifier).then(function (confirmationResult) {
        //s is in lowercase
        //alert('Entered');
        window.confirmationResult=confirmationResult;
        coderesult=confirmationResult;
        //console.log(coderesult);

       Swal.fire({
          title: 'Enter One Time Password',
          text: 'OTP has been sent Successfully to ' + number,
          showLoaderOnConfirm: true,
          input: 'text',
          showCancelButton: true,
          inputValidator: (value) => {
            if (!value) {
              return 'Please enter OTP!'
            }
          
            codeverify(value,number);
            
           
          }
        })

    }).catch(function (error) {
        alert(error.message);
    });
}
function codeverify(value1,number) {
    
    coderesult.confirm(value1).then(function (result) {
        //Swal.fire("Successful","Registered Successfully","success");
        var user=result.user;
        console.log(user);
        var url = "register_restaurant_details.php"; 
        //setting cookie Phone Number
        setCookie("phone_number",number,1);
        //redirecting page
        location.replace(url);
   
   }).catch(function (error) {
        alert(error.message);
    });
}
function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  var expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
        </script> 


    </head>
    <body style="background: linear-gradient(90deg, rgba(218,47,115,1) 0%, rgba(108,39,117,1) 35%, rgba(23,159,214,1) 100%);">
    <!-- <?php
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
            if (empty($_POST["emailid"])) {
                $emailErr = "Email required";
                $boolean = false;
            } else {
              // check if e-mail address is well-formed
               if (!filter_var($_POST["emailid"], FILTER_VALIDATE_EMAIL)) {
                 $emailErr = "Invalid email format";
                 $boolean = false;
               }else{
                  $email = test_input($_POST["emailid"]);
                  $boolean = true;
            }
         }

         //Password Validation
         //$length = strlength($_POST["password"]);
         if(empty($_POST["pwd"])){
           $passwordErr = "Password required";
           $boolean = false;
         }else {

            $ln= strlen($_POST["pwd"]);
            if($ln > 15){
               $passwordErr = "Password should be less than 15 characters";
               $boolean = false;
            } elseif($ln < 5 && $ln >=1) {
               $passwordErr = "Password should be greater than 4 characters";
               $boolean=false;
            } else {
               $password = test_input($_POST["pwd"]);
               $boolean = true;
            }

         }


       //Restaurant and Admin Login
       function SignIn($email, $password){

      
        $sql="SELECT * FROM restaurants where Email_ID='".$email."'";

        $retval = mysqli_query($GLOBALS['con'],$sql);

        $count = mysqli_num_rows($retval);

          if($count==0) {
            echo "<script> swal('Invalid Username','','warning');</script>";
          } else {

            $row = mysqli_fetch_array($retval,MYSQLI_ASSOC);
            
           if($row["Password"]==$_POST["pwd"]) {

            session_start();
            $_SESSION['email'] = $_POST["emailid"];
            header("Location: ./restaurant_home.php");

          } else {
              echo "<script>
                  swal('Invalid Password','','warning');
            </script>";
          }

        }
      

        mysqli_free_result($retval);


    }


      if($boolean){


          $admin_email = "admin@gmail.com";
          $admin_pwd = "admin123";
       
          $email = $_POST["emailid"];
          $password = $_POST["pwd"];
         

        $dbname = "starvelater";
        $con = mysqli_connect("localhost","root","",$dbname);
    
         //Check for DB Connection
         if(!$con){
            die("Connection Failed :" + mysqli_connect_error());
         }else{
            if(isset($_POST["login"])){
              
               if (($admin_email == $email) && ($admin_pwd == $password)) {
                    header("Location: ./admin.php?status=view");
              } else {
                SignIn($email,$password);
                mysqli_close($GLOBALS["con"]);
                $boolean = false;
              }
            }
         }
    
      }

    }


    ?>
 -->

        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Restaurant Registration</h3></div>
                                    <div class="card-body">

                                    	<!-- Form  -->
                                        <form name="f1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                                        

                                             <!-- Password -->
                                            <div class="form-group"><label class="small mb-1" for="inputPhone" >Phone Number</label><input class="form-control py-4" id="inputPhone" type="text" value="+91" name="number" placeholder="Enter Phone Number" /></div>

                                          <div id="recaptcha-container"></div>


                                           <!--   Forgot Password 
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0"><a class="small" href="password.html">Forgot Password?</a><br><br> -->

                                            <!-- Submit Button -->
                                            <p>&nbsp;</p>
                                           <input class="btn btn-primary btn-block" type="Button" name="login" onclick="phoneAuth();" id="btnsub" value="Send One Time Password (OTP)"/>
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
                <footer class="py-4 footer-dark mt-auto" style="background-color: #000;">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="footer-text-color" style="color: #fff;">Copyright &copy; STARVE<span><b>LATER</b></span> 2020</div>
                            <div class="footer-text-color" style="color: #fff;">Made with ❤️ by <b><a href="https://umangsolutions.org">Umang Solutions</a></b></div>
                            <div>
                                <a href="#" class="white-text">Privacy Policy</a>
                                &middot;
                                <a href="#" class="white-text">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!-- <script src="/__/firebase/7.14.6/firebase-app.js"></script>

TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries
<script src="/__/firebase/7.14.6/firebase-analytics.js"></script>

Initialize Firebase
<script src="/__/firebase/init.js"></script> -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
