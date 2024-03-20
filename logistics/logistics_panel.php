<?php
include("../config.php");

// Function to get shipment details
function getShipmentDetails($conn) {
    $query = "SELECT * FROM shipments"; // Replace with your actual SQL query
    $result = mysqli_query($conn, $query);
    $shipments = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $shipments;
}

// Function to get transportation schedule
function getTransportationSchedule($conn) {
    $query = "SELECT * FROM transportation_schedule"; // Replace with your actual SQL query
    $result = mysqli_query($conn, $query);
    $schedule = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $schedule;
}

// Function to get vehicle details
function getVehicleDetails($conn) {
    $query = "SELECT * FROM vehicles"; // Replace with your actual SQL query
    $result = mysqli_query($conn, $query);
    $vehicles = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $vehicles;
}


// Function to update vehicle status
function updateVehicleStatus($conn, $vehicleId, $newStatus) {
    $query = "UPDATE vehicles SET status = '$newStatus' WHERE id = $vehicleId";
    mysqli_query($conn, $query);
}

// Fetch vehicle data
$vehicles = getVehicleDetails($conn);

// Function to update schedule (Placeholder - Implement as needed)
function updateSchedule($conn, $scheduleId, $newDate) {
    // Update the schedule in the database
}

// Fetching data
$shipments = getShipmentDetails($conn);
$schedule = getTransportationSchedule($conn);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $product = mysqli_real_escape_string($conn, $_POST["product"]);
    $quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);
    $destination = mysqli_real_escape_string($conn, $_POST["destination"]);

    $sql = "INSERT INTO shipments (product, quantity, destination) VALUES ('$product', '$quantity', '$destination')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect to the main page
        exit(); // Terminate script after redirection
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch recent shipments
// $sqlRecentShipments = "SELECT * FROM shipments ORDER BY id DESC LIMIT 5";
// $resultRecentShipments = $conn->query($sqlRecentShipments);
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
        <div>
            <!-- Add Shipment Modal -->
<div class="modal fade" id="addShipmentModal" tabindex="-1" role="dialog" aria-labelledby="addShipmentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addShipmentModalLabel">Add New Shipment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="process.php" method="post">
                <div class="modal-body">
                    <!-- Form fields -->
                    <div class="form-group">
                        <label for="product">Product:</label>
                        <input type="text" class="form-control" name="product" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" class="form-control" name="quantity" required>
                    </div>
                    <div class="form-group">
                        <label for="destination">Destination:</label>
                        <input type="text" class="form-control" name="destination" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Add Shipment">
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Shipment Tracking                 <a href="#" class="btn waves-effect waves-light btn btn-info pull-right hidden-sm-down text-white" data-toggle="modal" data-target="#addShipmentModal">+ Add Shipment</a>
</h4>
                <!-- Shipment Tracking Table -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Shipment ID</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Destination</th>
                                <!-- Add other relevant columns -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($shipments as $shipment): ?>
                                <tr>
                                    <td><?= htmlspecialchars($shipment['id']) ?></td>
                                    <td><?= htmlspecialchars($shipment['product']) ?></td>
                                    <td><?= htmlspecialchars($shipment['quantity']) ?></td>
                                    <td><?= htmlspecialchars($shipment['destination']) ?></td>
                                    <!-- Output other shipment details -->
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Transportation Scheduling Section -->
    <div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Transportation Scheduling</h4>

                <!-- Transportation Scheduling Table -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Transport ID</th>
                                <!-- Add other relevant columns -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($schedule as $entry): ?>
                                <tr>
                                    <td><?= htmlspecialchars($entry['date']) ?></td>
                                    <td><?= htmlspecialchars($entry['transport_id']) ?></td>
                                    <!-- Output other scheduling details -->
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- </div> -->

<!-- <div class="row mt-3"> -->
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Vehicle Details</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Vehicle ID</th>
                                <th>Vehicle Number</th>
                                <th>Capacity</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($vehicles as $vehicle): ?>
                                <tr>
                                    <td><?= htmlspecialchars($vehicle['id']) ?></td>
                                    <td><?= htmlspecialchars($vehicle['vehicle_number']) ?></td>
                                    <td><?= htmlspecialchars($vehicle['capacity']) ?></td>
                                    <td><?= htmlspecialchars($vehicle['status']) ?></td>
                                    <!-- Add other relevant columns -->
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

                    <!-- Distributor List -->
    <!-- <div class="row mt-3">
        <div class="col-10">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Distributor List</h4>
                    <div class="table-responsive">
                        <table class="table">
         <thead>
            <tr>
                <th>ID</th>
                <th></th>
                <th>Destination</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($resultRecentShipments->num_rows > 0) : ?>
                <?php while ($row = $resultRecentShipments->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row["product"]); ?></td>
                        <td><?php echo htmlspecialchars($row["quantity"]); ?></td>
                        <td><?php echo htmlspecialchars($row["destination"]); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else : ?>
                <tr> -->
                    <!-- <td colspan="3">No recent shipments.</td> -->
                <!-- </tr>
            <?php endif; ?>
            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
