  <?php

    session_start();

    include_once('config/conn/db_connection.php');
    include_once('config/class/petshop_class.php');


    if(!isset($_SESSION['logged_in']))
    {
       header("location:index.php");
    }else{

    $user_session = trim($_SESSION['user_no']);
    $ser = new Petshop_class();
    $services = $ser->fetch_services(); 
    $controls = $ser->fetch_usergroupControl($user_session); 


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
     <!--                        <a class="nav-link" href="#"><i class="fa fa-user"></i> My Profile</a>

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
                            <li class="active">Services Management</li>
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
                                <strong class="card-title">Services Management Table</strong>
                                <button type="button" id="control_add" class="btn btn-success btn-sm" data-toggle="modal" data-target="#smallmodal5" style="margin-left:87%"><i class="fa fa-plus">Add</i>
                               </button>
                            </div>
                            <div class="card-body">
                              <div class="table-responsive">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Reference No.</th>
                                            <th>Service</th>
                                            <th>Detail</th>
                                            <th>Service Fee</th>
                                            <th>Vendor</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <?php
                                          foreach($services as $srvce){ ?>

                                           <td><?= ucfirst(htmlentities($srvce['reference_no'])); ?></td>
                                           <td><?= ucfirst(htmlentities($srvce['service'])); ?></td>
                                           <td><?= ucfirst(htmlentities($srvce['service_detail'])); ?></td>
                                           <td>&#8369; <?= ucfirst(htmlentities(number_format($srvce['service_fee'],0))); ?></td>
                                           <td><?= ucfirst(htmlentities($srvce['vendor'])); ?></td>
                                       
                                           <td>
                                            <div class="d-flex">
                                              <div class="flex-1">
                                                <button type="button" id="control_edit" class="btn btn-info btn-xs serviceedit" data-toggle="modal" data-target="#edit-service" data-serv="<?= htmlentities($srvce['services_id']); ?>"><i class="fa fa-pencil"></i> 
                                                </button>
                                              </div>
                                              <div class="flex-1">
                                            <button type="button" id="control_delete" class="btn btn-danger btn-xs serdel" data-toggle="modal" data-target="#del-services" data-del="<?= htmlentities($srvce['services_id']); ?>"><i class="fa fa-trash"></i> 
                                            </button>
                                          </div>
                                          </div>
                                        </td>
                                        </td>
                                        </tr>
                                        <?php $found_rows = true; }  if (!isset($found_rows)) echo "<tr><td colspan ='6'><div class='alert alert-danger' style='font-weight:bold;'>No records found.</div></td></tr>"; 
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
   <?php include 'modal/services_modal.php';?>
   <?php include 'modal/servicesedit_modal.php';?>
   <?php include 'modal/servicesdelete_modal.php';?>



          <script>
           $(document).ready(function() {   
               load_data();    
               var count = 1; 
               function load_data() {
                   $(document).on('click', '.serviceedit', function() {
                    // $('#edit_category').modal('show');
                        var services_id = $(this).data("serv");
                      // console.log(category_id);
                          getIDa(services_id); //argument    
                 
                   });
                }

                 function getIDa(services_id) {
                      $.ajax({
                          type: 'POST',
                          url: 'fetch_row/services_row.php',
                          data: {
                              services_id: services_id
                          },
                          dataType: 'json',
                          success: function(response) {
                          $('#edit_servicesid').val(response.services_id);
                          $('#edit_referenceno').val(response.reference_no);
                          $('#edit_service').val(response.service);
                          $('#edit_servicedetail').val(response.service_detail);
                          $('#edit_vendor').val(response.vendor);
                          $('#edit_servicefee').val(response.service_fee);

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
                   $(document).on('click', '.serdel', function() {
                    // $('#delete-activity').modal('show');
                        let services_id = $(this).data("del");
                       // console.log(logid);
                        getIDs_del(services_id); //argument    
                 
                   });
                }

                 function getIDs_del(services_id) {
                      $.ajax({
                          type: 'POST',
                          url: 'fetch_row/services_row.php',
                          data: {
                              services_id: services_id
                          },
                          dataType: 'json',
                          success: function(responses2) {
                          $('#del_servicesid').val(responses2.services_id);
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
