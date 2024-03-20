<?php
	include("../config.php");
	session_start();
	if(isset($_SESSION['admin_login'])) {
		if($_SESSION['admin_login'] == true) {
			
			//select last 5 products
			$query_selectProducts = "SELECT * FROM inventory  ORDER BY product_id DESC LIMIT 5";
			$result_selectProducts = mysqli_query($conn,$query_selectProducts);
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
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data
            $warehouseName = $_POST["warehouseName"];
            $warehouseCapacity = $_POST["warehouseCapacity"];
            $managerName = $_POST["managerName"];
            $warehouseLocation = $_POST["warehouseLocation"];
            $managerEmail = $_POST["managerEmail"];
            $managerPhone = $_POST["managerPhone"];
        
            // Insert data into the database
            $stmt = $conn->prepare("INSERT INTO warehouse (warehouse_name, capacity, manager_name,location, manager_email, manager_phone) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sissi", $warehouseName, $warehouseCapacity, $managerName, $managerEmail, $managerPhone);
            $stmt->execute();
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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">List of Warehouses</h3>
                        <div class="card-tools">
                            <a href="javascript:void(0)" id="create_new_warehouse" class="btn btn-flat btn-primary" data-toggle="modal" data-target="#createWarehouseModal">
                                <span class="fas fa-plus"></span> Create New Warehouse
                            </a>
                        </div>
                    </div>
                </div>                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <!-- <th>Sr. No.</th> -->
                                <th>Warehouse ID</th>
                                <th>Warehouse Name</th>
                                <th>Capacity</th>
                                <th>Location</th>
                                <th>Manager Name</th>
                                <th>Manager Email</th>
                                <th>Manager Phone</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM warehouse";
                            $result = $conn->query($sql);

                            // Check if the query was successful
                            if ($result) {
                                $i = 1;
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['warehouse_id']; ?></td>
                                        <td><?php echo $row['warehouse_name']; ?></td>
                                        <td><?php echo $row['capacity']; ?></td>
                                        <td><?php echo $row['location']; ?></td>
                                        <td><?php echo $row['manager_name']; ?></td>
                                        <td><?php echo $row['manager_email']; ?></td>
                                        <td><?php echo $row['manager_phone']; ?></td>
                                    </tr>

                                    <?php
                                    $i++;
                                }
                            } else {
                                echo "<tr><td colspan='4'>No products found.</td></tr>";
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
<!-- Create Warehouse Modal -->
<div class="modal" id="createWarehouseModal" tabindex="-1" role="dialog" aria-labelledby="createWarehouseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createWarehouseModalLabel">Create New Warehouse</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form to Enter Warehouse Details -->
                <form id="createWarehouseForm">
                    <div class="form-group">
                        <label for="warehouseName">Warehouse Name:</label>
                        <input type="text" class="form-control" id="warehouseName" name="warehouseName" required>
                    </div>
                    <div class="form-group">
                        <label for="warehouseCapacity">Warehouse Capacity:</label>
                        <input type="number" class="form-control" id="warehouseCapacity" name="warehouseCapacity" required>
                    </div>
                    <div class="form-group">
                    <label for="warehouseLocation">Warehouse Location:</label>
                    <input type="text" class="form-control" id="warehouseLocation" name="warehouseLocation" required>
                </div>
                    <div class="form-group">
                        <label for="managerName">Manager Name:</label>
                        <input type="text" class="form-control" id="managerName" name="managerName" required>
                    </div>
                    <div class="form-group">
                        <label for="managerEmail">Manager Email:</label>
                        <input type="email" class="form-control" id="managerEmail" name="managerEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="managerPhone">Manager Phone Number:</label>
                        <input type="tel" class="form-control" id="managerPhone" name="managerPhone" required>
                    </div>
                    <!-- Additional fields can be added as needed -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveWarehouseBtn">Create Warehouse</button>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    $("#saveWarehouseBtn").click(function () {
        var formData = $("#createWarehouseForm").serialize();

        $.ajax({
            type: "POST",
            url: "wh_detail.php",  // Update the URL as needed
            data: formData,
            success: function (response) {
                // Handle the server response
                console.log(response);

                // Refresh the page after creating the warehouse (you can implement a better approach)
                window.location.href = 'wh_detail.php';
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