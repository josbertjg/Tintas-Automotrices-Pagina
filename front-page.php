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
      <div id="container-marcas" class="row d-flex justify-content-around container-fluid align-items-center container">
        <?php

          //CICLO PARA GUARDAR LAS MARCAS EN UN ARREGLO
          $args=array(
            'category_name'=>"marca",
            'posts_per_archive_page'=>999999
          );
          $q= new WP_Query($args);
          if($q->have_posts()){
            $categorias=array();
            while($q->have_posts()){
              $q->the_post();
              foreach(get_the_category() as $categoria){
                if(!in_array($categoria->term_id, $categorias))
                  array_push($categorias,$categoria->term_id);
              }
            }
            wp_reset_postdata();
          }

          //CICLO PARA MOSTRAR LAS MARCAS
          $args=array(
            'category_name'=>"marca",
            'posts_per_archive_page'=>999999
          );
          query_posts($args);
          if(have_posts()){
            while(have_posts()){
              the_post();
              foreach(get_the_category() as $categoria){
                if($categoria->name!="marca"){
                  $nombreMarca=$categoria->name;
                  $idMarca=$categoria->term_id;
                }
              }
              ?>
                <article class="col-6 d-flex justify-content-center flex-column align-items-center">
                  <form action="<?php echo get_permalink(get_option('page_for_posts')); ?>" method="POST" name="form-marcas">
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="logo-marca">
                    <h1><?php the_title(); ?></h1>
                    <input type="submit" class="verProductos" name="btn-marcas" id="" value="Ver Productos">
                    <input type="text" name="titulo" hidden value="<?php the_title(); ?>">
                    <input type="text" name="logo" hidden value="<?php the_post_thumbnail_url(); ?>">
                    <input type="text" name="descripcion" hidden value="<?php the_content(); ?>">
                    <input type="text" name="marca" hidden value="<?php echo $nombreMarca ?>">
                    <input type="text" name="idMarca" hidden value="<?php echo $idMarca ?>">
                    <input type="text" name="idCategorias" hidden value="<?php echo implode(",",$categorias) ?>">
                  </form>
                </article>
              <?php
            }
          }else{
            echo "<h2>¡Gracias por tu interes!</h2>";
            echo "<h4>Aún estamos trabajando en nuestras marcas</h4>";
          }
          wp_reset_postdata();
        ?>
      </div>
    </section>
    <!-- DISTRIBUIDORES -->
    <section id="distribuidores">
      <h1>Nuestros Distribuidores</h1>
      <div>
        <!-- SLIDER CON SWIPERJS -->
        <div class="swiper">
          <!-- Additional required wrapper -->
          <div class="swiper-wrapper">
            <?php
            //CICLO PARA MOSTRAR LOS DISTRIBUIDORES
              $args=array(
                'category_name'=>"distribuidor",
                'posts_per_archive_page'=>9
              );
              query_posts($args);
              if(have_posts()){
                while(have_posts()){
                  the_post();
                  ?>
                    <!-- Slides -->
                    <img class="swiper-slide" src="<?php the_post_thumbnail_url(); ?>" alt="distribuidor agrotintas">
                  <?php
                }
              }else{
                echo "<h2>Aún no contamos con distribuidores</h2>";
              }
              wp_reset_postdata();
            ?>
          </div>
        </div>
      </div>
      <!-- BOTON DEL MODAL DE DISTRIBUIDORES -->
      <a type="button" data-bs-toggle="modal" data-bs-target="#modalDistribuidores">Ver distribuidor en mi zona</a>

      <!-- MODAL DE DISTRIBUIDORES -->
      <div class="modal fade" id="modalDistribuidores" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-body modal-body-distribuidores">
              <section class="d-xl-block d-none">
                <?php
                  dynamic_sidebar('Imagen Ventana de Distribuidores');
                ?>
              </section>
              <section>
                <a type="button" class="btn-cerrar" data-bs-dismiss="modal" aria-label="Close">
                  <i class="bi bi-box-arrow-right"></i>
                </a>
                <h1>Selecciona un Estado</h1>
                 <select name="" id="estados" class="form-control">
                  <option class="opc-estado" value="none" selected hidden>Escoge un Estado</option>
                  <option class="opc-estado" value="amazonas">Amazonas</option>
                  <option class="opc-estado" value="anzoatequi">Anzoátegui</option>
                  <option class="opc-estado" value="apure">Apure</option>
                  <option class="opc-estado" value="aragua">Aragua</option>
                  <option class="opc-estado" value="Barinas">Barinas</option>
                  <option class="opc-estado" value="bolivar">Bolívar</option>
                  <option class="opc-estado" value="carabobo">Carabobo</option>
                  <option class="opc-estado" value="cojedes">Cojedes</option>
                  <option class="opc-estado" value="delta_amacuro">Delta Amacuro</option>
                  <option class="opc-estado" value="distrito_capital">Distrito Capital</option>
                  <option class="opc-estado" value="falcon">Falcón</option>
                  <option class="opc-estado" value="guarico">Guárico</option>
                  <option class="opc-estado" value="lara">Lara</option>
                  <option class="opc-estado" value="merida">Mérida</option>
                  <option class="opc-estado" value="miranda">Miranda</option>
                  <option class="opc-estado" value="monagas">Monagas</option>
                  <option class="opc-estado" value="nueva_esparta">Nueva Esparta</option>
                  <option class="opc-estado" value="portuguesa">Portuguesa</option>
                  <option class="opc-estado" value="sucre">Sucre</option>
                  <option class="opc-estado" value="trujillo">Trujillo</option>
                  <option class="opc-estado" value="vargas">Vargas</option>
                  <option class="opc-estado" value="yaracuy">Yaracuy</option>
                  <option class="opc-estado" value="zulia">Zulia</option>
                </select>
                <img id="loading" class="" src="<?php echo get_template_directory_uri()."/assets/img/loading.gif" ?>" alt="loading agrotintas">
                <section id="container-distribuidores-estados" class="d-flex justify-content-center align-items-center pt-1">
                  <h2 class="text-center text-danger">¡Selecciona un estado y mira nuestros distribuidores!</h2>
                </section>
              </section>
            </div>
          </div>
        </div>
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
            dynamic_sidebar('Mision');
          ?>
        </article>
        <article class="col-md-4 col-12">
          <?php
            dynamic_sidebar('Vision');
          ?>
        </article>
        <article class="col-md-4 col-12">
          <?php
            dynamic_sidebar('Valores');
          ?>
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