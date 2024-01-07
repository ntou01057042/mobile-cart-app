<?php
require_once("connMysql.php");
session_start();
//執行會員登入
if (isset($_POST["username"]) && isset($_POST["passwd"])) {
    echo "<script>";
    echo "window.location.href = 'register.php';";
    echo "</script>";
    //繫結登入會員資料
    $query_RecLogin = "SELECT m_id, m_username, m_passwd, m_level FROM memberdata WHERE m_username=?";
    $stmt = $db_link->prepare($query_RecLogin);
    $stmt->bind_param("s", $_POST["username"]);
    $stmt->execute();
    //取出帳號密碼的值綁定結果
    $stmt->bind_result($userid, $username, $passwd, $level);
    $stmt->fetch();
    $stmt->close();
    //比對密碼，若登入成功則呈現登入狀態
    if (password_verify($_POST["passwd"], $passwd)) {
        //設定登入者的名稱及等級
        $_SESSION["userId"] = $userid;
        $_SESSION["loginMember"] = $username;
        $_SESSION["memberLevel"] = $level;
        //使用Cookie記錄登入資料
        if (isset($_POST["rememberme"]) && ($_POST["rememberme"] == "true")) {
            setcookie("remUser", $_POST["username"], time() + 365 * 24 * 60);
            setcookie("remPass", $_POST["passwd"], time() + 365 * 24 * 60);
        } else {
            if (isset($_COOKIE["remUser"])) {
                setcookie("remUser", $_POST["username"], time() - 100);
                setcookie("remPass", $_POST["passwd"], time() - 100);
            }
        }
        header("Location: index.php");
    } else {
        header("Location: login.php?errMsg=1");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入頁面</title>
    <link href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" rel="stylesheet" type="text/css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js" type="text/javascript"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        #button {
            background-color: #38c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #button:hover {
            background-color: #38f;
        }

        p {
            margin-top: 16px;
            color: #555;
        }

        a {
            color: #38c;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        #error-message {
            color: red;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>行動購物網登入系統</h2>
        <form name="form1" method="post" action="">
            <label for="username">Username:</label>
            <input name="username" type="text" class="logintextbox" id="username" value="<?php if (isset($_COOKIE["remUser"]) && ($_COOKIE["remUser"] != "")) echo $_COOKIE["remUser"]; ?>" required>
            <br>
            <label for="passwd">Password:</label>
            <input name="passwd" type="password" class="logintextbox" id="passwd" value="<?php if (isset($_COOKIE["remPass"]) && ($_COOKIE["remPass"] != "")) echo $_COOKIE["remPass"]; ?>" required>
            <br>
            <p>
                <input name="rememberme" type="checkbox" id="rememberme" value="true">
                記住我的帳號密碼
            </p>
            <br>
            <?php if (isset($_GET["errMsg"]) && ($_GET["errMsg"] == "1")) { ?>
                <div id="error-message"> 登入帳號或密碼錯誤！</div>
            <?php } ?>
            <input type="submit" name="button" id="button" value="Login">
        </form>

        <p>還沒有帳號? <a href="register.php">註冊</a></p>
    </div>

</body>

</html>