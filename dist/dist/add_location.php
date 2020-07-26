<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel='shortcut icon' href='assets/img/sample.png' type='image/x-icon' />
        <title>Add Location | StarveLater</title>
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
              $stateErr = $cityErr =  $onlyStateErr = "";

              $state = $city = $onlyState = "";
              $boolean = false;
              $boolean1 = false;


                //Remove spaces, slashes and prevent XSS
                function test_input($data) {
                  $data = trim($data);
                  $data = stripslashes($data);
                  $data = htmlspecialchars($data);
                  return $data;
                }

                
              if ($_SERVER["REQUEST_METHOD"] == "POST") {


                     if(isset($_POST["AddState"])) {
                         //Only State Validation
                        if (empty($_POST["onlystate"])) {
                          $onlyStateErr = "State Name is required";
                          $boolean1 = false;
                        } else {
                          $onlyState = test_input($_POST["onlystate"]);
                          $boolean1 = true;
                        }
                     }

                    if(isset($_POST["AddCity"])) {
                     //State Validation
                    if ($_POST["state"] == 'Select State') {
                    $stateErr = "State Name is required";
                    $boolean = false;
                  } else {
                      $state = test_input($_POST["state"]);
                      $boolean = true;
                    }


                     //City Validation
                    if (empty($_POST["CityName"])) {
                    $cityErr = "City Name is required";
                    $boolean = false;
                  } else {
                      $city = test_input($_POST["CityName"]);
                      $boolean = true;
                    }
                }


                      



function addState(){

        $stateID = uniqid();

        $sql = "INSERT into state VALUES ('$stateID','".$_POST["onlystate"]."')";


        $result = mysqli_query($GLOBALS['con'],$sql) or die("Error: " . mysqli_error($con));

        if($result) {
            echo "<script> swal('Successfully added','State added Successfully','success'); </script>";
        } else {
            echo "<script> alert('Something Went Wrong !'); </script>";
        }
}

function addCity(){

        //Retrieving state ID from State Name
        $stateName = $_POST["state"];


        if($stateName != 'Select State') {

        $stateIDquery = "SELECT State_ID from state where Name = '$stateName'";

        $result1 = mysqli_query($GLOBALS['con'],$stateIDquery) or die("Error: " . mysqli_error($con));
        
        $followingdata = $result1->fetch_array(MYSQLI_ASSOC);

        $cityID = uniqid();

        $sql = "INSERT into city VALUES ('$cityID','".$_POST["CityName"]."','".$followingdata['State_ID']."');";

    

        $result = mysqli_query($GLOBALS['con'],$sql) or die("Error: " . mysqli_error($con));

        if($result) {
            echo "<script> swal('Successfully added','City added Successfully','success'); </script>";
        } else {
            echo "<script> alert('Something Went Wrong !'); </script>";
        }
    }
}
                  

                
                    $dbname = "starvelater";
                    $con = mysqli_connect("localhost","saikirankkd1","Gmrit@224",$dbname);
    
                    //Check for DB Connection
                    if(!$con){
                        die("Connection Failed :" + mysqli_connect_error());
                    }else{
                     
                         if(isset($_POST["AddState"])){
                          if($boolean1) {
                           addState(); 
                          } 
                        mysqli_close($GLOBALS["con"]);
                        $boolean1 = false;
                       }


                        if(isset($_POST["AddCity"])){
                         if($boolean) {
                             addCity(); 
                         }
                        mysqli_close($GLOBALS["con"]);
                        $boolean = false;
                       }

                    }
            

              }
        ?>

            <!-- Top Navigation bar -->
            <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" style="background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(0,0,0,1) 100%);">
            <a class="navbar-brand" href="index.php">STARVE<B>LATER</B></a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button
            ><!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Logout Dropdown-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="index.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>

         <!-- Side Navigation Bar -->
        <div id="layoutSidenav" style="background: linear-gradient(90deg, rgba(218,47,115,1) 0%, rgba(108,39,117,1) 35%, rgba(23,159,214,1) 100%);">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu" style="background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(0,0,0,1) 100%);">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="admin.php?status=view"
                                ><div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard</a
                            >
                            <div class="sb-sidenav-menu-heading">Interface</div>

                            <!-- Restaurants in Nav Bar--> 
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts"
                                ><div class="sb-nav-link-icon"><i class="fas fa-utensils"></i></div>
                                Restaurants
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                            ></a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="register_restaurant.php">Register Restaurant</a><a class="nav-link" href="manage_restaurants.php?restaurantname=all&status=view">Manage Restaurants</a></nav>
                            </div>

                            <!-- Locations in Nav Bar --> 
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLocationData" aria-expanded="false" aria-controls="collapseLayouts"
                                ><div class="sb-nav-link-icon"><i class="fas fa-map-marker-alt"></i></div>
                                Locations
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                            ></a>
                            <div class="collapse" id="collapseLocationData" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="add_location.php">Add New Location</a></nav>
                            </div>
                            
                            <!-- Customers in Nav Bar--> 
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsersData" aria-expanded="false" aria-controls="collapseLayouts"
                                ><div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Customers
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                            ></a>
                            <div class="collapse" id="collapseUsersData" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="register_customer.php">Register Customer</a><a class="nav-link" href="manage_customer.php">Manage Customers</a></nav>
                            </div>


                            <!-- Notifications in Nav Bar--> 
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNotification" aria-expanded="false" aria-controls="collapseLayouts"
                                ><div class="sb-nav-link-icon"><i class="fas fa-bell"></i></div>
                                Notification
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                            ></a>
                            <div class="collapse" id="collapseNotification" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="#">Send Notification</a></nav>
                            </div>


                           <!--  Statistics -->
                            <div class="sb-sidenav-menu-heading">STATISTICS</div>
                            <a class="nav-link" href="charts.html"
                                ><div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Orders Data</a
                            ><a class="nav-link" href="tables.html"
                                ><div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Restaurants Data</a>
                                <a class="nav-link" href="tables.html"
                                ><div class="sb-nav-link-icon"><i class="fas fa-chart-pie"></i></div>
                                Users Data</a>
                        
                        </div>
                    </div>

                    <!-- Login Status -->
                    <div class="sb-sidenav-footer" style="background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(0,0,0,1) 100%);">
                        <div class="small">Logged in as:</div>
                        Administrator
                    </div>

                </nav>
            </div>

            <!-- Title -->
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4" style="color: white;">Add Location</h1>

                       <!--  Marquee -->
                        <ol class="breadcrumb mb-4" width="100%" style="background-color: black;">
                            <li class="breadcrumb-item active" width="100%" style="color: white;"><marquee>Dear Administrator, You can add new Locations here.</marquee></li>
                        </ol>

                        

                        <h3 class="mt-4" style="margin-bottom: 15px;color: #fff;">Add State</h3>
                        
                        <!-- State Form  -->
                        <form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                                           <!-- State Name Input Field -->
                                            <div class="form-group"><label class="small mb-1" for="inputOnlyState" style="color: #fff;">Name of State</label><input class="form-control " id="inputOnlyState" name="onlystate" type="text" placeholder="Enter Name of the State" />
                                                <span id="span" style="color: black;"><?php echo $onlyStateErr; ?></span> 
                                            </div>

                                             
                                             <!-- Add State Button -->
                                            <div class="form-group mb-0" align="center"  ><input style="width: 100px;" class="btn btn-primary" type="submit" name="AddState" id="AddState" value="Add State"/></div>
                    </form>

                    
                    <h3 class="mt-4" style="margin-bottom: 15px;color: white;" >Add City</h3>

                    <!-- Add City Form -->
                    <form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                                           <!-- State Dropdown -->
                                           <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputState" style="color: #fff;">Choose State</label><br>
                                                        <select class="form-control" id="inputState" name="state" >
                                                            <option>Select State</option>
                                                         <?php
                                                                    $dbname = "starvelater";
                                                                    $con = mysqli_connect("localhost","saikirankkd1","Gmrit@224",$dbname);
    
                                                                //Check for DB Connection
                                                            if(!$con){
                                                                die("Connection Failed :" + mysqli_connect_error());
                                                            }else { 
                                                         //Load Restaurant  Data  
                                                                $sql = "SELECT Name FROM state";
                                                    
                                                                $retval = mysqli_query($GLOBALS['con'],$sql);
                                                       
                                                                   if(! $retval ) {
                                                                      die('Could not get data: ' . mysqli_error());
                                                                   }
                                                                   
                                                                   while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
                                                                      echo "<option>".$row["Name"]."</option>";  
                                                                   }

                                                                    mysqli_close($GLOBALS["con"]);
                                                                 }

                                                        ?>

                                                        </select>
                                                    </div>
                                                    <span id="span" style="color: black;"><?php echo $stateErr; ?></span>
                                                </div>

                                                 <!-- City Input Field -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputCityName" style="color: #fff;">Name of City</label><input class="form-control" id="inputCityName" type="text" aria-describedby="emailHelp" placeholder="Enter Name of City" name="CityName" id="CityName"/>
                                           
                                                    </div>
                                                    <span id="span" style="color: black;"><?php echo $cityErr; ?></span>
                                                </div>
                                            </div>


                                            <!-- Add City Button -->
                                            <div class="form-group mt-4 mb-0" align="center"  ><input style="width: 100px;" class="btn btn-primary" type="submit" name="AddCity" id="AddCity" value="Add City"/></div>

                    </form>


                    <?php 
                        $dbname = "starvelater";
                        $con = mysqli_connect("localhost","saikirankkd1","Gmrit@224",$dbname);

                        $location_arr = array();
                        //$location_arr['status'] = "Data retrieved Successfully !";
                        $state_arr = array();
                        $city_arr = array();
                        //Check for DB Connection
                        if(!$con){
                                die("Connection Failed :" + mysqli_connect_error());
                        }else { 

                            // State Data
                            $sql = "select * from state";

                            $state_result = mysqli_query($con,$sql);

                            if($state_result) {

                                while($row = mysqli_fetch_array($state_result,MYSQLI_ASSOC)) {
                                   
                                    $each_state = array();
                                    $each_state['stateID'] = $row['State_ID'];
                                    $each_state['stateName'] = $row['Name'];

                                    array_push($state_arr, $each_state);
                                }

                                array_push($location_arr,$state_arr);

                            }

                            // State Data
                            $sql1 = "select * from city";

                            $city_result = mysqli_query($con,$sql1);

                            if($city_result) {

                                while($row = mysqli_fetch_array($city_result,MYSQLI_ASSOC)) {
                                   
                                    $each_city = array();
                                    $each_city['cityID'] = $row['City_ID'];
                                    $each_city['cityName'] = $row['Name'];
                                    $each_city['stateID'] = $row['State_ID'];

                                    array_push($city_arr, $each_city);
                                }

                                
                                array_push($location_arr,$city_arr);

                            }

                            echo "<input type='hidden' value=".json_encode($location_arr)." name='locationarray'>";

                                 
                        }                              





                    ?>




                        <!-- Items Table -->

<!-- Query for Table
                         CREATE TABLE items(
                            item_id VARCHAR( 50 ) PRIMARY KEY ,
                            Restaurant_ID VARCHAR( 50 ) NOT NULL ,
                            FOREIGN KEY ( Restaurant_ID ) REFERENCES restaurants( Restaurant_ID ) ,
                            Name VARCHAR( 50 ) NOT NULL ,
                            TYPE VARCHAR( 50 ) NOT NULL ,
                            category VARCHAR( 50 ) NOT NULL ,
                            price VARCHAR( 50 ) NOT NULL ,
                            availability VARCHAR( 50 ) NOT NULL
                            ); -->


                           <!-- Orders Table -->
                            <!-- create table orders (order_Id varchar(50) primary key , item_ids varchar(50), foreign key (item_ids) references items(item_id), Restaurant_ID varchar(50), foreign key (Restaurant_ID) references restaurants(Restaurant_ID), Customer_ID varchar(50), foreign key (Customer_ID) references customers(Customer_ID), Order_Type varchar(50) not null, Booked_Time varchar(50) not null, Order_Status varchar(50) not null, Net_Bill varchar(50) not null); -->

                        


                 <P>&nbsp;</P>




                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; STARVE<b>LATER</b></div>
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
        <script src="/__/firebase/7.14.6/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="/__/firebase/7.14.6/firebase-analytics.js"></script>

<!-- Initialize Firebase -->
<script src="/__/firebase/init.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
        <script src="assets/demo/datatables1-demo.js"></script>
    </body>
</html>
