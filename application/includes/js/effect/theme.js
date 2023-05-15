const themeControl = document.getElementById("theme"),
    body = document.querySelector("body");

function checkTheme() {
    let theme = getCookie("theme");
    if (theme === "dark_mode") {
        body.style.background = "#212529";
        body.style.color = "#adb5bd";
        body.style.transition = ".5s";
    } else {
        body.style.background = "#ececec";
        body.style.color = "#000000";
        body.style.transition = ".5s";
    }
}

themeControl.onclick = function() {
    // Update the Button
    // set light or dark theme
    // set a cookie for controlling the theme
    if (themeControl.innerHTML.trim() === "dark_mode") {
        setCookie("theme", "light_mode");
        themeControl.innerHTML = "light_mode";
        body.style.background = "#ececec";
        body.style.color = "#000000";
        body.style.transition = ".5s";
    } else {
        setCookie("theme", "dark_mode");
        themeControl.innerHTML = "dark_mode";
        body.style.background = "#212529";
        body.style.color = "#adb5bd";
        body.style.transition = ".5s";
    }
}

checkTheme();
