<?php
function GetSQLValueString($theValue, $theType)
{
    switch ($theType) {
        case "string":
            $theValue = ($theValue != "") ? filter_var($theValue, FILTER_SANITIZE_ADD_SLASHES) : "";
            break;
            // case "int":
            //     $theValue = ($theValue != "") ? filter_var($theValue, FILTER_SANITIZE_NUMBER_INT) : "";
            //     break;
            // case "email":
            //     $theValue = ($theValue != "") ? filter_var($theValue, FILTER_VALIDATE_EMAIL) : "";
            //     break;
            // case "url":
            //     $theValue = ($theValue != "") ? filter_var($theValue, FILTER_VALIDATE_URL) : "";
            //     break;
    }
    return $theValue;
}

if (isset($_POST["action"]) && ($_POST["action"] == "join")) {
    require_once("connMysql.php");
    //找尋帳號是否已經註冊
    $query_RecFindUser = "SELECT m_username FROM memberdata WHERE m_username='{$_POST["m_username"]}'";
    $RecFindUser = $db_link->query($query_RecFindUser);
    if ($RecFindUser->num_rows > 0) {
        header("Location: member_join.php?errMsg=1&username={$_POST["m_username"]}");
    } else {
        //若沒有執行新增的動作
        $query_insert = "INSERT INTO memberdata (m_username, m_passwd) VALUES (?, ?)";
        $stmt = $db_link->prepare($query_insert);
        $stmt->bind_param(
            "ss",
            GetSQLValueString($_POST["m_username"], 'string'),
            password_hash($_POST["m_passwd"], PASSWORD_DEFAULT)
        );
        $stmt->execute();
        $stmt->close();
        $db_link->close();
        header("Location: member_join.php?loginStats=1");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>註冊頁面</title>
    <link href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" rel="stylesheet" type="text/css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js" type="text/javascript"></script>
    <style>
        /* Include the same styling as the login page for consistency */
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

        #register {
            background-color: #38c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #register:hover {
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
    </style>
    <script>
        function checkForm() {
            if (document.formJoin.m_username.value == "") {
                alert("請填寫帳號!");
                document.formJoin.m_username.focus();
                return false;
            } else {
                ;
            }
            if (document.formJoin.m_passwd.value != document.formJoin.m_passwdrecheck.value) {
                alert("密碼二次輸入不一樣,請重新輸入!\n");
                document.formJoin.m_passwd.focus();
                return false;
            }
            return confirm('確定送出嗎？');
        }
    </script>
</head>

<body>
    <?php if (isset($_GET["loginStats"]) && ($_GET["loginStats"] == "1")) { ?>
        <script language="javascript">
            alert('會員新增成功\n請用申請的帳號密碼登入。');
            window.location.href = 'index.php';
        </script>
    <?php } ?>

    <div class="container">
        <h2>行動購物網註冊系統</h2>
        <form action="" method="POST" name="formJoin" id="formJoin" onSubmit="return checkForm();">
            <label for="m_username">Username:</label>
            <input name="m_username" type="text" class="normalinput" id="m_username" required>
            <br>
            <label for="m_passwd">Password:</label>
            <input name="m_passwd" type="password" class="normalinput" id="m_passwd" required>
            <br>
            <label for="m_passwdrecheck">Confirm Password:</label>
            <input name="m_passwdrecheck" type="password" class="normalinput" id="m_passwdrecheck" required>
            <br>
            <input name="action" type="hidden" id="action" value="join">
            <input type="submit" value="Register" id="register">
        </form>

        <p>已經有帳號了? <a href="login.php">返回登入</a></p>
    </div>

</body>

</html>