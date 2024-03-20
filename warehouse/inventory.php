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
		// include("../includes/nav_admin.inc.php");
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
                    <li class="breadcrumb-item active">Table</li>
                </ol>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Product Inventory</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <!-- <th>Sr. No.</th> -->
                                <th>Inventory ID</th>
                                <th>Product ID</th>                               
                                <th>Address</th>                       
                                <th>Quantity</th>                               
                                <th>Date Added</th>                               
                                <th>Expiry Date</th>
                                <th>Info</th>
                                <th>Category</th>
</tr>
                        </thead>
                        <tbody>
                            <?php
                            // Placeholder: Fetch and display existing suppliers
                            $sql = "SELECT * FROM inventory";
                            $result = $conn->query($sql);

                            // Check if the query was successful
                            if ($result) {
                                $i = 1;
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
    <!-- <td><?php echo $i; ?></td> -->
    <td><?php echo $row['inventory_id']; ?></td>
    <td><?php echo $row['product_id']; ?></td>
    <td><?php echo $row['location']; ?></td>
    <td><?php echo $row['quantity']; ?></td>
    <td><?php echo $row['date_added']; ?></td>
    <td><?php echo $row['expiry_date']; ?></td>
    <td><?php echo $row['info']; ?></td>
    <td><?php echo $row['category']; ?></td>
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
     
        <!-- <div>
        <ul>
        <li><a href="inventory.php?action=add">Add Product to Inventory</a></li>
        <li><a href="inventory.php?action=view">View Inventory</a></li>
    </ul>

    <?php
    // Placeholder functionalities
    if ($_GET['action'] === 'add') {
        echo "<p>Add product to inventory form goes here.</p>";
    } elseif ($_GET['action'] === 'view') {
        echo "<p>View inventory functionality goes here.</p>";
    }
    ?>
    </div> -->

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