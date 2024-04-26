 <?php

  session_start();

    include_once('config/conn/db_connection.php');
    include_once('config/class/petshop_class.php');


   if(!isset($_SESSION['logged_in']))
    {
       header("location:index.php");
    }else{

    $user_session = trim($_SESSION['user_no']);
    $usr = new Petshop_class();
    $users = $usr->fetch_users(); 
    $controls = $usr->fetch_usergroupControl($user_session); 


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
                            <li class="active">User Management</li>
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
                                <strong class="card-title">User Management Table</strong>
                                <button type="button" id="control_add" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-user" style="margin-left:87%"><i class="fa fa-plus">Add</i>
                               </button>
                            </div>
                            <div class="card-body">
                              <div class="table-responsive">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>avatar</th>
                                            <th>Fullname</th>
                                            <th>Username</th>
                                            <th>Password</th>
<!--                                             <th>Contact</th>
                                            <th>Email</th> -->
                                          <!--   <th>User Category</th> -->
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                  <tr>
                                        <?php
                                          foreach($users as $user){ ?>

                                           <td><img src="<?= ucfirst(htmlentities($user['avatar'])); ?>" alt="Profile" class="brand-image img-square elevation-3" width="70" style="opacity: .8;border: 1px solid gray"></td>
                                           <td><?= ucwords(htmlentities($user['full_name'])); ?></td>
                                           <td><?= htmlentities($user['username']); ?></td>
                                           <td><?= htmlentities($user['password']); ?></td>
<!--                                            <td><?= ucfirst(htmlentities($user['contact'])); ?></td>
                                           <td><?= htmlentities($user['email']); ?></td> -->
                                          <!--  <td><?= ucfirst(htmlentities($user['user_category'])); ?></td> -->
                                           <td>
                                            <?php
                                             if(htmlentities($user['status']) == 'Active'){
                                                 echo '<span class="right badge badge-success">'.htmlentities($user['status']).'</span>';
                                               }else{
                                                 echo '<span class="right badge badge-danger">'.htmlentities($user['status']).'</span>';
                                               }

                                             ?>
                                            
                                          </td>
                                       
                                           <td>
                                            <div class="d-flex">
                                              <div class="flex-1">
                                                <button type="button" id="control_edit" class="btn btn-info btn-xs useredits" data-toggle="modal" data-target="#edit-user" data-usrs="<?= htmlentities($user['user_id']); ?>"><i class="fa fa-pencil"></i> 
                                                </button>
                                              </div>
                                              <div class="flex-1">
                                            <button type="button" id="control_delete" class="btn btn-danger btn-xs userdel" data-toggle="modal" data-target="#del-user" data-del="<?= htmlentities($user['user_id']); ?>"><i class="fa fa-trash"></i> 
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
    <?php include 'modal/user_modal.php';?>
    <?php include 'modal/useredit_modal.php';?>
    <?php include 'modal/userdelete_modal.php';?>

     <script>
           $(document).ready(function() {   
               load_data();    
               var count = 1; 
               function load_data() {
                   $(document).on('click', '.useredits', function() {
                    // $('#edit_category').modal('show');
                        var user_id = $(this).data("usrs");
                        // console.log(user_id);
                          getIDa(user_id); //argument    
                 
                   });
                }

                 function getIDa(user_id) {
                      $.ajax({
                          type: 'POST',
                          url: 'fetch_row/user_row.php',
                          data: {
                              user_id: user_id
                          },
                          dataType: 'json',
                          success: function(response) {
                          $('#edit_userid').val(response.user_id);
                          $('#edit_fullname').val(response.full_name);
                          $('#edit_username').val(response.username);
                          $('#edit_password').val(response.password);
                          $('#edit_contact').val(response.contact);
                          $('#edit_email').val(response.email);
                          $('#edit_usercategory').val(response.user_category);
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
                   $(document).on('click', '.userdel', function() {
                    // $('#delete-activity').modal('show');
                        let user_id = $(this).data("del");
                       // console.log(logid);
                        getIDs_del(user_id); //argument    
                 
                   });
                }

                 function getIDs_del(user_id) {
                      $.ajax({
                          type: 'POST',
                          url: 'fetch_row/user_row.php',
                          data: {
                              user_id: user_id
                          },
                          dataType: 'json',
                          success: function(responses2) {
                          $('#del_userid').val(responses2.user_id);
                          $('#del_fullname').val(responses2.full_name);

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
