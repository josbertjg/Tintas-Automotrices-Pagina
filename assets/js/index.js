$(document).ready(()=>{
    //CHEQUEANDO LA URL PARA GUARDAR DATOS EN LAS COOKIES
    let arrPath= window.location.pathname.split("/");
    if(arrPath.indexOf("marcas")!=-1){
        if((Cookies.get("logo")==undefined || Cookies.get("titulo")==undefined || Cookies.get("descripcion")==undefined)){
            Cookies.set("logo",$("#logo-marca").attr("src"));
            Cookies.set("titulo",$("#titulo-marca").text());
            Cookies.set("descripcion",$("#descripcion-marca").text());
        }
        if($("#logo-marca").attr("src").trim().length==0 && $("#titulo").text().trim().length==0 && $("#descripcion-marca").text().trim().length==0){
            $("#logo-marca").attr("src",Cookies.get("logo"));
            $("#titulo-marca").text(Cookies.get("titulo"));
            $("#descripcion-marca").text(Cookies.get("descripcion"));
        }
    }
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
    });
    //CERRANDO EL OFFCANVAS CADA VEZ QUE SE CLICKEA UN ITEM
    $(".item-menu").click(()=>document.getElementById("cerrar-offcanvas").click());
    //ALGORITMO PARA ENVIAR CORREO
    $("#form-contacto").submit((event)=>{
        event.preventDefault();
        $("#loading-formulario").fadeIn();

        let datos= new FormData(document.getElementById("form-contacto"));

        $("#loading").fadeIn("fast");

        fetch(ajax_var.ajaxurl,{
            method:"POST",
            body:datos
        })
        .then((respuesta)=>{
            if(respuesta.ok)
                return respuesta.text();
            else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ocurrio un error, intentalo mas tarde.',
                    showConfirmButton: false,
                });
            }
        })
        .then((respuesta)=>{
            if(respuesta==1){
                Swal.fire({
                    icon: 'success',
                    title: 'Correo Enviado.',
                    showConfirmButton: false,
                });
                $("#nombre-formulario").val("");
                $("#email-formulario").val("");
                $("#mensaje-formulario").val("");
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ocurrio un error, intentalo mas tarde.',
                    showConfirmButton: false,
                });
            }
        })
        .catch((e)=>{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ocurrio un error, intentalo mas tarde.',
                footer: `<p>${e}</p>`,
                showConfirmButton: false,
            });
        })
        .finally(()=>{
            $("#loading-formulario").fadeOut("fast");
        });
    });
});