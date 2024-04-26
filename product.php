
<?php

  session_start();

    include_once('config/conn/db_connection.php');
    include_once('config/class/petshop_class.php');


    if(!isset($_SESSION['logged_in']))
    {
       header("location:index.php");
    }else{

    $user_session = trim($_SESSION['user_no']);
    $pro = new Petshop_class();
    $product = $pro->fetch_product();
    $controls = $pro->fetch_usergroupControl($user_session); 


    foreach ($controls as $row) {

//////////////////////////allow add///////////////////////////////

           if (htmlentities($row['allow_add']) == 0) {
               echo "<style>
                     #control_add {
                       display: none;   
                      }        
                   </style>";
              } else if (htmlentities($row['allow_add']) == 1) {
               echo "<style>
                     #control_add {
                       display: block;   
                      }        
                   </style>";
              }
 //////////////////////////allow edit///////////////////////////////


//////////////////////////allow add///////////////////////////////

           if (htmlentities($row['allow_edit']) == 0) {
               echo "<style>
                     #control_edit {
                       display: none;   
                      }        
                   </style>";
              } else if (htmlentities($row['allow_edit']) == 1) {
               echo "<style>
                     #control_edit {
                       display: block;   
                      }        
                   </style>";
              }
 //////////////////////////allow edit///////////////////////////////

//////////////////////////allow delete///////////////////////////////

           if (htmlentities($row['allow_delete']) == 0) {
               echo "<style>
                     #control_delete {
                       display: none;   
                      }        
                   </style>";
              } else if (htmlentities($row['allow_delete']) == 1) {
               echo "<style>
                     #control_delete {
                       display: block;   
                      }        
                   </style>";
              }
 //////////////////////////allow delete///////////////////////////////


         }
 

?>

<?php include 'header/main-header.php';?>

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks" style="padding-top:30%"></i></a>
   
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
                            <li class="active">Pet Product</li>
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
                                <strong class="card-title">Pet Product Table</strong>
                                <button type="button" id="control_add" class="btn btn-success btn-sm" data-toggle="modal" data-target="#smallmodal3" style="margin-left:87%"><i class="fa fa-plus">Add</i>
                               </button>
                            </div>
                            <div class="card-body">
                              <div class="table-responsive">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Product Code</th>
                                            <th>Name</th>
                                            <th>Detail</th>
                                            <th>Category</th>
                                            <th>Qty</th>
                                            <th>Vendor Price</th>
                                            <th>Retail Price</th>
                                            <th>Discount</th>
                                            <th>Vendor</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                          <tr>
                                       <?php
                                          foreach($product as $pduct){ ?>
                                        <td><?= ucfirst(htmlentities($pduct['product_code'])); ?></td>
                                        <td><?= ucfirst(htmlentities($pduct['product_name'])); ?></td>
                                        <td><?= ucfirst(htmlentities($pduct['detail'])); ?></td>
                                        <td><?= ucfirst(htmlentities($pduct['category'])); ?></td>
                                        <td><?= ucfirst(htmlentities($pduct['qty'])); ?></td>
                                        <td>&#8369; <?= ucfirst(htmlentities(number_format($pduct['vendor_price'],0))); ?></td>
                                        <td>&#8369; <?= ucfirst(htmlentities(number_format($pduct['retail_price'],0))); ?></td>
                                        <td><?= ucfirst(htmlentities($pduct['disc'])); ?> %</td>
                                        <td><?= ucfirst(htmlentities($pduct['vendor'])); ?></td>
                                        <td><?= ucfirst(htmlentities($pduct['status'])); ?></td>

                                        <td>
                                          <div class="d-flex">
                                            <div class="flex-1">
                                            <button type="button" id="control_edit"  class="btn btn-info btn-xs product" data-toggle="modal" data-target="#edit-product" data-product="<?= htmlentities($pduct['product_id']); ?>"><i class="fa fa-pencil"></i> 
                                            </button>
                                          </div>
                                          <div class="flex-1">
                                            <button type="button" id="control_delete" class="btn btn-danger btn-xs pduct" data-toggle="modal" data-target="#del-product" data-prodct="<?= htmlentities($pduct['product_id']); ?>"><i class="fa fa-trash"></i> 
                                            </button>
                                          </div>
                                          </div>
                                        </td>
                                        </tr>

                                      <?php $found_rows = true; }  if (!isset($found_rows)) echo "<tr><td colspan ='11'><div class='alert alert-danger' style='font-weight:bold;'>No records found.</div></td></tr>"; 
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
    <?php include 'modal/product_modal.php';?>
    <?php include 'modal/productedit_modal.php';?>
    <?php include 'modal/productdelete_modal.php';?>


          <script>
           $(document).ready(function() {   
               load_data();    
               var count = 1; 
               function load_data() {
                   $(document).on('click', '.product', function() {
                    // $('#edit_category').modal('show');
                        var product_id = $(this).data("product");
                      // console.log(category_id);
                          getIDa(product_id); //argument    
                 
                   });
                }

                 function getIDa(product_id) {
                      $.ajax({
                          type: 'POST',
                          url: 'fetch_row/product_row.php',
                          data: {
                              product_id: product_id
                          },
                          dataType: 'json',
                          success: function(response) {
                          $('#edit_productid').val(response.product_id);
                          $('#edit_productcode').val(response.product_code);
                          $('#edit_productname').val(response.product_name);
                          $('#edit_detail').val(response.detail);
                          $('#edit_category').val(response.category);
                          $('#edit_qty').val(response.qty);
                          $('#edit_vendorprice').val(response.vendor_price);
                          $('#edit_retailprice').val(response.retail_price);
                          $('#edit_disc').val(response.disc);
                          $('#edit_vendor').val(response.vendor);
                          $('#edit_status').val(response.status);

                       }
                    });
                 }
           
           });
            
     </script>

          <script>
           $(document).ready(function() {   
               load_data();    
               var count = 1; 
               function load_data() {
                   $(document).on('click', '.pduct', function() {
                    // $('#delete-activity').modal('show');
                        let product_id = $(this).data("prodct");
                       // console.log(logid);
                        getIDs_del(product_id); //argument    
                 
                   });
                }

                 function getIDs_del(product_id) {
                      $.ajax({
                          type: 'POST',
                          url: 'fetch_row/product_row.php',
                          data: {
                              product_id: product_id
                          },
                          dataType: 'json',
                          success: function(responses2) {
                          $('#del_productid').val(responses2.product_id);
                          $('#del_productname').val(responses2.product_name);

                       }
                    });
                 }
           
           });
            
    </script>


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
