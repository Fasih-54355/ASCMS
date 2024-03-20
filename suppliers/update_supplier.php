<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supplier_id = $_POST['id']; // Assuming 'id' is the identifier for the supplier
    $name = trim($_POST['name']); // Basic sanitization
    $address = trim($_POST['address']);
    $contact = trim($_POST['contact']);
    $raw_material = trim($_POST['raw_material']); // Assuming you have a raw_material field

    // Validate and sanitize inputs (add your validation logic here)

    $sql = "UPDATE supplier_list SET name = ?, address = ?, contact = ?, raw_material = ? WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssi", $name, $address, $contact, $raw_material, $supplier_id);
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                // Redirect to a different page after successful update
                header("Location: suppliers_panel.php"); // Adjust with the correct URL of your suppliers page
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
