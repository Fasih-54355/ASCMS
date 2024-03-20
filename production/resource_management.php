<?php
include("../config.php"); // Database connection file
session_start();

if(isset($_SESSION['admin_login']) && $_SESSION['admin_login'] == true) {
    // Function to retrieve raw materials
    function getRawMaterials() {
        global $conn;
        $sql = "SELECT * FROM rawmaterials";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Function to retrieve suppliers
    function getSuppliers() {
        global $conn;
        $sql = "SELECT * FROM suppliers";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Function to retrieve inventory items
    function getInventory() {
        global $conn;
        $sql = "SELECT * FROM inventory";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Retrieve data
    $rawMaterials = getRawMaterials();
    $suppliers = getSuppliers();
    $inventoryItems = getInventory();
} else {
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
    <?php include '../header.php'; ?>
    <?php include '../sidebar.php'; ?>

    <!-- Page wrapper -->
    <div class="page-wrapper">
        <!-- Container fluid -->
        <div class="container-fluid">
                                    <!-- Subheader with additional links -->
                                    <div class="header">
                <div class="navbar-collapse">
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

            <!-- Resource Management Sections -->

            <!-- Raw Materials Section -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                    <h4 class="card-title">Raw Materials</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Supplier ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rawMaterials as $material): ?>
                                    <tr>
                                        <td><?php echo $material["RawMaterialID"]; ?></td>
                                        <td><?php echo $material["RawMaterialName"]; ?></td>
                                        <td><?php echo $material["QuantityInStock"]; ?></td>
                                        <td><?php echo $material["SupplierID"]; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
                    </div>

            <!-- Suppliers Section -->
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                    <h4 class="card-title">Suppliers</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Contact Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($suppliers as $supplier): ?>
                                    <tr>
                                        <td><?php echo $supplier["supplier_id"]; ?></td>
                                        <td><?php echo $supplier["supplier_name"]; ?></td>
                                        <td><?php echo $supplier["supplier_phone"]; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
                    <!-- </div> -->

            <!-- Inventory Section -->
            <!-- <div class="row mt-4"> -->
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                    <h4 class="card-title">Inventory</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Material ID</th>
                                    <th>Available Quantity</th>
                                    <th>Last Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($inventoryItems as $item): ?>
                                    <tr>
                                        <td><?php echo $item["inventory_id"]; ?></td>
                                        <td><?php echo $item["product_id"]; ?></td>
                                        <td><?php echo $item["quantity"]; ?></td>
                                        <td><?php echo $item["date_added"]; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
                    <!-- </div> -->
        <!-- End Container fluid -->
    </div>
    <!-- End Page wrapper -->

    <?php include("../footer.php"); ?>
    <!-- Include scripts -->
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
