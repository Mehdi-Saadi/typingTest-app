<?php

$serverName = "localhost";
$DB_username = "root";
$DB_password = "";
$DB_name = "typingtest";

// create connection
$conn = mysqli_connect($serverName, $DB_username, $DB_password, $DB_name);

// check connection
if (!$conn)
    die("Connection failed: " . mysqli_connect_error());
