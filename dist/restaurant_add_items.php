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

                            $ItemNameErr = $TypeErr = $CategoryErr = $PriceErr = $AvailabilityErr = $PhotoErr = "";

                            $ItemName = $Type = $Category = $Price = $Availability = "";



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
                     
                                  //Item Name Validation
                                if (empty($_POST["ItemName"])) {
                                $ItemNameErr = "Item Name is required";
                                $boolean = false;
                              } else {
                                  $ItemName = test_input($_POST["ItemName"]);
                                  $boolean = true;
                                }


                                 //Category Validation
                                if (empty($_POST["Category"])) {
                                $CategoryErr = "Category is required";
                                $boolean = false;
                              } else {
                                  $Category = test_input($_POST["Category"]);
                                  $boolean = true;
                                }


                                //Type Validation
                                if (empty($_POST["Type"])) {
                                $TypeErr = "Type is required";
                                $boolean = false;
                              } else {
                                  $Type = test_input($_POST["Type"]);
                                  $boolean = true;
                                }


                              
                                //Price Validation
                                if (empty($_POST["Price"])) {
                                $PriceErr = "Price is required";
                                $boolean = false;
                              } else if($_POST["Price"] < 0) {
                                 $PriceErr = "Invalid Price";
                                 $boolean = false;
                              } else {
                                  $Price = test_input($_POST["Price"]);
                                  $boolean = true;
                                }


                            //Availability Validation
                            if (empty($_POST["Availability"])) {
                            $AvailabilityErr = "Availability is required";
                            $boolean = false;
                          } else {
                              $Availability = test_input($_POST["Availability"]);
                              $boolean = true;
                            }




                    
                    function insertData($resID, $resName){
                         
                            $target_dir = "C:\wamp\www\StarveLater\dist\itemphotos/".$resName;

                            if(!file_exists($target_dir)) {
                              mkdir($target_dir);
                            }
                            //$target_dir = "C:\wamp\www\StarveLater\dist\itemphotos/".$resName;
                            
                            $target_file = $target_dir."/".basename($_FILES['fileToUpload']['name']);
                            $uploadOk = 1;
                            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


                            if ($uploadOk == 0) {
                              echo "Sorry, your file was not uploaded.";
                              $boolean = false;
                            // if everything is ok, try to upload file
                            } else {
                              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                                $boolean = true;
                              } else {
                                //echo "Sorry, there was an error uploading your file.";
                                $boolean = true;
                              }
                            }

                           $logoFileName = basename( $_FILES["fileToUpload"]["name"]);


                           if(!empty($logoFileName)) {
                           
                           $itemID = uniqid();

                            $sql = "INSERT into items values('".$itemID."','".$resID."','".$_POST["ItemName"]."','".$_POST["Type"]."',
                            '".$_POST["Category"]."','".$_POST["Price"]."','".$_POST["Availability"]."','0 %','".$_POST["Price"]."','".$logoFileName."')";


                            $result = mysqli_query($GLOBALS['con'],$sql) or die("Error: " . mysqli_error($con));

                            if($result) {
                                echo "<script> swal('Successfull', 'Item Added Successfully', 'success'); </script>";
                            } else {
                                echo "<script> alert('Something Went Wrong !'); </script>";
                            }
                        }
                   }

                   


                           $dbname = "starvelater";
                            $con = mysqli_connect("localhost","root","",$dbname);

                        
                        //Check for DB Connection
                        if(!$con){
                            die("Connection Failed :" + mysqli_connect_error());
                        }else{

                              $resID = $followingdata['Restaurant_ID'];
                              $resName = $followingdata['Restaurant_Name'];
                        
                            if(isset($_POST["Submit"])){
                                if($boolean) {
                                   insertData($resID,$resName);
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

                            <!-- Categories in Nav Bar --> 
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLocationData" aria-expanded="false" aria-controls="collapseLayouts"
                                ><div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                                Categories
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                            ></a>
                            <div class="collapse" id="collapseLocationData" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="restaurant_manage_category.php">Manage Categories</a></nav>
                            </div>

                            
                            <!-- Menu in Nav Bar--> 
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsersData" aria-expanded="false" aria-controls="collapseLayouts"
                                ><div class="sb-nav-link-icon"><i class="fab fa-elementor"></i></div>
                                Menu 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                            ></a>
                            <div class="collapse" id="collapseUsersData" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="">Add Items</a><a class="nav-link" href="restaurant_manage_items.php">Manage Items</a></nav>
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
                        <h1 class="mt-4" style="color: #fff;">Add Items</h1>
                        <ol class="breadcrumb mb-4" width="100%" style="background-color: #000;">
                           <li class="breadcrumb-item active" width="100%" style="color: #fff;"><marquee>Welcome <span><?php echo $followingdata['fname']." ".$followingdata['lname']; ?></span> to Restaurant Dashboard. You can add Restaurant Items here.</marquee></li>
                        </ol>



                      
                        
                        <!-- Profile Form  -->
                        <form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                                           <!-- Name of Item Field -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputItemName" style="color: #fff;">Name of Item</label><input class="form-control" id="inputItemName" type="text" aria-describedby="emailHelp" placeholder="Enter Name of Item" name="ItemName" id="ItemName"  />
                                                         <span id="span" style="color: black;"><?php echo $ItemNameErr; ?></span>
                                                    </div>
                                                </div>

                                                <!-- Type Field -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputType" style="color: #fff;">Type</label>
                                                        <select name="Type" class="form-control" id="inputType">
                                                            <option value="0">Select Type</option>
                                                            <option value="Vegetarian">Vegetarian</option>
                                                            <option value="Non-Vegetarian">Non-Vegetarian</option>
                                                        </select>
                                                        <span id="span" style="color: black;"><?php echo $TypeErr; ?></span>
                                                    </div>
                                                </div>

                                                 <!-- Category Field -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputCategory" style="color: #fff;">Category</label>
                                                        <select name="Category" class="form-control" id="inputCategory">
                                                          <option>Select Category</option>
                                                            <?php
                                                              
                                                              $con = mysqli_connect('localhost','root','','starvelater');

                                                          $sql = "SELECT * from category where Restaurant_ID='".$followingdata['Restaurant_ID']."'";

                                                          $result_val = mysqli_query($con,$sql);

                                                          while($row = mysqli_fetch_array($result_val,MYSQLI_ASSOC)) {
                                                              
                                                              echo "<option>".$row['Name']."</option>";

                                                          }
                                                            ?>
                                                        </select>
                                                         <span id="span" style="color: black;"><?php echo $CategoryErr; ?></span>
                                                    </div>
                                                </div>

                                                <!-- Price -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPrice" style="color: #fff;">Price</label><input class="form-control" id="inputPrice" type="text" aria-describedby="emailHelp" placeholder="Enter Item Price" name="Price" id="Price"/>
                                                        <span id="span" style="color: black;"><?php echo $PriceErr; ?></span>
                                                    </div>
                                                     
                                                </div>

                                                <!-- Availability -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputAvailability" style="color: #fff;">Availability</label>
                                                        <select name="Availability" class="form-control" id="inputAvailability">
                                                            <option value="0">Select Availability</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                         <span id="span" style="color: black;"><?php echo $AvailabilityErr; ?></span>
                                                    </div>
                                                </div>

                                                 <!-- Upload File -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="fileToUpload" style="color: #fff;">Upload Item Photo</label>
                                                         <input type="File" class="form-control" accept="image/*" name="fileToUpload" id="fileToUpload">
                                                         <span id="span" style="color: black;"><?php echo $PhotoErr; ?></span>
                                                    </div>
                                                </div>

                                                
                                            

                                               

                                             
                                             <!-- Submit Button -->
                                            <div class="form-group mb-0" align="center"  ><input style="width: 100px;" class="btn btn-primary" type="submit" name="Submit" id="Submit"/></div>
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
    </body>
</html>
