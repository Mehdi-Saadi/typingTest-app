const deleteBtn = document.querySelector("#deleteBtn"),
    deleteForm = document.querySelector("#deleteForm"),
    textarea = document.querySelector("textarea"),
    changeBtn = document.querySelector("#changePass"),
    changeForm = document.querySelector("#changeForm");

textarea.addEventListener("keyup", e=>{
    textarea.style.height = "64px";
    let scHeight = e.target.scrollHeight;
    textarea.style.height = `${scHeight}px`;
});

changeBtn.addEventListener("click", function () {
    changeForm.classList.toggle("displayForm");
});

deleteBtn.addEventListener("click", function () {
    deleteForm.classList.toggle("displayForm");
});
