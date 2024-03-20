<?php
include '../../config.php';
include '../sidebar.php';
include '../../header.php';
  $page_title = 'All Product';
  require_once('includes/load.php');
  $products = join_product_table();
  function count_id(){
    static $count = 1;
    return $count++;
  }

			$query_selectProducts = "SELECT * FROM inventory ORDER BY product_id";
			$result_selectProducts = mysqli_query($conn,$query_selectProducts);
		           
            $query_chart = "SELECT * FROM inventory ORDER BY product_id";
			$result_chart = mysqli_query($conn,$query_selectProducts);
		           
            // Fetch data for the chart
                    $inventoryChartData = array();
                    while($row = mysqli_fetch_assoc($result_chart)) {
                        $inventoryChartData[] = $row;
                    }
  include_once('layouts/header.php');
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
</style>
</head>
<body>
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
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark"
                            href="javascript:void(0)"><i class="fa fa-bars"></i></a> </li>

                            <nav>
                                    <a href="product.php">Home</a><!--
                                    --><a href="categorie.php">Categories</a><!--
                                    <a href="product.php">Products</a>
                                     <a href="add_product.php"
                                      class="btn waves-effect waves-light btn btn-info pull-right hidden-sm-down text-white">+ Add Product</a> -->
                            </nav>
                        </li>
                    </ul>
            </div>
        </div>
        <br>
  <div class="row">
  <div class="col-9">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Inventory Level</h4>
                            <canvas id="inventoryChart" width="200" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="row">
    <div class="col-md-12">
      <div class="card">
      <div class="card-body">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         <div class="pull-right">
           <a href="add_product.php" class="btn btn-primary">Add New</a>
         </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Product Title </th>
                <th class="text-center" style="width: 10%;"> Categories </th>
                <th class="text-center" style="width: 10%;"> In-Stock </th>
                <th class="text-center" style="width: 10%;"> Buying Price </th>
                <th class="text-center" style="width: 10%;"> Selling Price </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td> <?php echo $product['name']; ?></td>
                <td class="text-center"> <?php echo $product['categorie']; ?></td>
                <td class="text-center"> <?php echo $product['quantity']; ?></td>
                <td class="text-center"> <?php echo $product['buy_price']; ?></td>
                <td class="text-center"> <?php echo $product['sale_price']; ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs"  title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </tabel>
        </div>
      </div>
    </div>
    </div>
  </div>
  </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>

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
    <script>
    // Get the data from PHP and convert it to a JavaScript array
    var inventoryData = <?php echo json_encode($inventoryChartData); ?>;

    // Extract product names and quantities for the chart
    var productNames = inventoryData.map(item => item.info);
    var quantities = inventoryData.map(item => item.quantity);

    // Get the canvas element and context
    var ctx = document.getElementById('inventoryChart').getContext('2d');

    // Create the bar chart
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: productNames,
            datasets: [{
                label: 'Quantity',
                data: quantities,
                backgroundColor: 'rgb(65, 105, 225)', // Royal Blue color
                borderColor: 'rgba(75, 192, 192, 1)', // Border color
                borderWidth: 1 // Border width
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

      </body>
      </html>