$(document).ready(function(){
    document.getElementById("mmenuBtn").addEventListener("click", MenuToggle)
    document.getElementById("mcontact").addEventListener("click", ContactPage);
    document.getElementById("mhelp").addEventListener("click", HelpPage);
});

var isClosed = true;
function MenuToggle() {
    if (isClosed)
    {
        OpenAnim();
        isClosed = false;
    }
    else
    {
        CloseAnim();
        isClosed = true;
    }
}

function OpenAnim() {
    let upper = document.getElementById("mupperBar");
    let middle = document.getElementById("mmiddleBar");
    let lower = document.getElementById("mlowerBar");
    let menu = document.getElementById("mmenu");
    let menuBG = document.getElementById("mmenuBG");

    middle.style.backgroundColor="rgba(255,255,255,0)";
    upper.style.marginTop = "17px";
    lower.style.marginTop = "17px";
    upper.style.transform = "rotate(45deg)";
    lower.style.transform = "rotate(-45deg)";
    menu.style.right = "0px";
    menu.style.height = "70px";
}

function CloseAnim() {
    let upper = document.getElementById("mupperBar");
    let middle = document.getElementById("mmiddleBar");
    let lower = document.getElementById("mlowerBar");
    let menu = document.getElementById("mmenu");
    let menuBG = document.getElementById("mmenuBG");

    middle.style.backgroundColor="#E28300";
    upper.style.marginTop = "5px";
    lower.style.marginTop = "29px";
    upper.style.transform = "rotate(0deg)";
    lower.style.transform = "rotate(0deg)";
    menu.style.right = "-260px";
    menu.style.height = "0px";
}

function ContactPage() {
}

function HelpPage() {
}