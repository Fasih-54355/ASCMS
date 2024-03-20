<?php
include '../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sale_id = $_POST['sale_id']; // Assuming 'sale_id' comes as a string like 'SAL98'
    $product_name = trim($_POST['product_name']); // Basic sanitization
    $quantity_sold = $_POST['quantity_sold'];
    $revenue = $_POST['revenue'];
    $date = $_POST['date'];

    // Validate and sanitize inputs (add your validation logic here)

    $sql = "UPDATE sales SET product_name = ?, quantity_sold = ?, revenue = ?, date = ? WHERE sale_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        // Notice that 'sale_id' is bound as a string ('s')
        $stmt->bind_param("sidss", $product_name, $quantity_sold, $revenue, $date, $sale_id);
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                // Redirect to a different page after successful update
                header("Location: sales.php"); // Adjust with the correct URL of your sales page
                exit();
            } else {
                echo "No changes made or error occurred.";
            }
        } else {
            echo "Error executing query: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid request method.";
}
?>
