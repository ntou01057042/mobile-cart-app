<?php
require_once('connMysql.php');
<<<<<<< HEAD
if($_SESSION["m_level"] == "")
    $query_RecOrder = "SELECT * FROM `order` ORDER BY `order`.`orderid` ASC";
    $stmt = $db_link->prepare($query_RecOrder);
    $stmt->execute();
    $RecOrder = $stmt->get_result();
=======
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
$query_RecOrder = "SELECT * FROM `order` ORDER BY `order`.`orderid` ASC";
$stmt = $db_link->prepare($query_RecOrder);
$stmt->execute();
$RecOrder = $stmt->get_result();
>>>>>>> main
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="utf-8">
    <title>訂單查詢</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" rel="stylesheet" type="text/css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js" type="text/javascript"></script>
    <style>
        body {
            font-family: sans-serif;
            background-color: #ffffff;
        }

        header {
            background-color: #000000;
            color: #ffffff;
            padding: 10px;
        }

        main {
            padding: 20px;
        }

        .orders {
            margin-bottom: 20px;
        }

        .datatable {
            border-collapse: collapse;
        }

        .datatable tr {
            border-bottom: 1px solid #000;
        }

        .datatable tr.last {
            border-bottom: none;
        }
    </style>
</head>

<body>
    <div data-position="fixed" data-role="header" data-position="fixed">
        <h1>訂單查詢</h1>
    </div>
    <main>
        <table width="100%" border="0" cellpadding="2" cellspacing="0" class="datatable">
            <tr>
                <th>編號</th>
                <th>小計</th>
                <th>訂購人姓名</th>
                <th>信箱</th>
                <th>住址</th>
                <th>電話</th>
                <th>付款方式</th>
                <th>操作</th>
            </tr>
            <?php while ($row_RecOrder = $RecOrder->fetch_assoc()) { ?>
                <tr>
                    <td align="center"><?php echo $row_RecOrder['orderid']; ?></td>
                    <td align="center"><?php echo $row_RecOrder['total']; ?></td>
                    <td align="center"><?php echo $row_RecOrder['customername']; ?></td>
                    <td align="center"><?php echo $row_RecOrder['customeremail']; ?></td>
                    <td align="center"><?php echo $row_RecOrder['customeraddress']; ?></td>
                    <td align="center"><?php echo $row_RecOrder['customerphone']; ?></td>
                    <td align="center"><?php echo $row_RecOrder['paytype']; ?></td>
                    <td><button type="button" class="cancel" data-orderid="<?php echo $row_RecOrder['orderid']; ?>">取消</button><button type="button" class="edit" data-orderid="<?php echo $row_RecOrder['orderid']; ?>">修改</button></td>
                </tr>
            <?php } ?>
        </table>
    </main>
    <div data-role="footer" data-position="fixed">
        <div data-role="navbar">
            <ul>
                <li><a href="index.php" data-icon="grid">逛逛商店</a></li>
                <li><a href="cart.php" data-icon="star" data-ajax="false">檢視購物車</a></li>
                <li><a href="search.php" data-icon="search" data-ajax="false" class="ui-btn-active">訂單查詢</a></li>
                <li><a href="?logout=true" data-icon="gear" data-ajax="false">登出</a></li>
            </ul>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(function() {
            // 取消訂單
            $('.cancel').click(function() {
                let orderID = $(this).data('orderid');
                let confirmCancel = window.confirm('您確定要取消此訂單嗎？');
                if (confirmCancel) {
                    $.ajax({
                        type: 'POST',
                        url: 'cancel_order.php', // PHP file to handle cancellation logic
                        data: {
                            orderID: orderID
                        },
                        success: function(response) {
                            // Handle success response here
                            window.alert("刪除成功");
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            // Handle error response here
                            console.error(xhr.responseText);
                            window.alert("刪除失敗");
                        }
                    });
                }
            });

            // 修改訂單
            $('.edit').click(function() {
                let orderID = $(this).data('orderid');
                window.location.href = "edit.php?oid=" + orderID;
            });
        });
    </script>
</body>

</html>