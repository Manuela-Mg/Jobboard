import './bootstrap';

const popUp = document.getElementById("popUp")
const menuBtn = document.getElementById("menuBtn")
const showClass = 'show-popup'
const hidePop = 'hide-popup'
let popOpen = false;

menuBtn.addEventListener('click',()=>{
    if(!popOpen) {
        popOpen = true
        console.log("HAAAAAAAAA")
        popUp.classList.add(showClass)
        popUp.classList.remove(hidePop)
    }
    else {
        popOpen = false
        popUp.classList.remove(showClass)
        popUp.classList.add(hidePop)
    }
    console.log("blaba")
})