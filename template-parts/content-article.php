<?php 
$_SESSION["titulo"];
$_SESSION["descripcion"];
$_SESSION["logo"];
$_SESSION["marca"];
$_SESSION["idMarca"];
$_SESSION["idCategorias"];
    echo $_SESSION["titulo"];
    echo $_SESSION["descripcion"];
    echo $_SESSION["logo"];
    echo $_SESSION["marca"];
    echo $_SESSION["idMarca"];
    echo $_SESSION["idCategorias"];
?>
<div class="container">
            <div class="row">
                <section class="col-lg-8 col-12">
                    <div>
                        <img src="<?php the_post_thumbnail_url(); ?>" alt="producto agrotintas">
                    </div>
                    <hr>
                    <div class="container-descripcion">
                        <h1 class="titulo-detalle">Descripción</h1>
                        <h2 class="nombre-detalle"><b>Nombre: </b><span><?php the_title(); ?></span></h2>
                        <h2 class="marca"><b>Marca:</b><?php echo $_SESSION["marca"] ?></h2>
                        <?php
                            the_content();
                        ?>
                    </div>
                    <hr>
                    <h1 class="titulo-detalle">Productos Relacionados</h1>
                    <div>
                        <!-- Slider main container -->
                        <div class="swiper2">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                <?php
                                $categoriasEliminadas=$_SESSION["categoriasEliminadas"];
                                $marca=$_SESSION["marca"];
                                // Argumentos
                                    $args = array(
                                        'category_name'=>"producto,$marca",
                                        'cat'=>"$categoriasEliminadas",
                                        'posts_per_archive_page'=>8
                                    );
                                    // Custom query.
                                    $query = new WP_Query($args);//"category_name=producto,'$marca'");
                                    // Check that we have query results.
                                    if ( $query->have_posts() ) {
                                        // Start looping over the query results.
                                        while ( $query->have_posts() ) {
                                            $query->the_post();
                                            ?>
                                                <a href="<?php the_permalink(); ?>" class="swiper-slide">
                                                    <img src="<?php the_post_thumbnail_url(); ?>" alt="productos relacionados agrotintas">
                                                </a>
                                            <?php
                                        }
                                    }
                                    
                                    // Restore original post data.
                                    wp_reset_postdata();
                                    ?>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="col-lg-4 col-12">
                    <div>
                        <h1><?php the_title(); ?></h1>
                        <h2 class="marca"><b>Marca:</b> <span><?php echo $_SESSION["marca"] ?></span></h2>
                        <p>¿Te interesa este producto?</p>
                        <p>Inicia sesión en nuestro sistema para comprarlo</p>
                        <!-- BOTON PARA INGRESAR -->
                        <a type="button" class="" data-bs-toggle="modal" data-bs-target="#exampleModal">INICIAR SESIÓN</a>
                    </div>
                    <div>
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
                                <p>Carrera 3, entre calle 4 y 6, Modulo I, Local Parcela 55 Nro 5/A, Barquisimeto 3001, Lara</p>
                                <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15712.662073637732!2d-69.3750346!3d10.0855205!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe01433933faeb68a!2sTINTAS%20AUTOMOTRICES%20VZLA%2C%20C.A!5e0!3m2!1ses-419!2sve!4v1667660229749!5m2!1ses-419!2sve"
                                width="200" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </li>
                        </ul>
                    </div>
                </section>
            </div>
        </div>