/*
    Codigo referente a la pagina de marcas.
*/

$(document).ready(()=>{
    let arrProductos=[];
    let currentPage=1;
    let totalPages=1;
    let nombreMarca="",categoriaPadre="";
    let hacerConsulta=true;
    let contPaginacion=1;

    //CHEQUEANDO LA URL PARA GUARDAR DATOS EN LAS COOKIES
    let arrPath= window.location.pathname.split("/");
    if(arrPath.indexOf("marcas")!=-1){

        //SI LOS INPUTS Y LAS COOKIES ESTAN VACIAS, ENTONCES LLEVAME AL INICIO
        if(($("#idMarca").val()=="" || $("#categoriaPadre").val()=="")&&(Cookies.get("idMarca")==undefined || Cookies.get("categoriaPadre")==undefined)){
            window.location=window.location.origin;
        }else if($("#idMarca").val()!="" && $("#categoriaPadre").val()!=""){ //SI LOS INPUTS TIENEN VALORES, ENTONCES GUARDALOS EN LAS COOKIES
            Cookies.set("idMarca",$("#idMarca").val());
            Cookies.set("categoriaPadre",$("#categoriaPadre").val());
            Cookies.set("nombreMarca",$("#nombreMarca").val());
            Cookies.set("subCatAuto",$("#subCatAuto").val());
        }else{
            window.location=window.location.origin;
        }

        nombreMarca=Cookies.get("nombreMarca");
        categoriaPadre=Cookies.get("categoriaPadre");
        subCatAuto=Cookies.get("subCatAuto");
        // Consulta asincrona para guardar la cantidad de paginas devueltas, luego de la consulta se realizaran N consultas al api para mostrar los productos

        if(categoriaPadre.toLowerCase().trim()=="automotriz" && subCatAuto.toLowerCase().trim()=="")
            hacerConsulta=false;
        else 
            if(subCatAuto.trim().length==0 && categoriaPadre.toLowerCase().trim()!="automotriz")
                hacerConsulta=true;

        if(hacerConsulta){
            fetch(`http://localhost/wordpressTintasAutomotrices/wp-json/wp/v2/posts?_embed&per_page=100&categories=${Cookies.get("idMarca")}`)
            .then((response)=>{
                totalPages=response.headers.get('X-WP-TotalPages');
            })
            .catch((error)=>{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ocurrio un error con el servidor, intentalo más tarde.\n'+error,
                    showConfirmButton: false,
                });
            })
            .finally(()=>{
                if(totalPages<=0){
                    $("#container-productos").append("<h4>No se encontraron productos.</h4>");
                    $("#resultados").text("No hay resultados.");
                    $("#loading-productos").hide();
                }else{
                    for(let i=1;i<=totalPages;i++){
                        currentPage=i;
                        consultarProductos(i);
                    }
                }
            });
        }

        // Mostrando las Categorias
        imprimirCategorias();

        // Evento click al seleccionar una categoria
        $(".sub-categoria").click((event)=>{
            $("#container-productos").empty();
            $("#paginacion").hide();
            buscarProdPorCategoria($(event.currentTarget).attr("subCategoria"),$(event.currentTarget).val());
        })
        
        // Evento click para mostrar todos los productos
        $("#mostrarTodos").click(()=>{
            $("#container-productos").empty();
            mostrarProductos(true)
        })

        //Evento click de la paginacion para mostrar mas productos
        $("#paginacion").click(()=>mostrarProductos())
    }
    /* FUNCIONES */
    // Consulta asincrona para obtener los post de la marca especifica
    function consultarProductos(pageNumber){
        fetch(`http://localhost/wordpressTintasAutomotrices/wp-json/wp/v2/posts?_embed&per_page=100&page=${pageNumber}&categories=${Cookies.get("idMarca")}`)
        .then((response)=>{
            if(response.ok)
                return response.json()
            else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ocurrio un error con el servidor, intentalo más tarde.',
                    showConfirmButton: false,
                });            }
        })
        .then((productos)=>{
            // Filtrando los productos por categoria padre guardada en la cookie y guardandolos en el arreglo arrProductos
            if(nombreMarca=="anjo")
                //FILTRANDO LOS PRODUCTOS QUE TIENEN CATPADRE AUTOMOTRIZ Y SUB CATEGORIA DE TIPO DE SISTEMA
                if(categoriaPadre.toLowerCase().trim()=="automotriz" && subCatAuto.toLowerCase().trim()!=""){
                    for(let i=0;i<productos.length;i++){
                        if(productos[i].acf.categorias_anjo.toLowerCase().trim()==categoriaPadre.toLowerCase().trim() && productos[i].acf.tipo_de_sistema.toLowerCase().trim()==subCatAuto.toLowerCase().trim()){
                            arrProductos.push(productos[i]);
                        }
                    }
                }else
                    for(let i=0;i<productos.length;i++){ //PRODUCTOS QUE CONCUERDAN CON LA CATEGORIA PADRE DE ANJO
                        if(productos[i].acf.categorias_anjo.toLowerCase().trim()==categoriaPadre.toLowerCase().trim()){
                            arrProductos.push(productos[i]);
                        }
                    }
            else if(nombreMarca=="atlas")
                for(let i=0;i<productos.length;i++){ //PRODUCTOS QUE CONCUERDAN CON LA CATEGORIA PADRE DE ATLAS
                    if(productos[i].acf.categorias_atlas.toLowerCase().trim()==categoriaPadre.toLowerCase().trim()){
                        arrProductos.push(productos[i]);
                    }
                }
        })
        .catch((error)=>{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ocurrio un error con tu conexión, intentalo más tarde.\n'+error,
                showConfirmButton: false,
            });
        })
        .finally(()=>{
            if(arrProductos.length==0){ //Si no hay productos con la subcategoria especifica entonces muestra un mensaje
                $("#loading-productos").hide();
                $("#container-productos").append("<h4>No se encontraron productos.</h4>");
                $("#resultados").text("No hay resultados.")
            }else
                if(currentPage==totalPages){ //Si la pagina actual es igual al total de paginas entonces muestra los productos

                    $("#container-productos").empty();
                    mostrarProductos()

                    $("#resultados").text(arrProductos.length+" Encontrados");
                    $(".sub-categoria").removeAttr("disabled");
                    $("#mostrarTodos").removeAttr("disabled");
                }
        })
    }
    // Mostrando productos
    function mostrarProductos(mostrarTodos){
        let sub_categoria="";
        let sub_categoria2="";
        if(arrProductos.length==0){
            $("#loading-productos").hide();
            $("#container-productos").append("<h4>No se encontraron productos.</h4>");
            $("#resultados").text("No hay resultados.")
        }else{
            // Si mostrarTodos no se paso por parametro entonces se le asigna false;
            if(mostrarTodos==undefined)
                mostrarTodos=false;

            // Si es true entonces la paginacion se inicializa desde el principio ya que no se usara paginacion
            if(mostrarTodos){
                contPaginacion=1;
            }
            for(let i=contPaginacion-1;i<arrProductos.length;i++){
    
                switch(nombreMarca){ //Mostrando la sub categoria a la que pertenece el producto
                    case "anjo": 
                    switch(arrProductos[i].acf.categorias_anjo){
                        case "automotriz": sub_categoria=arrProductos[i].acf.categorias_automotrices;
                        sub_categoria=categoriasAnjo[0].subCategoriasTitulos[categoriasAnjo[0].subCategorias.indexOf(sub_categoria)];
                        break;
                        case "inmobiliaria": sub_categoria=arrProductos[i].acf.categorias_inmobiliarias;
                        sub_categoria=categoriasAnjo[1].subCategoriasTitulos[categoriasAnjo[1].subCategorias.indexOf(sub_categoria)];
                        break;
                        case "anjoprint": sub_categoria=arrProductos[i].acf.categorias_anjoprint;
                        sub_categoria=categoriasAnjo[2].subCategoriasTitulos[categoriasAnjo[2].subCategorias.indexOf(sub_categoria)];
                        break;
                        case "anjotech": sub_categoria=arrProductos[i].acf.categorias_sistema;
                            sub_categoria2=arrProductos[i].acf.tecnologia;
                            sub_categoria2=categoriasAnjo[3].subCategoriasTitulos[categoriasAnjo[3].subCategorias.indexOf(sub_categoria2)];
                            sub_categoria=categoriasAnjo[4].subCategoriasTitulos[categoriasAnjo[4].subCategorias.indexOf(sub_categoria)];
                        break;
                        case "solventes": sub_categoria=arrProductos[i].acf.categorias_de_solventes;
                        sub_categoria=categoriasAnjo[5].subCategoriasTitulos[categoriasAnjo[5].subCategorias.indexOf(sub_categoria)];
                        break;
                    }
                    break;
                    case "atlas": 
                    switch(arrProductos[i].acf.categorias_atlas){
                        case "brochas": sub_categoria=arrProductos[i].acf.tipos_de_brochas;
                        sub_categoria=categoriasAtlas[0].subCategoriasTitulos[categoriasAtlas[0].subCategorias.indexOf(sub_categoria)];
                        break;
                        case "rodillos": sub_categoria=arrProductos[i].acf.tipos_de_rodillos;
                        sub_categoria=categoriasAtlas[1].subCategoriasTitulos[categoriasAtlas[1].subCategorias.indexOf(sub_categoria)];
                        break;
                        case "mini_rodillos": sub_categoria=arrProductos[i].acf.tipos_de_mini_rodillos;
                        sub_categoria=categoriasAtlas[2].subCategoriasTitulos[categoriasAtlas[2].subCategorias.indexOf(sub_categoria)];
                        break;
                        case "mangos": sub_categoria=arrProductos[i].acf.tipos_de_mangos;
                            sub_categoria=categoriasAtlas[3].subCategoriasTitulos[categoriasAtlas[3].subCategorias.indexOf(sub_categoria)];
                        break;
                        case "accesorios": sub_categoria=arrProductos[i].acf.accesorios_generales;
                        sub_categoria=categoriasAtlas[4].subCategoriasTitulos[categoriasAtlas[4].subCategorias.indexOf(sub_categoria)];
                        break;
                        case "espatulas": sub_categoria=arrProductos[i].acf.tipos_de_espatulas;
                        sub_categoria=categoriasAtlas[5].subCategoriasTitulos[categoriasAtlas[5].subCategorias.indexOf(sub_categoria)];
                        break;
                        case "cepillo_acero": sub_categoria=arrProductos[i].acf.tipos_de_cepillos_de_acero;
                        sub_categoria=categoriasAtlas[6].subCategoriasTitulos[categoriasAtlas[6].subCategorias.indexOf(sub_categoria)];
                        break;
                        case "rodillos_textura": sub_categoria=arrProductos[i].acf.tipos_de_rodillos_textura;
                        sub_categoria=categoriasAtlas[7].subCategoriasTitulos[categoriasAtlas[7].subCategorias.indexOf(sub_categoria)];
                        break;
                        case "mini_rodillos_textura": sub_categoria=arrProductos[i].acf.tipos_de_mini_rodillos_textura;
                        sub_categoria=categoriasAtlas[8].subCategoriasTitulos[categoriasAtlas[8].subCategorias.indexOf(sub_categoria)];
                        break;
                    }
                    break;
                }
    
                $("#container-productos").append(`<a href='${arrProductos[i].link}'><img src='${arrProductos[i].fimg_url}' alt='productos anjotintas'><hr class='border-danger border-2'><div><h1>${arrProductos[i].title.rendered}</h1><span>${sub_categoria + " " + sub_categoria2}</span></div></a>`)
                
                contPaginacion++; //VARIABLE QUE CONTROLA LA PAGINACION
                if(contPaginacion%10==0)
                    break;
            }
            $("#resultados").text(arrProductos.length + " Encontrados.")

            //Mostrando segun sea el caso el boton de paginacion
            if(contPaginacion<arrProductos.length)
                $("#paginacion").css("display","flex");
            else
                $("#paginacion").hide();
        }
    }
    // Imprimir las categorias en pantalla
    function imprimirCategorias(){
        switch(nombreMarca){
            case 'anjo': for(let i=0;i<categoriasAnjo.length;i++){
                if(categoriasAnjo[i].nombre.toLocaleLowerCase().trim()==Cookies.get("categoriaPadre").toLocaleLowerCase().trim()){

                    $("#container-categorias").append(`<a data-bs-toggle='collapse' href='${"#categoria"+i}' role='button' aria-expanded='false' aria-controls='${"#categoria"+i}'> ${categoriasAnjo[i].titulo} <i class='bi bi-caret-right'></i> </a>`)

                    let div = document.createElement("div");
                    $(div).attr("class","collapse");
                    $(div).attr("id",`${"categoria"+i}`)

                    for(let j=0;j<categoriasAnjo[i].subCategorias.length;j++){
                        $(div).append(`<input class='sub-categoria' disabled type='button' value='- ${categoriasAnjo[i].subCategoriasTitulos[j]}' subCategoria='${categoriasAnjo[i].subCategorias[j]}' nombre='${categoriasAnjo[i].nombre}'>`)
                    }
                    $("#container-categorias").append(div)
                }
            }
            break;
            case 'atlas': for(let i=0;i<categoriasAtlas.length;i++){
                if(categoriasAtlas[i].nombre.toLocaleLowerCase().trim()==Cookies.get("categoriaPadre").toLocaleLowerCase().trim()){

                    $("#container-categorias").append(`<a data-bs-toggle='collapse' href='${"#categoria"+i}' role='button' aria-expanded='false' aria-controls='${"#categoria"+i}'> ${categoriasAtlas[i].titulo} <i class='bi bi-caret-right'></i> </a>`)

                    let div = document.createElement("div");
                    $(div).attr("class","collapse");
                    $(div).attr("id",`${"categoria"+i}`)

                    for(let j=0;j<categoriasAtlas[i].subCategorias.length;j++){
                        $(div).append(`<input class='sub-categoria' disabled type='button' value='- ${categoriasAtlas[i].subCategoriasTitulos[j]}' subCategoria='${categoriasAtlas[i].subCategorias[j]}' nombre='${categoriasAtlas[i].nombre}'>`)
                    }
                    $("#container-categorias").append(div)
                }
            }
            break;
        }
    }

    //Buscar productos por categorias seleccionadas en el arreglo de productos
    function buscarProdPorCategoria(subcat,subcatTitulo){
        let encontrado=false;
        let contProd=0;
        titulo=subcatTitulo.split(" ");
        titulo.shift();
        titulo=titulo.join(" ");
        // Recorriendo el arreglo en busca de los productos
        for(let i=0;i<arrProductos.length;i++){
            switch(nombreMarca){
                case "anjo": 
                switch(categoriaPadre){
                    case "automotriz": 
                    if(arrProductos[i].acf.categorias_anjo.toLowerCase().trim()==categoriaPadre && arrProductos[i].acf.categorias_automotrices.toLowerCase().trim()==subcat){
                        encontrado=true;
                        contProd++;
                        $("#container-productos").append(`<a href='${arrProductos[i].link}'><img src='${arrProductos[i].fimg_url}' alt='productos anjotintas'><hr class='border-danger border-2'><div><h1>${arrProductos[i].title.rendered}</h1><span>${titulo}</span></div></a>`)
                    }
                    break;
                    case "inmobiliaria": 
                    if(arrProductos[i].acf.categorias_anjo.toLowerCase().trim()==categoriaPadre && arrProductos[i].acf.categorias_inmobiliarias.toLowerCase().trim()==subcat){
                        encontrado=true;
                        contProd++;
                        $("#container-productos").append(`<a href='${arrProductos[i].link}'><img src='${arrProductos[i].fimg_url}' alt='productos anjotintas'><hr class='border-danger border-2'><div><h1>${arrProductos[i].title.rendered}</h1><span>${titulo}</span></div></a>`)
                    }
                    break;
                    case "anjoprint": 
                    if(arrProductos[i].acf.categorias_anjo.toLowerCase().trim()==categoriaPadre && arrProductos[i].acf.categorias_anjoprint.toLowerCase().trim()==subcat){
                        encontrado=true;
                        contProd++;
                        $("#container-productos").append(`<a href='${arrProductos[i].link}'><img src='${arrProductos[i].fimg_url}' alt='productos anjotintas'><hr class='border-danger border-2'><div><h1>${arrProductos[i].title.rendered}</h1><span>${titulo}</span></div></a>`)
                    }
                    break;
                    case "anjotech": 
                    if(categoriasAnjo[3].subCategorias.indexOf(subcat)!=-1){
                        if(arrProductos[i].acf.categorias_anjo.toLowerCase().trim()==categoriaPadre && arrProductos[i].acf.tecnologia.toLowerCase().trim()==subcat){
                            encontrado=true;
                            contProd++;
                            $("#container-productos").append(`<a href='${arrProductos[i].link}'><img src='${arrProductos[i].fimg_url}' alt='productos anjotintas'><hr class='border-danger border-2'><div><h1>${arrProductos[i].title.rendered}</h1><span>${titulo}</span></div></a>`)
                        }
                    }else{
                        if(arrProductos[i].acf.categorias_anjo.toLowerCase().trim()==categoriaPadre && arrProductos[i].acf.categorias_sistema.toLowerCase().trim()==subcat){
                            encontrado=true;
                            contProd++;
                            $("#container-productos").append(`<a href='${arrProductos[i].link}'><img src='${arrProductos[i].fimg_url}' alt='productos anjotintas'><hr class='border-danger border-2'><div><h1>${arrProductos[i].title.rendered}</h1><span>${titulo}</span></div></a>`)
                        }
                    }
                    break;
                    case "solventes": 
                    if(arrProductos[i].acf.categorias_anjo.toLowerCase().trim()==categoriaPadre && arrProductos[i].acf.categorias_de_solventes.toLowerCase().trim()==subcat){
                        encontrado=true;
                        contProd++;
                        $("#container-productos").append(`<a href='${arrProductos[i].link}'><img src='${arrProductos[i].fimg_url}' alt='productos anjotintas'><hr class='border-danger border-2'><div><h1>${arrProductos[i].title.rendered}</h1><span>${titulo}</span></div></a>`)
                    }
                    break;
                }
                break;
                case "atlas":
                    switch(categoriaPadre){
                        case "brochas": 
                        if(arrProductos[i].acf.categorias_atlas.toLowerCase().trim()==categoriaPadre && arrProductos[i].acf.tipos_de_brochas.toLowerCase().trim()==subcat){
                            encontrado=true;
                            contProd++;
                            $("#container-productos").append(`<a href='${arrProductos[i].link}'><img src='${arrProductos[i].fimg_url}' alt='productos anjotintas'><hr class='border-danger border-2'><div><h1>${arrProductos[i].title.rendered}</h1><span>${titulo}</span></div></a>`)
                        }
                        break;
                        case "rodillos": 
                        if(arrProductos[i].acf.categorias_atlas.toLowerCase().trim()==categoriaPadre && arrProductos[i].acf.tipos_de_rodillos.toLowerCase().trim()==subcat){
                            encontrado=true;
                            contProd++;
                            $("#container-productos").append(`<a href='${arrProductos[i].link}'><img src='${arrProductos[i].fimg_url}' alt='productos anjotintas'><hr class='border-danger border-2'><div><h1>${arrProductos[i].title.rendered}</h1><span>${titulo}</span></div></a>`)
                        }
                        break;
                        case "mini_rodillos": 
                        if(arrProductos[i].acf.categorias_atlas.toLowerCase().trim()==categoriaPadre && arrProductos[i].acf.tipos_de_mini_rodillos.toLowerCase().trim()==subcat){
                            encontrado=true;
                            contProd++;
                            $("#container-productos").append(`<a href='${arrProductos[i].link}'><img src='${arrProductos[i].fimg_url}' alt='productos anjotintas'><hr class='border-danger border-2'><div><h1>${arrProductos[i].title.rendered}</h1><span>${titulo}</span></div></a>`)
                        }
                        break;
                        case "mangos": 
                        if(arrProductos[i].acf.categorias_atlas.toLowerCase().trim()==categoriaPadre && arrProductos[i].acf.tipos_de_mangos.toLowerCase().trim()==subcat){
                            encontrado=true;
                            contProd++;
                            $("#container-productos").append(`<a href='${arrProductos[i].link}'><img src='${arrProductos[i].fimg_url}' alt='productos anjotintas'><hr class='border-danger border-2'><div><h1>${arrProductos[i].title.rendered}</h1><span>${titulo}</span></div></a>`)
                        }
                        break;
                        case "accesorios": 
                        if(arrProductos[i].acf.categorias_atlas.toLowerCase().trim()==categoriaPadre && arrProductos[i].acf.accesorios_generales.toLowerCase().trim()==subcat){
                            encontrado=true;
                            contProd++;
                            $("#container-productos").append(`<a href='${arrProductos[i].link}'><img src='${arrProductos[i].fimg_url}' alt='productos anjotintas'><hr class='border-danger border-2'><div><h1>${arrProductos[i].title.rendered}</h1><span>${titulo}</span></div></a>`)
                        }
                        break;
                        case "espatulas": 
                        if(arrProductos[i].acf.categorias_atlas.toLowerCase().trim()==categoriaPadre && arrProductos[i].acf.tipos_de_espatulas.toLowerCase().trim()==subcat){
                            encontrado=true;
                            contProd++;
                            $("#container-productos").append(`<a href='${arrProductos[i].link}'><img src='${arrProductos[i].fimg_url}' alt='productos anjotintas'><hr class='border-danger border-2'><div><h1>${arrProductos[i].title.rendered}</h1><span>${titulo}</span></div></a>`)
                        }
                        break;
                        case "cepillo_acero": 
                        if(arrProductos[i].acf.categorias_atlas.toLowerCase().trim()==categoriaPadre && arrProductos[i].acf.tipos_de_cepillos_de_acero.toLowerCase().trim()==subcat){
                            encontrado=true;
                            contProd++;
                            $("#container-productos").append(`<a href='${arrProductos[i].link}'><img src='${arrProductos[i].fimg_url}' alt='productos anjotintas'><hr class='border-danger border-2'><div><h1>${arrProductos[i].title.rendered}</h1><span>${titulo}</span></div></a>`)
                        }
                        break;
                        case "rodillos_textura": 
                        if(arrProductos[i].acf.categorias_atlas.toLowerCase().trim()==categoriaPadre && arrProductos[i].acf.tipos_de_rodillos.toLowerCase().trim()==subcat){
                            encontrado=true;
                            contProd++;
                            $("#container-productos").append(`<a href='${arrProductos[i].link}'><img src='${arrProductos[i].fimg_url}' alt='productos anjotintas'><hr class='border-danger border-2'><div><h1>${arrProductos[i].title.rendered}</h1><span>${titulo}</span></div></a>`)
                        }
                        break;
                        case "mini_rodillos_textura": 
                        if(arrProductos[i].acf.categorias_atlas.toLowerCase().trim()==categoriaPadre && arrProductos[i].acf.tipos_de_mini_rodillos_textura.toLowerCase().trim()==subcat){
                            encontrado=true;
                            contProd++;
                            $("#container-productos").append(`<a href='${arrProductos[i].link}'><img src='${arrProductos[i].fimg_url}' alt='productos anjotintas'><hr class='border-danger border-2'><div><h1>${arrProductos[i].title.rendered}</h1><span>${titulo}</span></div></a>`)
                        }
                        break;
                    }
                break;
            }
        }
        if(!encontrado){
            $("#container-productos").append("<h1>No se encontraron productos.</h1>")
        }
        $("#resultados").text(contProd+" Encontrados");
    }
});