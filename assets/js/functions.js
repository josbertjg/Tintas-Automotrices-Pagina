//DETECTING IF AN ELEMENT IS ON VIEWPORT
function isInViewport(elem) {
    let distance = elem.getBoundingClientRect();
    return (distance.top < (window.innerHeight || document.documentElement.clientHeight) && distance.bottom > 0);
}
/* MARCAS */
//EFECTOS
async function marcasEffects(){
    $("#marcas > h1").animate({
        top:"30vh",
        opacity:"1"
    },1000)
    // $("#marcas > h1").fadeIn()
}