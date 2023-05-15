<?php

if (isset($_POST['submit'])) {
    $conn = 0;
    $errorMessage = [];
    $email = $_SESSION['userEmail'];
    $confirmTxt = $_POST['confirmTxt'];
    require_once "./includes/php/db.php";

    // set an error if the confirmation text field is empty
    if (!$email)
        $errorMessage['email'] = "Your Email not exists in the session. Try again later!";

    if (trim($confirmTxt) == "")
        $errorMessage['text'] = "Confirm text can not be empty!";

    if (empty($errorMessage)) {
        // deleting special chars
        $confirmTxt = mysqli_real_escape_string($conn, $confirmTxt);

        if ($confirmTxt === 'Delete Account') {

            // delete if user exists
            $sql = "delete from users where email = '$email';";

            if (mysqli_query($conn, $sql)) {
                setcookie("volume", "", time() - 10, '/');
                setcookie("theme", "", time() - 10, '/');
                session_destroy();
                header("Location: ./index.php");
            } else {
                $errorMessage['user'] = "No data found!";
            }
        } else {
            $errorMessage['text'] = "Wrong text";
        }
    }
    mysqli_close($conn);
}
