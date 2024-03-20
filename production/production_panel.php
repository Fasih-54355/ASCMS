<?php
include("../config.php"); // Include your database connection file
session_start();
if(isset($_SESSION['admin_login'])) {
    if($_SESSION['admin_login'] == true) {
            // Function to add a new product to the database
            function addProduct($productName, $quantity, $productionDate) {
                global $conn;
                $sql = "INSERT INTO products (product_name, quantity, production_date)
                        VALUES ('$productName', '$quantity', '$productionDate')";
                return $conn->query($sql);
            }

            // Function to retrieve a list of products from the database
            function getProducts() {
                global $conn;
                $sql = "SELECT * FROM production";
                $result = $conn->query($sql);
                return $result->fetch_all(MYSQLI_ASSOC);
            }
            function getProductionDetails() {
                global $conn;
                $sql = "SELECT * FROM production"; // Update the table name as necessary
                $result = $conn->query($sql);
                return $result->fetch_all(MYSQLI_ASSOC);
            }
            
            // Retrieve and display the detailed production information
            $productionDetails = getProductionDetails();
            
            // Example usage:
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Add a new product
                $productName = $_POST["product_name"];
                $quantity = $_POST["quantity"];
                $productionDate = $_POST["production_date"];

                if (addProduct($productName, $quantity, $productionDate)) {
                    echo "Product added successfully.";
                } else {
                    echo "Error adding product.";
                }
            }

            // Retrieve and display the list of products
            $products = getProducts();
               }
    }
    else {
        header('Location:../index.php');
    }
// else {
//     header('Location:../index.php');
// }
?>

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
    <!-- <title>AdminWrap Lite Template by WrapPixel</title> -->
    <!-- <link rel="canonical" href="https://www.wrappixel.com/templates/adminwrap-lite/" /> -->
    <!-- Favicon icon -->
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png"> -->
    <!-- Bootstrap Core CSS -->
    <link href="../assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/style.css" rel="stylesheet">
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
          <!-- Subheader with additional links -->
          <div class="header">
    <div class="navbar-collapse">
        <!-- toggle and nav items -->
        <ul class="navbar-nav me-auto">
            <li class="nav-item"> 
                <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)">
                    <i class="fa fa-bars"></i>
                </a> 
            </li>

            <nav>
                <a href="production_panel.php">Home</a>
                <a href="production_scheduling.php">Production Scheduling</a>
                <!-- <a href="quality_assurance.php">Quality Assurance</a> -->
                <a href="resource_management.php">Resource Management</a>
            </nav>
        </li>
        </ul>
    </div>                    
</div>
    <!-- <div class="row">
            <div class="col-9">
            <h4 class="card-title">Products</h4>
    <form method="post" action="">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" required><br>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" required><br>

        <label for="production_date">Production Date:</label>
        <input type="date" name="production_date" required><br>

        <button type="submit">Add Product</button>
    </form> -->
        <!-- Recently Added Products -->
        <!-- <div class="row mt-3">
            <div class="col-10">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">products list</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
        <tr>
            <th>Product ID</th>
            <th>Quantity</th>
            <th>Production Date</th>
        </tr>
        </thead>
                                <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo $product["product_id"]; ?></td>
                <td><?php echo $product["QuantityProduced"]; ?></td>
                <td><?php echo $product["EndDateTime"]; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
</div>
</div>
</div>
</div> -->
<!-- Detailed Production Information -->
<div class="row mt-3">
    <div class="col-10">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Production Details</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Production ID</th>
                                <th>Raw Material ID</th>
                                <th>Product Name</th>
                                <!-- <th>Raw Materials</th> -->
                                <!-- <th>Suppliers</th> -->
                                <th>Production Start</th>
                                <th>Production End</th>
                                <th>Production Status</th>
                                <th>Production Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($productionDetails as $detail): ?>
                                <tr>
                                    <td><?php echo $detail["ProductionID"]; ?></td>
                                    <td><?php echo $detail["rawmaterialid"]; ?></td>                                    <td><?php echo $detail["product_name"]; ?></td>
                                    <td><?php echo $detail["StartDateTime"]; ?></td>
                                    <td><?php echo $detail["EndDateTime"]; ?></td>
                                    <td><?php echo $detail["ProductionStatus"]; ?></td>
                                    <td><?php echo $detail["FactoryLocation"]; ?></td>
                                </tr>
                            <?php endforeach; ?>
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

    </body>
</html>