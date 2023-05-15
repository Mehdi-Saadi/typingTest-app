<?php

if (isset($_POST['submit'])) {
    session_start();

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

        // check if user exists
        $sql = "select * from users where email = '$email';";
        $result = mysqli_query($conn, $sql);

        // login if user exists
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                $_SESSION['userId'] = $row['id'];
                $_SESSION['userEmail'] = $row['email'];
                $_SESSION['is_admin'] = $row['is_admin'];
                $_SESSION['is_verified'] = $row['is_verified'];
                $_SESSION['has_custom'] = $row['has_custom'];
                $_SESSION['created_at'] = $row['created_at'];
                header("Location: ../index.php");
            } else {
                $errorMessage['password'] = "Email or Password is wrong!";
            }
        } else {
            $errorMessage['user'] = "Email or Password is wrong!";
        }
    }
    mysqli_close($conn);
}
