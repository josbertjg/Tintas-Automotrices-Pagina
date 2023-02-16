$(document).ready(()=>{
    //SLIDER DE DETALLE CON SWIPER JS (MAS PRODUCTOS)
    const swiper = new Swiper('.swiper', {
        grabCursor:true,
        speed: 400,
        slidesPerView: 1,
        loop: true,
        autoplay:{
            delay:5000
        },
        // Responsive breakpoints
        breakpoints: {
            // when window width is >= 576px
            576: {
            slidesPerView: 2,
            spaceBetween: 10,
            },
            // when window width is >= 768px
            768: {
            slidesPerView: 3,
            spaceBetween: 20,
            },
            // when window width is >= 992px
            992: {
            slidesPerView: 3,
            spaceBetween: 10
            },
            // when window width is >= 1200px
            1200: {
            slidesPerView: 3,
            spaceBetween: 20
            },
            // when window width is >= 1400px
            1400: {
            slidesPerView: 4,
            spaceBetween: 25
            }
        }
    });
})