document.addEventListener("DOMContentLoaded", () => {

    cart = document.querySelector(".cart_icon");
    cartHeader = document.querySelector(".cart_header");
    const mediaQuery = window.matchMedia('(max-width: 1000px)')

    cart.addEventListener('click', () => {
        if (mediaQuery.matches) {
            if (cartHeader.style.display == "none") {
                cartHeader.style.display = "block"
            } else {
                cartHeader.style.display = "none"
            }
        } else {
            cartHeader.style.display = "none"
        }
    });
});