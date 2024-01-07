<?php
require_once('connMysql.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['orderID'])) {

    // Retrieve POST data
    $orderid = $_POST['orderID'];
    $customername = $_POST['customername'];
    $customeremail = $_POST['customeremail'];
    $customeraddress = $_POST['customeraddress'];
    $customerphone = $_POST['customerphone'];
    $paytype = $_POST['paytype'];
    // Prepare and execute the SQL query
    $query = "UPDATE `order` SET customername=?, customeremail=?, customeraddress=?, customerphone=?, paytype=? WHERE orderid=?";
    $stmt = $db_link->prepare($query);
    $stmt->bind_param('sssssi', $customername, $customeremail, $customeraddress, $customerphone, $paytype, $orderid); // Corrected variable name
    if ($stmt->execute()) {
        // Return a success message or any relevant response back to the AJAX call
        echo "Order edited successfully";
    } else {
        // Return an error message if the edit operation fails
        echo "Failed to edit order";
    }
} else {
    // Return an error message for invalid requests
    echo "Invalid request";
}
?>
