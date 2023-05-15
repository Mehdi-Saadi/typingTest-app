<?php

// this file will insert the user's text to custom table in db

if (isset($_POST['customTxt'])) {
    $conn = 0;
    $errorMessage = [];
    $email = $_SESSION['userEmail'];
    $userId = $_SESSION['userId'];
    $text = $_POST['text'];
    require_once "./includes/php/db.php";

    // set an error if the confirmation text field is empty
    if (!$email || !$userId)
        $errorMessage['email'] = "Your Email or Id not exists in the session. Try again later!";

    if (trim($text) == "")
        $errorMessage['text'] = "Text can not be empty!";

    if (empty($errorMessage)) {
        // deleting special chars
        $text = mysqli_real_escape_string($conn, $text);

        $sql = "insert into customs (user_id, text) values (" . $userId . ", '$text');";
        if (mysqli_query($conn, $sql)) {
            $sql = "update users set has_custom = 1 where email = '$email';";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['has_custom'] = 1;
                echo "<script>alert('Added successfully');</script>";
            } else {
                echo "<script>alert('Can not add your text');</script>";
            }
        }
    }
    mysqli_close($conn);
}
