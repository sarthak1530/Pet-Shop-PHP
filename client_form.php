  <?php

   session_start();

    include_once('config/conn/db_connection.php');
    include_once('config/class/petshop_class.php');



    if(!isset($_SESSION['logged_in']))
    {
       header("location:index.php");
    }else{

    $user_session = trim($_SESSION['user_no']);
    $cli = new Petshop_class();
    $client = $cli->fetch_client(); 
    $controls = $cli->fetch_usergroupControl($user_session); 


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
  <!--                           <a class="nav-link" href="#"><i class="fa fa-user"></i> My Profile</a>

                            <a class="nav-link" href="#"><i class="fa fa-cog"></i> Settings</a>
 -->
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
                            <li class="active">Client Form</li>
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
                                <strong class="card-title">Client Form Table</strong>
                                <button type="button" id="control_add" class="btn btn-success btn-sm" data-toggle="modal" data-target="#smallmodal4" style="margin-left:87%"><i class="fa fa-plus">Add</i>
                               </button>
                            </div>
                            <div class="card-body">
                              <div class="table-responsive">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Profile</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Contact Number</th>
                                            <th>Email Address</th>
                                            <th>Gender</th>
                                            <th>Civil Status</th>
                                            <th>Birth Date</th>
                                            <th>Account Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <?php
                                          foreach($client as $clnt){ ?>

                                        <td><img src="<?= ucfirst(htmlentities($clnt['image_profile'])); ?>" alt="Profile" class="brand-image img-square elevation-3" width="70" style="opacity: .8;border: 1px solid gray"></td>
                                           <td><?= ucfirst(htmlentities($clnt['first_name'])); ?></td>
                                           <td><?= ucfirst(htmlentities($clnt['last_name'])); ?></td>
                                           <td><?= ucfirst(htmlentities($clnt['contact_number'])); ?></td>
                                           <td><?= ucfirst(htmlentities($clnt['email_address'])); ?></td>
                                           <td><?= ucfirst(htmlentities($clnt['gender'])); ?></td>
                                           <td><?= ucfirst(htmlentities($clnt['civil_status'])); ?></td>
                                           <td><?= ucfirst(htmlentities($clnt['birth_date'])); ?></td>
                                           <td>
                                            <?php
                                             if(htmlentities($clnt['status']) == 'Active'){
                                                 echo '<span class="right badge badge-success">'.htmlentities($clnt['status']).'</span>';
               
                                               }else{
                                                  echo '<span class="right badge badge-danger">'.htmlentities($clnt['status']).'</span>';
                                               }

                                             ?>
                                            
                                          </td>
                                       
                                           <td>
                                            <div class="d-flex">
                                              <div class="flex-1">
                                                <button type="button" id="control_edit" class="btn btn-info btn-xs clientedit" data-toggle="modal" data-target="#edit-client" data-clnt="<?= htmlentities($clnt['client_id']); ?>"><i class="fa fa-pencil"></i> 
                                                </button>
                                              </div>
                                              <div class="flex-1">
                                            <button type="button" id="control_delete" class="btn btn-danger btn-xs petdel" data-toggle="modal" data-target="#del-client" data-del="<?= htmlentities($clnt['client_id']); ?>"><i class="fa fa-trash"></i> 
                                            </button>
                                          </div>
                                          </div>
                                        </td>
                                        </td>
                                        </tr>
                                        <?php $found_rows = true; }  if (!isset($found_rows)) echo "<tr><td colspan ='10'><div class='alert alert-danger' style='font-weight:bold;'>No records found.</div></td></tr>"; 
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
   <?php include 'modal/client_modal.php';?>
   <?php include 'modal/clientedit_modal.php';?>
   <?php include 'modal/clientdelete_modal.php';?>


     <script>
           $(document).ready(function() {   
               load_data();    
               var count = 1; 
               function load_data() {
                   $(document).on('click', '.clientedit', function() {
                    // $('#edit_category').modal('show');
                        var client_id = $(this).data("clnt");
                      // console.log(category_id);
                          getIDa(client_id); //argument    
                 
                   });
                }

                 function getIDa(client_id) {
                      $.ajax({
                          type: 'POST',
                          url: 'fetch_row/client_row.php',
                          data: {
                              client_id: client_id
                          },
                          dataType: 'json',
                          success: function(response) {
                          $('#edit_clientid').val(response.client_id);
                          $('#edit_firstname').val(response.first_name);
                          $('#edit_middlename').val(response.middle_name);
                          $('#edit_lastname').val(response.last_name);
                          $('#edit_completeaddress').val(response.complete_address);
                          $('#edit_emailaddress').val(response.email_address);
                          $('#edit_contactnumber').val(response.contact_number);
                          $('#edit_civilstatus').val(response.civil_status);
                          $('#edit_birthdate').val(response.birth_date);
                          $('#edit_username').val(response.username);
                          $('#edit_password').val(response.password);
                          $('#edit_status').val(response.status);
                          $('#edit_gender').val(response.gender);

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
                   $(document).on('click', '.petdel', function() {
                    // $('#delete-activity').modal('show');
                        let client_id = $(this).data("del");
                       // console.log(logid);
                        getIDs_del(client_id); //argument    
                 
                   });
                }

                 function getIDs_del(client_id) {
                      $.ajax({
                          type: 'POST',
                          url: 'fetch_row/client_row.php',
                          data: {
                              client_id: client_id
                          },
                          dataType: 'json',
                          success: function(responses2) {
                          $('#del_clientid').val(responses2.client_id);
                          $('#del_name').val(responses2.last_name+' ,'+responses2.first_name);

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
