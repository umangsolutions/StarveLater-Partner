<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Restaurant Dashboard | STARVELATER</title>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

        
    </head>
    <body class="sb-nav-fixed">

        <?php
                           
                          session_start();
                          //echo $_SESSION['email'];

                            $dbname = "starvelater";
                            $con = mysqli_connect("localhost","root","",$dbname);
    
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

        ?>



        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" style="background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(0,0,0,1) 100%);">
            <a class="navbar-brand" href="index.html">STARVE<B>LATER</B></a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button
            ><!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">

                     <!-- Ready Status Button -->
                     <div class="form-group" >
                                  
                                     <?php 
                                           $status = $followingdata['OperationStatus'];

                                           if ($status == 'Open') { ?>

                                                 <!-- Setting Dropdown Color Green -->
                                     <i id="online" class="fas fa-check-circle" style="font-size: 25px;color: #28a745;margin-right: 10px;"></i>
                                     <i id="offline" class="far fa-times-circle" style="display:none;font-size: 25px;color: #dc3545;margin-right: 10px;"></i>
                                     <select class="form-control"  style="background-color: #28a745;color: #fff;border-color: #000;width:150px;" name="inputCategory" id="inputCategory" data-id="<?php echo 
                                                        $followingdata['Restaurant_ID']; ?>" >

                                                <option class="bg-primary">Open</option>
                                                <option class="bg-danger" value="Closed">Closed</option>
                                               </select>
                                        <?php   } else { ?>

                                                <!-- Setting Dropdown Color Red -->
                                        <i id="offline" class="far fa-times-circle" style="font-size: 25px;color: #dc3545;margin-right: 10px;"></i>
                                        <i id="online" class="fas fa-check-circle" style="display:none;font-size: 25px;color: #28a745;margin-right: 10px;"></i>
                                        <select class="form-control"  style="background-color: #dc3545;color: #fff;border-color: #000;width:150px;" name="inputCategory" id="inputCategory" data-id="<?php echo 
                                                        $followingdata['Restaurant_ID']; ?>" >

                                                <option class="bg-danger" value="Closed">Closed</option>
                                                 <option class="bg-primary">Open</option>
                                             </select>
                                      <?php  }

                                     ?>
                                     
    
                    </div>
                     &nbsp;&nbsp;&nbsp;

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



                            <!-- Orders in Nav Bar--> 
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoutsOrders" aria-expanded="false" aria-controls="collapseLayouts"
                                ><div class="sb-nav-link-icon"><i class="fas fa-utensils"></i></div>
                                Orders
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                            ></a>
                            <div class="collapse" id="collapseLayoutsOrders" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="restaurant_orders.php">View Orders</a></nav>
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
                                <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="restaurant_add_items.php">Add Items</a><a class="nav-link" href="restaurant_manage_items.php">Manage Items</a></nav>
                            </div>


                            <!-- Tables in Nav Bar--> 
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNotification" aria-expanded="false" aria-controls="collapseLayouts"
                                ><div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
                            ></a>
                            <div class="collapse" id="collapseNotification" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="#">Manage Table Numbers</a></nav>
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

                        <h1 class="mt-4" style="color: #fff;">Restaurant Dashboard</h1>
                        <!-- <div class="row">
                             <div class="col-sm-9">   
                                <h1 class="mt-4" style="color: #fff;">Restaurant Dashboard</h1>
                             </div>
                            <div class="col-sm-3" style="margin-top: 25px;">
                                <input type="checkbox" checked data-toggle="toggle"  data-on="Ready" data-off="Not Ready" data-onstyle="success" data-offstyle="danger">
                             </div>
                       </div> -->

                        <ol class="breadcrumb mb-4" width="100%" style="background-color: #000;">
                           <li class="breadcrumb-item active" width="100%" style="color: #fff;"><marquee>Welcome <span><?php echo $followingdata['fname']." ".$followingdata['lname']; ?></span> to Restaurant Dashboard.Please update your Profile under Profile Section</marquee></li>
                        </ol>
                
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Total Orders Recieved</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Restaurant Overview</div> 
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Bulk Orders</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Completed Orders</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Order Statistics</div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-chart-bar mr-1"></i>User Statistics</div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>

                       <!--  Orders Table -->
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Orders Received</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                     <br>
                                    <div class="row">
                                         <!-- Start Date -->  
                                         <div class="col-md-4">
                                        <div class="input-daterange">
                                                
                                                <input type="text" autocomplete="off" placeholder="Start Date" name="start_date" id="start_date" class="form-control" />
                                        
                                        </div>
                                    </div>

                                        <!--  End Date --> 
                                        <div class="col-md-4">
                                        <div class="input-daterange">
                                            
                                                <input type="text" autocomplete="off" placeholder="End Date" name="end_date" id="end_date" class="form-control" />
                                            
                                        </div>
                                    </div>

                                        <div class="col-md-4">
                                          <input type="button" name="search" id="search" value="Search" class="btn btn-info" />
                                        </div>
                                    </div>
                                    <br > 
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-id="<?php 
                                    echo $followingdata['Restaurant_ID']; ?>">
                                        <thead>
                                            <tr>
                                                <th>Order_ID</th>
                                                
                                                <th>Name of Item</th>
                                                <th>Take Away / Dine-in</th>
                                                <th>Order Date</th>
                                                <th>Status of Order</th>
                                                <th>Amount (INR)</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>

                                                 <th>Order_ID</th>
                                               
                                                <th>Name of Item</th>
                                                <th>Take Away / Dine-in</th>
                                                <th>Order Date</th>
                                                <th>Status of Order</th>
                                                <th>Amount (INR)</th>
                                                </tr>
                                        </tfoot>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                      
                        <!-- Table Close -->
                    </div>
                </main>


                 <!-- Today's Data Table  -->
                        <script type="text/javascript" language="javascript" >


                            $(document).ready(function(){
 
 $('.input-daterange').datepicker({
  todayBtn:'linked',
  format: "yyyy-mm-dd",
  autoclose: true
 });

 var rest_id = $('#dataTable').data('id');
 fetch_data('no','','',rest_id);


 function fetch_data(is_date_search, start_date='', end_date='',rest_id)
 {
  var dataTable = $('#dataTable').DataTable({
   "processing" : true,
   "serverSide" : true,
   "order" : [],
   "ajax" : {
    url:"fetch.php",
    type:"POST",
    data:{
     is_date_search:is_date_search, start_date:start_date, end_date:end_date,res_id: rest_id
    }
   }
  });
 }

 $('#search').click(function(){
  var start_date = $('#start_date').val();
  var end_date = $('#end_date').val();
  var rest_id = $('#dataTable').data('id');
  if(start_date != '' && end_date !='')
  {
   $('#dataTable').DataTable().destroy();
   fetch_data('yes', start_date, end_date,rest_id);
  }
  else
  {
   swal("Error","Both Date's are Required","warning");
  }
 }); 
 
});
    
                        </script>


             




         <script>
   
           $(document).ready(function() {

                var prev_val;

                $('#inputCategory').focus(function() {
                    prev_val = $(this).val();
                }).change(function() {
                     //$(this).blur() // Firefox fix as suggested by AgDude
                     if(prev_val == 'Open') {
                    var success = confirm('Are you sure you want to change the Status to Closed?');
                } else {
                    var success = confirm('Are you sure you want to change the Status to Open?');   
                }
                    if(success)
                    {
                         if(prev_val == 'Open') {
                            var id = $('#inputCategory').data('id');
                             $.ajax({
                                 
                                 url : 'update_status.php',
                                 method : 'POST',
                                 data : { id: id, status: 'Closed'},
                                 success : function(response) {

                                       $('#inputCategory').css('background','#dc3545');
                                       $('#offline').show();
                                       $('#online').hide();
                                      swal('successful','Restaurant is Now Closed','success');
                                 }
                              
                             });
                        //alert('Changedd to Closed');
                       } else {
                        var id = $('#inputCategory').data('id');
                             $.ajax({
                                 
                                 url : 'update_status.php',
                                 method : 'POST',
                                 data : { id: id, status: 'Open'},
                                 success : function(response) {
                                       $('#inputCategory').css('background','#28a745');
                                       $('#online').show();
                                       $('#offline').hide();
                                      swal('successful','Restaurant is Now Open','success');
                                 }
                              
                             });
                         //alert('Changed to Open');
                       } 
                        // Other changed code would be here...
                    }  
                    else
                    {
                        $(this).val(prev_val);
                        //alert('unchanged');
                        return false; 
                    }
                });
           });

    
        </script>
                    
                
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
        <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    </body>
</html>
