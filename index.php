<?php 
    get_header();
    $_SESSION["titulo"]=$_POST["titulo"];
    $_SESSION["descripcion"]=$_POST["descripcion"];
    $_SESSION["logo"]=$_POST["logo"];
    $_SESSION["marca"]=$_POST["marca"];
    $_SESSION["idMarca"]=$_POST["idMarca"];
    $_SESSION["idCategorias"]=$_POST["idCategorias"];
    $marca=$_SESSION["marca"];
    $idMarca=$_SESSION["idMarca"];
    //CONVIRTIENDO EL STRING RECIBIDO EN UN ARRAY
    $idCategorias=explode(",",$_SESSION["idCategorias"]);
    //ELIMINANDO DEL ARRAY, LA POSICION QUE CONTIENE EL ID DE LA MARCA A MOSTRAR
    unset($idCategorias[array_search($idMarca, $idCategorias)]);
    //CREANDO EL NUEO ARRAY DE LAS MARCAS A ELIMINAR
    $categoriasEliminadas=array();
    //AGREGANDO AL NUEVO ARREGLO LOS VALORES A ELIMINAR
    foreach($idCategorias as $categoria){
        array_push($categoriasEliminadas,$categoria*-1);
    }
    //CONVIRTIENDO EL ARREGLO EN UN STRING
    $categoriasEliminadas=implode(",",$categoriasEliminadas);
    $_SESSION["categoriasEliminadas"]=$categoriasEliminadas;
?>
<header id="header-marca">
    <section>
        <img id="logo-marca" src="<?php echo $_SESSION["logo"]?>" alt="marca">
        <div>
            <h1 id="titulo-marca"><?php echo $_SESSION["titulo"]?></h1>
            <p id="descripcion-marca"><?php echo $_SESSION["descripcion"]?></p>
        </div>
    </section>
</header>
<main id="main-productos" class="row container-fluid m-0">
    <aside class="col-xl-3 col-md-4 col-12">
        <section>
            <h1>Productos</h1>
            <span>12 Encontrados</span>
        </section>
        <section>
            <h1>Contáctanos</h1>
            <ul>
                <li>
                    <i class="bi bi-facebook"></i>
                    <a href="https://www.facebook.com/Tintasautomotricesvzla" target="_blank">Tintas Automotrices Vzla</a>
                </li>
                <li>
                    <i class="bi bi-instagram"></i>
                    <a href="https://www.instagram.com/tintasautomotricesvzla/" target="_blank">Tintasautomotricesvzla</a>
                </li>
                <li>
                    <i class="bi bi-telephone-fill"></i>
                    <a>+58 251 814 52 46</a>
                </li>
                <li>
                    <i class="bi bi-envelope-fill"></i>
                    <a>tintasautomotrices.vzla@gmail.com</a>
                </li>
                <li> 
                    <i class="bi bi-geo-alt-fill"></i>
                    <a href="https://g.co/kgs/a3rGnh" target="_blank">Ubicación</a>
                    <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15712.662073637732!2d-69.3750346!3d10.0855205!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe01433933faeb68a!2sTINTAS%20AUTOMOTRICES%20VZLA%2C%20C.A!5e0!3m2!1ses-419!2sve!4v1667660229749!5m2!1ses-419!2sve"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                </li>
            </ul>
        </section>
        <section>
            <img src="<?php echo get_template_directory_uri()."/assets/img/logo-white.png" ?>" alt="logo tintasautomotrices venezuela">
            <p>¿Quieres saber más de nosotros?</p>
            <!-- BOTON PARA INGRESAR -->
            <a type="button" class="" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bi bi-person-circle"></i>
                <span>Iniciar Sesión</span>
            </a>
        </section>
    </aside>
    <section class="col-xl-9 col-md-8 col-12">
        <section id="container-productos">
            <?php
                $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
    
                // Argumentos
                $args = array(
                    'category_name'=>"producto,$marca",
                    'cat'=>"$categoriasEliminadas",
                    'paged' => $paged
                );
                // Custom query.
                $query = new WP_Query($args);//"category_name=producto,'$marca'");
                // Check that we have query results.
                if ( $query->have_posts() ) {
                    // Start looping over the query results.
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        get_template_part('template-parts/content','archive');
                    }
                
                // Restore original post data.
                wp_reset_postdata();
                ?>
        </section>
        <section id="paginacion">
            <?php
                $big = 999999999; // need an unlikely integer

                echo paginate_links( array(
                    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format' => '?paged=%#%',
                    'current' => (get_query_var( 'paged' )==0)?1:get_query_var( 'paged' ),
                    'total' => $query->max_num_pages,
                    'end_size'=>3,
                    'prev_text'=>'<',
                    'next_text'=>'>'
                ) );
            }
            ?>
        </section>
    </section>
</main>

<?php 
    get_footer();
?>