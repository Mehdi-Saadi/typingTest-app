<?php
// control.php included to every page in root directory
// for controlling effects and use in processes

session_start();

// using cookie for controlling volume
if (!isset($_COOKIE["volume"]))
    setcookie("volume", "volume_up", time() + (86400 * 30 * 12), '/');

// using cookie for controlling theme
if (!isset($_COOKIE["theme"]))
    setcookie("theme", "light_mode", time() + (86400 * 30 * 12), '/');
