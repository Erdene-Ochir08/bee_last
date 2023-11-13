const closeBtn = document.querySelector('.card-menu .fa-times');
const cardMenu = document.querySelector('.card-menu');
const openBtn = document.querySelector('.open');
const visible = document.querySelector(".a-overlay");
const openBtn2 = document.querySelector('.open2');
console.log(closeBtn);
closeBtn.addEventListener("click", ()=>{
    cardMenu.classList.add("c-hide");
    cardMenu.classList.remove("openCard");
    visible.classList.remove("visible");
});
openBtn.addEventListener('click',()=>{
    cardMenu.classList.remove("c-hide");
    cardMenu.classList.add("openCard");
    visible.classList.add("visible");
});
openBtn2.addEventListener('click',()=>{
    cardMenu.classList.remove("c-hide");
    cardMenu.classList.add("openCard");
    visible.classList.add("visible");
});