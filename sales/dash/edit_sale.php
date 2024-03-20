<?php
include '../../config.php';
include('sidebar.php');
include_once('../../header.php');
if (isset($_GET['id'])) {
    $sale_id = $_GET['id'];

    $sql = "SELECT * FROM sales WHERE sale_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $sale_id); 
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $sale = $result->fetch_assoc();
        } else {
            echo "Sale not found.";
            exit;
        }
    } else {
        echo "Error: " . $conn->error;
        exit;
    }
} else {
    echo "No sale ID specified.";
    exit;
}
?><?php include_once('layouts/header.php'); ?>
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
    <!-- <div class="container"> -->
        <div class="card">
        <div class="card-body">

    <h2>Edit Sale</h2>
    <form action="update_sale.php" method="post">
        <input type="hidden" name="sale_id" value="<?php echo $sale['sale_id']; ?>">
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Product Name:</label>
                    <input type="text" name="product_name" class="form-control" value="<?php echo $sale['product_name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Quantity:</label>
                    <input type="number" name="quantity_sold" class="form-control" value="<?php echo $sale['quantity_sold']; ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Total:</label>
                    <input type="text" name="revenue" class="form-control" value="<?php echo $sale['revenue']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Date:</label>
                    <input type="date" name="date" class="form-control" value="<?php echo date('Y-m-d', strtotime($sale['date'])); ?>">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>


    <?php include_once('layouts/footer.php'); ?>

<!-- </div> -->
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
