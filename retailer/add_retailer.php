<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retailer Management System</title>
    <!-- Include Bootstrap CSS if needed -->
</head>
<body>
<?php
include '../config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve retailer name from the form
    $retailerName = $_POST["username"];

    // Validation and sanitation can be added here

    // Add retailer to the database
    $sql = "INSERT INTO retailer (username) VALUES ('$retailerName')";
    mysqli_query($conn, $sql);
    
    // Redirect back to the main page
    header("Location: index.php");
    exit();
}
?>


    <h1>Retailer Management System</h1>

    <h2>Add Retailer</h2>
    <form action="add_retailer.php" method="post">
        <label for="retailer_name">Retailer Name:</label>
        <input type="text" id="retailer_name" name="retailer_name" required>
        <button type="submit">Add Retailer</button>
    </form>

    <h2>View Retailers</h2>
    <?php include 'view_retailers.php'; ?>

</body>
</html>
