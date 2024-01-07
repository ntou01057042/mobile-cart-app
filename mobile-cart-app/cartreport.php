<!--  -->
<?php 
    require_once('connMysql.php');
    if(isset($_POST['customername'])&&($_POST['customername']!="")){
        require_once('class.Cart.php');
        //購物車初始化
        $cart = new Cart([
            'cartMaxItem'=>0,
            'itemMaxQuantity'=>0,
            'useCookie'=>false,
        ]);
        //新增訂單資料
        $sql_query = "INSERT INTO `order`(`m_id`, `total`, `customername`, `customeremail`, `customeraddress`, `customerphone`, `paytype`) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db_link->prepare($sql_query);
        $stmt->bind_param("iisssss", $_SESSION["userId"] ,$cart->getAttributeTotal('price'), $_POST["customername"], $_POST["customeremail"], $_POST["customeraddress"], $_POST["customerphone"], $_POST["paytype"]);
        $stmt->execute();
        //取得新增的訂單編號
        $o_pid = $stmt->insert_id;
        $stmt->close();
        //新增訂單內貨品資料
        if($cart->getTotalitem() > 0) {
            $allItems = $cart->getItems();
            foreach ($allItems as $items) {
                foreach ($items as $item) {
                    $sql_query="INSERT INTO orderdetail (orderid ,productid ,productname ,unitprice ,quantity) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $db_link->prepare($sql_query);
                    $stmt->bind_param("iisii", $o_pid, $item['id'], $item['attributes']['pname'], $item['attributes']['price'], $item['quantity']);
                    $stmt->execute();
                    $stmt->close();
                }
            }
        }
    //郵寄通知
	$cname = $_POST["customername"];
	$cmail = $_POST["customeremail"];
	$ctel = $_POST["customerphone"];
	$caddress = $_POST["customeraddress"];
	$cpaytype = $_POST["paytype"];
	$total = $cart->getAttributeTotal('price');    
	$mailcontent=<<<msg
	親愛的 $cname 您好：
	感謝您的光臨
	本次消費詳細資料如下：
	--------------------------------------------------
	訂單編號： $o_pid 
	客戶姓名：$cname 
	電子郵件： $cmail 
	電話： $ctel 
	住址： $caddress 
	付款方式： $cpaytype 
	消費金額：	$total 
	--------------------------------------------------
	希望能再次為您服務 
	
	網路購物公司 敬上
msg;
    $mailFrom="=?UTF-8?B?" . base64_encode("網路購物系統") . "?= <01057042@email.ntou.edu.tw>";
    $mailto = $_POST["customeremail"]; 
	$mailSubject="=?UTF-8?B?" . base64_encode("網路購物系統訂單通知"). "?=";  
	$mailHeader="From:".$mailFrom."\r\n";
	$mailHeader.="Content-type:text/html;charset=UTF-8";   
    if(!mail($mailto, $mailSubject, nl2br($mailcontent), $mailHeader)) die('郵寄失敗!');
    //清空購物車
    $cart->clear(); 
}     
?>
<script language="javascript">
alert("感謝您的購買，我們將儘快進行處理。");
window.location.href="index.php";
</script>