<?php
require_once("connMysql.php");
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
$query_RecCategory = "SELECT `category`.`categoryid`, `category`.`categoryname`, `category`.`categorysort`, COUNT(`product`.`productid`) as `productNum` FROM `category` LEFT JOIN `product` ON `category`.`categoryid` = `product`.`categoryid` GROUP BY `category`.`categoryid`, `category`.`categoryname`, `category`.`categorysort` ORDER BY `category`.`categorysort` ASC";
$Rec_Category = $db_link->query($query_RecCategory);
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
        <div data-position="fixed" data-role="header" data-position="fixed">
            <h1>行動購物網</h1>
        </div>
        <div data-role="content">
            <ul data-role="listview" data-inset="true" data-filter="true">
                <li data-role="list-divider">分類</li>
                <?php while ($row_RecCategory = $Rec_Category->fetch_assoc()) { ?>
                    <li><a href="category.php?cid=<?php echo $row_RecCategory['categoryid']; ?>"><?php echo $row_RecCategory['categoryname']; ?><span class="ui-li-count"><?php echo $row_RecCategory['productNum']; ?></span></a></li>
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
<?php $db_link->close(); ?>