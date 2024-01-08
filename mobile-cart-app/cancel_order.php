<?php
// cancel_order.php
require_once('connMysql.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['orderID'])) {
    $orderid = $_POST['orderID'];
    $stmt = $db_link->prepare("DELETE FROM `order` WHERE orderid = ?");
    $stmt->bind_param('i', $orderid);

    if ($stmt->execute()) {
        // Return success message if cancellation is successful
        echo "Order cancelled successfully";
    } else {
        // Return error message if cancellation fails
        echo "Failed to cancel order";
    }
} else {
    echo "Invalid request";
}
