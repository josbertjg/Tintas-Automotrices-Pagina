<?php
foreach(get_the_category() as $categoria){
    $marca=$categoria->name;
}
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
                <h2 class="marca"><b>Marca: </b><?php echo $marca ?></h2>
                <ul class="nav nav-tabs flex-xl-row flex-column" id="myTab" role="tablist">
                <?php
                if( !empty( get_field('indicaciones') ) ){ ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="indicaciones-tab" data-bs-toggle="tab" data-bs-target="#indicaciones-tab-pane" type="button" role="tab" aria-controls="indicaciones-tab-pane" aria-selected="true">
                        <i class="bi bi-journal-text"></i>
                        <span>INDICACIONES</span>
                        </button>
                    </li>
                <?php }
                if( !empty( get_field('preparacion') ) ){
                ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="preparacion-tab" data-bs-toggle="tab" data-bs-target="#preparacion-tab-pane" type="button" role="tab" aria-controls="preparacion-tab-pane" aria-selected="false">
                        <i class="bi bi-paint-bucket"></i>
                        <span>PREPARACIÓN</span>
                        </button>
                    </li>
                <?php } 
                if( !empty( get_field('observaciones') ) ){
                ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="observaciones-tab" data-bs-toggle="tab" data-bs-target="#observaciones-tab-pane" type="button" role="tab" aria-controls="observaciones-tab-pane" aria-selected="false">
                        <i class="bi bi-chat-square-dots"></i>
                        <span>OBSERVACIONES</span>
                    </button>
                    </li>
                <?php } 
                if( !empty( get_field('contenido_datos_tecnicos') ) || !empty( get_field('archivo_fispq') ) || !empty( get_field('archivo_boletin_tecnico') ) ){
                ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link datosTecnicos" id="datos-tab" data-bs-toggle="tab" data-bs-target="#datos-tab-pane" type="button" role="tab" aria-controls="datos-tab-pane" aria-selected="false">
                        <i class="bi bi-exclamation-circle"></i>
                        <span>DATOS TÉCNICOS Y BOLETÍN TÉCNICO <b>DE LA FISpQ</b></span>
                    </button>
                    </li>
                <?php } 
                if( !empty( get_field('archivo_catalogo_de_colores') ) ){
                ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="colores-tab" data-bs-toggle="tab" data-bs-target="#colores-tab-pane" type="button" role="tab" aria-controls="colores-tab-pane" aria-selected="false">
                            <i class="bi bi-palette"></i>
                            <span>CATÁLOGO DE COLORES</span>
                        </button>
                    </li>
                <?php } ?>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="indicaciones-tab-pane" role="tabpanel" aria-labelledby="indicaciones-tab" tabindex="0">
                        <?php echo get_field('indicaciones') ?>
                    </div>
                    <div class="tab-pane fade" id="preparacion-tab-pane" role="tabpanel" aria-labelledby="preparacion-tab" tabindex="0">
                        <?php echo get_field('preparacion') ?>
                    </div>
                    <div class="tab-pane fade" id="observaciones-tab-pane" role="tabpanel" aria-labelledby="observaciones-tab" tabindex="0">
                        <?php echo get_field('observaciones') ?>
                    </div>
                    <div class="tab-pane fade" id="datos-tab-pane" role="tabpanel" aria-labelledby="datos-tab" tabindex="0">
                        <?php if( !empty(get_field('archivo_fispq')) || !empty(get_field('archivo_boletin_tecnico'))){ ?>
                            <div class="container-descargas">
                                <span>Descargas</span>
                                <div>
                                    <?php if(!empty(get_field('archivo_fispq'))){ ?>
                                        <a href="<?php echo get_field('archivo_fispq') ?>" download="Ficha FISPQ">Descargar FISPQ</a>
                                    <?php } ?>
                                    <?php if(!empty(get_field('archivo_boletin_tecnico'))){ ?>
                                        <a href="<?php echo get_field('archivo_boletin_tecnico') ?>" download="Boletín Técnico">Descargar Boletín Técnico</a>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php 
                            } 
                            if(!empty(get_field('contenido_datos_tecnicos'))){
                                echo get_field('contenido_datos_tecnicos');
                            }
                        ?>
                    </div>
                    <div class="tab-pane fade" id="colores-tab-pane" role="tabpanel" aria-labelledby="colores-tab" tabindex="0">
                    <?php if( !empty(get_field('archivo_catalogo_de_colores'))){ ?>
                            <div class="container-descargas">
                                <span>Descargas</span>
                                <div>
                                    <?php if(!empty(get_field('archivo_catalogo_de_colores'))){ ?>
                                        <a href="<?php echo get_field('archivo_catalogo_de_colores') ?>" download="Catálogo de Colores">Descargar Catálogo de Colores</a>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <hr>
            <h1 class="titulo-detalle">Más Productos</h1>
            <div>
                <!-- Slider main container -->
                <div class="swiper">
                    <!-- Additional required wrapper -->
                    <div id="slide-wrapper" class="swiper-wrapper">
                        <!-- Slides -->
                        <?php
                        $categoriasEliminadas=$_SESSION["categoriasEliminadas"];
                        // Argumentos
                            $args = array(
                                'category_name'=>"$marca",
                            );
                            // Custom query.
                            $query = new WP_Query($args);
                            // Check that we have query results.
                            if ( $query->have_posts() ) {
                                // Start looping over the query results.
                                while ( $query->have_posts() ) {
                                    $query->the_post();
                                    ?>
                                        <a href="<?php the_permalink(); ?>" class="swiper-slide">
                                            <img src="<?php the_post_thumbnail_url(); ?>" alt="productos anjotintas">
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
                <h2 class="marca"><b>Marca:</b> <span><?php echo $marca ?></span></h2>
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