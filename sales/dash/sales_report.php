<?php
include '../../config.php';  // Includes your database configuration
include('sidebar.php');
include_once('../../header.php');
include_once('layouts/header.php');
require_once('includes/load.php');  // Assuming this file contains necessary initializations

// Function to fetch sales data
function getSalesData($startDate, $endDate) {
    global $conn;  // Use the global database connection

    $sql = "SELECT date, product_name, revenue, quantity_sold
            FROM sales 
            WHERE date BETWEEN ? AND ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $startDate, $endDate);
    $stmt->execute();
    $result = $stmt->get_result();
    $salesData = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    return $salesData;
}

// Fetching and processing the data
$salesData = [];
if(isset($_POST['submit'])){
    $startDate = $_POST['start-date'] ?? '';
    $endDate = $_POST['end-date'] ?? '';
    $salesData = getSalesData($startDate, $endDate);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/style.css" rel="stylesheet">
    <title>Sales Report</title>
</head>
<body>
<div class="page-wrapper">
    <div class="container-fluid">
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

        <!-- Your page content goes here -->
        <h1>Sales Report</h1>
        <form action="" method="post">
            Start Date: <input type="date" name="start-date" required>
            End Date: <input type="date" name="end-date" required>
            <input type="submit" name="submit" value="Generate Report">
        </form>

        <?php if(count($salesData) > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Product Title</th>
                        <!-- <th>Buying Price</th> -->
                        <th>Selling Price</th>
                        <th>Total Qty</th>
                        <th>Total Sales Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($salesData as $sale): ?>
                    <tr>
                        <td><?= htmlspecialchars($sale['date']) ?></td>
                        <td><?= htmlspecialchars($sale['product_name']) ?></td>
                        <!-- <td><?= htmlspecialchars($sale['buy_price']) ?></td> -->
                        <td><?= htmlspecialchars($sale['revenue']) ?></td>
                        <td><?= htmlspecialchars($sale['quantity_sold']) ?></td>
                        <!-- <td><?= htmlspecialchars($sale['sale_price'] * $sale['total_qty']) ?></td> -->
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No sales data found for the selected period.</p>
        <?php endif; ?>
    </div>
</div>

<?php include_once('layouts/footer.php'); ?>

<script src="../../assets/node_modules/jquery/jquery.min.js"></script>
<script src="../../assets/node_modules/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../js/perfect-scrollbar.jquery.min.js"></script>
<script src="../../js/waves.js"></script>
<script src="../../js/sidebarmenu.js"></script>
<script src="../../js/custom.min.js"></script>
<script src="../../assets/node_modules/peity/jquery.peity.min.js"></script>
<script src="../../assets/node_modules/peity/jquery.peity.init.js"></script>
</body>
</html>
