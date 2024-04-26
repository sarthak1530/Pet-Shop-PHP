
<?php

 session_start();

    include_once('config/conn/db_connection.php');
    include_once('config/class/petshop_class.php');


if(!isset($_SESSION['logged_in']))
    {
       header("location:index.php");
    }else{

    $user_session = trim($_SESSION['user_no']);
    $ordr = new Petshop_class();
    $orders = $ordr->fetch_orderAll(); 

?>

<?php include 'header/main-header.php';?>

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
   
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <strong style="color: #007bff;" class="mt-2">Welcome !, <?= ucfirst($user_session) ;?></strong> &nbsp;<img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
<!--                             <a class="nav-link" href="#"><i class="fa fa-user"></i> My Profile</a>

                            <a class="nav-link" href="#"><i class="fa fa-cog"></i> Settings</a> -->

                             <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="main.php">Dashboard</a></li>
                            <li class="active">Order Management</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Order Management Table</strong>

                                 <div class="btn-group pull-right">
                                         <a href="orderdetail.php"> <button type="button" class="btn btn-info btn-sm" style=""><i class="fa fa-list-alt"> Order Details</i>
                              </button>
                              </a>



                                   </div>

                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                              <table id="bootstrap-data-table-export" class="table table-striped table-bordered employee_table">
                                    <thead>
                                        <tr>
                                            <th>Reference No.</th>
                                            <th>Customer Name</th>
                                            <th>Order Date</th>
                                            <th>Item</th>
                                            <th>Expected Delivery</th>
                                            <th>QTY</th>
                                            <th>Price</th>
                                            <th>Order Status</th>
                                            <th>Remarks</th>
         
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                       <?php
                                          foreach($orders as $odr){ ?>
                                        <td><?= ucfirst(htmlentities($odr['reference_no'])); ?></td>
                                        <td><?= ucfirst(htmlentities($odr['customer_name'])); ?></td>
                                        <td><?= date('M-d-Y h:i A', strtotime(htmlentities($odr['date_created']))); ?></td>
                                        <td><?= ucfirst(htmlentities($odr['item'])); ?></td>
                                         <td><?= date('M-d-Y', strtotime(htmlentities($odr['date_created']))); ?></td>
                                        <td><?= ucfirst(htmlentities($odr['qty'])); ?></td>
                                        <td>&#8369; <?= ucfirst(htmlentities(number_format($odr['price'],0))); ?></td>
                                        <td>
                                            <?php
                                             if(htmlentities($odr['status']) == 'Approved'){
                                                 echo '<span class="right badge badge-success">'.htmlentities($odr['status']).'</span>';
                                               }else if(htmlentities($odr['status']) == 'To Deliver'){
                                                 echo '<span class="right badge badge-primary">'.htmlentities($odr['status']).'</span>';
                                               
                                               }else if(htmlentities($odr['status']) == 'Received'){
                                                 echo '<span class="right badge badge-warning">'.htmlentities($odr['status']).'</span>';
                                               
                                               }else{
                                                  echo '<span class="right badge badge-danger">'.htmlentities($odr['status']).'</span>';
                                               }

                                             ?>
                                            
                                          </td>
                                        <td><?= ucfirst(htmlentities($odr['remarks'])); ?></td>
              
                                        </tr>

                                      <?php $found_rows = true; }  if (!isset($found_rows)) echo "<tr><td colspan ='7'><div class='alert alert-danger' style='font-weight:bold;'>No records found.</div></td></tr>"; 
                                      ?>   
            


                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->

    <!-- Right Panel -->
<?php } ?>


    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="assets/js/init-scripts/data-table/datatables-init.js"></script>


</body>

</html>
