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
require_once('class.Cart.php');
//購物車初始化
$cart = new Cart([
  'cartMaxItem' => 0,
  'itemMaxQuantity' => 0,
  'useCookie' => false,
]);
//新增購物車
if (isset($_GET['cartaction']) && ($_GET['cartaction'] == 'add')) {
  $cart->add($_GET['id'], $_GET['qty'], ['price' => $_GET['price'], 'pname' => $_GET['name']]);
}
//更新購物車
if (isset($_POST["cartaction"]) && ($_POST["cartaction"] == "update")) {
  if (isset($_POST["updateid"])) {
    $i = count($_POST["updateid"]);
    for ($j = 0; $j < $i; $j++) {
      $product = $cart->getItem($_POST['updateid'][$j]);
      $cart->update($product['id'], $_POST['qty'][$j], [
        'price' => $product['attributes']['price'],
        'pname' => $product['attributes']['pname'],
      ]);
    }
  }
  header("Location: cart.php");
}
//移除購物車
if (isset($_GET['cartaction']) && ($_GET['cartaction'] == 'remove')) {
  $rid = intval($_GET['delid']);
  $cart->remove($rid);
  header("Location: cart.php");
}
//清空購物車
if (isset($_GET['cartaction']) && ($_GET['cartaction'] == 'empty')) {
  $cart->clear();
  header("Location: cart.php");
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
  <div data-role="page" id="page" data-add-back-btn="true">
    <div data-role="header" data-position="fixed">
      <h1>購物車內容</h1>
    </div>
    <div data-role="content">
      <?php if ($cart->getTotalItem() > 0) { ?>
        <form action="cart.php" method="post" name="cartform" id="cartform">
          <table width="100%" border="0" cellpadding="2" cellspacing="0" class="datatable">
            <tr>
              <th width="20%">功能</th>
              <th>名稱</th>
              <th width="20%">數量</th>
              <th width="30%">小計</th>
            </tr>
            <?php
            $allItems = $cart->getItems();
            foreach ($allItems as $items) {
              foreach ($items as $item) {
            ?>
                <tr class="last">
                  <td align="center"><a href="?cartaction=remove&delid=<?php echo $item['id']; ?>">移除</a></td>
                  <td><?php echo $item['attributes']['pname']; ?></td>
                  <td align="center"><input name="updateid[]" type="hidden" id="updateid[]" value="<?php echo $item['id']; ?>">
                    <input name="qty[]" type="number" id="qty[]" value="<?php echo $item['quantity']; ?>" pattern="[0-9]*">
                  </td>
                  <td align="right">$ <?php echo number_format($item['attributes']['price'] * $item['quantity']); ?></td>
                </tr>
            <?php }
            } ?>
            <tr>
              <td align="center">總計</td>
              <td>&nbsp;</td>
              <td align="right">&nbsp;</td>
              <td align="right">$ <?php echo number_format($cart->getAttributeTotal('price')); ?></td>
            </tr>
          </table>
          <input name="cartaction" type="hidden" id="cartaction" value="update">
        </form>
        <div data-role="controlgroup" data-type="horizontal" style="text-align:center">
          <a href="javascript:cartform.submit();" data-role="button" data-icon="refresh">更新</a>
          <a href="?cartaction=empty" data-role="button" data-icon="minus">清空</a>
          <a href="checkout.php" data-role="button" data-icon="forward" data-ajax="false">結帳</a>
        </div>
      <?php } else { ?>
        <div class="message"> 購物車是空的喔！</div>
        <div data-role="controlgroup" data-type="horizontal" style="text-align:center">
          <a href="index.php" data-role="button" data-icon="home">返回首頁</a>
        </div>
      <?php } ?>
    </div>
    <div data-role="footer" data-position="fixed">
      <div data-role="navbar">
        <ul>
          <li><a href="index.php" data-icon="grid">逛逛商店</a></li>
          <li><a href="cart.php" data-icon="star" class="ui-btn-active" data-ajax="false">檢視購物車</a></li>
          <li><a href="search.php" data-icon="search" data-ajax="false">訂單查詢</a></li>
          <li><a href="?logout=true" data-icon="gear" data-ajax="false">登出</a></li>
        </ul>
      </div>
    </div>
  </div>
</body>

</html>