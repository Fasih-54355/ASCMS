<?php
include '../config.php';  // Make sure to include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $currentStatus = $_POST["status"];
    $newStatus = $currentStatus == 1 ? 0 : 1; // Toggle the status

    $stmt = $conn->prepare("UPDATE supplier_list SET status = ? WHERE id = ?");
    $stmt->bind_param("ii", $newStatus, $id);
    $stmt->execute();

    echo json_encode(array("success" => true));
}

?>
