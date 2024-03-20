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
    <!-- Bootstrap Core CSS -->
    <link href="../assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
	<?php
    	include '../header.php';
		include '../config.php';
		include '../sidebar.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Retrieve form data
                $supplierName = $_POST["supplierName"];
                $supplierAddress = $_POST["supplierAddress"];
                $contactNumber = $_POST["contactNumber"];
                $rawMaterialName = $_POST["rawMaterialName"];

                // Insert data into the database
                $stmt = $conn->prepare("INSERT INTO supplier_list (name, address, contact, raw_material) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $supplierName, $supplierAddress, $contactNumber, $rawMaterial);
                $stmt->execute();
                    }
 

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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">List of Suppliers</h3>
                            <div class="card-tools">
                                <a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-primary" data-toggle="modal" data-target="#createSupplierModal">
                                    <span class="fas fa-plus"></span> Create New
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <table class="table table-bordered table-striped">
                                <!-- Table Header -->
                                <colgroup>
                                    <col width="5%">
                                    <col width="15%">
                                    <col width="25%">
                                    <col width="25%">
                                    <col width="15%">
                                    <col width="15%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date Created</th>
                                        <th>Supplier</th>
                                        <th>Contact</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <!-- Table Body -->
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $qry = $conn->query("SELECT * FROM `supplier_list` ORDER BY `name` ASC");
                                    while ($row = $qry->fetch_assoc()):
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $i++; ?></td>
                                            <td><?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
                                            <td><?php echo $row['name'] ?></td>
                                            <td class=""><?php echo $row['contact'] ?></td>
                                            <td class="text-center">
                                                <span class="badge badge-<?php echo $row['status'] == 1 ? 'success' : 'danger'; ?> rounded-pill status-toggle" data-id="<?php echo $row['id']; ?>" data-status="<?php echo $row['status']; ?>">
                                                    <?php echo $row['status'] == 1 ? 'Active' : 'Inactive'; ?>
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                    Action
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu" role="menu">
                                                    <a class="dropdown-item edit_data" href="edit_supplier.php?id=<?php echo $row['id']; ?>">
                                                        <span class="fa fa-edit text-primary"></span> Edit
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item delete_data" href="delete_supplier.php?id=<?php echo $row['id']; ?>">
                                                        <span class="fa fa-trash text-danger"></span> Delete
                                                    </a>
                                                </div>
                                            </td>

                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
$(document).ready(function() {
    // Toggle Status
    $(".status-toggle").click(function() {
        var id = $(this).data("id");
        var status = $(this).data("status");
        $.ajax({
            url: "update_status.php", // PHP file to update the status
            type: "POST",
            data: { id: id, status: status },
            success: function(response) {
                location.reload(); // Reload the page to see the updated status
            }
        });
    });

});
</script>

<!-- <script>
$(document).ready(function() {
    // Handle the click event for the edit_data link
    $(".edit_data").on("click", function() {
        // Retrieve the data-id attribute value
        var id = $(this).data("id");

        // Open the modal for editing
        $('#editModal').modal('show');

        // Set the initial value in the modal input field (you can fetch the existing data using AJAX if needed)
        var initialData = "Initial data for ID: " + id;
        $("#editInput").val(initialData);

        // Handle the Save Changes button click
        $("#saveChangesBtn").on("click", function() {
            // Get the edited data from the input field
            var editedData = $("#editInput").val();

            // Implement your logic to save the changes (e.g., update the database)
            console.log("Saving changes for ID: " + id + ", New data: " + editedData);

            // Close the modal after saving changes
            $('#editModal').modal('hide');
        });
    });
});
</script> -->

    <!-- Create Supplier Modal -->
    <div class="modal" id="createSupplierModal" tabindex="-1" role="dialog" aria-labelledby="createSupplierModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createSupplierModalLabel">Create New Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form to Enter Supplier Details -->
                    <form id="createSupplierForm">
                        <div class="form-group">
                            <label for="supplierName">Name:</label>
                            <input type="text" class="form-control" id="supplierName" name="supplierName" required>
                        </div>
                        <div class="form-group">
                            <label for="supplierAddress">Address:</label>
                            <input type="text" class="form-control" id="supplierAddress" name="supplierAddress" required>
                        </div>
                        <div class="form-group">
                            <label for="contactNumber">Contact Number:</label>
                            <input type="text" class="form-control" id="contactNumber" name="contactNumber" required>
                        </div>
                        <div class="form-group">
        <label for="rawMaterial">Raw Material:</label>
        <input type="text" class="form-control" id="rawMaterial" name="rawMaterial" required>
    </div>
                        <!-- <div class="form-group">
                            <label for="supplierStatus">Status:</label>
                            <select class="form-control" id="supplierStatus" name="supplierStatus" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div> -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveSupplierBtn">Create Supplier</button>
                </div>
            </div>
        </div>
    </div>


    <script>
    $(document).ready(function () {
        $("#saveSupplierBtn").click(function () {
            var formData = $("#createSupplierForm").serialize();

            $.ajax({
                type: "POST",
                url: "suppliers_panel.php",
                data: formData,
                // dataType: "json",
                success: function (response) {
                    // Handle the server response
                    console.log(response);

                    window.location.href = 'suppliers_panel.php';

                },
                error: function (error) {
                    console.error(error);
                }
            });
        });
    });
</script>
<?php
       // Delete data based on ID
       if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_id"])) {
        $delete_id = $_POST["delete_id"];
    
        $stmt = $conn->prepare("DELETE FROM supplier_list WHERE id = ?");
        $stmt->bind_param("i", $delete_id);
        $stmt->execute();
    
        echo json_encode(array("success" => true));
        exit;
    }?>


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
		// include("../footer.php");
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