<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入頁面</title>
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

        button {
            background-color: #38c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
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
</head>
<body>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 處理登入表單提交
    $username = $_POST["username"];
    $password = $_POST["password"];

    // 在真實應用中，這裡需要從資料庫中檢查使用者名稱和密碼

    // 這裡只是一個簡單的比對，實際應用中應該使用加密存儲和比對密碼
    if ($username === "example" && $password === "password") {
        $_SESSION["username"] = $username;
        header("Location: dashboard.php"); // 登入成功，重定向到用戶的控制台或主頁
        exit();
    } else {
        echo '<script>alert("密碼錯誤");</script>';
        // echo "<p style='color: #d9534f;'>Invalid username or password. <a href='#'>Try again</a></p>";
    }
}
?>

<div class="container">
    <h2>行動購物網登入系統</h2>
    <form id="myForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>

    <p>還沒有帳號? <a href="register.php">註冊</a></p>
</div>

</body>
</html>
