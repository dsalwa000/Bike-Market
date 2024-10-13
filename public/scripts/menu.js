// SIDE MENU
const menuMobile = document.querySelector(".menu__mobile");
const menuIcon = document.querySelector(".menu__icon");
const menuMobileButton = document.querySelector(".menu__mobile-button");

menuIcon.addEventListener("click", () => {
    menuMobile.style.width = "75%";
});

menuMobileButton.addEventListener("click", () => {
    menuMobile.style.width = "0%";
});

