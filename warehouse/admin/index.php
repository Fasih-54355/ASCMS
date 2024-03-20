<?php require_once('../config.php'); ?>
<?php include('../../sidebar.php'); ?>
<?php include('../../header.php'); ?>

 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, AdminWrap lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, AdminWrap lite design, AdminWrap lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="AdminWrap Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <!-- Favicon icon -->
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png"> -->
    <!-- Bootstrap Core CSS -->
    <link href="../../assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../../css/style.css" rel="stylesheet">
    <!-- Include Chart.js library -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url ?>dist/css/adminlte.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/summernote/summernote-bs4.min.css">
     <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

     <!-- jQuery -->
    <script src="<?php echo base_url ?>plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url ?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?php echo base_url ?>plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="<?php echo base_url ?>plugins/toastr/toastr.min.js"></script>
    <script>
        var _base_url_ = '<?php echo base_url ?>';
    </script>
    <script src="<?php echo base_url ?>dist/js/script.js"></script>
    <script src="../assets/node_modules/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/node_modules/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="../js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../js/custom.min.js"></script>
    <!-- jQuery peity -->
    <script src="../assets/node_modules/peity/jquery.peity.min.js"></script>
    <script src="../assets/node_modules/peity/jquery.peity.init.js"></script>
  <!-- Include Bootstrap JS for card functionality -->
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

</head>
<body>
    <?php if($_settings->chk_flashdata('success')): ?>
      <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
      </script>
      <?php endif;?>    
     <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home';  ?>

  <!-- Page wrapper  -->
  <!-- ============================================================== -->
  <div class="page-wrapper">
      <!-- ============================================================== -->
      <!-- Container fluid  -->
      <!-- ============================================================== -->
      <div class="container-fluid">
          <!-- ============================================================== -->
          
          <?php require_once('inc/navigation.php') ?>

                          <!-- /.content -->
                  
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box bg-light shadow">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-th-list"></i></span>

                            <div class="info-box-content">
                            <span class="info-box-text">PO Records</span>
                            <span class="info-box-number text-right">
                                <?php 
                                    echo $conn->query("SELECT * FROM `purchase_order_list`")->num_rows;
                                ?>
                            </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box bg-light shadow">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-boxes"></i></span>

                            <div class="info-box-content">
                            <span class="info-box-text">Receiving Records</span>
                            <span class="info-box-number text-right">
                                <?php 
                                    echo $conn->query("SELECT * FROM `receiving_list`")->num_rows;
                                ?>
                            </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box bg-light shadow">
                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-exchange-alt"></i></span>

                            <div class="info-box-content">
                            <span class="info-box-text">BO Records</span>
                            <span class="info-box-number text-right">
                                <?php 
                                    echo $conn->query("SELECT * FROM `back_order_list`")->num_rows;
                                ?>
                            </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box bg-light shadow">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-undo"></i></span>

                            <div class="info-box-content">
                            <span class="info-box-text">Return Records</span>
                            <span class="info-box-number text-right">
                                <?php 
                                    echo $conn->query("SELECT * FROM `return_list`")->num_rows;
                                ?>
                            </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box bg-light shadow">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-file-invoice-dollar"></i></span>

                            <div class="info-box-content">
                            <span class="info-box-text">Sales Records</span>
                            <span class="info-box-number text-right">
                                <?php 
                                    echo $conn->query("SELECT * FROM `sales_list`")->num_rows;
                                ?>
                            </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box bg-light shadow">
                            <span class="info-box-icon bg-navy elevation-1"><i class="fas fa-truck-loading"></i></span>

                            <div class="info-box-content">
                            <span class="info-box-text">Suppliers</span>
                            <span class="info-box-number text-right">
                                <?php 
                                    echo $conn->query("SELECT * FROM `supplier_list` where `status` = 1")->num_rows;
                                ?>
                            </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box bg-light shadow">
                            <span class="info-box-icon bg-lightblue elevation-1"><i class="fas fa-th-list"></i></span>

                            <div class="info-box-content">
                            <span class="info-box-text">Items</span>
                            <span class="info-box-number text-right">
                                <?php 
                                    echo $conn->query("SELECT * FROM `item_list` where `status` = 1")->num_rows;
                                ?>
                            </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <?php if($_settings->userdata('type') == 1): ?>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box bg-light shadow">
                            <span class="info-box-icon bg-teal elevation-1"><i class="fas fa-users"></i></span>

                            <div class="info-box-content">
                            <span class="info-box-text">Users</span>
                            <span class="info-box-number text-right">
                                <?php 
                                    echo $conn->query("SELECT * FROM `users` where id != 1 ")->num_rows;
                                ?>
                            </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <?php endif; ?>
                </div>


                            <?php 
                              if(!file_exists($page.".php") && !is_dir($page)){
                                  // include '404.html';
                              }else{
                                if(is_dir($page))
                                  include $page.'/index.php';
                                else
                                  include $page.'.php';

                              }
                            ?>
                          </div>
                        <!-- </section> -->
                        <div class="modal fade" id="confirm_modal" role='dialog'>
                    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title">Confirmation</h5>
                      </div>
                      <div class="modal-body">
                        <div id="delete_content"></div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal fade" id="uni_modal" role='dialog'>
                    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title"></h5>
                      </div>
                      <div class="modal-body">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal fade" id="uni_modal_right" role='dialog'>
                    <div class="modal-dialog modal-full-height  modal-md" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span class="fa fa-arrow-right"></span>
                        </button>
                      </div>
                      <div class="modal-body">
                      </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal fade" id="viewer_modal" role='dialog'>
                    <div class="modal-dialog modal-md" role="document">
                      <div class="modal-content">
                              <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
                              <img src="" alt="">
                      </div>
                    </div>
                  </div>
        </div>
        <!-- /.content-wrapper -->
        <?php require_once('inc/footer.php') ?>
        
        <script>
          var page;
      $(document).ready(function(){
        page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
        page = page.replace(/\//gi,'_');

        if($('.nav-link.nav-'+page).length > 0){
              $('.nav-link.nav-'+page).addClass('active')
          if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
              $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
            $('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
          }
          if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
            $('.nav-link.nav-'+page).parent().addClass('menu-open')
          }

        }
        
      $('#receive-nav').click(function(){
        $('#uni_modal').on('shown.bs.modal',function(){
          $('#find-transaction [name="tracking_code"]').focus();
        })
        uni_modal("Enter Tracking Number","transaction/find_transaction.php");
      })
      })
    </script>
              <!-- All Jquery -->
      <!-- ============================================================== -->
      <script src="../../assets/node_modules/jquery/jquery.min.js"></script>
      <!-- Bootstrap tether Core JavaScript -->
      <script src="../../assets/node_modules/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- slimscrollbar scrollbar JavaScript -->
      <script src="../../js/perfect-scrollbar.jquery.min.js"></script>
      <!--Wave Effects -->
      <script src="../../js/waves.js"></script>
      <!--Menu sidebar -->
      <script src="../../js/sidebarmenu.js"></script>
      <!--Custom JavaScript -->
      <script src="../../js/custom.min.js"></script>
      <!-- jQuery peity -->
      <script src="../../assets/node_modules/peity/jquery.peity.min.js"></script>
      <script src="../../assets/node_modules/peity/jquery.peity.init.js"></script>
    <!-- Include Bootstrap JS for card functionality -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
</body>
</html>
