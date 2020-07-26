<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Manage Items | STARVELATER</title>
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
          <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

    </head>

    <body class="sb-nav-fixed">

        <?php
                           
                          session_start();
                          //echo $_SESSION['email'];

                            $ItemNameErr = $TypeErr = $CategoryErr = $PriceErr = $AvailabilityErr = $PhotoErr = "";

                            $ItemName = $Type = $Category = $Price = $Availability = "";



                            $dbname = "starvelater";
                            $con = mysqli_connect("localhost","saikirankkd1","Gmrit@224",$dbname);


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




                    
                    function updateData($resID, $resName){
                         
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
                            '".$_POST["Category"]."','".$_POST["Price"]."','".$_POST["Availability"]."','".$logoFileName."')";


                            $result = mysqli_query($GLOBALS['con'],$sql) or die("Error: " . mysqli_error($con));

                            if($result) {
                                echo "<script> swal('Successfull', 'Item Added Successfully', 'success'); </script>";
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

                              $resID = $followingdata['Restaurant_ID'];
                              $resName = $followingdata['Restaurant_Name'];
                        
                            if(isset($_POST["Submit"])){
                                if($boolean) {
                                   updateData($resID,$resName);
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
                                <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="restaurant_add_items.php">Add Items</a><a class="nav-link" href="">Manage Items</a></nav>
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
                        <h1 class="mt-4" style="color: #fff;">Manage Items</h1>
                        <ol class="breadcrumb mb-4" width="100%" style="background-color: #000;">
                           <li class="breadcrumb-item active" width="100%" style="color: #fff;"><marquee>Welcome <span><?php echo $followingdata['fname']." ".$followingdata['lname']; ?></span> to Restaurant Dashboard. You can Manage Restaurant Items here.</marquee></li>
                        </ol>
                       
                         <!-- Items Table -->
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-concierge-bell mr-1"></i>Items</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Item Photo</th>
                                                <th>Item ID</th>
                                                <th>Item Name</th>
                                                <th>Item Type</th>
                                                <th>Item Category</th>
                                                <th>Item Price</th>
                                                <th>Item Availability</th>
                                                <th>Discount %</th>
                                                <th>Final Price</th>
                                                <th>Operations</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Item Photo</th>
                                                <th>Item ID</th>
                                                <th>Item Name</th>
                                                <th>Item Type</th>
                                                <th>Item Category</th>
                                                <th>Item Price</th>
                                                <th>Item Availability</th>
                                                <th>Discount %</th>
                                                <th>Final Price</th>
                                                <th>Operations</th>
                                                </tr>
                                        </tfoot>
                                        <tbody>
                                        
                                             <?php

                                                     
                                                     //define('MYSQL_ASSOC',MYSQLI_ASSOC);
                                                     $dbname = "starvelater";
                                                     $con = mysqli_connect("localhost","saikirankkd1","Gmrit@224",$dbname);
    
                                                     //Check for DB Connection
                                                     if(!$con){
                                                        die("Connection Failed :" + mysqli_connect_error());
                                                     }else { 

                                                       $sql1 = "SELECT * FROM restaurants where Email_ID = '".$_SESSION['email']."'";
                                                                        
                                                        $retvalue = mysqli_query($GLOBALS['con'],$sql1);

                                                        $followingdata = $retvalue->fetch_array(MYSQLI_ASSOC);
                                                       
                                                        $restaurantID = $followingdata["Restaurant_ID"];
                                                        $resName = $followingdata["Restaurant_Name"];

                                                         //Load Items Data using  Restaurant ID 
                                                       $sql = "SELECT * FROM items where Restaurant_ID='".$restaurantID."' ";
                                                    
                                                       $retval = mysqli_query($GLOBALS['con'],$sql);
                                                       
                                                       if(! $retval ) {
                                                          die('Could not get data: ' . mysqli_error());
                                                       }
                                                       
                                                         while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {

                                                          
                                                           if($row['availability'] == 'No') {
                                                              //Non- available Products
                                                             echo "<tr data-target='rowbg' bgcolor='#dee2df' id='".$row['item_id']."'>";
                                                          echo "<td><img src='itemphotos/".$resName."/".$row['photoname']."' width='110px' height='75px'></img></td>";
                                                          echo "<td data-target='item_id'>".$row['item_id']."</td>";
                                                          echo "<td data-target='Name'>".$row['Name']."</td>";
                                                          if($row['Type'] == 'Vegetarian') {
                                                             //Vegetarian Products
                                                             echo "<td style='color:#28a745;font-weight:bold;'>".$row['Type']."</td> ";
                                                           } else {
                                                               //Non Vegetarian Products
                                                              echo "<td style='color:red;font-weight:bold;'>".$row['Type']."</td> ";
                                                           }
                                                          echo "<td data-target='category'>".$row['category']."</td> ";
                                                          echo "<td data-target='price'>".$row['price']."</td>"; 
                                                          echo "<td data-target='availability'>".$row['availability']."</td>";
                                                          echo "<td data-target='discount'>".$row['Discount']."</td>";
                                                          echo "<td data-target='final_price'>".$row['Final_Price']."</td>";
                                                          echo "<td>"; ?>

                                                         <!--  Edit Button -->
                                                         <a href="#" class="btn btn-success a-btn-slide-text green" name="Edit" data-role="update" data-id="<?php echo $row['item_id']; ?>">
                                                        <span  aria-hidden="true"><i class="fas fa-edit"></i></span>
                                                         </a>
                                                        &nbsp;&nbsp;

                                                        <!-- Delete Button -->
                                                        <a href="#" class="btn btn-danger a-btn-slide-text red" name="Delete" data-id="<?php echo $row['item_id']; ?>">
                                                         <span  aria-hidden="true"><i class="fas fa-trash-alt"></i></span>
                                                        </a>

                                                        <script>
                                                          $("a.red").click(function(){
                                                            //("Hello " + this.id);
                                                            swal({
                                                              title: 'Are you sure?',
                                                              text: 'You will not be able to recover the Restaurant Details again!',
                                                              icon: 'warning',
                                                              buttons: true,
                                                              dangerMode: true,
                                                            })
                                                            .then((willDelete) => {
                                                              if (willDelete) { 
                                                                //swal(this.id);
                                                                var el = this;
                                                                var deleteid = $(this).data('id');
                                                                //swal(deleteid);
                                                                $.ajax({
                                                                 url: 'remove_item.php',
                                                                 type: 'POST',
                                                                 data: { id: deleteid },
                                                                 success: function(response){
                                                                   // Remove row from HTML Table
                                                                   $(el).closest('tr').css('background','tomato');
                                                                   $(el).closest('tr').fadeOut(800,function(){
                                                                      $(this).remove();
                                                                   });
                                                                      
                                                                 }
                                                                });

                                                              } else {
                                                                //swal('Restaurant is safe!');

                                                              }
                                                            });

                                                            
                                                          });

                                                          </script>
                                                  <?php      
                                                         echo "</td>";
                                                         echo "</tr>";

                                                           } else {
                                                                     //Available Products
                                                           if($row['Type'] == 'Vegetarian') {
                                                            //Vegetaraian Products
                                                           echo "<tr data-target='rowbg' id='".$row['item_id']."'>";
                                                          echo "<td><img src='itemphotos/".$resName."/".$row['photoname']."' width='110px' height='75px'></img></td>";
                                                          echo "<td data-target='item_id' >".$row['item_id']."</td>";
                                                          echo "<td data-target='Name'>".$row['Name']."</td>";
                                                          echo "<b><td style='color:#28a745;font-weight:bold;' >".$row['Type']."</td></b> ";
                                                          echo "<td data-target='category'>".$row['category']."</td> ";
                                                          echo "<td data-target='price'>".$row['price']."</td> ";
                                                          echo "<td data-target='availability'>".$row['availability']."</td>";
                                                          echo "<td data-target='discount'>".$row['Discount']."</td>";
                                                          echo "<td data-target='final_price'>".$row['Final_Price']."</td>";
                                                          echo "<td>"; ?>
                                                        
                                                         <!--  Edit Button -->
                                                         <a href="#" class="btn btn-success a-btn-slide-text green" data-role="update" data-id="<?php echo $row['item_id']; ?>">
                                                        <span  aria-hidden="true"><i class="fas fa-edit"></i></span>
                                                         </a>
                                                        &nbsp;&nbsp;

                                                        <!-- Delete Button -->
                                                        <a href="#" class="btn btn-danger a-btn-slide-text red" data-id="<?php echo $row['item_id']; ?>">
                                                         <span  aria-hidden="true"><i class="fas fa-trash-alt"></i></span>
                                                        </a>

                                                         <script>
                                                          $("a.red").click(function(){
                                                            //("Hello " + this.id);
                                                            swal({
                                                              title: 'Are you sure?',
                                                              text: 'You will not be able to recover the Item Details again!',
                                                              icon: 'warning',
                                                              buttons: true,
                                                              dangerMode: true,
                                                            })
                                                            .then((willDelete) => {
                                                              if (willDelete) { 
                                                                //swal(this.id);
                                                                var el = this;
                                                                var deleteid = $(this).data('id');
                                                                //swal(deleteid);
                                                                $.ajax({
                                                                 url: 'remove_item.php',
                                                                 type: 'POST',
                                                                 data: { id: deleteid },
                                                                 success: function(response){

                                                                
                                                                   // Remove row from HTML Table
                                                                   $(el).closest('tr').css('background','tomato');
                                                                   $(el).closest('tr').fadeOut(800,function(){
                                                                      $(this).remove();
                                                                   });
                                                                      
                                                                 }
                                                                });

                                                              } else {
                                                                //swal('Restaurant is safe!');
                                                              }
                                                            });
                                                          });

                                                          </script>         
                                                  <?php      
                                                         echo "</td>";
                                                        echo "</tr>";
                                                          } else {
                                                             
                                                             //Non-Vegetarian Products
                                                            echo "<tr data-target='rowbg'  id='".$row['item_id']."'>";
                                                          echo "<td><img src='itemphotos/".$resName."/".$row['photoname']."' width='110px' height='75px'></img></td>";
                                                          echo "<td data-target='item_id'>".$row['item_id']."</td>";
                                                          echo "<td data-target='Name'>".$row['Name']."</td>";
                                                          echo "<td style='color:red;font-weight:bold;' >".$row['Type']."</td> ";
                                                          echo "<td data-target='category'>".$row['category']."</td> ";
                                                          echo "<td data-target='price'>".$row['price']."</td>"; 
                                                          echo "<td data-target='availability'>".$row['availability']."</td>";
                                                          echo "<td data-target='discount'>".$row['Discount']."</td>";
                                                          echo "<td data-target='final_price'>".$row['Final_Price']."</td>";
                                                          echo "<td>"; ?>

                                                         <!--  Edit Button -->
                                                         <a href="#" class="btn btn-success a-btn-slide-text green" name="Edit" data-role="update" data-id="<?php echo $row['item_id']; ?>">
                                                        <span  aria-hidden="true"><i class="fas fa-edit"></i></span>
                                                         </a>
                                                        &nbsp;&nbsp;

                                                        <!-- Delete Button -->
                                                        <a href="#" class="btn btn-danger a-btn-slide-text red" name="Delete" data-id="<?php echo $row['item_id']; ?>">
                                                         <span  aria-hidden="true"><i class="fas fa-trash-alt"></i></span>
                                                        </a>

                                                        <script>
                                                          $("a.red").click(function(){
                                                            //("Hello " + this.id);
                                                            swal({
                                                              title: 'Are you sure?',
                                                              text: 'You will not be able to recover the Restaurant Details again!',
                                                              icon: 'warning',
                                                              buttons: true,
                                                              dangerMode: true,
                                                            })
                                                            .then((willDelete) => {
                                                              if (willDelete) { 
                                                                //swal(this.id);
                                                                var el = this;
                                                                var deleteid = $(this).data('id');
                                                                //swal(deleteid);
                                                                $.ajax({
                                                                 url: 'remove_item.php',
                                                                 type: 'POST',
                                                                 data: { id: deleteid },
                                                                 success: function(response){
                                                                   // Remove row from HTML Table
                                                                   $(el).closest('tr').css('background','tomato');
                                                                   $(el).closest('tr').fadeOut(800,function(){
                                                                      $(this).remove();
                                                                   });
                                                                      
                                                                 }
                                                                });

                                                              } else {
                                                                //swal('Restaurant is safe!');

                                                              }
                                                            });
                                                          });

                                                          </script>
                                                  <?php      
                                                         echo "</td>";
                                                         echo "</tr>";
                                                          } // Closing Non-Veg
                                                       }//closing Available Products block
                                                     }//Closing While Loop

                                                     mysqli_close($GLOBALS["con"]);
                                                  }//CLosing Database Connection Else Block

                                                ?> 
                                                 
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
       
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

                 <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <!-- <h4 class="modal-title">Modal Header</h4> -->
                                <!-- <p>Update Details</p> -->
                              </div>
                              <div class="modal-body">
                                <!-- Price Input -->
                                <div class="form-group">
                                   <label>Item Price</label>
                                   <input type="text" name="price" id="price" class="form-control">
                                </div>
                                 
                                 <!-- Availability Dropdown -->
                                <div class="form-group">
                                   <label>Item Availability</label>
                                   <select class="form-control" name="inputCategory" id="inputCategory">
                                     <option value="Yes">Yes</option>
                                     <option value="No">No</option>
                                   </select>
                                </div>

                                <!-- Discount Dropdown -->
                                <div class="form-group">
                                   <label>Item Discount</label>
                                   <select class="form-control" name="inputDiscount" id="inputDiscount">
                                     <option value="0 %">0 %</option>
                                     <option value="10 %">10 %</option>
                                     <option value="20 %">20 %</option>
                                     <option value="30 %">30 %</option>
                                     <option value="40 %">40 %</option>
                                     <option value="50 %">50 %</option>
                                     <option value="60 %">60 %</option>
                                   </select>
                                </div>

                                <input type="hidden" id="userId" class="form-control">

                              </div>
                              <div class="modal-footer">
                                <a href="#" id="save" class="btn btn-primary pull-right">Update</a>
                                <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
                              </div>
                            </div>

                          </div>
                        </div>
       
       <script>

         //Appending Values to Input Fields
         $(document).ready(function(){
             $(document).on('click','a[data-role=update]',function() {
                var id = $(this).data('id');
                var price = $('#' + id).children('td[data-target=price]').text();
                var availability = $('#' + id).children('td[data-target=availability]').text();
                var discount = $('#' + id).children('td[data-target=discount]').text();
                
                $('#price').val(price);
                $('#inputCategory').val(availability);
                $('#inputDiscount').val(discount);
                $('#userId').val(id);
                $('#myModal').modal('toggle');

             });

              //Updating Values
          $('#save').click(function(){
              var id = $('#userId').val();

              var price = Number($('#price').val());
              var availability = $('#inputCategory').val();
              var discount = $('#inputDiscount').val();
              
              var temp = new Array();
              temp = discount.split(' ');
              var final_price = (price-((price/100)*temp[0]));
              
              var el = this;
              $.ajax({
                  url : 'update.php',
                  method : 'POST',
               data : {id : id, price : price, availability : availability, discount : discount, final_price : final_price },
                  success : function(response){
                              //console.log(response);
                              $('#' + id).children('td[data-target=price]').text(price);

                              $('#dataTable1 td').each(function() {
                                  if(availability == 'No') {
                                  
                                   $('#' + id).css('background','#dee2df');
                                  } else {
                                    $('#' + id).css('background','white');
                                  }
                              });
                             
                              $('#' + id).children('td[data-target=availability]').text(availability);

                              $('#' + id).children('td[data-target=discount]').text(discount);

                              $('#' + id).children('td[data-target=final_price]').text(final_price);
                              
                              $('#myModal').modal('toggle');
                            }
              });
          });
      });




       </script>

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
