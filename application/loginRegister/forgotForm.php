<?php require_once "./process/forgot.php"; ?>

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
    <h1>Password Recovery</h1>
    <form method="post" action="">
        <div class="txt_field">
            <input type="email" id="email" name="email"  value="<?php if (isset($_POST['submit']) && isset($email)) echo $email; ?>" required>
            <span></span>
            <label for="email">Email</label>
        </div>
        <input type="submit" name="submit" value="Get New Password">
    </form>
</div>
<!-- error -->
<div <?php if (!empty($errorMessage)): ?> class="error" <?php endif; ?>>
    <p>
        <?php
        if (isset($errorMessage['email']))
            echo $errorMessage['email'] . "<br>";

        if (isset($errorMessage['user']))
            echo $errorMessage['user'] . "<br>";

        if (isset($errorMessage['codeSent']))
            echo $errorMessage['codeSent'] . "<br>";

        if (isset($errorMessage['addingUser']))
            echo $errorMessage['addingUser'];
        ?>
    </p>
</div>
</body>
</html>
