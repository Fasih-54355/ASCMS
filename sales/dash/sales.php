<?php
include '../../config.php';
include('sidebar.php');
include_once('../../header.php');
// sales data
$sql = "SELECT * FROM sales ORDER BY sale_id DESC";
$result = mysqli_query($conn, $sql);

$sales = array();
if ($result) {
    while($row = mysqli_fetch_assoc($result)) {
        $sales[] = $row;
    }
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
<?php include_once('layouts/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- <title> Admin: Home </title>
	<link rel="stylesheet" href="../includes/main_style.css" > -->
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, AdminWrap lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, AdminWrap lite design, AdminWrap lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="AdminWrap Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <!-- <link rel="canonical" href="https://www.wrappixel.com/templates/adminwrap-lite/" /> -->
    <!-- Favicon icon -->
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png"> -->
    <!-- Bootstrap Core CSS -->
    <link href="../../assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../../css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
    .scrollable-table {
    max-height: 500px; /* Adjust the height as needed */
    overflow-y: auto;
    overflow-x: hidden;
}
    
</style>
</head>
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
                                    <a href="admin.php">Home</a><!--
                                    --><a href="sales.php">Manage Sales</a>
                                    <a href="sales_report.php">Reports</a>
                                    <a href="sales_predict.php">Sales Prediction</a>
                                     <!--<a href="add_product.php"
                                      class="btn waves-effect waves-light btn btn-info pull-right hidden-sm-down text-white">+ Add Product</a> -->
                            </nav>
                        </li>
                    </ul>
            </div>
        </div>
        <br>
  <div class="row">
  <div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading clearfix">
      <strong>
        <span class="glyphicon glyphicon-th"></span>
        <span>All Sales</span>
      </strong>
      <div class="pull-right">
        <a href="add_sale.php" class="btn btn-primary">Add sale</a>
      </div>
    </div>
    <div class="panel-body">
    <div class="scrollable-table">
    <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th> Product name </th>
            <th class="text-center" style="width: 15%;"> Quantity</th>
            <th class="text-center" style="width: 15%;"> Total </th>
            <th class="text-center" style="width: 15%;"> Date </th>
            <th class="text-center" style="width: 100px;"> Actions </th>
          </tr>
          <tbody>
    <?php foreach ($sales as $sale): ?>
        <tr>
            <td class="text-center"><?php echo $sale['sale_id']; ?></td>
            <td><?php echo $sale['product_name']; ?></td>
            <td class="text-center"><?php echo (int)$sale['quantity_sold']; ?></td>
            <td class="text-center">$<?php echo $sale['revenue']; ?></td>
            <td class="text-center"><?php echo $sale['date']; ?></td>
            <td class="text-center">
                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                  Action
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu" role="menu">
                <a class="dropdown-item edit_data" href="edit_sale.php?id=<?php echo $sale['sale_id']; ?>">
                    <span class="fa fa-edit text-primary"></span> Edit</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item delete_data" href="delete_sale.php?id=<?php echo $sale['sale_id']; ?>">
                        <span class="fa fa-trash text-danger"></span> Delete
                    </a>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
      </table>
    </div>
  </div>
</div>
</div>
</div>
  
<?php include_once('layouts/footer.php'); ?>

</div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
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

  </body>
</html>
