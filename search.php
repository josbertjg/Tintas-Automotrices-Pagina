<?php 
    get_header();
?>
<main id="main-productos" class="row container-fluid m-0">
    <aside class="col-xl-3 col-md-4 col-12">
        <section>
            <h1>Búsqueda:</h1>
            <span id="resultados">busqueda...</span>
        </section>
        <h1 id="search-title">¿Encontraste lo que buscabas?</h1>
        <?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>

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
            if(have_posts()){
            while(have_posts()){
                the_post();
                ?>
                <a href="<?php echo the_permalink(); ?>">
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="productos anjotintas">
                    <hr class="border-danger border-2">
                    <div>
                        <h1><?php the_title(); ?></h1>
                        <?php 
                            $categories = get_the_category();
                            if(!empty($categories)){
                                foreach ( $categories as $category ) {
                                    ?>
                                        <span><?php echo $category->name; ?></span>
                                    <?php
                                }
                            }else{
                                
                                //MOSTRANDO LA MARCA A LA QUE PERTENECE EL PRODUCTO
                                if (get_post_type() == 'anjo') {
                                    echo '<span>Anjo</span>';
                                } else if(get_post_type() == 'atlas'){
                                    echo '<span>Atlas</span>';
                                }

                                //CATEGORIAS PADRE AJGO
                                $terms=get_the_terms( get_the_ID(), 'categorias_padre' );

                                if(!empty($terms))
                                foreach ( $terms as $term ) {
                                    ?>
                                        <span style="text-transform:capitalize;"><?php echo $term->name; ?></span>
                                    <?php
                                }

                                //CATEGORIAS HIJO ANJO
                                $terms=get_the_terms( get_the_ID(), 'hijo_anjo' );


                                // $catHijo = get_term(17,'hijo_anjo');//get_the_terms(get_the_ID(), 'hijo_anjo')[0]->term_id);
                                // $opcionSeleccionada = get_field('slug_de_la_categoria_hija', $catHijo);
                                // echo "<span>" . $opcionSeleccionada . "</span>";

                                if(!empty($terms))
                                foreach ( $terms as $term ) {
                                    ?>
                                        <span style="text-transform:capitalize;"><?php echo $term->name; ?></span>
                                    <?php
                                }

                                //CATEGORIAS PADRE
                                $terms=get_the_terms( get_the_ID(), 'categorias_padre_atlas' );

                                if(!empty($terms))
                                foreach ( $terms as $term ) {
                                    ?>
                                        <span style="text-transform:capitalize;"><?php echo $term->name; ?></span>
                                    <?php
                                }


                                //CATEGORIAS HIJO ATLAS
                                $terms=get_the_terms( get_the_ID(), 'hijo_atlas' );

                                if(!empty($terms))
                                foreach ( $terms as $term ) {
                                    ?>
                                        <span style="text-transform:capitalize;"><?php echo $term->name; ?></span>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                </a>
                <?php
            }
            }else{
                echo "<h4>No se encontraron resultados</h4>";
                echo "<h2>¡Gracias por tu interes!</h2>";
            }
            wp_reset_postdata();
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