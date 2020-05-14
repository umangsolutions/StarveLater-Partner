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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
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
                            $sql = "SELECT fname,lname,Restaurant_Name FROM restaurants where Email_ID = '".$_SESSION['email']."'";
                                                    
                                    $retval = mysqli_query($GLOBALS['con'],$sql);

                                    $followingdata = $retval->fetch_array(MYSQLI_ASSOC);
                                                       
                                   // echo $followingdata['restaurantname'];

                                    mysqli_close($GLOBALS["con"]);
                            }

        ?>



        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
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
                        <a class="dropdown-item" href="#">Settings</a><a class="dropdown-item" href="#">Activity Log</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="index.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
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
                                <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="register.php">Manage Profile</a></nav>
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
                                <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="layout-static.html">Add Items</a><a class="nav-link" href="layout-sidenav-light.html">Manage Items</a></nav>
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
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                         <span><?php echo $followingdata['Restaurant_Name']; ?></span>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Restaurant Dashboard</h1>
                        <ol class="breadcrumb mb-4" width="100%">
                           <li class="breadcrumb-item active" width="100%"><marquee>Welcome <span><?php echo $followingdata['fname']." ".$followingdata['lname']; ?></span> to Restaurant Dashboard.Please update your Profile under Profile Section</marquee></li>
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
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Orders Received</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Name of Customer</th>
                                                <th>Restaurant Ordered</th>
                                                <th>Name of Item</th>
                                                <th>Take Away / Dine-in</th>
                                                <th>Time Booked</th>
                                                <th>Status of Order</th>
                                                <th>Amount (INR)</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>

                                                <th>Name of Customer</th>
                                                <th>Restaurant Ordered</th>
                                                <th>Name of Item</th>
                                                <th>Mode of Delivery</th>
                                                <th>Time Booked</th>
                                                <th>Status of Order</th>
                                                <th>Amount (INR)</th>
                                                </tr>
                                        </tfoot>
                                        <tbody>
                                            <tr>
                                                <td>Saikiran Kopparthi</td>
                                                <td>Haveli Dakshin, Kakinada</td>
                                                <td>Veg Biryani</td>
                                                <td>Dine-in</td>
                                                <td>2020/05/03 22:15:02</td>
                                                <td>Completed</td>
                                                <td>₹500.00</td>
                                            </tr>
                                                 
                                            <tr>
                                                <td>Koushik Modekurti</td>
                                                <td>Ravi Bakery, Rajam</td>
                                                <td>Pizza</td>
                                                <td>Take Away</td>
                                                <td>2020/06/15 12:28:15</td>
                                                <td>In progress</td>
                                                <td>₹250.00</td>
                                            </tr>
                                            <tr>
                                                <td>Santosh Burada</td>
                                                <td>Paradise, Hyderabad</td>
                                                <td>Panner 65</td>
                                                <td>Dine-in</td>
                                                <td>2020/05/25 17:23:12</td>
                                                <td>In progress</td>
                                                <td>₹300.00</td>
                                            </tr>
                                            <tr>
                                                <td>Prathyusha Kuppili</td>
                                                <td>SVN Grand, Kakinada</td>
                                                <td>Veg Biryani</td>
                                                <td>Take Away</td>
                                                <td>2020/05/22 11:10:02</td>
                                                <td>Completed</td>
                                                <td>₹520.00</td>
                                            </tr>
                                            <tr>
                                                <td>Manikanta Gontu</td>
                                                <td>SR Foodex, Rajam</td>
                                                <td>Baby Corn Munchuria</td>
                                                <td>Dine-in</td>
                                                <td>2020/12/13 18:25:58</td>
                                                <td>In Progress</td>
                                                <td>₹275.00</td>
                                            </tr>                                  </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
