<?php

if (isset($_POST['submit'])) {

    $conn = 0;
    $errorMessage = [];
    $email = $_COOKIE['userEmail'];
    $verifyCode = $_POST['code'];
    require_once "../includes/php/db.php";

    if (!empty($email)) {
        if (trim($verifyCode) == "")
            $errorMessage['code'] = "Verification Code can not be empty!";

        if (empty($errorMessage)) {
            // deleting special chars
            $verifyCode = mysqli_real_escape_string($conn, $verifyCode);

            // check if user exists
            $sql = "select code from users where email = '$email';";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                if (password_verify($verifyCode, $row['code'])) {
                    $sql = "update users set is_verified = 1 where email = '$email';";

                    if (mysqli_query($conn, $sql)) {
                        // destroying cookie and go to log in form
                        setcookie('userEmail', "", time() - 10, '/', '', true, true);
                        header("Location: ./index.php");
                    } else {
                        $errorMessage['is_verified'] = "can not connect to db and is_verified is 0...";
                    }
                } else {
                    $errorMessage['code'] = "Wrong Code...";
                }
            } else {
                $errorMessage['user'] = "Sorry. The data has not been entered into the database...";
            }
        }
    } else {
        $errorMessage['cookieDisable'] = "
        Cookies are disabled in your browser.
        Please set it enable and try again...
        ";
    }
    mysqli_close($conn);
}
