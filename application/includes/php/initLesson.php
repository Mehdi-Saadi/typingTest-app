<?php

// getting lesson request
// connecting to db and return result to lesson.php
$conn = 0;
require "./includes/php/db.php";

$lesson = mysqli_real_escape_string($conn, $_GET["lesson"]);
if (trim($lesson) != "") {
    $location = explode("-", $lesson);
    $table = $location[0];
    $column = $location[1];
    $number = $location[2];

    if (trim($table) == "" || trim($column) == "" || trim($number) == "") {
        $table = 'introduction';
        $column = 'basics';
        $number = 1;
    }

    $sql = "select $column from $table where id = $number;";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // pass the data from db to js variable for using in page
        $row = mysqli_fetch_assoc($result);
        $text = str_replace("\\", "\\\\", $row[$column]);
        $text = str_replace("'", "\'", $text);
        $text = str_replace('"', '\"', $text);
        // remove line breaks
        $text = str_replace("\r\n", " ", $text);
        $text .= ".";
        $query = '<script>let text = "' . $text . '";</script>';
        echo $query;
    } else {
        echo '<script>let text = "not found.";</script>';
    }
} else {
    echo '<script>let text = "not found.";</script>';
}

mysqli_close($conn);
