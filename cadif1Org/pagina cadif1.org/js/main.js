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

});