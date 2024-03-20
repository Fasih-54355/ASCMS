<?php
include("../config.php");
session_start();

if(isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $query_updateStatus = "UPDATE dist_order SET status = 'Confirmed' WHERE Order_id = $order_id";
    
    if(mysqli_query($conn, $query_updateStatus)) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}
?>
