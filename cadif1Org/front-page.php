<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri()."/assets/images/logo.ico" ?>">

  <?php 
    wp_head();
  ?>

</head>
<body>
    <?php get_header(); ?>
    <main>
      <section>
        <section id="header-section">
        <?php
          global $wpdb;
          $sliders = $wpdb->get_results("SELECT MIN(id) FROM ".$wpdb->prefix."nextend2_smartslider3_sliders");

          $propiedad="MIN(id)";
          $id= $sliders[0]->$propiedad;
          echo do_shortcode('[smartslider3 slider="'.$id.'"]');
        ?>

        <?php 
          query_posts("category_name=projet");
          if(have_posts()){
            while(have_posts()){
              the_post();
              $fecha=get_field('fecha_evento');
              $fecha_evento = explode('/',$fecha);
              
              if(intval($fecha_evento[2])>=intval(date('Y')))
                if(intval($fecha_evento[1])>=intval(date('m')))
                  if(intval($fecha_evento[0])>intval(date('d'))){ 
            ?>
            <div id="card-container">
                <span>¡ATENCIÓN!</span>
                <p>Jóvenes Emprendedores Tecnológicos</p>
                <p>Próximamente nuevo ciclo del</p>
                <p>PROGRAMA JOVEN EMPRENDEDOR TECNOLÓGICO <b>(ProJET)</b></p>
                <span>¿Quieres saber más?</span>
                <a class="ancla-boton" href="#contactanos-container">¡CONTÁCTANOS!</a>           
                <div id="card-circle"></div>
            </div>
          <?php
              }
            }
          }
        ?>
        </section>
      </section>
      <section id="projet-container">
        <div>
          <span><i>ProJET</i></span>
          <span>PROGRAMA JOVEN EMPRENDEDOR TECNOLÓGICO</span>
        </div>
        <div>
          <p>
            <?php
              dynamic_sidebar('projet');
            ?>
          </p>
          <a href="http://projet.cadif1.org/" target="_blank">Saber Más</a>
          <img src="<?php echo get_template_directory_uri()."/assets/images/secundario-naranja2-.png" ?>" alt="figura-pequeña-azul">
        </div>
      </section>
      <section id="nosotros-container" class="">
        <div class="row container">
          <div id="laFundacion" class="col-md-6 col-sm-12 order-1 order-md-1 nosotros-celda">
            <span>La Fundación CADIF1</span>
          </div>
          <div id="laFundacion-descripcion" class="col-md-6 col-sm-12 order-2 order-md-2 nosotros-celda">
            <p>
              <?php 
                dynamic_sidebar('laFundacion');
              ?>
            </p>
          </div>
          <div id="mision" class="col-md-6 col-sm-12 order-4 order-md-3 nosotros-celda">
            <span>Misión</span>
            <p>
              <?php 
                dynamic_sidebar('mision');
              ?>
            </p>
            <img src="<?php echo get_template_directory_uri()."/assets/images/mision.png" ?>" alt="mision">
          </div>
          <div id="vision" class="col-md-6 col-sm-12 order-3 order-md-4 nosotros-celda">
            <span>Visión</span>
            <p>
              <?php 
                dynamic_sidebar('vision');
              ?>
            </p>
            <img src="<?php echo get_template_directory_uri()."/assets/images/vision.png" ?>" alt="vision">
          </div>
        </div>
      </section>
      <section id="eventos-container">
        <span>EVENTOS</span>
          <div class="container-box">
            <div class="box box1">
  
              <i class="fa-regular fa-calendar-check icon"></i>
              <h4>Eventos</h4>
              <p>
                <?php 
                  dynamic_sidebar('eventos');
                ?>
              </p>
              <div class="circle-hover"></div>
  
            </div>
            
            <div class="box box2">
  
              <i class="fa-solid fa-angles-up icon"></i>
              <h4>Impulsos</h4>
              <p>
                <?php 
                  dynamic_sidebar('impulsos');
                ?>
              </p>
              <div class="circle-hover"></div>
  
            </div>
            <div class="box box3">
  
              <i class="fa-solid fa-hand-back-fist icon"></i>
              <h4>Entrenamiento</h4>
              <p>
                <?php 
                  dynamic_sidebar('entrenamiento');
                ?>
              </p>
              <div class="circle-hover"></div>

            </div>
          </div>
      </section>
      <section id="container-proximosEventos">
        <div class="card">
          <h5 class="card-header">¡PRÓXIMOS EVENTOS!</h5>
          <div class="card-body">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <?php
                  query_posts("category_name='evento'");
                    if(have_posts()){
                        $i=1;
                        while(have_posts()){
                            the_post();          
                            //VALIDANDO QUE LA FECHA INGRESADA EN EL CUSTOM FIELD SEA MAYOR QUE LA FECHA ACTUAL
                            $fecha=get_field('fecha_evento');
                            $fecha_evento = explode('/',$fecha);
                            
                            if(intval($fecha_evento[2])>=intval(date('Y')))
                              if(intval($fecha_evento[1])>=intval(date('m')))
                                if(intval($fecha_evento[0])>intval(date('d'))){                           
                          ?>
                             <div class="carousel-item <?php if($i==1) echo "active";  ?>">
                              <img src="<?php the_post_thumbnail_url(); ?>" class="d-block w-100" alt="...">
                              <div class="carousel-caption">
                                <h5><?php the_title(); ?></h5>
                                <p class="d-none d-sm-block"><?php echo "Fecha: "; the_field('fecha_evento'); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn btn-primary rounded">¡Saber Más!</a>
                              </div>
                            </div>
                        <?php 
                            $i++; 
                            }         
                        }
                      if($i==1){
                        echo "
                          <h1>¡Aún estamos trabajando en mas eventos!</h1>
                        ";
                      }
                    }
                ?>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
          <div id="circle-proximosEventos" class="circle"></div>
          <img id="linea-proximosEventos" src="<?php echo get_template_directory_uri()."/assets/images/linea-azul1.png" ?>" alt="figura de linea azul">
        </div>
      </section>
      <section id="container-dona">
        <span>¡DONATIVOS!</span>
        <div>
          <img id="background-img-dona" src="<?php echo get_template_directory_uri()."/assets/images/principal-azul.png" ?>" alt="figura principal azul">
          <div id="card-dona-container">
            <h4>¡Ayúdanos a seguir impulsando!</h4>
            <p>
              <?php 
                  dynamic_sidebar('donativos');
              ?>
            </p>
            <!-- Button trigger modal -->
            <a type="button" class="btn btn-primary border-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
              ¡Quiero Apoyar!
            </a>  
          </div>
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">¡MUCHAS GRACIAS POR COLABORAR!</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div>
                    <h4>Fundación CADI F1</h4>
                    <h5>Rif. <b>J-409049418</b></h5>
                    <h5>Banco <b>Mercantil</b></h5>
                    <h5>Número de Cuenta:</h5>
                    <h5><b>01050102481102186295</b></h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div>
            <img id="second-img-dona" src="<?php echo get_template_directory_uri()."/assets/images/secundario-naranja.png" ?>" alt="figura secundaria naranja">
            <div>
              <img src="<?php echo get_template_directory_uri()."/assets/images/dona.png" ?>" alt="dona">
            </div>
          </div>
          <img id="figura-narajna-dona" src="<?php echo get_template_directory_uri()."/assets/images/secundario-naranja3.png" ?>" alt="figura naranja 3">
        </div>
      </section>
      <section id="container-participa">
        <div>
          <span>Participa</span>
          <p>
            <?php 
              dynamic_sidebar('participa');
            ?>
          </p>
          <img src="<?php echo get_template_directory_uri()."/assets/images/principal-naranja.png" ?>" alt="figura principal naranja">
          <!-- -------------------------------------------------------------------- -->
          <form id="formulario-participa" action="<?php echo admin_url( 'admin-post.php' ) ?>">
            <?php
              // if ( isset($_GET['sent']) ){
              //   if ( $_GET['sent'] == '1'){
              //     echo "<div> ✔ Formulario enviado correctamente</div>";
              //   }
              //   else {
              //     echo "<div> Hubo un error al enviar</div>";
              //   }
              // }
            ?>
            <input type="text" class="form-control mb-2" placeholder="Ingresa Tu Nombre:" name="name" id="name">

            <input type="email" class="form-control mb-2" placeholder="Ingresa tu Email:" name="email" id="email">

            <textarea class="form-control" name="message" id="message" cols="30" rows="5" placeholder="¡Cuéntanos como quieres participar!"></textarea>

            <div><input type="checkbox" id="terms" name="terms" required> Acepto los Términos y Condiciones</div>

            <div class="d-flex justify-content-center mt-3">
              <input type="hidden" name="action" value="process_form">
              <input type="submit" name="submit" id="btnParticipar" value="¡PARTICIPAR!">
            </div>
          </form>
          <!-- -------------------------------------------------------------------- -->
          <img src="<?php echo get_template_directory_uri()."/assets/images/participa.png" ?>" alt="">
        </div>
      </section>
      <section id="contactanos-container" class="d-flex justify-content-center">

        <div>
          <iframe class="d-none d-lg-block" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.4056759964756!2d-69.35556088516674!3d10.065807374659444!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e8766edd5edc079%3A0xac84de4d8ad2a5c7!2sCadi%20F1%20Academia%20de%20Software!5e0!3m2!1ses!2sve!4v1650487289953!5m2!1ses!2sve" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          <iframe class="d-md-block d-lg-none d-sm-none d-none" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3928.405740193437!2d-69.3533722!3d10.0658021!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e8766edd5edc079%3A0xac84de4d8ad2a5c7!2sCadi%20F1%20Academia%20de%20Software!5e0!3m2!1ses!2sve!4v1650554092203!5m2!1ses!2sve" width="500" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          
          <iframe class="d-sm-block d-md-none" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3928.405740193437!2d-69.3533722!3d10.0658021!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e8766edd5edc079%3A0xac84de4d8ad2a5c7!2sCadi%20F1%20Academia%20de%20Software!5e0!3m2!1ses!2sve!4v1650554092203!5m2!1ses!2sve" width="320" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          <div id="circle-contactanos" class="circle"></div>
        </div>

      </section>
      <section id="noticias-container">
        <span>NOTICIAS</span>
        <div id="container-noti-cards" class="container-fluid row">
          <?php
            query_posts("category_name='noticia'");
            if(have_posts()){
              $i=1;
              while(have_posts()){
                the_post();
                if($i>3){
                  break;
                }else{
                  $i++;
                ?>
                  <article class="not-card col-lg-4 col-md-6">
                    <div class="not-card-body">
                      <img src="<?php the_post_thumbnail_url(); ?>" alt="">
                      <span><?php the_title(); ?></span>
                      <p><?php the_excerpt(); ?></p>
                      <a href="<?php the_permalink(); ?>" class="">Ver Noticia</a>
                    </div>
                  </article>
                <?php
                }
              }
            }
          ?>
        </div>
        <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="">Ver Noticias Anteriores</a>
      </section>
      <img id="loading" src="<?php echo get_template_directory_uri()."/assets/images/loading.gif" ?>" alt="">
    </main>
    
    <?php 
      get_footer();
    ?>