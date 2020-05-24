<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Restaurant Profile | STARVELATER</title>
        <link rel='shortcut icon' href='assets/img/sample.png' type='image/x-icon' />
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <style type="text/css">
        	li {
        		width: 100%;
        	}
        </style>
         <style type="text/css">
          .white-text {
            text-decoration: none;
            color: white;
          }
        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body class="sb-nav-fixed">

        <?php
                           
                          session_start();
                          //echo $_SESSION['email'];


                          $RestaurantNameErr = $FNameErr = $LNameErr = $PhoneErr =   $SeatingErr  =$AddressErr = "";

                          $RestaurantName = $FName = $LName = $Phone = $Seating = $Address = "";



                            $dbname = "starvelater";
                            $con = mysqli_connect("localhost","root","",$dbname);


                             //Remove spaces, slashes and prevent XSS
                                function test_input($data) {
                                  $data = trim($data);
                                  $data = stripslashes($data);
                                  $data = htmlspecialchars($data);
                                  return $data;
                                }
    
                            //Check for DB Connection
                            if(!$con){
                                    die("Connection Failed :" + mysqli_connect_error());
                            }else { 
                                                         //Load Restaurant  Data  
                            $sql = "SELECT * FROM restaurants where Email_ID = '".$_SESSION['email']."'";
                                                    
                                    $retval = mysqli_query($GLOBALS['con'],$sql);

                                    $followingdata = $retval->fetch_array(MYSQLI_ASSOC);
                                                       
                                   // echo $followingdata['restaurantname'];

                                    mysqli_close($GLOBALS["con"]);
                            }


                             if ($_SERVER["REQUEST_METHOD"] == "POST") {
                     
                                  //Restaurant Name Validation
                                if (empty($_POST["RestaurantName"])) {
                                $RestaurantNameErr = "Restaurant Name is required";
                                $boolean = false;
                              } else {
                                  $RestaurantName = test_input($_POST["RestaurantName"]);
                                  $boolean = true;
                                }


                                 //First Name Validation
                                if (empty($_POST["FirstName"])) {
                                $FNameErr = "First Name is required";
                                $boolean = false;
                              } else {
                                  $FName = test_input($_POST["FirstName"]);
                                  $boolean = true;
                                }


                                //Last Name Validation
                                if (empty($_POST["LastName"])) {
                                $LNameErr = "Last Name is required";
                                $boolean = false;
                              } else {
                                  $LName = test_input($_POST["LastName"]);
                                  $boolean = true;
                                }


                                //Phone number Validation
                                if(empty($_POST["RestaurantPhone"])){
                                $PhoneErr = "Phone number Required";
                                $boolean = false;
                            } elseif($_POST["RestaurantPhone"] < 10 && $_POST["RestaurantPhone"] > 10){
                                $PhoneErr = "Invalid Phone Number";
                                $boolean = false;
                            } else{
                                $boolean = true;
                            }

                             //Seating Validation
                                if(empty($_POST["SeatingCapacity"])){
                                $SeatingErr = "Seating Capacity Required";
                                $boolean = false;
                            } elseif($_POST["SeatingCapacity"] < 0){
                                $SeatingErr = "Invalid Seating Number";
                                $boolean = false;
                            } else{
                                $boolean = true;
                            }
                          


                            //Address Validation
                            if (empty($_POST["RestaurantAddress"])) {
                            $AddressErr = "Address is required";
                            $boolean = false;
                          } else {
                              $Address = test_input($_POST["RestaurantAddress"]);
                              $boolean = true;
                            }




                     




                    function updateData($resID){

                           
                        

                            $sql = "UPDATE restaurants SET Restaurant_Name = '".$_POST["RestaurantName"]."',fname = '".$_POST["FirstName"]."',lname='".$_POST["LastName"]."',Phone = '".$_POST["RestaurantPhone"]."',SeatingCapacity='".$_POST["SeatingCapacity"]."',Address='".$_POST["RestaurantAddress"]."' where Restaurant_ID='".$resID."' ";


                            $result = mysqli_query($GLOBALS['con'],$sql) or die("Error: " . mysqli_error($con));

                            if($result) {
                                echo "<script> swal('Successfull', 'Details Updated Successfully', 'success'); </script>";
                            } else {
                                echo "<script> alert('Something Went Wrong !'); </script>";
                            }
                    }

                   


                           $dbname = "starvelater";
                            $con = mysqli_connect("localhost","root","",$dbname);

                        
                        //Check for DB Connection
                        if(!$con){
                            die("Connection Failed :" + mysqli_connect_error());
                        }else{

                              $resID = $followingdata['Restaurant_ID'];
                        
                            if(isset($_POST["Update"])){
                                if($boolean) {
                                   updateData($resID);
                                }
                            mysqli_close($GLOBALS["con"]);
                            $boolean = false;
                           }


                        }
                    

              }

        ?>



        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" style="background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(0,0,0,1) 100%);">
            <a class="navbar-brand" href="index.html">STARVE<B>LATER</B></a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button
            ><!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        
                        <a class="dropdown-item" href="index.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav" style="background: linear-gradient(90deg, rgba(218,47,115,1) 0%, rgba(108,39,117,1) 35%, rgba(23,159,214,1) 100%);">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu" style="background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(0,0,0,1) 100%);">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="restaurant_home.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard</a
                            >
                            <div class="sb-sidenav-menu-heading">Interface</div>

                            <!-- Profile in Nav Bar--> 
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts"
                                ><div class="sb-nav-link-icon"><i class="fas fa-user-circle"></i></div>
                                Profile
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                            ></a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="restaurant_profile.php">Manage Profile</a></nav>
                            </div>


                            <!-- Profile in Nav Bar--> 
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoutsOrders" aria-expanded="false" aria-controls="collapseLayouts"
                                ><div class="sb-nav-link-icon"><i class="fas fa-utensils"></i></div>
                                Orders
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                            ></a>
                            <div class="collapse" id="collapseLayoutsOrders" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="restaurant_profile.php">View Orders</a></nav>
                            </div>

                            <!-- Status in Nav Bar --> 
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLocationData" aria-expanded="false" aria-controls="collapseLayouts"
                                ><div class="sb-nav-link-icon"><i class="fas fa-toggle-on"></i></div>
                                Current Status
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                            ></a>
                            <div class="collapse" id="collapseLocationData" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="layout-static.html">Offline/Online</a></nav>
                            </div>
                            
                            <!-- Menu in Nav Bar--> 
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsersData" aria-expanded="false" aria-controls="collapseLayouts"
                                ><div class="sb-nav-link-icon"><i class="fab fa-elementor"></i></div>
                                Menu 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                            ></a>
                            <div class="collapse" id="collapseUsersData" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="restaurant_add_items.php">Add Items</a><a class="nav-link" href="restaurant_manage_items.php">Manage Items</a></nav>
                            </div>


                            <!-- Tables in Nav Bar--> 
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNotification" aria-expanded="false" aria-controls="collapseLayouts"
                                ><div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                            ></a>
                            <div class="collapse" id="collapseNotification" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="layout-static.html">Manage Table Numbers</a></nav>
                            </div>
                        
                        </div>
                    </div>
                    <div class="sb-sidenav-footer" style="background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(0,0,0,1) 100%);">
                        <div class="small">Logged in as:</div>
                         <span><?php echo $followingdata['Restaurant_Name']; ?></span>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4" style="color: #fff;">Restaurant Profile</h1>
                        <ol class="breadcrumb mb-4" width="100%" style="background-color: #000;">
                           <li class="breadcrumb-item active" width="100%" style="color: #fff;"><marquee>Welcome <span><?php echo $followingdata['fname']." ".$followingdata['lname']; ?></span> to Restaurant Dashboard. Please update your Profile under Profile Section</marquee></li>
                        </ol>



                      
                        
                        <!-- Profile Form  -->
                        <form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="align-self: center;">

                                           <!-- Restaurant Name Field -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputRestaurantName" style="color: #fff;">Name of Restaurant</label><input class="form-control" id="inputRestaurantName" type="text" aria-describedby="emailHelp" placeholder="Enter Name of Restaurant" name="RestaurantName" id="RestaurantName" value="<?php echo $followingdata['Restaurant_Name']; ?>" />
                                                         <span id="span" style="color: black;"><?php echo $RestaurantNameErr; ?></span>
                                                    </div>
                                                </div>

                                                <!-- First Name Field -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName" style="color: #fff;">First Name</label><input class="form-control" id="inputFirstName" type="text" aria-describedby="emailHelp" placeholder="Enter First Name" name="FirstName" id="FirstName" value="<?php echo $followingdata['fname']; ?>" />
                                                        <span id="span" style="color: black;"><?php echo $FNameErr; ?></span>
                                                    </div>
                                                </div>

                                                 <!-- Last Name Field -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName" style="color: #fff;">Last Name</label><input class="form-control" id="inputLastName" type="text" aria-describedby="emailHelp" placeholder="Enter Last Name" name="LastName" id="LName" value="<?php echo $followingdata['lname']; ?>" />
                                                         <span id="span" style="color: black;"><?php echo $LNameErr; ?></span>
                                                    </div>
                                                </div>

                                                <!-- Email ID -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputRestaurantEmail" style="color: #fff;">Email ID</label><input class="form-control" id="inputRestaurantEmail" type="text" aria-describedby="emailHelp" placeholder="EMail ID" name="RestaurantEmail" id="RestaurantEmail" value="<?php echo $followingdata['Email_ID']; ?>" disabled/>


                                                    </div>
                                                </div>

                                                <!-- Phone Number -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputRestaurantName" style="color: #fff;">Phone Number</label><input class="form-control" id="inputRestaurantName" type="text" aria-describedby="emailHelp" placeholder="Phone Number" name="RestaurantPhone" id="RestaurantPhone" value="<?php echo $followingdata['Phone']; ?>"/>
                                                         <span id="span" style="color: black;"><?php echo $PhoneErr; ?></span>
                                                    </div>
                                                </div>

                                                <!-- Seating Capacity -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputSeatingCapacity" style="color: #fff;">Seating Capacity</label><input class="form-control" id="inputSeatingCapacity" type="text" aria-describedby="emailHelp" placeholder="SeatingCapacity" name="SeatingCapacity" id="SeatingCapacity" value="<?php echo $followingdata['SeatingCapacity']; ?>"/>
                                                         <span id="span" style="color: black;"><?php echo $SeatingErr; ?></span>
                                                    </div>
                                                </div>


                                                <!-- Address -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputRestaurantAddress" style="color: #fff;">Address</label><input class="form-control" id="inputRestaurantAddress" type="text" aria-describedby="emailHelp" placeholder="Address" name="RestaurantAddress" id="RestaurantAddress" value="<?php echo $followingdata['Address']; ?>"/>
                                                         <span id="span" style="color: black;"><?php echo $AddressErr; ?></span>
                                                    </div>
                                                </div>

                                                 <!-- GSTIN  -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputGSTIN" style="color: #fff;">GSTIN Number</label><input class="form-control" id="inputGSTIN" type="text" aria-describedby="emailHelp" placeholder="GSTIN" name="GSTIN" id="GSTIN" value="<?php echo $followingdata['GSTIN']; ?>" disabled/>
                                                         
                                                    </div>
                                                </div>

                                                 <!-- Food License -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFoodLicense" style="color: #fff;">Food License</label><input class="form-control" id="inputFoodLicense" type="text" aria-describedby="emailHelp" placeholder="FoodLicense" name="FoodLicense" id="FoodLicense" value="<?php echo $followingdata['FoodLicense']; ?>" disabled/>

                                                    </div>
                                                </div>

                                                 <!-- Labour License -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLabourLicense" style="color: #fff;">Labour License</label><input class="form-control" id="inputLabourLicense" type="text" aria-describedby="emailHelp" placeholder="LabourLicense" name="LabourLicense" id="LabourLicense" value="<?php echo $followingdata['LabourLicense']; ?>" disabled/>

                                                    </div>
                                                </div>




                                             
                                             <!-- Update Button -->
                                            <div class="form-group mb-0" align="center"  ><input style="width: 100px;" class="btn btn-primary" type="submit" name="Update" id="Update" value="Update"/></div>
                                            <p>&nbsp;</p>
                    </form>

                        </div>
                    </main>
                <footer class="py-4 footer-dark mt-auto" style="background-color: #000;">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="footer-text-color" style="color: #fff;">Copyright &copy; STARVE<span><b>LATER</b></span> 2020</div>
                            <div class="footer-text-color" style="color: #fff;">Made with ❤️ by <b><a href="https://umangsolutions.org">Umang Solutions</a></b></div>                                <div>
                                <a href="#" class="white-text">Privacy Policy</a>
                                &middot;
                                <a href="#" class="white-text">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
