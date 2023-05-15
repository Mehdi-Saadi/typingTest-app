<?php

if (isset($_POST['submit'])) {

    $conn = 0;
    $errorMessage = [];
    $email = $_POST['email'];
    require_once "../includes/php/db.php";

    // set an error if email or password field are empty
    if (trim($email) == "")
        $errorMessage['email'] = "Email can not be empty!";

    if (empty($errorMessage)) {
        // deleting special chars
        $email = mysqli_real_escape_string($conn, $email);

        // creating random password
        $newPass = rand(100000, 999999);

        // hash pass
        $hashedPass = password_hash($newPass, PASSWORD_DEFAULT);

        // check if user exists
        $sql = "select email from users where email = '$email';";
        $result = mysqli_query($conn, $sql);

        // update password if user exist
        if (mysqli_num_rows($result) > 0) {
            $sql = "update users set password = '$hashedPass' where email = '$email';";
            $result = mysqli_query($conn, $sql);

            // check if password added successfully
            if ($result) {
                // sending new password to user email
                $subject = "typingTest New Password";
                $body = "
                <h3>Please CHANGE your PASSWORD After login!</h3>
                <p>Your New Password:</p>
                <p><b>$newPass</b></p>
                ";

                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: "typingTest"' . "\r\n";

                if (mail($email, $subject, $body, $headers)) {
                    header("Location: ./index.php");
                } else {
                    $errorMessage['codeSent'] = "
                    Sorry, failed while sending mail!
                    Please try again later...
                    ";
                }
            } else {
                $errorMessage['addingUser'] = "
                Sorry Can't update password!
                Please try again later...
                ";
            }
        } else {
            $errorMessage['user'] = "Email not exists!";
        }
    }
    mysqli_close($conn);
}
