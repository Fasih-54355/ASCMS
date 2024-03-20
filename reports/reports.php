<?php
	include("../config.php");
	session_start();
	if(isset($_SESSION['admin_login'])) {
		if($_SESSION['admin_login'] == true) {
            // Example report query to get total shipments by product
$sql = "SELECT product, SUM(quantity) AS total_quantity FROM shipments GROUP BY product";
$result = $conn->query($sql);

// Example report query to get current inventory levels
$sqlInventory = "SELECT product_id, SUM(quantity) AS current_inventory FROM inventory GROUP BY product_id";
$resultInventory = $conn->query($sqlInventory);

// Example report query to get total orders by product
$sqlOrders = "SELECT product_id, SUM(order_quantity) AS total_orders FROM orders GROUP BY product_id";
$resultOrders = $conn->query($sqlOrders);
		}
		else {
			header('Location:../index.php');
		}
	}
	else {
		header('Location:../index.php');
	}
?>

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
    <!-- Bootstrap Core CSS -->
    <link href="../assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
<?php
		include '../header.php';
		include '../sidebar.php';
	?>
	<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row">
            <h1>Report</h1>
                <div class="col-md-6">
                    <div class="card">
                    <div class="card-body">
                        <h3>Total Shipments by Product</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Total Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()) : ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row["product"]); ?></td>
                                            <td><?php echo htmlspecialchars($row["total_quantity"]); ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>

                </div>
        </div>        
        <div class="row">
                <div class="col-md-6">
                    <div class="card">
                    <div class="card-body">
                        <h3>Current Inventory Levels by Product</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Current Inventory</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($rowInventory = $resultInventory->fetch_assoc()) : ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($rowInventory["product_id"]); ?></td>
                                            <td><?php echo htmlspecialchars($rowInventory["current_inventory"]); ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="card">     
                    <div class="card-body">
                        <h3>Total Orders by Product</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Total Orders</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($rowOrders = $resultOrders->fetch_assoc()) : ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($rowOrders["product_id"]); ?></td>
                                            <td><?php echo htmlspecialchars($rowOrders["total_orders"]); ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>

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
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->

	<?php
		include("../footer.php");
	?>
	        <!-- All Jquery -->
    <!-- ============================================================== -->
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

</body>

</html>
