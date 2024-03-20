<?php
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = mysqli_real_escape_string($conn, $_POST['product_name']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);

    // Check inventory for the requested product
    $query_checkInventory = "SELECT quantity FROM inventory WHERE product_name = '$productName'";
    $result_inventory = mysqli_query($conn, $query_checkInventory);
    
    if ($result_inventory) {
        $inventory = mysqli_fetch_assoc($result_inventory);

        // Check if sufficient stock is available
        if ($inventory['quantity'] >= $quantity) {
            // Process the order normally
            // Insert into orders table
            $query_insertOrder = "INSERT INTO dist_orders (product_name, Quantity, Order_date, status) VALUES ('$productName', '$quantity', NOW(), 'Confirmed')";
            mysqli_query($conn, $query_insertOrder);
            echo "Order placed successfully";
            // Additional logic for reducing inventory, etc.
        } else {
            // Insert into back order table
            $query_insertBackOrder = "INSERT INTO bo_items (product_name, quantity, order_date) VALUES ('$productName', '$quantity', NOW())";
            mysqli_query($conn, $query_insertBackOrder);
            echo "Product is out of stock, order has been placed in back orders";
        }
    } else {
        // echo "Error checking inventory: " . mysqli_error($conn);
    }
}
// session_start();
// if (isset($_SESSION['dist_login'])) {
//     if ($_SESSION['dist_login'] == true) {
//         // Select last 5 retailers
//         $query_selectRetailer = "SELECT * FROM retailer ORDER BY retailer_id DESC LIMIT 5";
//         $result_selectRetailer = mysqli_query($conn, $query_selectRetailer);

//         // Select last 5 products
//         $query_selectProducts = "SELECT * FROM products ORDER BY product_id DESC LIMIT 5";
//         $result_selectProducts = mysqli_query($conn, $query_selectProducts);
//     } else {
//         header('Location:../index.php');
//     }
// } else {
//     header('Location:../index.php');
// }
$query_selectOrders = "SELECT * FROM dist_orders ORDER BY Order_id DESC"; // Adjust the query as per your database schema
$result_selectOrders = mysqli_query($conn, $query_selectOrders);

// SQL query to fetch products
$sql = "SELECT product_id, name FROM products"; // Adjust with your actual table and column names
$result = $conn->query($sql);

// Check if we have products
$products = [];
if ($result && $result->num_rows > 0) {
    // Fetch all products
    while($row = $result->fetch_assoc()) {
        $products[$row["product_id"]] = $row["name"];
    }
} else {
    echo "0 results";
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
    <!-- Bootstrap Core CSS -->
    <link href="../assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
	<?php
		include '../header.php';
		include 'sidebar.php';
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
                </ol>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- Orders Table -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Order Details</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Order Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result_selectOrders)): ?>
                                <tr>
                                    <td><?php echo $row['Order_id']; ?></td>
                                    <td><?php echo $row['product_name']; ?></td>
                                    <td><?php echo $row['Quantity']; ?></td>
                                    <td><?php echo $row['Order_date']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#placeOrderModal">
  Place New Order
</button>

<!-- Order Modal -->
<div class="modal fade" id="placeOrderModal" tabindex="-1" aria-labelledby="placeOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="placeOrderModalLabel">New Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="dist_orders.php">

                <div class="mb-3">
    <label for="productName" class="form-label">Product Name</label>
    <select class="form-control" id="productName" name="product_name" required>
        <option value="">Select a product</option>
        <?php foreach($products as $id => $name): ?>
            <option value="<?php echo htmlspecialchars($id); ?>"><?php echo htmlspecialchars($name); ?></option>
        <?php endforeach; ?>
    </select>
</div>                    <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" required>
                    </div>
                    <!-- Add any additional fields you need for the order -->
                    <button type="submit" class="btn btn-primary">Place Order</button>
                    </form>
                    </div>
</div>
</div>

</div>
<div class="row">

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