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

if (isset($_GET['oid']) && ($_GET['oid'] != '')) {
    $query_RecProduct = "SELECT * FROM `order` WHERE orderid=?";
    $stmt = $db_link->prepare($query_RecProduct);
    $stmt->bind_param("i", $_GET['oid']);
    $stmt->execute();
    $RecOrder = $stmt->get_result();
}

if (isset($_GET['oid']) && ($_GET['oid'] != '')) {
    $query_RecProduct = "SELECT * FROM `orderdetail` WHERE orderid=?";
    $stmt = $db_link->prepare($query_RecProduct);
    $stmt->bind_param("i", $_GET['oid']);
    $stmt->execute();
    $RecOrderdetail = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>PHP行動購物網</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .message {
            font-weight: bolder;
            color: #900;
            background-color: #FCC;
            text-align: center;
            padding: 20px;
            width: 60%;
            margin-right: auto;
            margin-left: auto;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .line_top {
            border-top-width: 1px;
            border-top-style: dotted;
            border-top-color: #666;
        }

        .datatable {
            border-collapse: collapse;
        }

        .datatable th {
            background-color: #ECE1E1;
        }

        .datatable tr {
            border-bottom: 1px solid #000;
        }

        .datatable tr.last {
            border-bottom: none;
        }
    </style>
    <script language="javascript">
        function checkForm() {
            if (document.cartform.customername.value == "") {
                alert("請填寫姓名!");
                document.cartform.customername.focus();
                return false;
            }
            if (document.cartform.customeremail.value == "") {
                alert("請填寫電子郵件!");
                document.cartform.customeremail.focus();
                return false;
            }
            if (!checkmail(document.cartform.customeremail)) {
                document.cartform.customeremail.focus();
                return false;
            }
            if (document.cartform.customerphone.value == "") {
                alert("請填寫電話!");
                document.cartform.customerphone.focus();
                return false;
            }
            if (document.cartform.customeraddress.value == "") {
                alert("請填寫地址!");
                document.cartform.customeraddress.focus();
                return false;
            }
            if (confirm('確定送出嗎？')) {
                cartform.submit();
            }
        }

        function checkmail(myEmail) {
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (filter.test(myEmail.value)) {
                return true;
            }
            alert("電子郵件格式不正確");
            return false;
        }
    </script>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js" type="text/javascript"></script>
</head>

<body>
    <div data-role="page" id="page" data-add-back-btn="true">
        <div data-role="header" data-position="fixed">
            <h1><span class="subjectDiv">更改訂單</span></h1>
        </div>
        <div data-role="content">
            <h2>購物內容 </h2>
            <table width="100%" border="0" cellpadding="2" cellspacing="0" class="datatable">
                <tr>
                    <th width="20%">編號</th>
                    <th>名稱</th>
                    <th width="20%">數量</th>
                    <th width="30%">小計</th>
                </tr>
                <?php $i = 1;
                $total = 0;
                while ($row_RecOrderdetail = $RecOrderdetail->fetch_assoc()) {
                    $subTotal = $row_RecOrderdetail['unitprice'] * $row_RecOrderdetail['quantity'];
                    $total += $subTotal; ?>
                    <tr class="last">
                        <td align="center"><?php echo $i; ?>.</td>
                        <td><?php echo $row_RecOrderdetail['productname']; ?></td>
                        <td align="center"><?php echo $row_RecOrderdetail['quantity']; ?></td>
                        <td align="right">
                            $ <?php echo number_format($row_RecOrderdetail['unitprice'] * $row_RecOrderdetail['quantity']); ?></td>
                    </tr>
                <?php $i++;
                } ?>

                <tr>
                    <td align="center">總計</td>
                    <td>&nbsp;</td>
                    <td align="right">&nbsp;</td>
                    <td align="right">$ <?php echo number_format($total); ?></td>
                </tr>
            </table>
            <?php $row_RecOrder = $RecOrder->fetch_assoc() ?>
            <form action="cartreport.php" method="post" name="cartform" id="cartform">
                <h2>聯絡資料</h2>
                <table width="100%" cellpadding="2" cellspacing="0" class="datatable">
                    <tr>
                        <th width="30%">姓名<font color="#FF0000">*</font>
                        </th>
                        <td bgcolor="#F6F6F6"><input type="text" name="customername" id="customername" value="<?php echo $row_RecOrder['customername']; ?>"></td>
                    </tr>
                    <tr>
                        <th width="20%">電子郵件<font color="#FF0000">*</font>
                        </th>
                        <td bgcolor="#F6F6F6"><input type="text" name="customeremail" id="customeremail" value="<?php echo $row_RecOrder['customeremail']; ?>"></td>
                    </tr>
                    <tr>
                        <th width="20%">電話<font color="#FF0000">*</font>
                        </th>
                        <td bgcolor="#F6F6F6"><input type="text" name="customerphone" id="customerphone" value="<?php echo $row_RecOrder['customerphone']; ?>"></td>
                    </tr>
                    <tr>
                        <th width="20%">住址<font color="#FF0000">*</font>
                        </th>
                        <td bgcolor="#F6F6F6"><input name="customeraddress" type="text" id="customeraddress" value="<?php echo $row_RecOrder['customeraddress']; ?>"></td>
                    </tr>
                    <tr>
                        <th>付款方式<font color="#FF0000">*</font>
                        </th>
                        <td>
                            <select name="paytype" id="paytype">
                                <option value="ATM匯款" <?php if ($row_RecOrder['paytype'] == 'ATM匯款') echo ' selected'; ?>>
                                    ATM匯款
                                </option>
                                <option value="線上刷卡" <?php if ($row_RecOrder['paytype'] == '線上刷卡') echo ' selected'; ?>>
                                    線上刷卡
                                </option>
                                <option value="貨到付款" <?php if ($row_RecOrder['paytype'] == '貨到付款') echo ' selected'; ?>>
                                    貨到付款
                                </option>
                            </select>
                        </td>
                    </tr>
                </table>
                <input name="cartaction" type="hidden" id="cartaction" value="update">
            </form>
            <div data-role="controlgroup" data-type="horizontal" style="text-align:center">
                <a href="search.php" data-role="button" data-icon="back" data-rel="back">取消修改</a>
                <a href="search.php" data-role="button" data-icon="check" class="modify_btn" data-orderid="<?php echo $row_RecOrder['orderid']; ?>">確認修改</a>
            </div>
        </div>
        <div data-role="footer" data-position="fixed">
            <div data-role="navbar">
                <ul>
                    <li><a href="index.php" data-icon="grid">逛逛商店</a></li>
                    <li><a href="cart.php" data-icon="star" data-ajax="false">檢視購物車</a></li>
                    <li><a href="search.php" data-icon="search" class="ui-btn-active" data-ajax="false">訂單查詢</a></li>
                    <li><a href="?logout=true" data-icon="" data-ajax="false">登出</a></li>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // 修改訂單
        $('.modify_btn').click(function() {
            // 在這修改
            let orderID = $(this).data('orderid');
            let customerName = $('#customername').val();
            let customerEmail = $('#customeremail').val();
            let customerPhone = $('#customerphone').val();
            let customerAddress = $('#customeraddress').val();
            let payType = $('#paytype').val();
            let confirmCancel = window.confirm('您確定要消改此訂單嗎？');
            if (confirmCancel) {
                $.ajax({
                    type: 'POST',
                    url: 'edit_order.php', // PHP file to handle cancellation logic
                    data: {
                        orderID: orderID,
                        customername: customerName,
                        customeremail: customerEmail,
                        customerphone: customerPhone,
                        customeraddress: customerAddress,
                        paytype: payType
                    },
                    success: function(response) {
                        // Handle success response here
                        window.alert("修改成功");
                        // location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle error response here
                        console.error(xhr.responseText);
                        window.alert("修改失敗");
                    }
                });
            }
        });
    </script>

</body>

</html>