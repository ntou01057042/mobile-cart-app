<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="utf-8">
  <title>訂單查詢</title>
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

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      border: 1px solid #000000;
      padding: 10px;
    }

    .orders {
      margin-bottom: 20px;
    }

    .cancel, .edit {
      background-color: #000000;
      color: #ffffff;
      padding: 10px;
      border: none;
      cursor: pointer;
    }

    .cancel {
      color: red;
    }
  </style>
  <link href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" rel="stylesheet" type="text/css"/>
<script src="http://code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js" type="text/javascript"></script>

</head>
<body>
    <div data-position="fixed" data-role="header" data-position="fixed">
		<h1>行動購物網</h1>
	</div>
  <main>
    <table class="orders">
      <thead>
        <tr>
          <th>編號</th>
          <th>小計</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // 取得訂單資料
          $orders = [
            [
              'id' => '000',
              'total' => '1000',
            ],
          ];

          // 輸出訂單資料
          foreach ($orders as $order) {
            echo '<tr>';
            echo '<td>' . $order['id'] . '</td>';
            echo '<td>新台幣 ' . $order['total'] . ' 元</td>';
            echo '<td><button type="button" class="cancel">取消</button><button type="button" class="edit">修改</button></td>';
            echo '</tr>';
          }
        ?>
      </tbody>
    </table>
  </main>
  <div data-role="footer" data-position="fixed">
		<div data-role="navbar">
            <ul>
                <li><a href="index.php" data-icon="grid" class="ui-btn-active">逛逛商店</a></li>
                <li><a href="cart.php" data-icon="star" data-ajax="false">檢視購物車</a></li>
                <li><a href="#popupDialog" data-rel="popup" data-position-to="window" data-transition="pop" data-icon="gear">關於我們</a></li>
            </ul>
        </div>        
	</div>
    <!-- <div data-role="popup" id="popupDialog" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
        <div data-role="header" data-theme="a">
        <h1>關於我們</h1>
        </div>
        <div role="main" class="ui-content">
            <h3 class="ui-title">行動購物網</h3>
            <p>期待能提供最新的產品，最優惠的價格，讓顧客能夠盡情的享受線上購物的樂趣，歡迎多多光臨！</p>        
            <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back" data-transition="flow">關閉</a>
        </div>
    </div>      -->

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
    $(function() {
      // 取消訂單
      $('.cancel').click(function() {
        // 提示確認
        var confirm = window.confirm('您確定要取消此訂單嗎？');
        if (confirm) {
          // 發送取消訂單請求
          // ...
        }
      });

      // 修改訂單
      $('.edit').click(function() {
        // 跳轉到訂單修改頁面
        // ...
      });
    });
  </script>
</body>
</html>
