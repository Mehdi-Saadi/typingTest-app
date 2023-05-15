<?php require_once "./process/verifyCode.php"; ?>

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
    <h1>Verification Code</h1>
    <form method="post" action="" autocomplete="off">
        <div class="txt_field">
            <input type="number" name="code" id="code" required>
            <span></span>
            <label for="code">Code</label>
        </div>
        <input type="submit" name="submit" value="Verify">
    </form>
</div>
<!-- error -->
<div <?php if (!empty($errorMessage)): ?> class="error" <?php endif; ?>>
    <p>
        <?php
        if (isset($errorMessage['cookieDisable']))
            echo $errorMessage['cookieDisable'] . "<br>";

        if (isset($errorMessage['code']))
            echo $errorMessage['code'] . "<br>";

        if (isset($errorMessage['user']))
            echo $errorMessage['user'] . "<br>";

        if (isset($errorMessage['is_verified']))
            echo $errorMessage['is_verified'];
        ?>
    </p>
</div>
</body>
</html>
