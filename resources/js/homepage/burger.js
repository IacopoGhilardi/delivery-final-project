document.addEventListener("DOMContentLoaded", () => {

    var burger = document.getElementById('burger_icon');
    const navMenu = document.querySelector('.nav_menu_small');
    const mediaQuery = window.matchMedia('(max-width: 576px)')
    var rotate1 = document.querySelector('#rotate-1');
    var rotate2 = document.querySelector('#rotate-2');
    var rotate3 = document.querySelector('#rotate-3');


    burger.addEventListener('click', () => {
        if (mediaQuery.matches) {
            if (navMenu.style.transform == "translateY(-100%)") {
                navMenu.style.transform = "translateY(0%)"
                rotate1.style.transform = 'rotate(-45deg) translateY(5px)';
                rotate1.style.transition = 'all .5s'
                rotate2.style.display = 'none';
            
                rotate3.style.transform = 'rotate(45deg) translateY(-5px)'; 
                rotate3.style.transition = 'all .5s';
            } else {
                navMenu.style.transform = "translateY(-100%)"
                rotate1.style.transform = 'rotate(0deg) translateY(0px)';
                rotate1.style.transition = 'all .5s'
                rotate2.style.display = 'block';
            
                rotate3.style.transform = 'rotate(0deg) translateY(0px)'; 
                rotate3.style.transition = 'all .5s';
            }
        } else {
            navMenu.style.transform = "translateY(-100%)"
        }
    })

});