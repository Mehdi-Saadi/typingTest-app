<?php require_once "./includes/php/control.php"; ?>
<?php require_once "./includes/php/customTxt.php" ?>
<?php require_once "./includes/php/changePass.php" ?>
<?php require_once "./includes/php/deleteAccount.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="mehdi.0.saadi@gmail.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="./includes/icons/favicon.ico">
    <link rel="stylesheet" href="./includes/style/header.css">
    <link rel="stylesheet" href="./includes/style/style.css">
    <link rel="stylesheet" href="./includes/style/dashboard.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- cookie functions -->
    <script src="./includes/js/cookie.js"></script>
    <title>typingTest</title>
</head>
<body>

<?php require_once "./includes/php/header.php"; ?>

<div class="wrapper">
    <div class="content-box">
        <div class="userDetails">
            <!-- user details -->
            <div>
                <p>Username: <?php echo $_SESSION['userEmail']; ?> / Account Created: <?php echo $_SESSION['created_at']; ?></p>
            </div>
            <!-- custom text form -->
            <div class="center">
                <h5>Your Custom Text</h5>
                <form method="post" action="" autocomplete="off">
                    <textarea name="text" placeholder="Type something here..." required></textarea>
                    <input type="submit" name="customTxt" id="text" value="Save My Text">
                </form>
            </div>
            <!-- change pass -->
            <div class="area">
                <button id="changePass" class="deleteBtn">Change Password</button>
            </div>
            <!-- change pass form -->
            <div id="changeForm" class="center hiddenForm">
                <form method="post" action="" autocomplete="off">
                    <div class="txt_field">
                        <input type="text" name="newPass" id="newPass" required>
                        <span></span>
                        <label for="newPass">New Pass</label>
                    </div>
                    <div class="txt_field">
                        <input type="text" name="oldPass" id="oldPass" required>
                        <span></span>
                        <label for="oldPass">Old Pass</label>
                    </div>
                    <input type="submit" name="changePass" value="Change My Password">
                </form>
            </div>
            <!-- delete account -->
            <div class="area">
                <h4>Permanently Delete Account: </h4>
                <button id="deleteBtn" class="deleteBtn">Delete My Account</button>
            </div>
            <!-- delete account form -->
            <div id="deleteForm" class="center hiddenForm">
                <h5>Enter 'Delete Account' to perform this action</h5>
                <form method="post" action="" autocomplete="off">
                    <div class="txt_field">
                        <input type="text" name="confirmTxt" id="text" required>
                        <span></span>
                        <label for="text">Confirm Text</label>
                    </div>
                    <input type="submit" name="submit" value="Delete My Account">
                </form>
            </div>
        </div>
    </div>
</div>

<!-- error -->
<div <?php if (!empty($errorMessage)): ?> class="error" <?php endif; ?>>
    <p>
        <?php
        if (isset($errorMessage['email']))
            echo $errorMessage['email'] . "<br>";

        if (isset($errorMessage['text']))
            echo $errorMessage['text'] . "<br>";

        if (isset($errorMessage['user']))
            echo $errorMessage['user'] . "<br>";
        ?>
    </p>
</div>

<script src="./includes/js/dashboard.js"></script>
<!-- controlling sound effect -->
<script src="./includes/js/effect/sound.js"></script>
<!-- controlling theme -->
<script src="./includes/js/effect/theme.js"></script>
</body>
</html>
