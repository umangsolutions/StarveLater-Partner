<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel='shortcut icon' href='assets/img/sample.png' type='image/x-icon' />
        <title><?php echo $_GET['restaurantname']; ?> | StarveLater</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

         <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js" integrity="sha256-5oApc/wMda1ntIEK4qoWJ4YItnV4fBHMwywunj8gPqc=" crossorigin="anonymous"></script>
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
         <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
           <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    </head>
    <body class="sb-nav-fixed">

   

        <?php

              $FoodLicenceErr = $LabourLicenceErr = $MarginErr = "";

              $FoodLicence = $LabourLicence = $Margin =  "";
              $boolean = false;


              $dbname = "starvelater";
              $con = mysqli_connect("localhost","saikirankkd1","Gmrit@224",$dbname);
        


              //Retrieving Values from Database if they are already present
              $foodLi = $labourLi = $marginLi =  "";

              $resname = $_GET["restaurantname"];


              $res = "SELECT FoodLicense, LabourLicense,Margin from restaurants where Restaurant_Name = '$resname'";

               $result = mysqli_query($GLOBALS['con'],$res) or die("Error: " . mysqli_error($con));


                if(! $result ) {
                  die('Could not get data: ' . mysqli_error());
                } 

                while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                   $foodLi = $row['FoodLicense'];
                   $labourLi = $row['LabourLicense'];
                   $marginLi = $row['Margin'];

                }


               

                if($foodLi == '0' && $labourLi == '0') {
                    if($marginLi == '0') {
                      echo "<script>swal('Please update required fields for this Restaurant');</script>";
                    } 
                } else {
                     if($marginLi == '0') {
                    echo "<script>swal('Please update Margin Details for this Restaurant');</script>";
                }
                }




                //Remove spaces, slashes and prevent XSS
                function test_input($data) {
                  $data = trim($data);
                  $data = stripslashes($data);
                  $data = htmlspecialchars($data);
                  return $data;
                }








        
              

             if ($_SERVER["REQUEST_METHOD"] == "POST") {
                     
                      //Food Licencse Validation
                    if (empty($_POST["FoodLicenceNumber"])) {
                    $FoodLicenceErr = "Food License Number is required";
                    $boolean = false;
                  } else {
                      $FoodLicenceNumber = test_input($_POST["FoodLicenceNumber"]);
                      $boolean = true;
                    }


                     //Labour Licencse Validation
                    if (empty($_POST["LabourLicenceNumber"])) {
                    $LabourLicenceErr = "Labour License Number is required";
                    $boolean = false;
                  } else {
                      $LabourLicenceNumber = test_input($_POST["LabourLicenceNumber"]);
                      $boolean = true;
                    }




                     //Margin Percent Validation
                    if (empty($_POST["Margin"])) {
                    $MarginErr = "Margin Percentage is required";
                    $boolean = false;
                  } else if($_POST["Margin"] == '0' || $_POST["Margin"] < 0 || $_POST["Margin"] > 100) {
                      $MarginErr = "Invalid Margin Percentage !";
                      $boolean = false;
                    } else {
                       $Margin = test_input($_POST["Margin"]);
                      $boolean = true; 
                    }




                    function updateData(){

                            $resname = $_GET["restaurantname"];

                            $sql = "UPDATE restaurants SET FoodLicense = '".$_POST["FoodLicenceNumber"]."', LabourLicense = '".$_POST["LabourLicenceNumber"]."',Margin = '".$_POST["Margin"]."' where Restaurant_Name='".$_GET["restaurantname"]."' ";


                            $result = mysqli_query($GLOBALS['con'],$sql) or die("Error: " . mysqli_error($con));

                            if($result) {
                                echo "<script> swal('Successfull', 'Details Updated Successfully', 'success'); </script>";
                            } else {
                                echo "<script> alert('Something Went Wrong !'); </script>";
                            }
                    }

                   


                    

                        
                        //Check for DB Connection
                        if(!$con){
                            die("Connection Failed :" + mysqli_connect_error());
                        }else{


                           if(isset($_POST["Delete"])){
                            //echo "<script>alert('Restaunt');</script>";
                            echo "<script> 
                                var resname = '$resname';
                              swal({
                              title: 'Are you sure?',
                              text: 'You will not be able to recover the Restaurant Details again!',
                              icon: 'warning',
                              buttons: true,
                              dangerMode: true,
                            })
                            .then((willDelete) => {
                              if (willDelete) { 
                                window.location = 'manage_restaurants.php?restaurantname='+resname+'&status=delete';
                              } else {
                                //swal('Restaurant is safe!');
                              }
                            });</script>";

                            //deleteData();
                            mysqli_close($GLOBALS["con"]);
                            $boolean = false;
                           }
                            

                            if(isset($_POST["Update"])){
                                if($boolean) {
                                   updateData();
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
                                Dashboard</a>
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
                            
                            <!-- Users in Nav Bar--> 
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsersData" aria-expanded="false" aria-controls="collapseLayouts"
                                ><div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Customers
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                            ></a>
                            <div class="collapse" id="collapseUsersData" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="register_customer.php">Register Customer</a><a class="nav-link" href="manage_customer.php">Manage Users</a></nav>
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
                    <div class="sb-sidenav-footer"  style="background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(0,0,0,1) 100%);">
                        <div class="small">Logged in as:</div>
                        Administrator
                    </div>

                </nav>
            </div>

            <!-- Title -->
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4" style="color: white;"><?php echo $_GET['restaurantname']; ?></h1>

                       <!--  Marquee -->
                        <ol class="breadcrumb mb-4" width="100%" style="background-color: #000;">
                            <li class="breadcrumb-item active" width="100%" style="color: #fff;"><marquee>Welcome to <span><?php echo $_GET['restaurantname']; ?></span> Dashboard.</marquee></li>
                        </ol>

                        

                        

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
                                                       
                                                        //Getting Restaurant Name from URL
                                                        $resName = $_GET['restaurantname'];

                                                        $sql = "SELECT Restaurant_ID from restaurants where Restaurant_Name = '".$resname."'";

                                                        $result = mysqli_query($GLOBALS['con'],$sql);
                                                      
                                                        $followingdata = $result->fetch_array(MYSQLI_ASSOC);

                                                        //Getting Restaurant ID Foreign Key in Items Table
                                                        $restaurantID = $followingdata['Restaurant_ID'];

                                                         //Load Items Data using  Restaurant ID as Foreign Key
                                                       $sql = "SELECT * FROM items where Restaurant_ID='".$restaurantID."' ";

                                                       $restaurant_profile_arr =array();
                                                    
                                                       $retval = mysqli_query($GLOBALS['con'],$sql);
                                                       
                                                       if(! $retval ) {
                                                          die('Could not get data: ' . mysqli_error());
                                                       }
                                                       
                                                         while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {

                                                          $item_data = array();
                                                          $item_data['itemPhoto'] = $row['photoname'];
                                                          $item_data['itemID'] = $row['item_id'];
                                                          $item_data['itemName'] = $row['Name'];
                                                          $item_data['itemType'] = $row['Type'];
                                                          $item_data['itemCategory'] = $row['category'];
                                                          $item_data['itemPrice'] = $row['price'];
                                                      $item_data['itemAvailability'] = $row['availability'];

                                                          array_push($restaurant_profile_arr, $item_data);



                                                          echo "<tr>";
                                                          echo "<td><img src='itemphotos/".$resName."/".$row['photoname']."' width='110px' height='75px'></img></td>";
                                                          echo "<td>".$row['item_id']."</td>";
                                                          echo "<td>".$row['Name']."</td>";
                                                          echo "<td>".$row['Type']."</td> ";
                                                          echo "<td>".$row['category']."</td> ";
                                                          echo "<td>".$row['price']."</td> ";
                                                          echo "<td>".$row['availability']."</td> ";
                                                          echo "</tr>";
                                                       }


    echo "<input type='hidden' value=".json_encode($restaurant_profile_arr)."  name='rest_profile_array' >";

                                                       mysqli_close($GLOBALS["con"]);
                                                     }

                                                ?> 
                                                 
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <?php 


                            $dbname = "starvelater";
                            $con = mysqli_connect("localhost","saikirankkd1","Gmrit@224",$dbname);
    
                            //Check for DB Connection
                            if(!$con){
                                    die("Connection Failed :" + mysqli_connect_error());
                            }else { 
                                                         //Load Restaurant  Data  
                            $sql = "SELECT * FROM restaurants where Restaurant_Name = '".$_GET['restaurantname']."'";
                                                    
                                    $retval = mysqli_query($GLOBALS['con'],$sql);

                                    $followingdata = $retval->fetch_array(MYSQLI_ASSOC);

                                   // echo "<script>alert('".$followingdata['Restaurant_ID']."');</script>";
                                                       
                                   // echo $followingdata['restaurantname'];

                                    mysqli_close($GLOBALS["con"]);
                            }

        


                        ?>

                       <!-- One Week Back Orders -->
                    <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Orders Received
                             Week ago</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                      
                                   <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0" data-id="<?php 
                                   echo $followingdata['Restaurant_ID']; ?>" data-margin="<?php echo $followingdata['Margin']; ?>">
                                        <thead>
                                            <tr>
                                                <th>Order_ID</th>  
                                                <th>Name of Item</th>
                                                <th>Type</th>
                                                <th>Order Date</th>
                                                <th>Status of Order</th>
                                                <th>Net Bill (INR)</th>
                                                <th>Our Margin Amount (<span><?php echo $marginLi; ?>%</span>)</th>
                                                <th>Final Amount</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                               <th colspan="5">Total</th>
                                               <th id="total_count"></th>
                                               <th id="our_margin"></th>
                                               <th id="final_margin"></th> 
                                                 
                                            </tr>
                                        </tfoot>
                                        
                                    </table>


                                </div>
                            </div>
                        </div>

                        <!--  One Week Ago's DataTable1 -->
                        <script type="text/javascript" language="javascript" >


                            $(document).ready(function(){
 //Retrieving Today's Date
var today = new Date();


var dd = String(today.getDate()).padStart(2, '0');
//Subtracting 7 days

var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

today = yyyy + '-' + mm + '-' + dd;

//Getting date before 7 days
var mcal = moment().subtract(7,'days').calendar();
var temp = new Array();
temp = mcal.split('/');
last = temp[2] + '-' + temp[0] + '-' + temp[1];
//alert(last);



 $('.input-daterange').datepicker({
  todayBtn:'linked',
  format: "yyyy-mm-dd",
  autoclose: true
 });



 function fetch_data(is_date_search, start_date='', end_date='',rest_id,margin)
 {
  var dataTable = $('#dataTable2').DataTable({
   "processing" : true,
   "serverSide" : true,
   "order" : [],
   "ajax" : {
    url:"fetch_restaurant.php",
    type:"POST",
    data:{
     is_date_search:is_date_search, start_date:start_date, end_date:end_date,res_id:rest_id,margin:margin
    }
   },
   drawCallback:function(settings) 
   {

      $("#total_count").html(settings.json.total_count);
      $("#our_margin").html(settings.json.our_margin);
      $("#final_margin").html(settings.json.final_margin);

   }
  });
 }

$('#dataTable2').DataTable().destroy();
var rest_id = $("#dataTable2").data('id');
var margin = $("#dataTable2").data('margin');
//alert(rest_id);
   fetch_data('yes',last,today,rest_id,margin);


/*
 $('#search1').click(function(){
  var start_date = $('#start_date1').val();
  var end_date = $('#end_date1').val();
  if(start_date != '' && end_date !='')
  {
   $('#dataTable1').DataTable().destroy();
   fetch_data('yes', today,last_week );
  }
  else
  {
   swal("Error","Both Date's are Required","warning");
  }
 }); */
 
});
    
                        </script>


                        
                        <hr>

                        <h2 class="mt-4" style="color: white;">Update Licence Details</h2>


                    <!-- Referring Same URL after Submitting the Page -->
                    <?php 
                        $destin_url = "http://localhost/StarveLater/dist/load_restaurant.php?restaurantname=".$_GET['restaurantname']."";
                        ?>
                         
                        <!-- Food Licence & Labour Licence -->
                        <form method="POST" enctype="multipart/form-data" action="<?php echo $destin_url; ?>" style="margin-top: 50px;">
                        <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group"><label class="small mb-1" for="inputFoodLicence" style="color: white;">Food Licence No.</label><input class="form-control py-4" id="inputFoodLicence" type="text" value="<?php echo $foodLi; ?>"placeholder="Enter Food Licence No." name="FoodLicenceNumber" />
                                    <span id="span" style="color: black;"><?php echo $FoodLicenceErr; ?></span>
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"><label class="small mb-1" for="inputLabourLicence" style="color: white;">Labour Licence</label><input class="form-control py-4" id="inputLabourLicence" type="text" value="<?php echo $labourLi;?>" placeholder="Enter Labour Licence No." name="LabourLicenceNumber" />
                                    <span id="span" style="color: black;"><?php echo $LabourLicenceErr; ?></span>
                                    </div>
                                </div>
                        </div>
                    

                    

                       
                       
                 <P>&nbsp;</P>

                  <hr>

                        <h2 class="mt-4" style="color: white;">Update Margin Percentage</h2>


                    <!-- Referring Same URL after Submitting the Page -->
                    <?php 
                        $destin_url = "http://localhost/StarveLater/dist/load_restaurant.php?restaurantname=".$_GET['restaurantname']."";
                        ?>
                         
                        <!-- Margin Percentage Detail -->
                    
                        <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group"><label class="small mb-1" for="inputMargin" style="color: white;">Margin Percentage</label><input class="form-control py-4" id="inputMargin" type="text" value="<?php echo $marginLi; ?>"placeholder="Enter Margin Percentage" name="Margin" />
                                    <span id="span" style="color: black;"><?php echo $MarginErr; ?></span>
                                </div>
                                </div>
                        </div>
                     
                       <!-- Update & Delete Button -->
                        <div class="form-row">
                                <div class="col-md-6">
                                            <div class="form-group mt-4 mb-0"><input class="btn btn-primary" type="submit" name="Update" id="btnupdate" value="Update" /></div>
                                </div>
                                <div class="col-md-6">
                                            <div class="form-group mt-4 mb-0"><input class="btn btn-danger" type="submit" name="Delete" id="btndelete" value="Delete"/></div>
                                </div>
                        </div>

                    </form>

                       
                       
                 <P>&nbsp;</P>







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


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
        <script src="assets/demo/datatables-demo.js"></script>
        <script src="assets/demo/datatables1-demo.js"></script>
    </body>
</html>
