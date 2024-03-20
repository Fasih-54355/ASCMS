<?php
include("../config.php"); // Database connection file
session_start();

if(isset($_SESSION['admin_login']) && $_SESSION['admin_login'] == true) {
    // Function to add a new QA record
    function addQARecord($productId, $qaDate, $qaMetrics, $qaResults) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO quality_assurance (product_id, qa_date, qa_metrics, qa_results) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $productId, $qaDate, $qaMetrics, $qaResults);
        return $stmt->execute();
    }

    // Function to retrieve QA records
    function getQARecords() {
        global $conn;
        $sql = "SELECT * FROM quality_assurance";
        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Handling form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $productId = $_POST["product_id"];
        $qaDate = $_POST["qa_date"];
        $qaMetrics = $_POST["qa_metrics"];
        $qaResults = $_POST["qa_results"];

        if (addQARecord($productId, $qaDate, $qaMetrics, $qaResults)) {
            echo "QA record added successfully.";
        } else {
            echo "Error adding QA record.";
        }
    }

    // Retrieve QA records
    $qaRecords = getQARecords();
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
                            <a href="quality_assurance.php">Quality Assurance</a>
                            <a href="resource_management.php">Resource Management</a>
                        </nav>
                    </li>
                    </ul>
                </div>                    
            </div>

            <!-- QA Form -->
            <div class="row">
                <div class="col-12">
                    <h4 class="card-title">Quality Assurance Record</h4>
                    <form method="post" action="">
                        <label for="product_id">Product ID:</label>
                        <input type="number" name="product_id" required><br>

                        <label for="qa_date">QA Date:</label>
                        <input type="date" name="qa_date" required><br>

                        <label for="qa_metrics">QA Metrics:</label>
                        <textarea name="qa_metrics" required></textarea><br>

                        <label for="qa_results">QA Results:</label>
                        <textarea name="qa_results" required></textarea><br>

                        <button type="submit">Add QA Record</button>
                    </form>
                </div>
            </div>

            <!-- Display QA Records -->
            <div class="row mt-4">
                <div class="col-12">
                    <h4 class="card-title">Quality Assurance Records</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>QA ID</th>
                                    <th>Product ID</th>
                                    <th>QA Date</th>
                                    <th>QA Metrics</th>
                                    <th>QA Results</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($qaRecords as $record): ?>
                                    <tr>
                                        <td><?php echo $record["qa_id"]; ?></td>
                                        <td><?php echo $record["product_id"]; ?></td>
                                        <td><?php echo $record["qa_date"]; ?></td>
                                        <td><?php echo $record["qa_metrics"]; ?></td>
                                        <td><?php echo $record["qa_results"]; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
