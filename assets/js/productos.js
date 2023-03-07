$(document).ready(()=>{
  let arrProductos=$("#container-productos").children();

  if(arrProductos.length==0){
    $(".sub-categoria").attr("disabled",true);
    $("#mostrarTodos").attr("disabled",true);
  }

  if(arrProductos.length>=9)
    $("#resultados").text(arrProductos.length+" o Más Encontrados");
  else
    $("#resultados").text(arrProductos.length+" Encontrados");

  //BUSCAR PRODUCTOS POR CATEGORIA CUANDO SE HACE CLICK EN UNA CATEGORIA
  $(".sub-categoria").click((event)=>{
    $("#container-productos").empty();
    $("#paginacion").hide();
    $("#loading-productos").fadeIn("fast");
    $(".sub-categoria").attr("disabled",true);
    $("#mostrarTodos").attr("disabled",true);
    buscarProductos(event.target.getAttribute("idCategoria"),event.target.value.trim());
  });

  //MOSTRANDO TODOS LOS PRODUCTOS
  $("#mostrarTodos").click(()=>{
    $("#container-productos").empty();

    if(arrProductos.length>=9)
      $("#resultados").text(arrProductos.length+" o Más Encontrados");
    else
      $("#resultados").text(arrProductos.length+" Encontrados");

    for(let i=0;i<arrProductos.length;i++){
        $("#container-productos").append(arrProductos[i]);
    }
    $("#paginacion").show();
  });

  /* FUNCIONES */

  //SE HACE FETCH AL API DE WORDPRESS EN BUSCA DE LOS PRODUCTOS (TAMBIEN SE RENDERIZAN EN ESTA FUNCION)
  async function buscarProductos(id,nombre){
    let url='http://localhost/wordpressTintasAutomotrices/wp-json/wp/v2/';
    let postType=$("#postType").val();
    if(postType=='anjo'){
      if($("#catPadre").val()=="automotriz" && ($("#catIntermedia").val()!=undefined || $("#catIntermedia").val()!=null || $("#catIntermedia").val()!="")){
        url+=`${postType}?_embed&per_page=100&hijo_anjo=${id}&cat_intermedia_anjo=${$("#idIntermedias").val()}`;
      }else{
        url+=`${postType}?_embed&per_page=100&hijo_anjo=${id}`;
      }
    }else if(postType=='atlas'){
      url+=`${postType}?_embed&per_page=100&hijo_atlas=${id}`;
    }
    fetch(url)
    .then((resp)=>{
      if(resp.ok)
        return resp.json();
      else
        console.log("Hubo un error con el servidor");
    })
    .then((productos)=>{
      console.log(productos)
      $("#resultados").text(productos.length+" Encontrados");
      if(productos.length==0)
        $("#container-productos").append("<h2 style='text-align:center;'>No contamos con productos de esta categoría en este momento.</h2>")
      else
        productos.map((producto)=>{
          $("#container-productos").append(`<a href="${producto.link}" target="_blank"><img src="${producto._embedded['wp:featuredmedia']['0'].source_url}" alt="${nombre} neopixels"><hr class="border-danger border-2"><div><h1>${producto.title.rendered}</h1><span style="text-transform:capitalize;">${nombre}</span></div></a>`);
        });
    })
    .catch((error)=>{
      console.log("Ocurrio un error con tu conexion.")
      console.log(error)
    })
    .finally(()=>{
      $(".sub-categoria").attr("disabled",false);
      $("#mostrarTodos").attr("disabled",true);
      $("#loading-productos").fadeOut(100);
    })
  }
});