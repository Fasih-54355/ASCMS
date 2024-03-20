<?php
include("../config.php"); // Include your database connection file
session_start();

if(isset($_SESSION['admin_login']) && $_SESSION['admin_login'] == true) {
    // Function to add a new production schedule to the database
    function addSchedule($productId, $scheduledStart, $scheduledEnd, $resources) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO production (ProductionID, StartDateTime, EndDateTime, raw_materials) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $productId, $scheduledStart, $scheduledEnd, $resources);
        return $stmt->execute();
    }

    // Example usage:
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $productId = $_POST["ProductionID"];
        $scheduledStart = $_POST["StartDateTime"];
        $scheduledEnd = $_POST["EndDateTime"];
        $resources = $_POST["raw_materials"];

        if (addSchedule($productId, $scheduledStart, $scheduledEnd, $resources)) {
            echo "Production schedule added successfully.";
        } else {
            echo "Error adding schedule.";
        }
    }
} else {
    header('Location:../index.php');
}
// Fetch categories
$categories_sql = "SELECT category_id, category_name FROM categories";
$categories_result = $conn->query($categories_sql);
$categories = [];
if ($categories_result && $categories_result->num_rows > 0) {
    while($row = $categories_result->fetch_assoc()) {
        $categories[$row["category_id"]] = $row["category_name"];
    }
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                    <h4 class="card-title">Schedule Production</h4>
                    <form method="post" action="">

                    <label for="Category">Category:</label>
    <select id="Category" name="Category" required onchange="fetchProducts(this.value)">
        <option value="">Select a Category</option>
        <?php foreach($categories as $id => $name): ?>
            <option value="<?php echo htmlspecialchars($id); ?>"><?php echo htmlspecialchars($name); ?></option>
        <?php endforeach; ?>
    </select><br>

    <label for="ProductName">Product Name:</label>
    <select id="ProductName" name="ProductName" required>
        <option value="">Select a Product</option>
        <!-- Product options will be dynamically populated -->
    </select><br>


                    <label for="ProductQuantity">Product Quantity:</label>
                    <input type="number" name="ProductQuantity" required><br>

                    <label for="StartDateTime">Scheduled Start:</label>
                    <input type="datetime-local" name="StartDateTime" required><br>

                    <label for="EndDateTime">Scheduled End:</label>
                    <input type="datetime-local" name="EndDateTime" required><br>

                    <h3>Resources</h3>
                    <div id="rawMaterialsContainer">
                        <label for="raw_materials">Raw Materials:</label>
                        <textarea name="raw_materials" required></textarea><br>
                    </div>
                    <button type="button" id="addMaterial">+ Add Raw Material</button><br>

                    <button type="submit">Add Schedule</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
                    </div>
        <!-- End Container fluid -->
    </div>
    <!-- End Page wrapper -->

    <?php include("../footer.php"); ?>
    <!-- Include your existing scripts -->
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

    <script>
    function fetchProducts(categoryId) {
        // Clear existing options
        document.getElementById('ProductName').innerHTML = '<option value="">Select a Product</option>';

        if (!categoryId) return;

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_products.php?category_id=' + categoryId, true);
        xhr.onload = function() {
            if (this.status === 200) {
                var products = JSON.parse(this.responseText);
                var productSelect = document.getElementById('ProductName');
                products.forEach(function(product) {
                    var option = document.createElement('option');
                    option.value = product.product_id;
                    option.textContent = product.name;
                    productSelect.appendChild(option);
                });
            }
        };
        xhr.send();
    }
</script>
</body>
</html>
