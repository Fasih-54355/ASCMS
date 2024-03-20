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
		include '../sidebar.php';
		include '../header.php';
        include '../config.php';
        
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $rawMaterialName = $_POST["rawMaterialName"];
    $description = $_POST["description"];
    $supplierID = $_POST["supplierID"];
    $unitOfMeasurement = $_POST["unitOfMeasurement"];
    $location = $_POST["location"];
    $costPerUnit = $_POST["costPerUnit"];
    $quantityInStock = $_POST["quantityInStock"];
    $reorderLevel = $_POST["reorderLevel"];
    $leadTime = $_POST["leadTime"];

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO rawmaterials (RawMaterialName, Description, SupplierID, UnitOfMeasurement, Location, CostPerUnit, QuantityInStock, ReorderLevel, LeadTime) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssissiii", $rawMaterialName, $description, $supplierID, $unitOfMeasurement, $location, $costPerUnit, $quantityInStock, $reorderLevel, $leadTime);
    $stmt->execute();

    echo "Raw material added successfully!";
} else {
    echo "Invalid request!";
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
                                    --><a href="../inventory/InventorySystem_PHP/product.php">Product Inventory</a><!--
                                    <a href="../admin/view_products.php">Products</a>
                                    <a href="../admin/view_orders.php">Orders</a>
                                    <a href="../admin/view_invoice.php">Invoice</a>-->
                                    <a href="javascript:void(0)" class="btn waves-effect waves-light btn btn-info pull-right hidden-sm-down text-white" data-toggle="modal" data-target="#addRawMaterialModal">+ Add Raw Material</a>

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
                <!-- Form to Enter Raw Material Details -->
                <form id="addRawMaterialForm">
                    <div class="form-group">
                        <label for="rawMaterialName">Raw Material Name:</label>
                        <input type="text" class="form-control" id="rawMaterialName" name="rawMaterialName" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                    <div class="form-group">
                        <label for="supplierID">Supplier ID:</label>
                        <input type="text" class="form-control" id="supplierID" name="supplierID" required>
                    </div>
                    <div class="form-group">
                        <label for="unitOfMeasurement">Unit of Measurement:</label>
                        <input type="text" class="form-control" id="unitOfMeasurement" name="unitOfMeasurement" required>
                    </div>
                    <div class="form-group">
                        <label for="location">Location:</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                    </div>
                    <div class="form-group">
                        <label for="costPerUnit">Cost Per Unit:</label>
                        <input type="text" class="form-control" id="costPerUnit" name="costPerUnit" required>
                    </div>
                    <div class="form-group">
                        <label for="quantityInStock">Quantity in Stock:</label>
                        <input type="text" class="form-control" id="quantityInStock" name="quantityInStock" required>
                    </div>
                    <div class="form-group">
                        <label for="reorderLevel">Reorder Level:</label>
                        <input type="text" class="form-control" id="reorderLevel" name="reorderLevel" required>
                    </div>
                    <div class="form-group">
                        <label for="leadTime">Lead Time:</label>
                        <input type="text" class="form-control" id="leadTime" name="leadTime" required>
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
<!-- Add this at the end of your HTML -->
<script>
$(document).ready(function () {
    // Handle the click event for the saveRawMaterialBtn button
    $("#saveRawMaterialBtn").click(function () {
        var formData = $("#addRawMaterialForm").serialize();

        $.ajax({
            type: "POST",
            url: "raw_material.php", // Adjust the URL accordingly
            data: formData,
            success: function (response) {
                console.log(response);
                // Refresh the page or update the raw material list
                location.reload();
            },
            error: function (error) {
                console.error(error);
            }
        });
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
