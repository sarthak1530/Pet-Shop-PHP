<?php

  session_start();

    include_once('config/conn/db_connection.php');
    include_once('config/class/petshop_class.php');

if(!isset($_SESSION['logged_in']))
    {
       header("location:index.php");
    }else{

    $user_session = trim($_SESSION['user_no']);

    $fetch = new Petshop_class();

    $countpet = $fetch->count_pets(); 
    $countpetproducts = $fetch->count_petproducts();
    $countcountvendors = $fetch->count_vendors(); 
    $quantity = $fetch->count_qty();  
    $prices = $fetch->count_price(); 


?>


<?php include 'header/main-header1.php';?>

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
                            <li><a href="main-vendor.php">Dashboard</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
         
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
 <!--/.col-->
    <div class="col-6 col-lg-6">
        <div class="card">
            <div class="card-body">
            <?php
                foreach($quantity as $oqty){ ?>
                <div class="clearfix">
                    <i class="fa fa-paw bg-flat-color-5 p-3 font-2xl mr-3 float-left text-light"></i>
                    <div class="h5 text-secondary mb-0 mt-1"><?= htmlentities(number_format($oqty['o_qty'])); ?></div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">Total Orders</div>
                </div>
               <?php } ?> 
                <div class="b-b-1 pt-3"></div>
                <hr>
                <div class="more-info pt-2" style="margin-bottom:-10px;">
                    <a class="font-weight-bold font-xs btn-block text-muted small" href="#">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!--/.col-->
       <div class="col-6 col-lg-6">
        <div class="card">
            <div class="card-body">
            
             <?php 

                $total = 0;

                foreach ($prices as $rows):
                
                $total += htmlentities($rows['qty']) * htmlentities($rows['price']); 

 
              ?>

               <?php endforeach ?>  
                <div class="clearfix">
                    <i class="fa fa-money bg-info p-3 font-2xl mr-3 float-left text-light"></i>
                    <div class="h5 text-secondary mb-0 mt-1"><?= number_format($total,2); ?></div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">Total Incomes</div>
                </div>
                <?php } ?> 
                <div class="b-b-1 pt-3"></div>
                <hr>
                <div class="more-info pt-2" style="margin-bottom:-10px;">
                    <a class="font-weight-bold font-xs btn-block text-muted small" href="#">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
                </div>
            </div>
        </div>
    </div>
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="assets/js/init-scripts/data-table/datatables-init.js"></script>


</body>

</html>
