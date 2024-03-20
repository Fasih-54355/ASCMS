<?php
	include("../config.php");
	session_start();
?>
<!DOCTYPE html>
<html>
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
    <link href="../assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/style.css" rel="stylesheet">
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Include Bootstrap CSS for card styling -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <style>
        /* Add any additional styles you need */
        .category-card {
            margin-bottom: 15px;
        }
    </style>
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
        <div class="header">
            <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark"
                                href="javascript:void(0)"><i class="fa fa-bars"></i></a> </li>

                                <nav>
                                    <a href="wh_panel.php">Home</a><!--
                                        --><a href="wh_detail.php">Warehouse Detail</a><!--
                                        --><a href="../raw_material/raw_material.php">Raw Material Inventory</a><!--
                                            --><a href="../inventory/InventorySystem_PHP/product.php">Product Inventory</a>
                                            <a href="stock/purchase_order.php">Purchase Order</a><!--
                                        --><a href="stock/receiving.php">Receiving</a><!--
                                            --><a href="stock/back_order.php">Back Order</a>
                                            <a href="stock/return_list.php">Return List</a>

                                            <!--
                                    <a href="../admin/view_orders.php">Orders</a>
                                    <a href="../admin/view_invoice.php">Invoice</a>-->
                                </nav>
                        </li>
                    </ul>
            </div>                    
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row">
        <?php
        $poCount = $conn->query("SELECT * FROM `purchase_order_list`")->num_rows;
        $receivingCount = $conn->query("SELECT * FROM `receiving_list`")->num_rows;
        $boCount = $conn->query("SELECT * FROM `back_order_list`")->num_rows;
        $returnCount = $conn->query("SELECT * FROM `return_list`")->num_rows;
        $salesCount = $conn->query("SELECT * FROM `sales_list`")->num_rows;
        $supplierCount = $conn->query("SELECT * FROM `supplier_list` where `status` = 1")->num_rows;
        $itemCount = $conn->query("SELECT * FROM `item_list` where `status` = 1")->num_rows;
        ?>
         <!-- PO Records -->
         <div class="col-12 col-sm-6 col-md-3">
            <div class="card category-card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $poCount; ?></h5>
                    <p class="card-text text-muted">PO Records</p>
                </div>
            </div>
        </div>

        <!-- Receiving Records -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card category-card ">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $receivingCount; ?></h5>
                    <p class="card-text text-muted">Receiving Records</p>
                </div>
            </div>
        </div>

        <!-- BO Records -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card category-card ">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $boCount; ?></h5>
                    <p class="card-text text-muted">BO Records</p>
                </div>
            </div>
        </div>

        <!-- Return Records -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card category-card ">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $returnCount; ?></h5>
                    <p class="card-text text-muted">Return Records</p>
                </div>
            </div>
        </div>

        <!-- Sales Records -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card category-card ">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $salesCount; ?></h5>
                    <p class="card-text text-muted">Sales Records</p>
                </div>
            </div>
        </div>

        <!-- Suppliers -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card category-card ">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $supplierCount; ?></h5>
                    <p class="card-text text-muted">Suppliers</p>
                </div>
            </div>
        </div>

        <!-- Items -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card category-card bg-lightblue">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $itemCount; ?></h5>
                    <p class="card-text text-muted">Items</p>
                </div>
            </div>
        </div>
    </div>
</div>

        <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Warehouse Detail</h4>
                <?php
                // Fetch data from warehouses table
                $warehouseData = [];
                $resultWarehouses = $conn->query("SELECT * FROM warehouse");
                while ($rowWarehouse = $resultWarehouses->fetch_assoc()) {
                    $warehouseData[] = $rowWarehouse;
                }

                // Fetch data from inventory table
                $inventoryData = [];
                $resultInventory = $conn->query("SELECT * FROM inventory");
                while ($rowInventory = $resultInventory->fetch_assoc()) {
                    $inventoryData[] = $rowInventory;
                }
                ?>
                <div class="row">
                    <?php
                    $availableSpaceForChart = []; // Initialize array here

                    foreach ($warehouseData as $key => $warehouse) {
                        // Calculate used and available space for the current warehouse
                        $usedSpace = 0;
                        foreach ($inventoryData as $inventory) {
                            if ($inventory['location'] == $warehouse['warehouse_name']) {
                                $usedSpace += $inventory['quantity'];
                            }
                        }

                        // Calculate total space and available space
                        $totalSpace = $warehouse['capacity'];
                        $availableSpace = $totalSpace - $usedSpace;

                        // Store available space for chart comparison
                        $availableSpaceForChart[] = $availableSpace;

                        // Generate a unique ID for each chart
                        $chartId = 'warehouseChart' . $key;

                        echo <<<HTML
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="$chartId" width="200" height="200"></canvas>
                                    <h5 class="card-title">{$warehouse['warehouse_name']}</h5>
                                </div>
                                <script>
                                    var ctx = document.getElementById('$chartId').getContext('2d');
                                    new Chart(ctx, {
                                        type: 'pie',
                                        data: {
                                            labels: ['Used Space', 'Available Space'],
                                            datasets: [{
                                                data: [$usedSpace, $availableSpace],
                                                backgroundColor: ['#1E90FF', '#DCDCDC']
                                            }]
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                        HTML;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-10">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Warehouse Details</h4>
                <div id="tableContainer">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Warehouse Name</th>
                                <th>Total Space</th>
                                <th>Available Space</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($warehouseData as $key => $warehouse) {
                                echo "<tr>";
                                echo "<td>{$warehouse['warehouse_name']}</td>";
                                echo "<td>{$warehouse['capacity']}</td>";
                                echo "<td>";
                                if (isset($availableSpaceForChart[$key])) {
                                    echo $availableSpaceForChart[$key];
                                }
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
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
  <!-- Include Bootstrap JS for card functionality -->
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
</body>
</html>