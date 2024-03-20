<?php
include_once('../../header.php');
include_once('../sidebar.php');

$host = 'localhost';
$dbname = 'scms';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}

$page_title = 'Add Product';
require_once('includes/load.php');

$all_categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
$all_sup = $pdo->query("SELECT * FROM suppliers")->fetchAll(PDO::FETCH_ASSOC);
$all_warehouse = $pdo->query("SELECT * FROM warehouse")->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['add_product'])) {
    $req_fields = array('product-title', 'product-categorie', 'product-quantity', 'buying-price', 'saleing-price', 'product-photo', 'product-categorie');
    if (empty($errors)) {
        $p_name  = $pdo->quote($_POST['product-title']);
        $p_cat   = $_POST['product-categorie'];
        $p_qty   = $_POST['product-quantity'];
        $p_cost   = $_POST['buying-price'];
        $p_sale  = $_POST['saleing-price'];
        $sup_id  = $_POST['product-photo'];
        $war_id  = $_POST['product-categorie'];

        $query = "INSERT INTO products (name, quantity, cost_price, sale_price, categorie_id, supplier_id, warehouse_id, date) ";
        $query .= "VALUES (:name, :quantity, :cost_price, :sale_price, :categorie_id, :supplier_id, :warehouse_id, NOW()) ";
        $query .= "ON DUPLICATE KEY UPDATE name = :name";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':name', $p_name);
        $stmt->bindParam(':quantity', $p_qty);
        $stmt->bindParam(':cost_price', $p_cost);
        $stmt->bindParam(':sale_price', $p_sale);
        $stmt->bindParam(':categorie_id', $p_cat);
        $stmt->bindParam(':supplier_id', $sup_id);
        $stmt->bindParam(':warehouse_id', $war_id);
        $stmt->execute();

        if ($stmt) {
            header('location: add_product.php');
        } else {
            header('location: product.php');
        }
    } else {
        header('location: add_product.php');
    }
}

include_once('layouts/header.php');
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
    <div class="col-md-12">
    </div>
</div>

<div class="row">
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>
                                <span class="glyphicon glyphicon-th"></span>
                                <span>Add New Product</span>
                            </strong>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <form method="post" action="add_product.php" class="clearfix">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="glyphicon glyphicon-th-large"></i>
                                            </span>
                                            <input type="text" class="form-control" name="product-title" placeholder="Product Title">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                        <div class="col-md-4">
                                    <select class="form-control" name="product-categorie">
                                        <option value="">Select Product Category</option>
                                        <?php foreach ($all_categories as $cat): ?>
                                            <option value="<?php echo (int)$cat['category_id'] ?>">
                                                <?php echo $cat['category_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                            <!-- <div class="col-md-4">
                                                <select class="form-control" name="product-photo">
                                                    <option value="">Select Supplier</option>
                                                    <?php foreach ($all_sup as $sup): ?>
                                                        <option value="<?php echo $sup['supplier_id'] ?>">
                                                            <?php echo $sup['supplier_name'] ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div> -->
                                            <div class="col-md-4">
                                                <select class="form-control" name="product-categorie">
                                                    <option value="">Select Warehouse</option>
                                                    <?php foreach ($all_warehouse as $war): ?>
                                                        <option value="<?php echo $war['warehouse_id'] ?>">
                                                            <?php echo $war['warehouse_name'] ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="glyphicon glyphicon-shopping-cart"></i>
                                                    </span>
                                                    <input type="number" class="form-control" name="product-quantity" placeholder="Product Quantity">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="glyphicon glyphicon-usd"></i>
                                                    </span>
                                                    <input type="number" class="form-control" name="buying-price" placeholder="Cost Price">
                                                    <span class="input-group-addon">.00</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="glyphicon glyphicon-usd"></i>
                                                    </span>
                                                    <input type="number" class="form-control" name="saleing-price" placeholder="Selling Price">
                                                    <span class="input-group-addon">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" name="add_product" class="btn btn-danger">Add product</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include_once('layouts/footer.php'); ?>

        </div>
    </div>    <!-- ============================================================== -->
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