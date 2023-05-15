<?php
// this file will insert the user's text to custom table in db

if (isset($_POST['changePass'])) {
    $conn = 0;
    $errorMessage = [];
    $email = $_SESSION['userEmail'];
    $newPass = $_POST['newPass'];
    $oldPass = $_POST['oldPass'];
    require_once "./includes/php/db.php";

    // set an error if the confirmation text field is empty
    if (!$email)
        $errorMessage['email'] = "Your Email not exists in the session. Try again later!";

    if (trim($oldPass) == "" || trim($newPass) == "")
        $errorMessage['text'] = "Password can not be empty!";

    if (empty($errorMessage)) {
        // deleting special chars
        $newPass = mysqli_real_escape_string($conn, $newPass);
        $oldPass = mysqli_real_escape_string($conn, $oldPass);

        // get userId if exists
        $sql = "select password from users where email = '$email';";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            // get the user id
            $row = mysqli_fetch_assoc($result);

            if (password_verify($oldPass, $row['password'])) {
                // hash the new password
                $newPass = password_hash($newPass, PASSWORD_DEFAULT);
                $sql = "update users set password = '$newPass' where email = '$email';";
                if (mysqli_query($conn, $sql)) {
                    header("Location: ./loginRegister/index.php?successful");
                } else {
                    header("Location: ./index.php?failed");
                }
            } else {
                $errorMessage['text'] = "Old Password is wrong!";
            }
        } else {
            $errorMessage['user'] = "Can't find your id!";
        }
    }
    mysqli_close($conn);
}
