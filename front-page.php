  <?php
    get_header();
    /*
    NOTAS:
    -CORREGIR EL MENU PARA QUE EL EFECTO NO TIEMBLE AL LLEGAR A UN PUNTO DE LA PANTALLA
    -ELIMINAR TODOS LOS COMENTARIOS NO UTILES
    */
  ?>
  <!-- BANNER -->
  <header>
    <?php
      global $wpdb;
      $sliders = $wpdb->get_results("SELECT MIN(id) FROM ".$wpdb->prefix."nextend2_smartslider3_sliders");

      $propiedad="MIN(id)";
      $id= $sliders[0]->$propiedad;
      echo do_shortcode('[smartslider3 slider="'.$id.'"]');
    ?>
    <!-- <img src="./img/banner.png" alt="banner"> -->
  </header>
  <!-- CONTENIDO -->
  <main>
    <!-- MARCAS -->
    <section id="marcas" class="container-fluid p-0">
      <!-- <section class="">
        <img src="./img/pintura-derramada.png" alt="pintura-derramada" class="">
      </section> -->
      <h1>Nuestras Marcas</h1>
      <!-- <div id="container-marcas" class="row d-flex justify-content-around container-fluid align-items-center container"> -->
        <?php

          //CICLO PARA GUARDAR LAS MARCAS EN UN ARREGLO
          // $args=array(
          //   'category_name'=>"marca",
          //   'posts_per_archive_page'=>999999
          // );
          // $q= new WP_Query($args);
          // if($q->have_posts()){
          //   $categorias=array();
          //   while($q->have_posts()){
          //     $q->the_post();
          //     foreach(get_the_category() as $categoria){
          //       if(!in_array($categoria->term_id, $categorias))
          //         array_push($categorias,$categoria->term_id);
          //     }
          //   }
          //   wp_reset_postdata();
          // }

          // //CICLO PARA MOSTRAR LAS MARCAS
          // $args=array(
          //   'category_name'=>"marca",
          //   'posts_per_archive_page'=>999999
          // );
          // query_posts($args);
          // if(have_posts()){
          //   while(have_posts()){
          //     the_post();
          //     foreach(get_the_category() as $categoria){
          //       if($categoria->name!="marca"){
          //         $nombreMarca=$categoria->name;
          //         $idMarca=$categoria->term_id;
          //       }
          //     }
              ?>
                <!-- <article class="col-6 d-flex justify-content-center flex-column align-items-center"> -->
                  <!-- <form action="<?php echo get_permalink(get_option('page_for_posts')); ?>" method="POST" name="form-marcas"> -->
                    <!-- <img src="<?php the_post_thumbnail_url(); ?>" alt="logo-marca"> -->
                    <!-- <h1><?php the_title(); ?></h1> -->
                    <!-- <button name="btn-marcas" class="verProductos">hola</button> -->
                    <!-- <input type="submit" class="verProductos" name="btn-marcas" id="" value="Ver Productos"> -->
                    <!-- <input type="text" name="titulo" hidden value="<?php the_title(); ?>"> -->
                    <!-- <input type="text" name="logo" hidden value="<?php the_post_thumbnail_url(); ?>"> -->
                    <!-- <input type="text" name="descripcion" hidden value="<?php the_content(); ?>"> -->
                    <!-- <input type="text" name="marca" hidden value="<?php echo $nombreMarca ?>"> -->
                    <!-- <input type="text" name="idMarca" hidden value="<?php echo $idMarca ?>"> -->
                    <!-- <input type="text" name="idCategorias" hidden value="<?php echo implode(",",$categorias) ?>"> -->
                  <!-- </form> -->
                <!-- </article> -->
              <?php
          //   }
          // }else{
          //   echo "<h2>¡Gracias por tu interes!</h2>";
          //   echo "<h4>Aún estamos trabajando en nuestras marcas</h4>";
          // }
          // wp_reset_postdata();
        ?>
      <!-- </div>
    </section> -->
    <?php
      $idAnjo=get_cat_ID ( 'anjo' );
      $idAtlas=get_cat_ID ( 'atlas' );
    ?>
    <div id="container-marcas" class="row d-flex justify-content-around container-fluid align-items-center container">
        <article class="marca-anjo col-6 d-flex justify-content-center flex-column align-items-center">
          <?php
            dynamic_sidebar('Imagen Marca Anjo');
          ?>
          <div class="container-categorias container-fluid d-flex justify-content-around align-items-center px-2 py-3 flex-wrap">
            <form action="<?php echo get_permalink(get_option('page_for_posts')); ?>" method="POST">
              <button>
                <i class="bi bi-car-front"></i>
                <span>Línea</span>
                <h1>Automotriz</h1>
                <input type="hidden" name="idMarca" value="<?php echo $idAnjo ?>">
                <input type="hidden" name="categoriaPadre" value="automotriz">
              </button>
            </form>
            <form action="<?php echo get_permalink(get_option('page_for_posts')); ?>" method="POST">
              <button>
                <i class="bi bi-house-door"></i>
                <span>Línea</span>
                <h1>Inmobiliaria</h1>
                <input type="hidden" name="idMarca" value="<?php echo $idAnjo ?>">
                <input type="hidden" name="categoriaPadre" value="inmobiliaria">
              </button>
            </form>
            <form action="<?php echo get_permalink(get_option('page_for_posts')); ?>" method="POST">
              <button>
                <i class="bi bi-paint-bucket"></i>
                <span>Línea</span>
                <h1>AnjoPrint</h1>
                <input type="hidden" name="idMarca" value="<?php echo $idAnjo ?>">
                <input type="hidden" name="categoriaPadre" value="anjoprint">
              </button>
            </form>
            <form action="<?php echo get_permalink(get_option('page_for_posts')); ?>" method="POST">
              <button>
                <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi bi-buildings" viewBox="0 0 16 16">
                  <path d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022ZM6 8.694 1 10.36V15h5V8.694ZM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15Z"/>
                  <path d="M2 11h1v1H2v-1Zm2 0h1v1H4v-1Zm-2 2h1v1H2v-1Zm2 0h1v1H4v-1Zm4-4h1v1H8V9Zm2 0h1v1h-1V9Zm-2 2h1v1H8v-1Zm2 0h1v1h-1v-1Zm2-2h1v1h-1V9Zm0 2h1v1h-1v-1ZM8 7h1v1H8V7Zm2 0h1v1h-1V7Zm2 0h1v1h-1V7ZM8 5h1v1H8V5Zm2 0h1v1h-1V5Zm2 0h1v1h-1V5Zm0-2h1v1h-1V3Z"/>
                </svg>
                <span>Línea</span>
                <h1>AnjoTech</h1>
                <input type="hidden" name="idMarca" value="<?php echo $idAnjo ?>">
                <input type="hidden" name="categoriaPadre" value="anjotech">
              </button>
            </form>
            <form action="<?php echo get_permalink(get_option('page_for_posts')); ?>" method="POST">
              <button>
                <i class="bi bi-droplet-half"></i>
                <span>Línea</span>
                <h1>Solventes</h1>
                <input type="hidden" name="idMarca" value="<?php echo $idAnjo ?>">
                <input type="hidden" name="categoriaPadre" value="solventes">
              </button>
            </form>
          </div>    
        </article>
        <article class="marca-atlas col-6 d-flex justify-content-center flex-column align-items-center">
          <?php
            dynamic_sidebar('Imagen Marca Atlas');
          ?>
          <div class="container-categorias container-fluid d-flex justify-content-around align-items-center px-2 py-3 flex-wrap">
            <form action="<?php echo get_permalink(get_option('page_for_posts')); ?>" method="POST">
              <button>
                <img src="<?php echo get_template_directory_uri()."/assets/img/brocha.jpeg" ?>" alt="brochas">
                <h1>Brochas</h1>
                <input type="hidden" name="idMarca" value="<?php echo $idAtlas ?>">
                <input type="hidden" name="categoriaPadre" value="brochas">
              </button>
            </form>
            <form action="<?php echo get_permalink(get_option('page_for_posts')); ?>" method="POST">
              <button>
                <img src="<?php echo get_template_directory_uri()."/assets/img/rodillo.jpeg" ?>" alt="brochas">
                <h1>rodillos</h1>
                <input type="hidden" name="idMarca" value="<?php echo $idAtlas ?>">
                <input type="hidden" name="categoriaPadre" value="rodillos">
              </button>
            </form>
            <form action="<?php echo get_permalink(get_option('page_for_posts')); ?>" method="POST">
              <button>
                <img src="<?php echo get_template_directory_uri()."/assets/img/minirodillo.jpeg" ?>" alt="brochas">
                <h1>mini rodillos</h1>
                <input type="hidden" name="idMarca" value="<?php echo $idAtlas ?>">
                <input type="hidden" name="categoriaPadre" value="mini_rodillos">
              </button>
            </form>
            <form action="<?php echo get_permalink(get_option('page_for_posts')); ?>" method="POST">
              <button>
                <img src="<?php echo get_template_directory_uri()."/assets/img/espatulas.jpeg" ?>" alt="brochas">
                <h1>espatulas</h1>
                <input type="hidden" name="idMarca" value="<?php echo $idAtlas ?>">
                <input type="hidden" name="categoriaPadre" value="espatulas">
              </button>
            </form>
            <form action="<?php echo get_permalink(get_option('page_for_posts')); ?>" method="POST">
              <button>
                <img src="<?php echo get_template_directory_uri()."/assets/img/accesorios.jpeg" ?>" alt="brochas">
                <h1>accesorios generales</h1>
                <input type="hidden" name="idMarca" value="<?php echo $idAtlas ?>">
                <input type="hidden" name="categoriaPadre" value="accesorios">
              </button>
            </form>
            <form action="<?php echo get_permalink(get_option('page_for_posts')); ?>" method="POST">
              <button>
                <img src="<?php echo get_template_directory_uri()."/assets/img/mangos.jpeg" ?>" alt="brochas">
                <h1>mangos</h1>
                <input type="hidden" name="idMarca" value="<?php echo $idAtlas ?>">
                <input type="hidden" name="categoriaPadre" value="mangos">
              </button>
            </form>
            <form action="<?php echo get_permalink(get_option('page_for_posts')); ?>" method="POST">
              <button>
                <img src="<?php echo get_template_directory_uri()."/assets/img/cepillo-acero.jpeg" ?>" alt="brochas">
                <h1>cepillo de acero</h1>
                <input type="hidden" name="idMarca" value="<?php echo $idAtlas ?>">
                <input type="hidden" name="categoriaPadre" value="cepillo_acero">
              </button>
            </form>
            <form action="<?php echo get_permalink(get_option('page_for_posts')); ?>" method="POST">
              <button>
                <img src="<?php echo get_template_directory_uri()."/assets/img/rodillo-textura.jpeg" ?>" alt="brochas">
                <h1>rodillos textura</h1>
                <input type="hidden" name="idMarca" value="<?php echo $idAtlas ?>">
                <input type="hidden" name="categoriaPadre" value="rodillos_textura">
              </button>
            </form>
            <form action="<?php echo get_permalink(get_option('page_for_posts')); ?>" method="POST">
              <button>
                <img src="<?php echo get_template_directory_uri()."/assets/img/minirodillo-textura.jpeg" ?>" alt="brochas">
                <h1>Mini rodillos textura</h1>
                <input type="hidden" name="idMarca" value="<?php echo $idAtlas ?>">
                <input type="hidden" name="categoriaPadre" value="mini_rodillos_textura">
              </button>
            </form>
          </div>    
        </article>
      </div>
    </section>
    <!-- SOBRE NOSOTROS -->
    <section id="about" class="container-fluid">
      <?php
        dynamic_sidebar('Sobre Nosotros');
      ?>
      <div class="row container-fluid p-0 m-0">
        <article class="col-md-4 col-12">
          <?php
            dynamic_sidebar('Imagen Mision');
          ?>
          <div class="caption">
            <?php
              dynamic_sidebar('Mision');
            ?>
          </div>
        </article>
        <article class="col-md-4 col-12">
          <?php
            dynamic_sidebar('Imagen Vision');
          ?>
          <div class="caption">
            <?php
              dynamic_sidebar('Vision');
            ?>
          </div>
        </article>
        <article class="col-md-4 col-12">
          <?php
            dynamic_sidebar('Imagen Valores');
          ?>
          <div class="caption">
            <?php
              dynamic_sidebar('Valores');
            ?>
          </div>
        </article>
      </div>
    </section>
    <!-- CONTACTANOS -->
    <section id="contacto">
      <img id="loading-formulario" class="" src="<?php echo get_template_directory_uri()."/assets/img/loading.gif" ?>" alt="loading agrotintas">
      <form action="#" id="form-contacto">
        <?php
          dynamic_sidebar('Contacto');
        ?>
        <input required type="text" id="nombre-formulario" name="name" placeholder="Nombre:" class="form-control">
        <input required type="email" id="email-formulario"  name="email" placeholder="Email:" class="form-control">
        <textarea required name="message" id="mensaje-formulario" cols="30" rows="6" class="form-control"></textarea>
        <input id="btnSubmit" type="submit" value="Enviar Correo">
        <input type="hidden" name="action" value="formulario">
        <div id="social-media">
          <a href="https://www.instagram.com/tintasautomotricesvzla/" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top"
          data-bs-custom-class="custom-tooltip"
          data-bs-title="@tintasautomotricesvzla">
            <i class="bi bi-instagram"></i>
          </a>
          <a href="https://www.facebook.com/Tintasautomotricesvzla" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top"
          data-bs-custom-class="custom-tooltip"
          data-bs-title="Tintas Automotrices Vzla">
            <i class="bi bi-facebook"></i>
          </a>
          <a data-bs-toggle="tooltip" data-bs-placement="top"
          data-bs-custom-class="custom-tooltip"
          data-bs-title="0251-8145246">
            <i class="bi bi-telephone-fill"></i>
          </a>
          <a data-bs-toggle="tooltip" data-bs-placement="top"
          data-bs-custom-class="custom-tooltip"
          data-bs-title="tintasautomotrices.vzla@gmail.com">
            <i class="bi bi-envelope-fill"></i>
          </a>
        </div>
      </form>
      <div>
        <?php
          dynamic_sidebar('Imagen de Contacto');
        ?>
      </div>
    </section>
    <!-- UBICACION -->
    <!-- <section id="ubicacion" class="container">
      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15712.662073637732!2d-69.3750346!3d10.0855205!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe01433933faeb68a!2sTINTAS%20AUTOMOTRICES%20VZLA%2C%20C.A!5e0!3m2!1ses-419!2sve!4v1667660229749!5m2!1ses-419!2sve" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section> -->
  </main>
  <!-- PIE DE PAGINA -->
  <?php
    get_footer();
  ?>
</html>