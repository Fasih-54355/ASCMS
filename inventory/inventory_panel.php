<?php
	include("../config.php");
	session_start();
	if(isset($_SESSION['admin_login'])) {
		if($_SESSION['admin_login'] == true) {

			$query_selectProducts = "SELECT * FROM inventory ORDER BY product_id";
			$result_selectProducts = mysqli_query($conn,$query_selectProducts);
		           
            $query_chart = "SELECT * FROM inventory ORDER BY product_id";
			$result_chart = mysqli_query($conn,$query_selectProducts);
		           
            // Fetch data for the chart
                    $inventoryChartData = array();
                    while($row = mysqli_fetch_assoc($result_chart)) {
                        $inventoryChartData[] = $row;
                    }
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
<html>
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
    <!-- <title>AdminWrap Lite Template by WrapPixel</title> -->
    <!-- <link rel="canonical" href="https://www.wrappixel.com/templates/adminwrap-lite/" /> -->
    <!-- Favicon icon -->
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png"> -->
    <!-- Bootstrap Core CSS -->
    <link href="../assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/style.css" rel="stylesheet">
<!-- Chart.js -->
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
    
        <div class="header">
            <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark"
                            href="javascript:void(0)"><i class="fa fa-bars"></i></a> </li>

                            <nav>
                                    <a href="inventory_panel.php">Home</a><!--
                                    --><a href="InventorySystem_PHP/categorie.php">Categories</a><!--
                                    --><a href="InventorySystem_PHP/product.php">Products</a>
                                    <!-- <a href="add_product.php"
                                      class="btn waves-effect waves-light btn btn-info pull-right hidden-sm-down text-white">+ Add Product</a> -->
                            </nav>
                        </li>
                    </ul>
            </div>
        </div>
        <br>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-9">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Inventory Level</h4>
                            <canvas id="inventoryChart" width="200" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- Recently Added Products -->
        <div class="row mt-3">
            <div class="col-10">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Inventory Details</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Inventory ID</th>
                                        <th>Product ID</th>
                                        <th>Name</th>
                                        <th>Location</th>
                                        <th>MFG Date</th>
                                        <th>EXP Date</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; while($row_selectProducts = mysqli_fetch_array($result_selectProducts)) { ?>
                                        <tr>
                                        <td><?php echo $row_selectProducts['inventory_id']; ?></td>
                                            <td><?php echo $row_selectProducts['product_id']; ?></td>
                                            <td><?php echo $row_selectProducts['info']; ?></td>
                                            <td><?php echo $row_selectProducts['location']; ?></td>
                                            <td><?php echo $row_selectProducts['date_added']; ?></td>
                                            <td><?php echo $row_selectProducts['expiry_date']; ?></td>
                                            <td><?php if($row_selectProducts['quantity'] == NULL){ echo "N/A";} else {echo $row_selectProducts['quantity'];} ?></td>
                                        </tr>
                                        <?php $i++; } ?>
                                </tbody>
                            </table>
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
    <script>
    // Get the data from PHP and convert it to a JavaScript array
    var inventoryData = <?php echo json_encode($inventoryChartData); ?>;

    // Extract product names and quantities for the chart
    var productNames = inventoryData.map(item => item.info);
    var quantities = inventoryData.map(item => item.quantity);

    // Get the canvas element and context
    var ctx = document.getElementById('inventoryChart').getContext('2d');

    // Create the bar chart
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: productNames,
            datasets: [{
                label: 'Quantity',
                data: quantities,
                backgroundColor: 'rgb(65, 105, 225)', // Royal Blue color
                borderColor: 'rgba(75, 192, 192, 1)', // Border color
                borderWidth: 1 // Border width
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</body>
</html>