<?php 
    get_header();
    
    if(!empty($_GET["idHijos"])){
        //EL ARRAY DE ID VIENE CON UNA POSICION EXTRA QUE ESTA VACIA, POR ESO EN LAS SIGUIENTES LINEAS LO ARREGLAMOS
        $idHijos=explode(',',$_GET["idHijos"]);
        unset($idHijos[count($idHijos)-1]);
        $idHijos = array_values($idHijos);
        //ARRAY QUE VA A ALMACENAR TODOS LOS SLUGS DE LAS CATEGORIAS HIJAS (EL MENSAJE AL QUE VA A PERTENECER CADA CAT HIJA)
        $slugs=array();
        foreach ( $idHijos as $id ) {
            $value=get_field('slug_hijo_atlas', get_term($id,'hijo_atlas'));
            if(!in_array($value, $slugs))
                array_push($slugs, $value);
        }
    }
    $postType=get_post_type();
?>
<input type="hidden" id="postType" value="<?php echo $postType ?>">
<header id="header-marca">
    <section>
        <?php
            dynamic_sidebar('Logo Marca Atlas');
        ?>
    </section>
</header>
<main id="main-productos" class="row container-fluid m-0">
    <aside class="col-xl-3 col-md-4 col-12">
        <section>
            <h1>Productos</h1>
            <span id="resultados">Cargando...</span>
        </section>
        <h1>Categorías</h1>
        <section id="container-categorias">
            <a class="" disabled id="mostrarTodos">
                Mostrar Todos
            </a>
            <?php
                $i=0;
                $repetidos = array();
                foreach ( $slugs as $slug ) {
                    $i++;
                    ?>
                        <a class="" data-bs-toggle="collapse" href="#cat<?php echo $i ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <?php echo $slug ?>
                            <i class="bi bi-caret-right"></i>
                        </a>
                        <div class="collapse" id="cat<?php echo $i ?>">
                    <?php
                        foreach ( $idHijos as $id ) {
                            $term=get_term($id,'hijo_atlas');
                            if($slug==get_field('slug_hijo_atlas', $term)){
                                ?>
                                    <input style="text-transform:capitalize;" class="sub-categoria" type="button" idCategoria="<?php echo $term->term_taxonomy_id; ?>" value="<?php echo $term->name?>">
                                <?php
                            }
                        }
                    ?>
                        </div>
                    <?php
                }
            ?>
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
        <img style="display:none;" id="loading-productos" src="<?php echo get_template_directory_uri()."/assets/img/loading.gif" ?>" alt="loading tintasautomotrices venezuela">
        <section id="container-productos">
            <?php
                // Check that we have results.
                if ( have_posts() ) {
                    // Start looping over the query results.
                    while ( have_posts() ) {
                        the_post();
                        $terms=get_the_terms( get_the_ID(), 'hijo_atlas' );
                        foreach ( $terms as $term ) {
                            $catName=$term->name;
                        }
                        ?>
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php the_post_thumbnail_url(); ?>" alt=" <?php the_title(); ?> producto anjotintas">
                                <hr class="border-danger border-2">
                                <div>
                                    <h1><?php the_title(); ?></h1>
                                    <span style="text-transform:capitalize;"><?php echo $catName ?></span>
                                </div>
                            </a>
                        <?php
                    }
                }else{
            ?>
        </section>
            <?php
                echo "<h1 style='text-align:center; position: relative; top: -200px;'>No contamos con Productos de este tipo en este momento.</h1>";
              }
            ?>
        </section>
        <section id="paginacion">
            <?php 
                $args = array(
                    'prev_text' => '<',
                    'next_text' => '>'
                );
                the_posts_pagination($args);
            ?>
        </section>
    </section>
</main>
<?php 
    get_footer();
?>