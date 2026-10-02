var MenuNav = document.getElementById("myHamburger");
var open = document.getElementById("open");
var close = document.getElementById("closeNav");

open.onclick = openNav;
close.onclick = closeNav;

function openNav(){
    MenuNav.classList.add("active");
}

function closeNav(){
    MenuNav.classList.remove("active");
}