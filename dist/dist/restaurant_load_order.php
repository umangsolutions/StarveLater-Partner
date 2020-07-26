<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel='shortcut icon' href='assets/img/sample.png' type='image/x-icon' />
        <title>Order Details | StarveLater</title>
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

                            $dbname = "starvelater";
                            $con = mysqli_connect("localhost","saikirankkd1","Gmrit@224",$dbname);
    
                            //Check for DB Connection
                            if(!$con){
                                    die("Connection Failed :" + mysqli_connect_error());
                            }else { 
                                                         //Load Restaurant  Data  
                              $sql = "SELECT * FROM restaurants where Email_ID = '".$_SESSION['email']."'";
                                                    
                                    $retval = mysqli_query($GLOBALS['con'],$sql);

                                    $followingdata = $retval->fetch_array(MYSQLI_ASSOC);
                                                       
                                   // echo $followingdata['restaurantname'];

                                    //mysqli_close($GLOBALS["con"]);
                            }

                            $order_query = "SELECT Customer_ID from orders where order_Id='".$_GET['order_Id']."'";

                            $result1 = mysqli_query($con,$order_query);

                            $result1_val = mysqli_fetch_array($result1);

                            $cust_query = "SELECT Name from customer where Customer_ID='".$result1_val[0]."'";

                            $cust_exec = mysqli_query($con,$cust_query);

                            $cust_name = mysqli_fetch_array($cust_exec);

        


                //Remove spaces, slashes and prevent XSS
                function test_input($data) {
                  $data = trim($data);
                  $data = stripslashes($data);
                  $data = htmlspecialchars($data);
                  return $data;
                }

                
function getOrderDetails($Order_Id){

        $Category_ID = uniqid();

        $sql = "INSERT into category VALUES ('$Category_ID','$Restaurant_ID','".$_POST['CategoryName']."')";


        $result = mysqli_query($GLOBALS['con'],$sql) or die("Error: " . mysqli_error($con));

        if($result) {
            echo "<script> swal('Successfully added','Category added Successfully','success'); </script>";
        } else {
            echo "<script> alert('Something Went Wrong !'); </script>";
        }
}


                
                    $dbname = "starvelater";
                    $con = mysqli_connect("localhost","saikirankkd1","Gmrit@224",$dbname);
    
                    //Check for DB Connection
                    if(!$con){
                        die("Connection Failed :" + mysqli_connect_error());
                    }else{
                     
                         $Restaurant_ID = $followingdata['Restaurant_ID'];

                         if(isset($_POST["AddCategory"])){
                            if($boolean) {
                              AddCategory($Restaurant_ID); 
                           }
                           mysqli_close($GLOBALS["con"]);
                           $boolean = false;
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

            <!-- Title -->
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4" style="color: white;">Order Placed by <?php echo $cust_name[0]; ?></h1>

                       <!--  Marquee -->
                        <ol class="breadcrumb mb-4" width="100%" style="background-color: black;">
                           <li class="breadcrumb-item active" width="100%" style="color: #fff;"><marquee>Welcome <span><?php echo $followingdata['fname']." ".$followingdata['lname']; ?></span> to Restaurant Dashboard. You can view the Order Details Here.</marquee></li>
                        </ol>

  
                    <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Order Details </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Item ID</th>
                                                <th>Item Name</th>
                                            
                                            
                                                <th>Item Cost</th>
                                            </tr>
                                        </thead>
                                                                                <tbody>
                                             
                                             <?php 
                                                   
                                                   $dbname = "starvelater";
                                                     $con = mysqli_connect("localhost","saikirankkd1","Gmrit@224",$dbname);
    
                                                     //Check for DB Connection
                                                     if(!$con){
                                                        die("Connection Failed :" + mysqli_connect_error());
                                                     } else {

                                                        $sql = "SELECT * from orders where Order_Id = '".$_GET['order_Id']."'";

                                                        $result_val = mysqli_query($con,$sql);

                                                        if(! $result_val ) {
                                                          die('Could not get data: ' . mysqli_error());
                                                       }

                                                        
                                                       while($row = mysqli_fetch_array($result_val,MYSQLI_ASSOC)) {
                                                           
                                                           echo "<tr>";
                                                           echo "<td>".$row['item_ids']."</td>";


                                                           $sqlquery = "SELECT Name from items where item_id='".$row['item_ids']."'";
                                                           $work = mysqli_query($con,$sqlquery);
                                                           $workArr = mysqli_fetch_array($work);
                                                           echo "<td>".$workArr[0]."</td>";
                                                           
                                                           echo "<td>".'₹ '.number_format($row['Net_Bill'],2)."</td>";
                                                           echo "</tr>";
                                                       }

                                                       $sum_query = "SELECT sum(Net_Bill) from orders where 
                                                       Order_Id='".$_GET['order_Id']."'";

                                                        $sum_exec = mysqli_query($con,$sum_query);

                                                        $sum_result = mysqli_fetch_array($sum_exec);
                                                
                                                     }



                                             ?>


                                        </tbody>
                                        <?php 

                                                       echo "<tr><th colspan='2'>Total</th><th>".'₹ '.number_format($sum_result[0],2)."</th></tr>";

                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>




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
                                <!-- Name Input -->
                                <div class="form-group">
                                   <label>Category Name</label>
                                   <input type="text" name="Name" id="Name" class="form-control">
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
                var name = $('#' + id).children('td[data-target=Name]').text();
                
                
                $('#Name').val(name);
                $('#userId').val(id);
                $('#myModal').modal('toggle');

             });

              //Updating Values
          $('#save').click(function(){
              var id = $('#userId').val();
              var name = $('#Name').val();
              
              
              var el = this;
              $.ajax({
                  url : 'update_category.php',
                  method : 'POST',
                  data : {id : id, name : name},
                  success : function(response){
                              //console.log(response);
                              $('#' + id).children('td[data-target=Name]').text(name);

                        
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
        <script src="assets/demo/datatables1-demo.js"></script>
    </body>
</html>
