const typingText = document.querySelector(".typing-text p"),
    inpField = document.querySelector(".wrapper .input-field"),
    timeTag = document.querySelector(".time span b"),
    mistakeTag = document.querySelector(".mistake span"),
    wpmTag = document.querySelector(".wpm span"),
    cpmTag = document.querySelector(".cpm span"),
    tryAgainBtn = document.querySelector("#try");

let timer,
    maxTime = 300,
    timeInit = 0,
    charIndex = mistakes = isTyping = 0,
    spanTag,
    typedChar,
    wpm,
    cpm;

function paragraph() {
    // set text empty
    typingText.innerHTML = "";

    // getting paragraph, splitting all characters
    // of it, adding each character inside span and then adding this span inside p tag
    text.split("").forEach(span => {
        spanTag = `<span>${span}</span>`;
        typingText.innerHTML += spanTag;
    });

    typingText.querySelectorAll("span")[0].classList.add("active");

    // focusing input field on keydown or click event
    document.addEventListener("keydown" , () => inpField.focus());
    typingText.addEventListener("click" , () => inpField.focus());
}

function initTyping() {
    const characters = typingText.querySelectorAll("span");
    typedChar = inpField.value.split("")[charIndex];

    if (charIndex < characters.length - 1 && timeInit <= maxTime) {
        // once timer is start, it won't restart again on every key clicked
        if (!isTyping) {
            timer = setInterval(initTimer , 1000);
            isTyping = true;
        }

        // if user hasn't entered any character or pressed backspace
        if (typedChar == null) {
            charIndex--;

            // decrement mistakes only if the charIndex span contains incorrect class
            if (characters[charIndex].classList.contains("incorrect")) {
                mistakes--;
            }
            characters[charIndex].classList.remove("incorrect" , "correct");
        } else {
            if (characters[charIndex].innerText === typedChar) {

                // if user typed character and shown character matched then add the
                // correct class else increment the mistakes and add the incorrect class
                characters[charIndex].classList.add("correct");
            } else {
                mistakes++;
                characters[charIndex].classList.add("incorrect");
            }

            // increment charIndex either user typed correct or incorrect character
            charIndex++;
        }

        characters.forEach(span => span.classList.remove("active"));
        characters[charIndex].classList.add("active");

        wpm = Math.round((((charIndex - mistakes) / 5) / timeInit) * 60);
        cpm = Math.round(((charIndex - mistakes) / timeInit) * 60);

        // if wpm value is 0, empty, or infinity them setting its value to 0
        wpm = wpm < 0 || !wpm || wpm === Infinity ? 0 : wpm;
        // if cpm value is 0, empty, or infinity them setting its value to 0
        cpm = cpm < 0 || !cpm || cpm === Infinity ? 0 : cpm;

        mistakeTag.innerText = mistakes;
        wpmTag.innerText = wpm;
        cpmTag.innerText = cpm;
    } else {
        inpField.value = "";
        clearInterval(timer);
    }
}

function initTimer() {

    // if timeLeft is greater than 0 then decrement the timeLeft else clear the timer
    if (timeInit < maxTime) {
        timeInit++;
        timeTag.innerText = timeInit;
    } else {
        clearInterval(timer);
    }
}

// reset the paragraph if tryAgain button clicked
function reset() {
    // calling randomParagraph func and resetting
    // each variable and element value to default
    paragraph();
    inpField.value = "";
    timeInit = 0;
    clearInterval(timer);
    charIndex = mistakes = isTyping = 0;
    timeTag.innerText = 0;
    mistakeTag.innerText = mistakes;
    wpmTag.innerText = 0;
    cpmTag.innerText = 0;
}


paragraph();
inpField.addEventListener("input" , initTyping);
tryAgainBtn.addEventListener("click" , reset);
