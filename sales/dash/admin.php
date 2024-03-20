<?php
include '../../config.php';
include('sidebar.php');
include_once('../../header.php');

  require_once('includes/load.php');
?>
<?php
//  $c_categorie     = count_by_id('categories');
//  $c_product       = count_by_id('products');
//  $c_sale          = count_by_id('sales');
//  $c_user          = count_by_id('users');
//  $products_sold   = find_higest_saleing_product('10');
//  $recent_products = find_recent_product_added('5');
//  $recent_sales    = find_recent_sale_added('5')

// category
$sql = "SELECT COUNT(*) as total_categories FROM categories";
$result = mysqli_query($conn, $sql);
$row1 = mysqli_fetch_assoc($result);

// products
$sql = "SELECT COUNT(*) as total_products FROM products";
$result = mysqli_query($conn, $sql);
$row2 = mysqli_fetch_assoc($result);

// sales
$sql = "SELECT COUNT(*) as total_sales FROM sales";
$result = mysqli_query($conn, $sql);
$row3 = mysqli_fetch_assoc($result);

// product data
$sql = "SELECT product_name, SUM(quantity_sold) AS quantity_sold FROM sales GROUP BY product_name ORDER BY quantity_sold DESC";
$result = mysqli_query($conn, $sql);

// Recent sales data
$sql = "SELECT sale_id, product_name, date, revenue FROM sales ORDER BY date DESC";
$recent = mysqli_query($conn, $sql);

?>
<?php include_once('layouts/header.php'); ?>
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
    .table-responsive {
    display: block;
    max-height: 400px; /* Adjust this value as needed */
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
    
        <div class="header">
            <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark"
                            href="javascript:void(0)"><i class="fa fa-bars"></i></a> </li>

                            <nav>
                                    <a href="admin.php">Home</a>
                                    <a href="sales.php">Manage Sales</a>
                                    <a href="sales_report.php">Reports</a>
                                    <a href="sales_predict.php">Sales Prediction</a>
                                     <!--<a href="add_product.php"
                                      class="btn waves-effect waves-light btn btn-info pull-right hidden-sm-down text-white">+ Add Product</a> -->
                            </nav>
                        </li>
                    </ul>
            </div>
        </div>
        <br>

  <div class="row">
  
	
    <div class="col-md-3">
    <a href="../../inventory/InventorySystem_PHP/categorie.php" style="text-decoration: none; color: inherit;">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-red">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $row1['total_categories']; ?> </h2>
          <p class="text-muted">Categories</p>
        </div>
       </div>
       </a>
    </div>

    <div class="col-md-3">
    <a href="../../inventory/InventorySystem_PHP/product.php" style="text-decoration: none; color: inherit;">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue2">
          <i class="glyphicon glyphicon-shopping-cart"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $row2['total_products']; ?> </h2>
          <p class="text-muted">Products</p>
        </div>
       </div>
       </a>
    </div>
	
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-usd"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $row3['total_sales']; ?></h2>
          <p class="text-muted">Sales</p>
        </div>
       </div>
    </div>

  </div>
  <br>
  <div class="row">
   <div class="col-md-4">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Highest Selling Products</span>
         </strong>
       </div>
       <div class="table-responsive">
       <table class="table table-striped table-bordered table-condensed">
    <thead>
        <tr>
            <th>Title</th>
            <th>Total Sold</th>
            <!-- <th>Total Quantity</th> -->
        </tr>
    </thead>
    <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo remove_junk(first_character($row['product_name'])); ?></td>
                    <td><?php echo (int)$row['quantity_sold']; ?></td>
                </tr>
            <?php endwhile; ?>
        <?php endif; ?>
    </tbody>
</table>
       </div>
     </div>
   </div>

   <div class="col-md-4">
  <div class="panel panel-default">
    <div class="panel-heading">
      <strong>
        <span class="glyphicon glyphicon-th"></span>
        <span>LATEST SALES</span>
      </strong>
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th>Product Name</th>
            <th>Date</th>
            <th>Total Sale</th>
          </tr>
        </thead>
        <tbody>
          <?php if (mysqli_num_rows($recent) > 0): ?>
            <?php foreach ($recent as $index => $recent_sale): ?>
              <tr>
                <td class="text-center"><?php echo $index + 1; ?></td>
                <td>
                    <?php echo $recent_sale['product_name']; ?>
                </td>
                <td><?php echo $recent_sale['date']; ?></td>
                <td>$<?php echo $recent_sale['revenue']; ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="4">No recent sales data available.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
  <!-- <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Recently Added Products</span>
        </strong>
      </div>
      <div class="panel-body">

        <div class="list-group">
      <?php foreach ($recent_products as  $recent_product): ?>
            <a class="list-group-item clearfix" href="edit_product.php?id=<?php echo    (int)$recent_product['id'];?>">
                <h4 class="list-group-item-heading">
                 <?php if($recent_product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $recent_product['image'];?>" alt="" />
                <?php endif;?>
                <?php echo remove_junk(first_character($recent_product['name']));?>
                  <span class="label label-warning pull-right">
                 $<?php echo (int)$recent_product['sale_price']; ?>
                  </span>
                </h4>
                <span class="list-group-item-text pull-right">
                <?php echo remove_junk(first_character($recent_product['categorie'])); ?>
              </span>
          </a>
      <?php endforeach; ?>
    </div>
  </div>
 </div>
</div>
 </div> -->
  <div class="row">

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


      </body>
      </html>