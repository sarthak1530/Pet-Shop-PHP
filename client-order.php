
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
    $orders = $ordr->fetch_order($user_session); 

?>

<?php include 'header/main-header2.php';?>

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
                            <li><a href="main-customer.php">Dashboard</a></li>
                            <li class="active">Orders</li>
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
                                <strong class="card-title">Orders Table</strong>
                                  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#smallmodal_o<?php echo $user_session;?>" style="margin-left:77%"><i class="fa fa-plus">Add</i>
                               </button>
                             </a>
                            </div>
                            <div class="card-body">
                              <div class="table-responsive">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Reference No.</th>
                                           <!--  <th>Customer Name</th>
 -->                                        <th>Item</th>
                                            <th>QTY</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Remarks</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                       <?php
                                          foreach($orders as $odr){ ?>
                                        <td><?= ucfirst(htmlentities($odr['reference_no'])); ?></td>
                                       <!--  <td><?= ucfirst(htmlentities($odr['customer_name'])); ?></td> -->
                                        <td><?= ucfirst(htmlentities($odr['item'])); ?></td>
                                        <td><?= ucfirst(htmlentities($odr['qty'])); ?></td>
                                        <td>&#8369; <?= ucfirst(htmlentities(number_format($odr['price'],0))); ?></td>
                                        <td><?= ucfirst(htmlentities($odr['status'])); ?></td>
                                        <td><?= ucfirst(htmlentities($odr['remarks'])); ?></td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-xs corder" data-toggle="modal" data-target="#edit-corder" data-order="<?= htmlentities($odr['order_id']); ?>"><i class="fa fa-pencil"></i> 
                                            </button>
                                            <button type="button" class="btn btn-danger btn-xs delorder" data-toggle="modal" data-target="#del-corder" data-delo="<?= htmlentities($odr['order_id']); ?>"><i class="fa fa-trash"></i> 
                                            </button>
                                        </td>
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

 <?php include 'modal/clientorder_modal.php';?>
 <?php include 'modal/clientorderedit_modal.php';?>
 <?php include 'modal/clientorderdelete_modal.php';?>

     <script>
           $(document).ready(function() {   
               load_data();    
               var count = 1; 
               function load_data() {
                   $(document).on('click', '.corder', function() {
                    // $('#edit_category').modal('show');
                        var order_id = $(this).data("order");
                      // console.log(category_id);
                          getIDa(order_id); //argument    
                 
                   });
                }

                 function getIDa(order_id) {
                      $.ajax({
                          type: 'POST',
                          url: 'fetch_row/order_row.php',
                          data: {
                              order_id: order_id
                          },
                          dataType: 'json',
                          success: function(response) {
                          $('#edit_orderid').val(response.order_id);
                          $('#edit_referenceno').val(response.reference_no);
                          $('#edit_item').val(response.item);
                          $('#edit_qty').val(response.qty);
                          $('#edit_price').val(response.price);
                          $('#edit_status').val(response.status);
                          $('#edit_remarks').val(response.remarks);
                          //$('#edit_retailprice').val(response.retail_price);

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
                   $(document).on('click', '.delorder', function() {
                    // $('#delete-activity').modal('show');
                        let order_id = $(this).data("delo");
                       // console.log(logid);
                        getIDs_del(order_id); //argument    
                 
                   });
                }

                 function getIDs_del(order_id) {
                      $.ajax({
                          type: 'POST',
                          url: 'fetch_row/order_row.php',
                          data: {
                              order_id: order_id
                          },
                          dataType: 'json',
                          success: function(responses2) {
                          $('#del_orderid').val(responses2.order_id);
                          $('#del_referenceno').val(responses2.reference_no);

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
