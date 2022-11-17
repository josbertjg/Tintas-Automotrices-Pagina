<?php 
    session_start();
    get_header();
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
<main id="main-detalle" class="container-fluid">

    <?php
        if(have_posts()){

            while(have_posts()){

                the_post();

                get_template_part('template-parts/content','article');
                
            }
        }
    ?>

</main>

<?php 
    get_footer();
?>