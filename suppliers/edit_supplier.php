<?php
include '../config.php';
include '../header.php';
include '../sidebar.php';

if (isset($_GET['id'])) {
    $supplier_id = $_GET['id'];

    $sql = "SELECT * FROM supplier_list WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $supplier_id); 
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $supplier = $result->fetch_assoc();
        } else {
            echo "Supplier not found.";
            exit;
        }
    } else {
        echo "Error: " . $conn->error;
        exit;
    }
} else {
    echo "No supplier ID specified.";
    exit;
}
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
    <!-- <link rel="canonical" href="https://www.wrappixel.com/templates/adminwrap-lite/" /> -->
    <!-- Favicon icon -->
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png"> -->
    <!-- Bootstrap Core CSS -->
    <link href="../../assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../../css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>

    .left-sidebar {
        width: 220px;
    }

    .page-wrapper {
        margin-left: 220px;
        transition: margin-left 0.5s;
    }

    .left-sidebar .sidebar-nav ul#sidebarnav li a {
        text-align: left;
        z-index: 0; /* Set a lower z-index for the items below */
    }

    .left-sidebar .sidebar-nav ul#sidebarnav li.with-subitems:hover ~ li {
        margin-top: 50px; /* Adjust the margin-top based on the height of the subitems */
    }
    .scrollable-table {
    max-height: 500px; /* Adjust the height as needed */
    overflow-y: auto;
    overflow-x: hidden;
}


    
</style>
</head>
<body>
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
    <!-- <div class="container"> -->
        <div class="card">
        <div class="card-body">

        <h2>Edit Supplier</h2>
                <form action="update_supplier.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $supplier['id']; ?>">

                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $supplier['name']; ?>">
                    </div>

                    <div class="form-group">
                        <label>Address:</label>
                        <input type="text" name="address" class="form-control" value="<?php echo $supplier['address']; ?>">
                    </div>

                    <div class="form-group">
                        <label>Contact Number:</label>
                        <input type="text" name="contact" class="form-control" value="<?php echo $supplier['contact']; ?>">
                    </div>

                    <!-- Raw Material Input Field -->
                    <div class="form-group">
                        <label>Raw Material:</label>
                        <input type="text" name="raw_material" class="form-control" value="<?php echo $supplier['raw_material']; ?>">
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
</div>



<!-- </div> -->
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
	        <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../../assets/node_modules/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../assets/node_modules/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../../js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="../../js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../../js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../../js/custom.min.js"></script>
    <!-- jQuery peity -->
    <script src="../../assets/node_modules/peity/jquery.peity.min.js"></script>
    <script src="../../assets/node_modules/peity/jquery.peity.init.js"></script>

  </body>
</html>