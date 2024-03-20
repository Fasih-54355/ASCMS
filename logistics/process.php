<?php
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and sanitize input
    $product = mysqli_real_escape_string($conn, $_POST["product"]);
    $quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);
    $destination = mysqli_real_escape_string($conn, $_POST["destination"]);

    // SQL to insert new shipment
    $sql = "INSERT INTO shipments (product, quantity, destination) VALUES (?, ?, ?)";

    // Prepare statement
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "sis", $product, $quantity, $destination);

        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to a confirmation page or back to the main page
            header("Location: logistics_panel.php?msg=ShipmentAdded");
        } else {
            // Handle errors, perhaps log them and show user-friendly message
            echo "Error: " . mysqli_error($conn);
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle errors, perhaps log them and show user-friendly message
        echo "Error preparing statement: " . mysqli_error($conn);
    }
} else {
    // Not a POST request, redirect or handle error
    header("Location: index.php");
    exit;
}

// Close connection
mysqli_close($conn);
?>
