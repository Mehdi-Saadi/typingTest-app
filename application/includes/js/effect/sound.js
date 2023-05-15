const audio = document.querySelector("#audio"),
    volumeControl = document.querySelector("#volume");

function checkVolume() {
    let volume = getCookie("volume");
    if (volume === "volume_off")
        audio.volume = 0;
    else
        audio.volume = 1;
}

// volume control
volumeControl.onclick = function () {
    // Update the Button
    // and turn on or off the sound
    // set a cookie for controlling the volume
    if (volumeControl.innerHTML.trim() === "volume_up") {
        setCookie("volume", "volume_off");
        volumeControl.innerHTML = "volume_off";
        audio.volume = 0;
    } else {
        setCookie("volume", "volume_up");
        volumeControl.innerHTML = "volume_up";
        audio.volume = 1;
    }
};

checkVolume();

document.addEventListener('keydown' , function () {
    audio.play();
});
