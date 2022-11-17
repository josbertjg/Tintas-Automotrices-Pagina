/*
Version: 1.1
*/
$(document).ready(function(){
    
    $(document).scroll(()=>{
        if(window.scrollY>=300)
            $("#scroller").fadeIn("fast");
        else
            $("#scroller").fadeOut("fast");
    });

    $("#scroller").click(()=>{
        window.scrollTo(0,0);
    });
    $("#formulario-participa").submit((event)=>{
        event.preventDefault();
        let datos = new FormData(document.getElementById('formulario-participa'));
        $("#loading").fadeIn("fast");
        fetch(cadif1org_vars.ajaxurl,{
            method:'POST',
            body: datos
        })
        .then((respuesta)=>{
            if(respuesta.ok){
                return respuesta.text();
            }else{
                Swal.fire({
                    icon: 'error',
                    title: '¡Ocurrió un error, intentalo mas tarde...!',
                    showConfirmButton: false,
                  });
            }
        })
        .then((respuesta)=>{
            console.log(respuesta);
            if(respuesta==1){
                Swal.fire({
                    icon: 'success',
                    title: 'Solicitud enviada, ¡Gracias por participar!',
                    showConfirmButton: false,
                  });
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Lo sentimos, no hemos podido recibir tu solicitud, intenta mas tarde.',
                    showConfirmButton: false,
                  });
            }
        })
        .catch((error)=>{
            console.log(error);
            Swal.fire({
                icon: 'error',
                title: '¡Ocurrió un error con tu conexión, inténtalo de nuevo...!',
                showConfirmButton: false,
              });
        })
        .finally(()=>$("#loading").fadeOut("fast"));


    });

});
