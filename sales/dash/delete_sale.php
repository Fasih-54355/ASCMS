<?php
include '../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $sale_id = $_GET['id'];

    $sql = "DELETE FROM sales WHERE sale_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $sale_id);
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo "Sale deleted successfully.";
            } else {
                echo "No sale found with the specified ID or deletion failed.";
            }
        } else {
            echo "Error executing query: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid request method or no sale ID specified.";
}

header("Location: sales.php");
exit();
?>
