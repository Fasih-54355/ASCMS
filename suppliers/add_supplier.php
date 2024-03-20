<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Retrieve form data
        $supplierName = $_POST["supplierName"];
        $supplierAddress = $_POST["supplierAddress"];
        $contactNumber = $_POST["contactNumber"];

        // Insert data into the database
        $stmt = $conn->prepare("INSERT INTO supplier_list (name, address, contact) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $supplierName, $supplierAddress, $contactNumber);

        if ($stmt->execute()) {
            // Success
            $response = array('status' => 'success');
        } else {
            // Error
            $response = array('status' => 'error', 'message' => 'Failed to execute statement');
        }

        // Close the statement
        $stmt->close();
    } catch (Exception $e) {
        $response = array('status' => 'error', 'message' => $e->getMessage());
    }

    // Close the database connection (if not using persistent connections)
    $conn->close();
} else {
    // Invalid request method
    $response = array('status' => 'error', 'message' => 'Method Not Allowed');
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
