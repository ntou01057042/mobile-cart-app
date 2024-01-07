<?php
require_once('connMysql.php');
//
session_start();
//檢查是否經過登入
if (!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"] == "")) {
    header("Location: login.php");
}
//執行登出動作
if (isset($_GET["logout"]) && ($_GET["logout"] == "true")) {
    unset($_SESSION["userId"]);
    unset($_SESSION["loginMember"]);
    unset($_SESSION["memberLevel"]);
    header("Location: index.php");
}
//
if (isset($_GET['cid']) && ($_GET['cid'] != "")) {
    $query_RecProduct = "SELECT * FROM product WHERE categoryid = ? ORDER BY productid DESC";
    $stmt = $db_link->prepare($query_RecProduct);
    $stmt->bind_param("i", $_GET['cid']);
    $stmt->execute();
    $RecProduct = $stmt->get_result();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>PHP行動購物網</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" rel="stylesheet" type="text/css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js" type="text/javascript"></script>
</head>

<body>

    <div data-role="page" id="page" data-add-back-btn="true">
        <div data-role="header" data-position="fixed">
            <h1>行動購物網</h1>
        </div>
        <div data-role="content">
            <ul data-role="listview" data-inset="true" data-filter="true">
                <li data-role="list-divider">產品列表</li>
                <!--  -->
                <?php while ($row_RecProcuct = $RecProduct->fetch_assoc()) { ?>
                    <li>
                        <a href="product.php?pid=<?php echo $row_RecProcuct['productid']; ?>">
                            <img src="proimg/<?php echo $row_RecProcuct['productimages']; ?>" alt="" border="0" />
                            <h2><?php echo $row_RecProcuct['productname']; ?></h2>
                            <p>特價 <strong>$<?php echo $row_RecProcuct['productprice']; ?></strong></p>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div data-role="footer" data-position="fixed">
            <div data-role="navbar">
                <ul>
                    <li><a href="index.php" data-icon="grid" class="ui-btn-active">逛逛商店</a></li>
                    <li><a href="cart.php" data-icon="star" data-ajax="false">檢視購物車</a></li>
                    <li><a href="search.php" data-icon="search" data-ajax="false">訂單查詢</a></li>
                    <li><a href="?logout=true" data-icon="gear" data-ajax="false">登出</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>
<?php
$stmt->close();
$db_link->close();
?>