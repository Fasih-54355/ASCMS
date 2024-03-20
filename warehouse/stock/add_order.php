<?php
include 'config.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the form is submitted
    $po_code = $_POST['po_code'];
    $supplier_id = $_POST['supplier_id'];
    $amount = $_POST['amount'];
    $discount_perc = $_POST['discount_perc'];
    $discount = $_POST['discount'];
    $tax_perc = $_POST['tax_perc'];
    $tax = $_POST['tax'];
    $remarks = $_POST['remarks'];

    // Your SQL query to insert data into the database
 // Your SQL query to insert data into the database
$query = "INSERT INTO purchase_order_list (po_code, supplier_id, amount, discount_perc, discount, tax_perc, tax, remarks)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare the statement
$stmt = $conn->prepare($query);

// Bind parameters
$stmt->bind_param("ssddddss", $po_code, $supplier_id, $amount, $discount_perc, $discount, $tax_perc, $tax, $remarks);

// Execute the query
$result = $stmt->execute();

// Check for success
if ($result) {
echo "Data inserted successfully!";
} else {
echo "Error: " . $stmt->error;
}

// Close the statement
$stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Purchase Order</title>
    <link href="../../assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add any additional styles as needed -->
</head>
<body>
    <div class="container">
        <h2>Add Purchase Order</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="po_code">P.O. Code</label>
                <input type="text" class="form-control" id="po_code" name="po_code" required>
            </div>

            <div class="form-group">
                <label for="supplier_id">Supplier</label>
                <select class="form-control" id="supplier_id" name="supplier_id" required>
                    <option value="" disabled selected>Select Supplier</option>
                    <?php
                    // Fetch suppliers from the database (replace this with your logic)
                    $supplierQuery = $conn->query("SELECT id, name FROM supplier_list WHERE status = 1 ORDER BY name ASC");
                    while ($row = $supplierQuery->fetch_assoc()) {
                        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" class="form-control" id="amount" name="amount" required>
            </div>

            <div class="form-group">
                <label for="discount_perc">Discount Percentage</label>
                <input type="number" class="form-control" id="discount_perc" name="discount_perc" required>
            </div>

            <div class="form-group">
                <label for="discount">Discount</label>
                <input type="number" class="form-control" id="discount" name="discount" required>
            </div>

            <div class="form-group">
                <label for="tax_perc">Tax Percentage</label>
                <input type="number" class="form-control" id="tax_perc" name="tax_perc" required>
            </div>

            <div class="form-group">
                <label for="tax">Tax</label>
                <input type="number" class="form-control" id="tax" name="tax" required>
            </div>

            <div class="form-group">
                <label for="remarks">Remarks</label>
                <textarea class="form-control" id="remarks" name="remarks"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add Order</button>
        </form>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
