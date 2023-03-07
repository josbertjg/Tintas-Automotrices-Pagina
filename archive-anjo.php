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
            $value=get_field('slug_hijo_anjo', get_term($id,'hijo_anjo'));
            if(!in_array($value, $slugs))
                array_push($slugs, $value);
        }
    }
    $postType=get_post_type();
?>
<?php
if($_GET["catPadre"]!="automotriz" || $_GET["catIntermedia"]!=""){
?>
<input type="hidden" id="catPadre" value="<?php echo $_GET['catPadre']; ?>">
<input type="hidden" id="catIntermedia" value="<?php echo $_GET['catIntermedia']; ?>">
<input type="hidden" id="idIntermedias" value="<?php echo $_GET['idIntermedias']; ?>">
<input type="hidden" id="postType" value="<?php echo $postType ?>">
<header id="header-marca">
    <section>
        <?php
            dynamic_sidebar('Logo Marca Anjo');
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
                            $term=get_term($id,'hijo_anjo');
                            if($slug==get_field('slug_hijo_anjo', $term)){
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
                        $terms=get_the_terms( get_the_ID(), 'hijo_anjo' );
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
<?php } else{?>
<main id="container-vehiculos">
    <div class="row container">

        <?php
            // CICLO PARA MOSTRAR LAS CATEGORIAS PADRE DE ANJO
            $args=array(
                'post_type'=>"intermedias_anjo",
                'posts_per_archive_page'=>999999
            );
            $q= new WP_Query($args);
            if($q->have_posts()){
                $indice=0;
                while($q->have_posts()){
                    $q->the_post();
                    $indice++;

                    //CAT INTERMEDIA
                    $id=get_the_ID();
                    $termsIntermedia=get_the_terms( $id, 'cat_intermedia_anjo' );
                    if(!empty($termsIntermedia))
                        foreach ( $termsIntermedia as $term ) {
                            $intermedia = $term->name;
                            $idIntermedias.= $term->term_taxonomy_id.',';
                        }

                    //CAT HIJOS
                    $termsHijos=get_the_terms( get_the_ID(), 'hijo_anjo' );
                    $idHijos="";
                    if(!empty($termsHijos))
                        foreach ( $termsHijos as $term ) {
                            $idHijos.= $term->term_taxonomy_id.',';
                        }
                    if($indice==1){
                        if($intermedia == "tradicional"){
                            ?>
                                <article class="col-lg-6 col-12" style="background: linear-gradient(to top,#ca1d37,rgb(223, 32, 61));">
                                    <form action="<?php echo get_post_type_archive_link('anjo'); ?>" method="GET">
                                        <button>
                                            <img src="<?php echo get_template_directory_uri()."/assets/img/tradicional.png" ?>" alt="sistema tradicional anjotintas">
                                            <h1><b><?php echo the_title();?></b></h1>
                                            <input type="hidden" name="catPadre" value="automotriz">
                                            <input type="hidden" name="catIntermedia" value="<?php echo $intermedia ?>">
                                            <input type="hidden" name="idIntermedias" value="<?php echo $idIntermedias ?>">
                                            <input type="hidden" name="idHijos" value="<?php echo $idHijos ?>">
                                        </button>
                                    </form>
                                </article>
                                <article class="col-6 d-none d-lg-flex">
                                    <img src="<?php echo get_template_directory_uri()."/assets/img/auto_tradicional.png" ?>" alt="">
                                </article>
                            <?php
                        }else if($intermedia == "alto desempeño"){
                            ?>
                                <article class="col-lg-6 col-12" style="background: linear-gradient(to top,#f1910a,#ffa629);">
                                    <form action="<?php echo get_post_type_archive_link('anjo'); ?>" method="GET">
                                        <button>
                                            <img src="<?php echo get_template_directory_uri()."/assets/img/alto_desempeño.png" ?>" alt="sistema de alto desempeño anjotintas">
                                            <h1><b><?php echo the_title();?></b></h1>
                                            <input type="hidden" name="catPadre" value="automotriz">
                                            <input type="hidden" name="catIntermedia" value="<?php echo $intermedia ?>">
                                            <input type="hidden" name="idIntermedias" value="<?php echo $idIntermedias ?>">
                                            <input type="hidden" name="idHijos" value="<?php echo $idHijos ?>">
                                        </button>
                                    </form>
                                </article>
                                <article class="col-6 d-none d-lg-flex">
                                    <img src="<?php echo get_template_directory_uri()."/assets/img/auto_alto_desempeño.png" ?>" alt="">
                                </article>
                            <?php
                        }
                    }else{
                        if($intermedia == "tradicional"){
                            ?>
                                <article class="col-6 d-none d-lg-flex">
                                    <img src="<?php echo get_template_directory_uri()."/assets/img/auto_tradicional.png" ?>" alt="">
                                </article>
                                <article class="col-lg-6 col-12" style="background: linear-gradient(to top,#ca1d37,rgb(223, 32, 61));">
                                    <form action="<?php echo get_post_type_archive_link('anjo'); ?>" method="GET">
                                        <button>
                                            <img src="<?php echo get_template_directory_uri()."/assets/img/tradicional.png" ?>" alt="sistema tradicional anjotintas">
                                            <h1><b><?php echo the_title();?></b></h1>
                                            <input type="hidden" name="catPadre" value="automotriz">
                                            <input type="hidden" name="catIntermedia" value="<?php echo $intermedia ?>">
                                            <input type="hidden" name="idIntermedias" value="<?php echo $idIntermedias ?>">
                                            <input type="hidden" name="idHijos" value="<?php echo $idHijos ?>">
                                        </button>
                                    </form>
                                </article>
                            <?php
                        }else if($intermedia == "alto desempeño"){
                            ?>
                                <article class="col-6 d-none d-lg-flex">
                                    <img src="<?php echo get_template_directory_uri()."/assets/img/auto_alto_desempeño.png" ?>" alt="">
                                </article>
                                <article class="col-lg-6 col-12" style="background: linear-gradient(to top,#f1910a,#ffa629);">
                                    <form action="<?php echo get_post_type_archive_link('anjo'); ?>" method="GET">
                                        <button>
                                            <img src="<?php echo get_template_directory_uri()."/assets/img/alto_desempeño.png" ?>" alt="sistema de alto desempeño anjotintas">
                                            <h1><b><?php echo the_title();?></b></h1>
                                            <input type="hidden" name="catPadre" value="automotriz">
                                            <input type="hidden" name="catIntermedia" value="<?php echo $intermedia ?>">
                                            <input type="hidden" name="idIntermedias" value="<?php echo $idIntermedias ?>">
                                            <input type="hidden" name="idHijos" value="<?php echo $idHijos ?>">
                                        </button>
                                    </form>
                                </article>
                            <?php
                        }
                    }
                }
            }
        ?>
    </div>
</main>
<?php } ?>
<?php 
    get_footer();
?>