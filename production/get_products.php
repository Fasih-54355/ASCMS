<?php
include("../config.php"); // Database connection file

if(isset($_GET['category_id'])) {
    $categoryId = $_GET['category_id'];

    // Fetch products based on the category
    $stmt = $conn->prepare("SELECT product_id, name FROM products WHERE category_id = ?");
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = [];
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    echo json_encode($products); // Return the product data in JSON format
    $conn->close();
}
?>
