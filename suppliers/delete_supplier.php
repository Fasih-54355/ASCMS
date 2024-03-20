<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $supplier_id = $_GET['id'];

    $sql = "DELETE FROM supplier_list WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $supplier_id); // Assuming 'id' is an integer
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo "Supplier deleted successfully.";
            } else {
                echo "No supplier found with the specified ID or deletion failed.";
            }
        } else {
            echo "Error executing query: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid request method or no supplier ID specified.";
}

header("Location: suppliers.php");
exit();
?>
