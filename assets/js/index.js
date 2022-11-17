$(document).ready(()=>{
    //DECLARANDO E INICIALIZANDO VARIABLES
    let navHeight=$("nav").height();
    //HABILITANDO LOS TOOLTIPS DE BOOTSTRAP
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    //SLIDER DE MARCAS CON SWIPER JS
    const swiper = new Swiper('.swiper', {
        effect:"coverflow",
        grabCursor:true,
        speed: 400,
        centeredSlides: true,
        loop: true,
        autoplay:{
            delay:3000
        },
        coverflowEffect:{
            rotate: 40,
            stretch: 0,
            depth: 150,
            modifier: 1,
            slideShadows: true,
        },
        // Responsive breakpoints
        breakpoints: {
            // when window width is >= 320px
            320: {
            slidesPerView: 2,
            spaceBetween: 20
            },
            // when window width is >= 480px
            480: {
            slidesPerView: 3,
            spaceBetween: 30
            },
            // when window width is >= 640px
            1000: {
            slidesPerView: 4,
            spaceBetween: 40
            }
        }
    });

    //SLIDER DE DETALLE CON SWIPER JS (PRODUCTOS RELACIONADOS)
    const swiper2 = new Swiper('.swiper2', {
        grabCursor:true,
        speed: 400,
        slidesPerView: 1,
        // centeredSlides: true,
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

    //DANDO ESTILOS AL MENU
    if(window.scrollY>navHeight){
        $("nav").addClass("menuEstilado");
    }else{
        $(".menuEstilado").removeClass("menuEstilado")
    }
    $(window).scroll(()=>{
        //EFECTOS DEL MENU
        if(window.scrollY>navHeight){
            $("nav").addClass("menuEstilado");
        }else{
            $(".menuEstilado").removeClass("menuEstilado")
        }
        //EFECTOS DE MARCAS
        if(isInViewport(document.getElementById("marcas"))){
            setTimeout(() => {
                marcasEffects();
                $("#marcas > img").addClass("imgMarcaEstilada");
            }, 1000);
        }
    });
    //CERRANDO EL OFFCANVAS CADA VEZ QUE SE CLICKEA UN ITEM
    $(".item-menu").click(()=>document.getElementById("cerrar-offcanvas").click());
    //ESTILOS DE LA SECCION MARCAS
    if(isInViewport(document.getElementById("marcas"))){
        setTimeout(() => {
            marcasEffects();
            $("#marcas > section img").addClass("imgMarcaEstilada");
        }, 1000);
    }
});