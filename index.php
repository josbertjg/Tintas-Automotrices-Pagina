<?php 
    get_header();
?>
<!-- COMUNICANDO LAS VARIABLES RECIBIDOS CON PHP HACIA JAVASCRIPT -->
<input type="hidden" id="idMarca" value="<?php echo $_POST["idMarca"]; ?>">
<input type="hidden" id="nombreMarca" value="<?php echo get_cat_name($_POST["idMarca"]) ?>">
<input type="hidden" id="categoriaPadre" value="<?php echo $_POST["categoriaPadre"]; ?>">
<input type="hidden" id="subCatAuto" value="<?php echo $_POST["subCatAuto"]; ?>">
<?php
if($_POST["categoriaPadre"]!="automotriz" || $_POST["subCatAuto"]!=""){
?>
<header id="header-marca">
    <section>
        <?php if(get_cat_name($_POST["idMarca"])=='atlas')
                dynamic_sidebar('Logo Marca Atlas');
            else
                if(get_cat_name($_POST["idMarca"])=='anjo')
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
        <img id="loading-productos" src="<?php echo get_template_directory_uri()."/assets/img/loading.gif" ?>" alt="logo tintasautomotrices venezuela">
        </section>
        <section id="paginacion">
            <i class="bi bi-plus"></i>
        </section>
    </section>
</main>
<?php } else{?>
<main id="container-vehiculos">
    <div class="row container">
        <article class="col-lg-6 col-12">
            <form action="<?php echo get_permalink(get_option('page_for_posts')); ?>" method="POST">
                <button>
                    <img src="<?php echo get_template_directory_uri()."/assets/img/tradicional.png" ?>" alt="sistema tradicional anjotintas">
                    <h1>Sistema <b>Tradicional</b></h1>
                    <input type="hidden" name="idMarca" value="<?php echo $_POST["idMarca"]; ?>">
                    <input type="hidden" name="categoriaPadre" value="automotriz">
                    <input type="hidden" name="subCatAuto" value="tradicional">
                </button>
            </form>
        </article>
        <article class="col-6 d-none d-lg-flex">
            <img src="<?php echo get_template_directory_uri()."/assets/img/auto_tradicional.png" ?>" alt="">
        </article>
        <article class="col-6 d-none d-lg-flex">
            <img src="<?php echo get_template_directory_uri()."/assets/img/auto_alto_desempeño.png" ?>" alt="">
        </article>
        <article class="col-lg-6 col-12">
            <form action="<?php echo get_permalink(get_option('page_for_posts')); ?>" method="POST">
                <button>
                    <img src="<?php echo get_template_directory_uri()."/assets/img/alto_desempeño.png" ?>" alt="sistema alto desempeño anjotintas">
                    <h1>Sistema <b>Alto Desempeño</b></h1>
                    <input type="hidden" name="idMarca" value="<?php echo $_POST["idMarca"]; ?>">
                    <input type="hidden" name="categoriaPadre" value="automotriz">
                    <input type="hidden" name="subCatAuto" value="alto_desempeño">
                </button>
            </form>
        </article>
    </div>
</main>
<?php } ?>
<?php 
    get_footer();
?>