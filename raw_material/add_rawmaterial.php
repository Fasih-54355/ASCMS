<?php
	include("../config.php");
	// session_start();
	// if(isset($_SESSION['admin_login'])) {
	// 	if($_SESSION['admin_login'] == true) {
	// 		$query_selectCategory = "SELECT category_id,category_name FROM categories";
	// 		$query_selectUnit = "SELECT id,unit_name FROM unit";
	// 		$result_selectCategory = mysqli_query($conn,$query_selectCategory);
	// 		$result_selectUnit = mysqli_query($conn,$query_selectUnit);
	// 		$name = $price = $unit = $category = $rdbStock = $description = "";
	// 		$nameErr = $priceErr = $requireErr = $confirmMessage = "";
	// 		$nameHolder = $priceHolder = $descriptionHolder = "";
	// 		if($_SERVER['REQUEST_METHOD'] == "POST") {
	// 			if(!empty($_POST['txtProductName'])) {
	// 				$nameHolder = $_POST['txtProductName'];
	// 				$name = $_POST['txtProductName'];
	// 			}
	// 			if(!empty($_POST['txtProductPrice'])) {
	// 				$priceHolder = $_POST['txtProductPrice'];
	// 				$resultValidate_price = validate_price($_POST['txtProductPrice']);
	// 				if($resultValidate_price == 1) {
	// 					$price = $_POST['txtProductPrice'];
	// 				}
	// 				else {
	// 					$priceErr = $resultValidate_price;
	// 				}
	// 			}
	// 			if(isset($_POST['cmbProductUnit'])) {
	// 				$unit = $_POST['cmbProductUnit'];
	// 			}
	// 			if(isset($_POST['cmbProductCategory'])) {
	// 				$category = $_POST['cmbProductCategory'];
	// 			}
	// 			if(empty($_POST['rdbStock'])) {
	// 				$rdbStock = "";
	// 			}
	// 			else {
	// 				if($_POST['rdbStock'] == 1) {
	// 					$rdbStock = 1;
	// 				}
	// 				else if($_POST['rdbStock'] == 2) {
	// 					$rdbStock = 2;
	// 				}
	// 			}
	// 			if(!empty($_POST['txtProductDescription'])) {
	// 				$description = $_POST['txtProductDescription'];
	// 				$descriptionHolder = $_POST['txtProductDescription'];
	// 			}
	// 			if($name != null && $price != null && $unit != null && $category != null && $rdbStock == 1) {
	// 				$rdbStock = 0;
	// 				$query_addProduct = "INSERT INTO products(pro_name,pro_desc,pro_price,unit,pro_cat,quantity) VALUES('$name','$description','$price','$unit','$category','$rdbStock')";
	// 				if(mysqli_query($conn,$query_addProduct)) {
	// 					echo "<script> alert(\"Product Added Successfully\"); </script>";
	// 					header('Refresh:0');
	// 				}
	// 				else {
	// 					$requireErr = "Adding Product Failed";
	// 				}
	// 		}
	// 			else if($name != null && $price != null && $unit != null && $category != null && $rdbStock == 2) {
	// 					$query_addProduct = "INSERT INTO products(pro_name,pro_desc,pro_price,unit,pro_cat,quantity) VALUES('$name','$description','$price','$unit','$category',NULL)";
	// 				if(mysqli_query($conn,$query_addProduct)) {
	// 					echo "<script> alert(\"Product Added Successfully\"); </script>";
	// 					header('Refresh:0');
	// 				}
	// 				else {
	// 					$requireErr = "Adding Product Failed";
	// 				}
	// 			}
	// 			else {
	// 				$requireErr = "* All Fields are Compulsory with valid values except Description";
	// 			}
	// 		}
	// 	}
	// 	else {
	// 		header('Location:../index.php');
	// 	}
	// }
	// else {
	// 	header('Location:../index.php');
	// }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
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
 </head>
<body>
	<?php
		include '../header.php';
		include '../sidebar.php';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Escape user inputs for security
	$rawid = $conn->real_escape_string($_POST['Rawid']);
    $rawMaterialName = $conn->real_escape_string($_POST['RawMaterialName']);
    $description = $conn->real_escape_string($_POST['Description']);
    $supplierID = $conn->real_escape_string($_POST['SupplierID']);
    $unitOfMeasurement = $conn->real_escape_string($_POST['UnitOfMeasurement']);
    $location = $conn->real_escape_string($_POST['location']);
    $costPerUnit = $conn->real_escape_string($_POST['CostPerUnit']);
    $quantityInStock = $conn->real_escape_string($_POST['QuantityInStock']);
    $reorderLevel = $conn->real_escape_string($_POST['ReorderLevel']);
    $leadTime = $conn->real_escape_string($_POST['LeadTime']);
    $receivingDate = $conn->real_escape_string($_POST['receiving_date']);
    $expiryDate = $conn->real_escape_string($_POST['expiry_date']);

    // SQL query to insert data
    $sql = "INSERT INTO rawmaterials (RawMaterialID,RawMaterialName, Description, SupplierID, UnitOfMeasurement, Location, CostPerUnit, QuantityInStock, ReorderLevel, LeadTime, receiving_date, expiry_date)
            VALUES ('$rawid','$rawMaterialName', '$description', '$supplierID', '$unitOfMeasurement', '$location', '$costPerUnit', '$quantityInStock', '$reorderLevel', '$leadTime', '$receivingDate', '$expiryDate')";

    // Execute query
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>

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

                                <nav>
                                    <a href="raw_material.php">Home</a><!--
                                        <a href="wh_detail.php"></a>
                                        <a href="../raw_material/raw_material.php">Raw Material Inventory</a>
                                    <a href="../inventory/InventorySystem_PHP/product.php">Product Inventory</a>
                                    <a href="../admin/view_products.php">Products</a>
                                    <a href="../admin/view_orders.php">Orders</a>
                                    <a href="../admin/view_invoice.php">Invoice</a>-->
									<!-- <a href="add_rawmaterial.php" class="btn waves-effect waves-light btn btn-info pull-right hidden-sm-down text-white">+ Add Raw Material</a> -->

                                </nav>
                        </li>
                    </ul>
            </div>                    
        </div>
        <
	<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

<form id="addRawMaterialForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<div class="form-group">
        <label for="Rawid">Raw Material id:</label>
        <input type="text" class="form-control" id="Rawid" name="Rawid" required>
    </div><div class="form-group">
        <label for="RawMaterialName">Raw Material Name:</label>
        <input type="text" class="form-control" id="RawMaterialName" name="RawMaterialName" required>
    </div>
    <div class="form-group">
        <label for="Description">Description:</label>
        <input type="text" class="form-control" id="Description" name="Description" required>
    </div>
    <div class="form-group">
        <label for="SupplierID">Supplier ID:</label>
        <input type="text" class="form-control" id="SupplierID" name="SupplierID" required>
    </div>
    <div class="form-group">
        <label for="UnitOfMeasurement">Unit of Measurement:</label>
        <input type="text" class="form-control" id="UnitOfMeasurement" name="UnitOfMeasurement" required>
    </div>
    <div class="form-group">
        <label for="location">Location:</label>
        <input type="text" class="form-control" id="location" name="location" required>
    </div>
    <div class="form-group">
        <label for="CostPerUnit">Cost Per Unit:</label>
        <input type="text" class="form-control" id="CostPerUnit" name="CostPerUnit" required>
    </div>
    <div class="form-group">
        <label for="QuantityInStock">Quantity in Stock:</label>
        <input type="text" class="form-control" id="QuantityInStock" name="QuantityInStock" required>
    </div>
    <div class="form-group">
        <label for="ReorderLevel">Reorder Level:</label>
        <input type="text" class="form-control" id="ReorderLevel" name="ReorderLevel" required>
    </div>
    <div class="form-group">
        <label for="LeadTime">Lead Time:</label>
        <input type="text" class="form-control" id="LeadTime" name="LeadTime" required>
    </div>
    <div class="form-group">
        <label for="receiving_date">Receiving Date:</label>
        <input type="date" class="form-control" id="receiving_date" name="receiving_date" required>
    </div>
    <div class="form-group">
        <label for="expiry_date">Expiry Date:</label>
        <input type="date" class="form-control" id="expiry_date" name="expiry_date" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

</div>

</div>
</div>
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