function setCookie(name, value) {
    // get current time and set the time for 1 year later
    let time = Math.floor(new Date().getTime() / 1000) + (86400 * 30 * 12);
    document.cookie = name + "=" + value + "; max-age=" + time + "; path=/";
}

function getCookie(name) {
    let cookie = document.cookie.split(";");
    for(let i = 0; i < cookie.length; i++) {
        let cookiePair = cookie[i].split("=");
        if(name === cookiePair[0].trim())
            return cookiePair[1].trim();
    }
    return false;
}
