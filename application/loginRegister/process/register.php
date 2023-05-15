<?php

if (isset($_POST['submit'])) {

    $conn = 0;
    $errorMessage = [];
    $email = $_POST['email'];
    $password = $_POST['password'];
    require_once "../includes/php/db.php";

    // set an error if email or password field are empty
    if (trim($email) == "")
        $errorMessage['email'] = "Email can not be empty!";

    if (trim($password) == "")
        $errorMessage['password'] = "Password can not be empty!";

    if (empty($errorMessage)) {
        // deleting special chars
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);

        // creating random verifyCode
        $verifyCode = rand(100000, 999999);


        // hash pass
        $hashedPass = password_hash($password, PASSWORD_DEFAULT);
        $hashedVerify = password_hash($verifyCode, PASSWORD_DEFAULT);

        // check if user exists
        $sql = "select email from users where email = '$email';";
        $result = mysqli_query($conn, $sql);

        // insert data if not exist before
        if (mysqli_num_rows($result) > 0) {
            $errorMessage['user'] = "Email used before!";
        } else {
            $sql = "insert into users (email, password, code) values ('$email', '$hashedPass', '$hashedVerify');";
            $result = mysqli_query($conn, $sql);

            // check if user added successfully
            if ($result) {
                // sending verification code to user email
                $subject = "typingTest Verification Code";
                $body = "
                <h3>Welcome to typingTest!</h3>
                <p>Your Verification Code:</p>
                <p><b>$verifyCode</b></p>
                ";

                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: "typingTest"' . "\r\n";

                if (mail($email, $subject, $body, $headers)) {
                    // setting cookie for saving user email
                    setcookie('userEmail', $email, time() + (86400 * 30), '/', '', true, true);
                    header("Location: ./verifyCodeForm.php");
                } else {
                    $errorMessage['codeSent'] = "
                    Sorry, failed while sending mail!
                    Please try again later...
                    ";
                }
            } else {
                $errorMessage['addingUser'] = "
                Sorry Can't add your data to database!
                Please try again later...
                ";
            }
        }
    }
    mysqli_close($conn);
}
