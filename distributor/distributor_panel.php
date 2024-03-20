<?php
include("../config.php");
session_start();
if (isset($_SESSION['admin_login']) && $_SESSION['admin_login'] == true) {
    $query_selectDistributors = "SELECT * FROM distributor ORDER BY dist_id";
    $result_selectDistributors = mysqli_query($conn, $query_selectDistributors);

    // Fetch distributor data
    $distributorData = array();
    while ($row = mysqli_fetch_assoc($result_selectDistributors)) {
        $distributorData[] = $row;
    }
} else {
    header('Location:../index.php');
}
$query_selectOrders = "SELECT * FROM dist_orders ORDER BY Order_id";
$result_selectOrders = mysqli_query($conn, $query_selectOrders);

// Fetch order request data
$orderData = array();
while ($row = mysqli_fetch_assoc($result_selectOrders)) {
    $orderData[] = $row;
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
    include '../sidebar.php';
    ?>
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
    <div class="row">
            <div class="col-12">
            <div class="header">
            <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav me-auto">
                        <!-- <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark"
                            href="javascript:void(0)"><i class="fa fa-bars"></i></a> </li> -->

                            <nav>
                                   
                                    <a href="add_dis.php"
                                      class="btn waves-effect waves-light btn btn-info pull-right hidden-sm-down text-white">+ Add Distributor</a>
                            </nav>
                        </li>
                    </ul>
            </div>
        </div>
        <br>
        <div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Order Request List</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Distributor ID</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orderData as $row_order): ?>
                                <tr>
                                    <td><?php echo $row_order['Order_id']; ?></td>
                                    <td><?php echo $row_order['Distributor_id']; ?></td>
                                    <td><?php echo $row_order['product_name']; ?></td>
                                    <td><?php echo $row_order['Quantity']; ?></td>
                                    <!-- Add more data as needed -->
                                    <td id="status_<?php echo $row_order['Order_id']; ?>">
                                        <?php echo $row_order['status']; ?>
                                    </td>
                                    <td>
                                        <?php if ($row_order['status'] == 'Pending'): ?>
                                            <button onclick="updateStatus(<?php echo $row_order['Order_id']; ?>)">Confirm</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function updateStatus(orderId) {
    $.ajax({
        url: 'update_order_status.php', // Create this PHP file
        type: 'POST',
        data: {order_id: orderId},
        success: function(response) {
            if(response == 'success') {
                $('#status_' + orderId).text('Confirmed');
            } else {
                alert('Error updating status');
            }
        }
    });
}
</script>

                    <!-- Distributor List -->
    <div class="row mt-3">
        <div class="col-10">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Distributor List</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($distributorData as $row_selectDistributors) : ?>
                                    <tr>
                                        <td><?php echo $row_selectDistributors['dist_id']; ?></td>
                                        <td><?php echo $row_selectDistributors['dist_name']; ?></td>
                                        <td><?php echo $row_selectDistributors['dist_email']; ?></td>
                                        <td><?php echo $row_selectDistributors['dist_phone']; ?></td>
                                        <td><?php echo $row_selectDistributors['dist_address']; ?></td>
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