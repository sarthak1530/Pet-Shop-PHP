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
    //$orders = $ordr->fetch_orderAll(); 
    $Approved = $ordr->fetch_orderApproved(); 
    $ToDeliver = $ordr->fetch_orderDeliver(); 
    $Received = $ordr->fetch_orderReceived(); 
    $Cancelled = $ordr->fetch_orderCancelled(); 

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
   <!--                      <a class="nav-link" href="#"><i class="fa fa-user"></i> My Profile</a>

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
                        <li class="active">Order Detail</li>
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
                            <strong class="card-title">Order Detail Table</strong>
                            <!--        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#smallmodal" style="margin-left:77%"><i class="fa fa-plus">Add</i>
                               </button> -->
                        </div>


                        <div class="card-body">

                            <div class="default-tab">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-Approved-tab" data-toggle="tab" href="#nav-Approved" role="tab" aria-controls="nav-Approved" aria-selected="true">Approved</a>
                                        <a class="nav-item nav-link" id="nav-Deliver-tab" data-toggle="tab" href="#nav-Deliver" role="tab" aria-controls="nav-Deliver" aria-selected="false">To Deliver</a>
                                        <a class="nav-item nav-link" id="nav-Received-tab" data-toggle="tab" href="#nav-Received" role="tab" aria-controls="nav-Received" aria-selected="false">Received</a>
                                        <a class="nav-item nav-link" id="nav-Cancelled-tab" data-toggle="tab" href="#nav-Cancelled" role="tab" aria-controls="nav-Cancelled" aria-selected="false">Cancelled</a>
                                    </div>
                                </nav>
                                <div class="tab-content pl-3 pt-2" id="nav-tabContent">

                                    <div class="tab-pane fade show active" id="nav-Approved" role="tabpanel" aria-labelledby="nav-Approved-tab">

                                        <!-- Approved -->
                                        <div class="table-responsive">
                                            <table class="table table-colored table-centered table-inverse m-0" id="dataTable_1" width="100%" cellspacing="0">
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
                                           foreach($Approved as $appro){ ?>
                                                <td><?= ucfirst(htmlentities($appro['reference_no'])); ?></td>
                                                <td><?= ucfirst(htmlentities($appro['customer_name'])); ?></td>
                                                <td><?= date('M-d-Y h:i A', strtotime(htmlentities($appro['date_created']))); ?></td>
                                                <td><?= ucfirst(htmlentities($appro['item'])); ?></td>
                                                <td><?= date('M-d-Y', strtotime(htmlentities($appro['date_created']))); ?></td>
                                                <td><?= ucfirst(htmlentities($appro['qty'])); ?></td>
                                                <td>&#8369; <?= ucfirst(htmlentities(number_format($appro['price'],0))); ?></td>
                                                 <td><span class="right badge badge-success"><?= htmlentities($appro['status']);?></span></td>
                                                 <td><?= ucfirst(htmlentities($appro['remarks'])); ?></td>

                                               </tr>

                                                    <?php $found_rows = true; }  if (!isset($found_rows)) echo "<tr><td colspan ='7'><div class='alert alert-danger' style='font-weight:bold;'>No records found.</div></td></tr>"; 
                                                ?>



                                                </tbody>
                                            </table>
                                        </div>

                                        <!--End Approved -->

                                    </div>
                                    <div class="tab-pane fade" id="nav-Deliver" role="tabpanel" aria-labelledby="nav-Deliver-tab">
                                        <!-- deliver -->
                                        <div class="table-responsive">
                                            <table class="table table-colored table-centered table-inverse m-0" id="dataTable_2" width="100%" cellspacing="0">
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
                                           foreach($ToDeliver as $deliver){ ?>
                                                <td><?= ucfirst(htmlentities($deliver['reference_no'])); ?></td>
                                                <td><?= ucfirst(htmlentities($deliver['customer_name'])); ?></td>
                                                <td><?= date('M-d-Y h:i A', strtotime(htmlentities($deliver['date_created']))); ?></td>
                                                <td><?= ucfirst(htmlentities($deliver['item'])); ?></td>
                                                <td><?= date('M-d-Y', strtotime(htmlentities($deliver['date_created']))); ?></td>
                                                <td><?= ucfirst(htmlentities($deliver['qty'])); ?></td>
                                                <td>&#8369; <?= ucfirst(htmlentities(number_format($deliver['price'],0))); ?></td>
                                                 <td><span class="right badge badge-primary"><?= htmlentities($deliver['status']);?></span></td>
                                                 <td><?= ucfirst(htmlentities($deliver['remarks'])); ?></td>

                                               </tr>

                                                    <?php $found_rows = true; }  if (!isset($found_rows)) echo "<tr><td colspan ='7'><div class='alert alert-danger' style='font-weight:bold;'>No records found.</div></td></tr>"; 
                                                ?>


                                                </tbody>
                                            </table>
                                        </div>

                                        <!--End deliver -->
                                    </div>
                                    <div class="tab-pane fade" id="nav-Received" role="tabpanel" aria-labelledby="nav-Received-tab">
                                        <!-- received -->
                                        <div class="table-responsive">
                                           <table class="table table-colored table-centered table-inverse m-0" id="dataTable_3" width="100%" cellspacing="0">
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
                                           foreach($Received as $rec){ ?>
                                                <td><?= ucfirst(htmlentities($rec['reference_no'])); ?></td>
                                                <td><?= ucfirst(htmlentities($rec['customer_name'])); ?></td>
                                                <td><?= date('M-d-Y h:i A', strtotime(htmlentities($rec['date_created']))); ?></td>
                                                <td><?= ucfirst(htmlentities($rec['item'])); ?></td>
                                                <td><?= date('M-d-Y', strtotime(htmlentities($rec['date_created']))); ?></td>
                                                <td><?= ucfirst(htmlentities($rec['qty'])); ?></td>
                                                <td>&#8369; <?= ucfirst(htmlentities(number_format($rec['price'],0))); ?></td>
                                                 <td><span class="right badge badge-warning"><?= htmlentities($rec['status']);?></span></td>
                                                 <td><?= ucfirst(htmlentities($rec['remarks'])); ?></td>

                                               </tr>

                                                    <?php $found_rows = true; }  if (!isset($found_rows)) echo "<tr><td colspan ='7'><div class='alert alert-danger' style='font-weight:bold;'>No records found.</div></td></tr>"; 
                                                ?>



                                                </tbody>
                                            </table>
                                        </div>

                                        <!--End received -->
                                    </div>
                                    <div class="tab-pane fade" id="nav-Cancelled" role="tabpanel" aria-labelledby="nav-Cancelled-tab">
                                        <!-- cancelled -->
                                        <div class="table-responsive">
                                            <table class="table table-colored table-centered table-inverse m-0" id="dataTable_4" width="100%" cellspacing="0">
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
                                           foreach($Cancelled as $can){ ?>
                                                <td><?= ucfirst(htmlentities($can['reference_no'])); ?></td>
                                                <td><?= ucfirst(htmlentities($can['customer_name'])); ?></td>
                                                <td><?= date('M-d-Y h:i A', strtotime(htmlentities($can['date_created']))); ?></td>
                                                <td><?= ucfirst(htmlentities($can['item'])); ?></td>
                                                <td><?= date('M-d-Y', strtotime(htmlentities($can['date_created']))); ?></td>
                                                <td><?= ucfirst(htmlentities($can['qty'])); ?></td>
                                                <td>&#8369; <?= ucfirst(htmlentities(number_format($can['price'],0))); ?></td>
                                                 <td><span class="right badge badge-danger"><?= htmlentities($can['status']);?></span></td>
                                                 <td><?= ucfirst(htmlentities($can['remarks'])); ?></td>

                                               </tr>

                                                    <?php $found_rows = true; }  if (!isset($found_rows)) echo "<tr><td colspan ='7'><div class='alert alert-danger' style='font-weight:bold;'>No records found.</div></td></tr>"; 
                                                ?>



                                                </tbody>
                                            </table>
                                        </div>

                                        <!--End cancelled -->
                                    </div>
                                </div>

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



<script src="assets/js/modernizr.min.js"></script>
<script src="assets/js/modernizr.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<!-- Custom styles for this template -->
<link href="css/modern-business.css" rel="stylesheet">
<script>
    $(document).ready(function() {
        $('#dataTable_1').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        $('#dataTable_2').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        $('#dataTable_3').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        $('#dataTable_4').DataTable();
    });
</script>


<!-- 
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
<script src="assets/js/init-scripts/data-table/datatables-init.js"></script> -->



</body>

</html>