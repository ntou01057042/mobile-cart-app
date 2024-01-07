<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>註冊頁面</title>
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
// Include any necessary PHP code for session start or other common functionalities

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and process registration data
    $reg_username = $_POST["reg_username"];
    $reg_password = $_POST["reg_password"];
    $confirm_password = $_POST["confirm_password"];

    // Add validation and database interaction logic here
    // For simplicity, we'll just check if the passwords match in this example
    if ($reg_password === $confirm_password) {
        // Registration successful, redirect to login page or wherever needed
        header("Location: login.php");
        exit();
    } else {
        echo '<script>alert("密碼不一致");</script>';
        // Handle password mismatch or other validation errors
    }
}
?>

<div class="container">
    <h2>行動購物網註冊系統</h2>
    <form id="registerForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="reg_username">Username:</label>
        <input type="text" id="reg_username" name="reg_username" required>
        <br>
        <label for="reg_password">Password:</label>
        <input type="password" id="reg_password" name="reg_password" required>
        <br>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <br>
        <button type="submit">Register</button>
    </form>

    <p>已經有帳號了? <a href="login.php">返回登入</a></p>
</div>

</body>
</html>
