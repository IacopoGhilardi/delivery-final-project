/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./resources/js/cart/script.js ***!
  \*************************************/
document.addEventListener("DOMContentLoaded", function () {
  cart = document.querySelector(".cart");
  cartHeader = document.querySelector(".cart_header");
  var mediaQuery = window.matchMedia('(max-width: 1000px)');
  cart.addEventListener('click', function () {
    if (mediaQuery.matches) {
      if (cartHeader.style.display == "none") {
        cartHeader.style.display = "block";
      } else {
        cartHeader.style.display = "none";
      }
    } else {
      cartHeader.style.display = "none";
    }
  });
});
/******/ })()
;