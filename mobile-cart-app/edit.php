<?php
require_once('connMysql.php');
if(isset($_GET['oid'])&&($_GET['oid']!='')){
    $query_RecProduct = "SELECT * FROM order WHERE orderid=?";
    $stmt = $db_link->prepare($query_RecProduct);
    $stmt->bind_param("i", $_GET['pid']);
    $stmt->execute();
    $RecProduct = $stmt->get_result();
    $row_RecProduct = $RecProduct->fetch_assoc();
}
?>