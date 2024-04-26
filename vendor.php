
<?php
   
   session_start();

    include_once('config/conn/db_connection.php');
    include_once('config/class/petshop_class.php');


    if(!isset($_SESSION['logged_in']))
    {
       header("location:index.php");
    }else{

    $user_session = trim($_SESSION['user_no']);
    $ven = new Petshop_class();
    $Vendor = $ven->fetch_vendor(); 
    $controls = $ven->fetch_usergroupControl($user_session); 


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
                            <li class="active">Vendor Management</li>
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
                                <strong class="card-title">Vendor Management Table</strong>
                                <button type="button" id="control_add" class="btn btn-success btn-sm" data-toggle="modal" data-target="#smallmodal4" style="margin-left:87%"><i class="fa fa-plus">Add</i>
                               </button>
                            </div>
                            <div class="card-body">
                              <div class="table-responsive">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Company Name</th>
                                            <th>Contact Person</th>
                                            <th>Email</th>
                                            <th>Contact Number</th>
                                            <th>Website</th>
                                            <th>About The Company</th>
                                   <!--          <th>UserName</th>
                                            <th>Password</th> -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                          foreach($Vendor as $vndr){ ?>

                                           <td><?= ucfirst(htmlentities($vndr['company_name'])); ?></td>
                                           <td><?= ucfirst(htmlentities($vndr['contact_person'])); ?></td>
                                           <td><?= htmlentities($vndr['email']); ?></td>
                                           <td><?= ucfirst(htmlentities($vndr['contact_number'])); ?></td>
                                           <td><?= htmlentities($vndr['website']); ?></td>
                                           <td><?= ucfirst(htmlentities($vndr['about_company'])); ?></td>
                             <!--               <td><?= htmlentities($vndr['username']); ?></td>
                                           <td><?= htmlentities($vndr['password']); ?></td>
 -->
                                           <td>
                                            <Div class="d-flex">
                                              <div class="flex-1">
                                            <button type="button" id="control_edit" class="btn btn-info btn-xs ven" data-toggle="modal" data-target="#edit-vendor" data-vendr="<?= htmlentities($vndr['vendor_id']); ?>"><i class="fa fa-pencil"></i> 
                                            </button>
                                          </div>
                                          <div class="flex-1">
                                            <button type="button" id="control_delete" class="btn btn-danger btn-xs vendel" data-toggle="modal" data-target="#del-vendor" data-vdel="<?= htmlentities($vndr['vendor_id']); ?>"><i class="fa fa-trash"></i> 
                                            </button>
                                          </div>
                                          </Div>
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
   <?php include 'modal/vendor_modal.php';?>
   <?php include 'modal/vendoredit_modal.php';?>
   <?php include 'modal/vendordelete_modal.php';?>


          <script>
           $(document).ready(function() {   
               load_data();    
               var count = 1; 
               function load_data() {
                   $(document).on('click', '.ven', function() {
                    // $('#edit_category').modal('show');
                        var vendor_id = $(this).data("vendr");
                      // console.log(category_id);
                          getIDa(vendor_id); //argument    
                 
                   });
                }

                 function getIDa(vendor_id) {
                      $.ajax({
                          type: 'POST',
                          url: 'fetch_row/vendor_row.php',
                          data: {
                              vendor_id: vendor_id
                          },
                          dataType: 'json',
                          success: function(response) {
                          $('#edit_vendorid').val(response.vendor_id);
                          $('#edit_companyname').val(response.company_name);
                          $('#edit_contactperson').val(response.contact_person);
                          $('#edit_email').val(response.email);
                          $('#edit_contactnumber').val(response.contact_number);
                          $('#edit_website').val(response.website);
                          $('#edit_aboutcompany').val(response.about_company);
                          $('#edit_username').val(response.username);
                          $('#edit_password').val(response.password);

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
                   $(document).on('click', '.vendel', function() {
                    // $('#delete-activity').modal('show');
                        let vendor_id = $(this).data("vdel");
                       // console.log(logid);
                        getIDs_del(vendor_id); //argument    
                 
                   });
                }

                 function getIDs_del(vendor_id) {
                      $.ajax({
                          type: 'POST',
                          url: 'fetch_row/vendor_row.php',
                          data: {
                              vendor_id: vendor_id
                          },
                          dataType: 'json',
                          success: function(responses2) {
                          $('#del_vendorid').val(responses2.vendor_id);
                          $('#del_username').val(responses2.username);

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
