<!--  -->
<?php
    require_once('connMysql.php');
    if(isset($_GET['pid'])&&($_GET['pid']!='')){
        $query_RecProduct = "SELECT * FROM product WHERE productid=?";
        $stmt = $db_link->prepare($query_RecProduct);
        $stmt->bind_param("i", $_GET['pid']);
        $stmt->execute();
        $RecProduct = $stmt->get_result();
        $row_RecProduct = $RecProduct->fetch_assoc();
    }
?>
<!DOCTYPE html> 
<html>
<head>
<meta charset="utf-8">
<title>PHP行動購物網</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" rel="stylesheet" type="text/css"/>
<script src="http://code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js" type="text/javascript"></script>
</head> 
<body> 

<div data-role="page" id="page" data-add-back-btn="true">
	<div data-role="header" data-position="fixed">
		<h1>商品資訊</h1>
	</div>
	<div data-role="content" style="text-align:center">	
        <!--  -->
        <h1><?php echo $row_RecProduct['productname'];?></h1>
        <img src="proimg/<?php echo $row_RecProduct['productimages'];?>" alt="<?php echo $row_RecProduct['productname'];?>" border="0" />
        <h2>特價 $<?php echo $row_RecProduct['productprice'];?></h2>
        <p><?php echo nl2br($row_RecProduct['description']);?></p>
        <div data-role="controlgroup" data-type="horizontal">
            <!--  -->
            <a href="cart.php?cartaction=add&name=<?php echo $row_RecProduct['productname'];?>&id=<?php echo $row_RecProduct['productid'];?>&price=<?php echo $row_RecProduct['productprice'];?>&qty=1" data-role="button" data-icon="plus">加入購物車</a>
            <a href="#" data-role="button" data-icon="back" data-rel="back">回上一頁</a>
        </div>
	</div>
	<div data-role="footer" data-position="fixed">
		<div data-role="navbar">
            <ul>
                <li><a href="index.php" data-icon="grid" class="ui-btn-active">逛逛商店</a></li>
                <li><a href="cart.php" data-icon="star" data-ajax="false">檢視購物車</a></li>
                <li><a href="search.php" data-icon="search" data-ajax="false">訂單查詢</a></li>
            </ul>
        </div>
	</div>  
</div>
</body>
</html>
<!--  -->
<?php
$stmt->close();
$db_link->close();
?>