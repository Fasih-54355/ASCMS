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

</head>
<body>
	<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    
		include '../sidebar.php';
		include '../header.php';
        include '../config.php';
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data
            $rawMaterialName = $_POST["RawMaterialName"];
            $description = $_POST["Description"];
            $supplierID = $_POST["SupplierID"];
            $unitOfMeasurement = $_POST["UnitOfMeasurement"];
            $location = $_POST["location"];
            $costPerUnit = $_POST["CostPerUnit"];
            $quantityInStock = $_POST["QuantityInStock"];
            $reorderLevel = $_POST["ReorderLevel"];
            $leadTime = $_POST["LeadTime"];
            $receivingDate = $_POST["receiving_date"];
            $expiryDate = $_POST["expiry_date"]; 
        
            $sql = "INSERT INTO rawmaterials (RawMaterialName, Description, SupplierID, UnitOfMeasurement, location, CostPerUnit, QuantityInStock, ReorderLevel, LeadTime, receiving_date, expiry_date) VALUES ('$rawMaterialName', '$description', '$supplierID', '$unitOfMeasurement', '$location', '$costPerUnit', '$quantityInStock', '$reorderLevel', '$leadTime', '$receivingDate', '$expiryDate')";

            if ($conn->query($sql) === TRUE) {
                echo "Raw material added successfully!";
            } else {
                echo "Error: " . $conn->error;
            }            
            
    // echo "Raw material added successfully!";
}
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
                                            <a href="stock/purchase_order.php">Purchase Order</a>
                                        <a href="stock/receiving.php">Receiving</a><!--
                                            --><a href="stock/back_order.php">Back Order</a>
                                            <a href="stock/return_list.php">Return List</a>
                                    <a href="add_rawmaterial.php" class="btn waves-effect waves-light btn btn-info pull-right hidden-sm-down text-white">+ Add Raw Material</a>

                                </nav>
                        </li>
                    </ul>
            </div>                    
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->

        <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Raw Material Stock</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Raw Material ID</th>
                                <th>Raw Material Name</th>                               
                                <th>Description</th>                       
                                <th>Supplier ID</th>                               
                                <th>Unit</th>                               
                                <th>Location</th>
                                <th>Cost Per Unit</th>
                                <th>Quantity</th>
                                <th>Reorder Level</th>
                                <th>Lead Time</th>
                                <th>Recieving</th>
                                <th>Expiry</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM rawmaterials";
                            $result = $conn->query($sql);

                            // Check if the query was successful
                            if ($result) {
                                $i = 1;
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                               <tr>
                                    <!-- <td><?php echo $i; ?></td> -->
                                    <td><?php echo $row['RawMaterialID']; ?></td>
                                    <td><?php echo $row['RawMaterialName']; ?></td>
                                    <td><?php echo $row['Description']; ?></td>
                                    <td><?php echo $row['SupplierID']; ?></td>
                                    <td><?php echo $row['UnitOfMeasurement']; ?></td>
                                    <td><?php echo $row['location']; ?></td>
                                    <td><?php echo $row['CostPerUnit']; ?></td>
                                    <td><?php echo $row['QuantityInStock']; ?></td>
                                    <td><?php echo $row['ReorderLevel']; ?></td>
                                    <td><?php echo $row['LeadTime']; ?></td>
                                    <td><?php echo $row['receiving_date']; ?></td>
                                    <td><?php echo $row['expiry_date']; ?></td>
                                </tr>

                                    <?php
                                    $i++;
                                }
                            } else {
                                echo "<tr><td colspan='4'>No suppliers found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add Raw Material Modal -->
<div class="modal" id="addRawMaterialModal" tabindex="-1" role="dialog" aria-labelledby="addRawMaterialModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRawMaterialModalLabel">Add New Raw Material</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addRawMaterialForm">
                    <div class="form-group">
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveRawMaterialBtn">Add Raw Material</button>
            </div>
        </div>
    </div>
</div>
<script>$("#saveRawMaterialBtn").click(function (e) {
    e.preventDefault(); // Prevent default form submission
    var formData = $("#addRawMaterialForm").serialize();

    $.ajax({
        type: "POST",
        url: "raw_material.php",
        data: formData,
        success: function (response) {
            console.log(response);
            location.reload();
        },
        error: function (error) {
            console.error(error);
        }
    });
});
</script>
     
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
		include '../footer.php';
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
