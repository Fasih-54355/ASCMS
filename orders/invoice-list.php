<?php


include('../header.php');
include('functions.php');
include('../sidebar.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<!-- JS -->
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="InvoiceMg-PHP/js/moment.js"></script>
	<script src="InvoiceMg-PHP/js/bootstrap.min.js"></script>
	<script src="InvoiceMg-PHP///cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>
	<script src="InvoiceMg-PHP///cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	<script src="InvoiceMg-PHP/js/bootstrap.datetime.js"></script>
	<script src="InvoiceMg-PHP/js/bootstrap.password.js"></script>
	<script src="InvoiceMg-PHP/js/scripts.js"></script>
	
	<link rel="stylesheet" href="InvoiceMg-PHP/css/bootstrap.min.css">
	<link rel="stylesheet" href="InvoiceMg-PHP/css/styles.css">
	<!-- <link href="../../assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
	<link href="../css/style.css" rel="stylesheet">
<style>
    
    .left-sidebar {
        width: 220px;
    }

    .page-wrapper {
        margin-left: 220px;
        transition: margin-left 0.5s;
    }

    .left-sidebar .sidebar-nav ul#sidebarnav li a {
        text-align: left;
        z-index: 0; /* Set a lower z-index for the items below */
    }

    .left-sidebar .sidebar-nav ul#sidebarnav li.with-subitems:hover ~ li {
        margin-top: 50px; /* Adjust the margin-top based on the height of the subitems */
    }
</style>
<body>
	
	<div class="page-wrapper">
		<!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
    <div class="header">
            <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark"
                                href="javascript:void(0)"><i class="fa fa-bars"></i></a> </li>

                                <nav>
                                    <a href="orders_panel.php">Home</a><!--
                                        --><a href="create_invoice.php">Invoice</a><!--
                                        --><a href="invoice-list.php">Manage Invoice</a>
                                </nav>
                        </li>
                    </ul>
            </div>                    
      </div>

	<div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

	<h1>Invoice List</h1>
	<hr>

<div class="row">

	<div class="col-xs-12">

		<div id="response" class="alert alert-success" style="display:none;">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<div class="message"></div>
		</div>
	
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4>Manage Invoices</h4>
			</div>
			<div class="panel-body form-group form-group-sm">
				<?php getInvoices(); ?>
			</div>
		</div>
	</div>
<div>

<div id="delete_invoice" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete Invoice</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this invoice?</p>
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
		<button type="button" data-dismiss="modal" class="btn">Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
</div>

<?php
	include('../footer.php');
?>
</body>
</html>