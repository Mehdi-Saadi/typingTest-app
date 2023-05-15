<?php require_once "./process/login.php"?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="UTF-8">
    <title>typingTest</title>
    <link rel="stylesheet" href="../includes/style/login.css">
</head>
<body>
<!-- navbar -->
<div class="navbar">
    <a href="../index.php"><img src="../includes/icons/icon.ico" alt="icon" class="icon"></a>
    <abbr title="Close"><a href="../index.php"><img src="../includes/icons/close.png" alt="close" class="close"></a></abbr>
</div>
<!-- form -->
<div class="center">
    <h1>Login</h1>
    <form method="post" action="">
        <div class="txt_field">
            <input type="email" name="email" id="email" value="<?php if (isset($_POST['submit']) && isset($email)) echo $email; ?>" required>
            <span></span>
            <label for="email">Email</label>
        </div>
        <div class="txt_field">
            <input type="password" name="password" id="password" required>
            <span></span>
            <label for="password">Password</label>
        </div>
        <div class="pass">
            <a href="./forgotForm.php">Forgot Password?</a>
        </div>
        <input type="submit" name="submit" value="Login">
        <div class="signup_link">
            Need an account? <a href="./registerForm.php">Signup</a>
        </div>
    </form>
</div>
<!-- error -->
<div <?php if (!empty($errorMessage)): ?> class="error" <?php endif; ?>>
    <p>
        <?php
        if (isset($errorMessage['email']))
            echo $errorMessage['email'] . "<br>";

        if (isset($errorMessage['password']))
            echo $errorMessage['password'] . "<br>";

        if (isset($errorMessage['user']))
            echo $errorMessage['user'] . "<br>";
        ?>
    </p>
</div>
</body>
</html>
