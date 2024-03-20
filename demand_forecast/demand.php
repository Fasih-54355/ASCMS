<?php
	include("../config.php");
	session_start();
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
<!-- Chart.js -->
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
        <div class="row">
  <?php echo '<iframe src="../demand_forecast/combined/demand_forecast.html" width="100%" height="600px"></iframe>';
?>
  </div>
  <div class="row">
    <?php
    $num_products = 8; // Replace 5 with the actual number of products
    for ($i = 1; $i <= $num_products; $i++) {
        echo '<div class="col-md-6">'; // Each chart will occupy half of the row (col-md-6 in Bootstrap)
        echo '<div class="card">';
        echo '<div class="class-body">';
        $filename = "../demand_forecast/chart_product_{$i}.html";
        if (file_exists($filename)) {
            echo file_get_contents($filename);
        } else {
            echo '<p>Chart not available.</p>';
        }
        echo '</div>'; // Close class-body
        echo '</div>'; // Close card
        echo '</div>'; // Close col-md-6

        // Add a new row after every second chart
        if ($i % 2 == 0 && $i != $num_products) {
            echo '</div>'; // Close row
            echo '<div class="row">'; // Start a new row
        }
    }
    ?>
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