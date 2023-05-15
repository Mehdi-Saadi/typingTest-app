const typingText = document.querySelector(".typing-text p"),
    inpField = document.querySelector(".wrapper .input-field"),
    timeTag = document.querySelector(".time span b"),
    mistakeTag = document.querySelector(".mistake span"),
    wpmTag = document.querySelector(".wpm span"),
    cpmTag = document.querySelector(".cpm span"),
    tryAgainBtn = document.querySelector("#try");

let timer,
    maxTime = 60,
    timeLeft = maxTime,
    charIndex = mistakes = isTyping = 0,
    randIndex,
    spanTag,
    typedChar,
    wpm;

function randomParagraph() {

    // getting random number, and it'll always less than the paragraphs length
    randIndex = Math.floor(Math.random() * paragraphs.length);

    // set text empty
    typingText.innerHTML = "";

    // getting random item from the paragraphs array, splitting all characters
    // of it, adding each character inside span and then adding this span inside p tag
    paragraphs[randIndex].split("").forEach(span => {
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

    if (charIndex <= characters.length - 1 && timeLeft > 0) {
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

        wpm = Math.round((((charIndex - mistakes) / 5) / (maxTime - timeLeft)) * 60);

        // if wpm value is 0, empty, or infinity them setting its value to 0
        wpm = wpm < 0 || !wpm || wpm === Infinity ? 0 : wpm;

        mistakeTag.innerText = mistakes;
        wpmTag.innerText = wpm;
        cpmTag.innerText = charIndex - mistakes;
    } else {
        inpField.value = "";
        clearInterval(timer);
    }
}

function initTimer() {

    // if timeLeft is greater than 0 then decrement the timeLeft else clear the timer
    if (timeLeft > 0) {
        timeLeft--;
        timeTag.innerText = timeLeft;
    } else {
        clearInterval(timer);
    }
}

// reset the paragraph if tryAgain button clicked
function reset() {
    // calling randomParagraph func and resetting
    // each variable and element value to default
    randomParagraph();
    inpField.value = "";
    clearInterval(timer);
    timeLeft = maxTime;
    charIndex = mistakes = isTyping = 0;
    timeTag.innerText = timeLeft;
    mistakeTag.innerText = mistakes;
    wpmTag.innerText = 0;
    cpmTag.innerText = 0;
}


randomParagraph();
inpField.addEventListener("input" , initTyping);
tryAgainBtn.addEventListener("click" , reset);
