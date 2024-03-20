<?php
	include("../config.php");
	session_start();
	if(isset($_SESSION['admin_login'])) {
		if($_SESSION['admin_login'] == true) {
			//select last 5 retialers
			$query_selectRetailer = "SELECT * FROM retailer ORDER BY retailer_id DESC LIMIT 5";
			$result_selectRetailer = mysqli_query($conn,$query_selectRetailer);

			$query_selectProducts = "SELECT * FROM products,categories ORDER BY product_id DESC LIMIT 5";
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
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor"></h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                </ol>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        
  <div class="row">
    <div class="col-md-6">
    <?php echo '<iframe src="../demand_forecast/combined/demand_forecast.html" width="100%" height="400px"></iframe>';
?>
</div>
    <div class="class col-md-6">
        <?php echo '<iframe src="../sales/sales prediction(combined)/product_1_sales_forecast.html" width="100%" height="400px"></iframe>';
        ?>
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
                        <div class="col-md-3">
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
            <div class="col-9">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Total Inventory</h4>
                            <canvas id="inventoryChart" width="200" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

<div class="col-md-3">
    <!-- <h2>Inventory level</h2><br>
        <canvas id="myPieChart" width="400" height="400"></canvas> -->

        <?php
// Sample data
// $labels = [];
// $data = [10,15,10];

// Fetch data from the category table
// $sql = "SELECT category_name FROM categories";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $labels[] = $row['category_name'];
//     }
// }

// Close the database connection
// $conn->close();
?>
<!-- 
<script>
    var ctx = document.getElementById('myPieChart').getContext('2d');
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                data: <?php echo json_encode($data); ?>,
                backgroundColor: [
                    'red',
                    'green',
                    'yellow'
                ]
            }]
        },
        options: { -->
            <!-- // You can add options here if needed -->
        <!-- }
    });
</script> -->

<!-- ———Pie chart—/// -->
<!-- </div>
        <div class="col-md-4">
        <canvas id="myLineChart" width="400" height="400"></canvas> -->

<?php
// Sample data
// $labels = ["January", "February", "March", "April", "May"];
// $data = [20, 35, 40, 50, 30];
?>

<!-- <script>
    var ctx = document.getElementById('myLineChart').getContext('2d');
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: 'Sample Data',
                data: <?php echo json_encode($data); ?>,
                fill: false,
                borderColor: 'blue',
                borderWidth: 1
            }]
        },
        options: { -->
            <!-- // You can add options here if needed -->
        <!-- }
    });
</script>
</div> -->
<!-- <div class="col-md-5"> -->
<?php
// Assume you have these values from your database or some other data source
// $currentStock = 1500;
// $reorderPoint = 500;

// Calculate the KPI value
// $inventoryKPI = ($currentStock / $reorderPoint) * 100;

// Display the KPI
// echo "<h2>Inventory KPI</h2>";
// echo "<p>Current Stock: $currentStock units</p>";
// echo "<p>Reorder Point: $reorderPoint units</p>";
// echo "<p>Inventory KPI: $inventoryKPI%</p>";

// Add some conditional formatting based on the KPI value
// if ($inventoryKPI >= 100) {
//     echo "<p style='color: green;'>Stock is above the reorder point. Good!</p>";
// } else {
//     echo "<p style='color: red;'>Stock is below the reorder point. Action required!</p>";
// }
// ?>
<!-- </div> -->
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