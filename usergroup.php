 <?php

  session_start();

    include_once('config/conn/db_connection.php');
    include_once('config/class/petshop_class.php');


   if(!isset($_SESSION['logged_in']))
    {
       header("location:index.php");
    }else{

    $user_session = trim($_SESSION['user_no']);
    $ugroup = new Petshop_class();
    $usergroup = $ugroup->fetch_usergroup(); 
    $controls = $ugroup->fetch_usergroupControl($user_session); 


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
                            <li class="active">User Control</li>
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
                                <strong class="card-title">User Control Table</strong>
                                <button type="button" id="control_add" class="btn btn-success btn-sm" data-toggle="modal" data-target="#smallmodal-g" style="margin-left:87%"><i class="fa fa-plus">Add</i>
                               </button>
                            </div>
                            <div class="card-body">
                              <div class="table-responsive">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Group Name</th>
                                            <th>Status</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                         <?php
                                          foreach($usergroup as $guser){ ?>

  
                                           <td><?= htmlentities($guser['full_name']); ?></td>
                                           <td><?= htmlentities($guser['stat']); ?></td>
                                           <td><?= htmlentities($guser['description']); ?></td>
                     
                                           <td>
                                            <div class="d-flex">
                                              <div class="flex-1">
                                                <button type="button" id="control_edit" class="btn btn-info btn-xs guseredits" data-toggle="modal" data-target="#edit-guser" data-gusrs="<?= htmlentities($guser['usergroup_id']); ?>"><i class="fa fa-pencil"></i> 
                                                </button>
                                              </div>
                                              <div class="flex-1">
                                            <button type="button" id="control_delete" class="btn btn-danger btn-xs userdel" data-toggle="modal" data-target="#del-usergroup" data-del="<?= htmlentities($guser['usergroup_id']); ?>"><i class="fa fa-trash"></i> 
                                            </button>
                                          </div>
                                          </div>
                                        </td>
                                        </td>
                                        </tr>
                                        <?php $found_rows = true; }  if (!isset($found_rows)) echo "<tr><td colspan ='3'><div class='alert alert-danger' style='font-weight:bold;'>No records found.</div></td></tr>"; 
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
<?php } ?>
<?php include 'modal/usergroup_modal.php';?>
<?php include 'modal/usergroupedit_modal.php';?>
<?php include 'modal/usergroupdelete_modal.php';?>


     <script>
           $(document).ready(function() {   
               load_data();    
               var count = 1; 
               function load_data() {
                   $(document).on('click', '.guseredits', function() {
                    // $('#edit_category').modal('show');
                        var usergroup_id = $(this).data("gusrs");
                        // console.log(user_id);
                          getIDa(usergroup_id); //argument    
                 
                   });
                }



                 function getIDa(usergroup_id) {
                      $.ajax({
                          type: 'POST',
                          url: 'fetch_row/usergroup_row.php',
                          data: {
                              usergroup_id: usergroup_id
                          },
                          dataType: 'json',
                          success: function(response) {
                          $('#edit_usergroupid').val(response.usergroup_id);
                          $('#edit_userid').val(response.user_id);
                          $('#edit_status').val(response.stat);
                          $('#edit_description').val(response.description);

                          $('#edit_allowadd').val(response.allow_add).click().each(function(e){///if checkbox is  value 1 the checkbox is checked if 0 unchecked by:nel
                              if($(this).val() == 1){
                                  $(this).prop("checked", true);
                              }else{
                                   $(this).prop("checked", false);
                              }
                          });

                          $('#edit_allowedit').val(response.allow_edit).click().each(function(e){
                              if($(this).val() == 1){
                                  $(this).prop("checked", true);
                              }else{
                                   $(this).prop("checked", false);
                              }
                          });
                          $('#edit_allowdelete').val(response.allow_delete).click().each(function(e){
                              if($(this).val() == 1){
                                  $(this).prop("checked", true);
                              }else{
                                   $(this).prop("checked", false);
                              }
                          });
                          $('#edit_allowexport').val(response.allow_export).click().each(function(e){
                              if($(this).val() == 1){
                                  $(this).prop("checked", true);
                              }else{
                                   $(this).prop("checked", false);
                              }
                          });
                  

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
                        let usergroup_id = $(this).data("del");
                       // console.log(logid);
                        getIDs_del(usergroup_id); //argument    
                 
                   });
                }

                 function getIDs_del(usergroup_id) {
                      $.ajax({
                          type: 'POST',
                          url: 'fetch_row/usergroup_row.php',
                          data: {
                              usergroup_id: usergroup_id
                          },
                          dataType: 'json',
                          success: function(responses2) {
                          $('#del_usergroupid').val(responses2.usergroup_id);
                          $('#del_fullnamegroup').val(responses2.full_name);

                       }
                    });
                 }
           
           });
            
    </script>



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
