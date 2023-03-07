/*
    Codigo General
*/

$(document).ready(()=>{
    
    //DECLARANDO E INICIALIZANDO VARIABLES
    let navHeight=$(".menu").height();
    //HABILITANDO LOS TOOLTIPS DE BOOTSTRAP
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));   

    //DANDO ESTILOS AL MENU
    if(window.scrollY>navHeight){
        $(".menu").addClass("menuEstilado");
    }else{
        $(".menuEstilado").removeClass("menuEstilado")
    }
    $(window).scroll(()=>{
        //EFECTOS DEL MENU
        setTimeout(() => {
            if(window.scrollY>0){
                $(".menu").addClass("menuEstilado");
            }else{
                $(".menuEstilado").removeClass("menuEstilado")
            }
        }, 200);
    });
    //CERRANDO EL OFFCANVAS CADA VEZ QUE SE CLICKEA UN ITEM
    $(".item-menu").click(()=>document.getElementById("cerrar-offcanvas").click());
    //MOSTRANDO LAS CATEGORIAS ANJO
    $(".marca-anjo").click((event)=>{
        if($(event.currentTarget).hasClass("show-categories-anjo")){
            $(event.currentTarget).removeClass("show-categories-anjo");
            setTimeout(() => {
                $(event.currentTarget).css("overflow","hidden")
            }, 400);
        }else{
            $(event.currentTarget).addClass("show-categories-anjo")
            $(event.currentTarget).css("overflow","visible")
        }
    });
    //MOSTRANDO LAS CATEGORIAS ATLAS
    $(".marca-atlas").click((event)=>{
        if($(event.currentTarget).hasClass("show-categories-atlas")){
            $(event.currentTarget).removeClass("show-categories-atlas");
            setTimeout(() => {
                $(event.currentTarget).css("overflow","hidden")
            }, 400);
        }else{
            $(event.currentTarget).addClass("show-categories-atlas")
            $(event.currentTarget).css("overflow","visible")
        }
    });
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