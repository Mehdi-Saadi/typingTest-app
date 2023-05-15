<?php require_once "./includes/php/control.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="mehdi.0.saadi@gmail.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="./includes/icons/favicon.ico">
    <link rel="stylesheet" href="./includes/style/style.css">
    <link rel="stylesheet" href="./includes/style/header.css">
    <!-- cookie functions -->
    <script src="./includes/js/cookie.js"></script>
    <title>typingTest</title>
</head>
<body>

<?php require_once "./includes/php/header.php"; ?>

<!-- typing part -->
<div class="wrapper">
    <!-- playing audio if user enables -->
    <audio id="audio">
        <source src="./includes/soundEffect/sound.mp3" type="audio/mpeg"> Your browser does not support the audio element.
    </audio>
    <!-- getting user data -->
    <input type="text" class="input-field">

    <div class="content-box">
        <div class="typing-text">
            <!-- the updated text goes here-->
            <p></p>
        </div>
        <div class="content">
            <ul class="result-details">
                <li class="time">
                    <p>Time:</p>
                    <span><b>0</b>s</span>
                </li>
                <li class="mistake">
                    <p>Mistakes:</p>
                    <span>0</span>
                </li>
                <li class="wpm">
                    <p>WPM:</p>
                    <span>0</span>
                </li>
                <li class="cpm">
                    <p>CPM:</p>
                    <span>0</span>
                </li>
            </ul>
            <button id="try">Try Again</button>
        </div>
    </div>
</div>

<!-- controlling sound effect -->
<script src="./includes/js/effect/sound.js"></script>
<!-- controlling theme -->
<script src="./includes/js/effect/theme.js"></script>
<!-- text -->
<?php require_once "./includes/php/initLesson.php"; ?>
<script src="./includes/js/lessonProcess.js"></script>
</body>
</html>
