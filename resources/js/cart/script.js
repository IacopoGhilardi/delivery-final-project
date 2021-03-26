document.addEventListener("DOMContentLoaded", () => {

    cart = document.querySelector(".cart_icon_mobile");
    cartMobile = document.querySelector(".cart_mobile_container");
    const mediaQuery = window.matchMedia('(max-width: 1000px)')

    cart.addEventListener('click', () => {
        console.log(cartMobile.style.transform);
        console.log(cartMobile);
        if (mediaQuery.matches) {
            if (cartMobile.style.transform == "translateY(calc(100% + 60px))") {
                cartMobile.style.transform = "translateY(calc(0%)"
            } else {
                cartMobile.style.transform = "translateY(calc(100% + 60px))"
            }
        } else {
            cartMobile.style.transform = "translateY(calc(100% + 60px))"
        }
    });
});