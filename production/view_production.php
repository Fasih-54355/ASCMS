<?php
include '../config.php';

$sql = "SELECT * FROM production";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["ProductionID"]. " - Product ID: " . $row["product_id"]. " - Start: " . $row["StartDateTime"]. " - End: " . $row["EndDateTime"]. " - Quantity: " . $row["QuantityProduced"]. " - Status: " . $row["Status"]. " - Remarks: " . $row["Remarks"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>