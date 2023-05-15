<?php
// this file will generate a list of custom texts

// create custom menu if user have text in db
if ($_SESSION['has_custom'] == 1) {
    $conn = 0;
    $userId = $_SESSION['userId'];
    // this should be 'require' not 'require_once' because db.php will be used in initLesson.php file
    require './includes/php/db.php';

    $sql = "select id from customs where user_id = $userId;";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $i = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li><a href='./lesson.php?lesson=customs-text-" . $row['id'] . "'>Text $i</a></li>";
            $i++;
        }
    } else {
        echo "<script>alert('Can not find your customs!');</script>";
    }
    mysqli_close($conn);
}
