<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- GOOGLE FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&family=Roboto:wght@300;500;900&display=swap" rel="stylesheet">
  <!-- TITLE -->
  <title>Tintas Automotrices Vnzla</title>

  <?php
    wp_head();
  ?>

</head>
<body>
  <nav class="navbar navbar-expand-lg sticky-top menuEstilado">
    <div class="container-fluid d-flex flex-sm-row flex-column">
      <a class="navbar-brand" href="#" class="order-1">
      <?php

        if(function_exists('the_custom_logo')){
            //buscando y gaurdando la ruta del logo cargado en wordpress
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id,"full");
        }

        ?>
        <img src="<?php echo $logo[0] ?>" alt="tintasautomotrices logo">
      </a>
      <div class="d-flex pe-sm-4 contenedor-opciones align-items-center">
          <button class="navbar-toggler order-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                <img src="<?php echo $logo[0] ?>" alt="logo">
              </h5>
              <button type="button" id="cerrar-offcanvas" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
              <?php
                
                wp_nav_menu(
                  array(
                    'menu' => 'primary',
                    'container' => '',
                    'theme_location' => 'primary',
                    'items_wrap' => '<ul class="flex-lg-row flex-column">%3$s</ul>'
                  )
                );

              ?>
                <!-- <ul class="flex-lg-row flex-column">
                    <li><a href="#marcas" class="item-menu">Marcas</a></li>
                    <li><a href="#distribuidores" class="item-menu">Distribuidores</a></li>
                    <li><a href="#about" class="item-menu">Sobre Nosotros</a></li>
                    <li><a href="#contacto" class="item-menu">Contacto</a></li>
                </ul> -->
            </div>
          </div>
          <section id="ingresar" class="order-2">         
            <!-- BOTON PARA INGRESAR -->
            <a type="button" class="" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <i class="bi bi-person-circle"></i>
              <span>INGRESAR</span>
            </a>
          </section>
        </div>
      </div>
    </nav>
    <!-- MODAL PARA INGRESAR -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-body modal-body-ingresar">
            <section class="d-lg-block d-none">
              <?php
                dynamic_sidebar('Imagen Ventana de Ingreso');
              ?>
            </section>
            <section>
              <a type="button" class="btn-cerrar" data-bs-dismiss="modal" aria-label="Close">
                <i class="bi bi-box-arrow-right"></i>
              </a>
              <!-- TABS (INICIO DE SESION - REGISTRO) -->
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <!-- BOTON DE INICIO DE SESION -->
                  <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login-tab-pane" type="button" role="tab" aria-controls="login-tab-pane" aria-selected="true">Acceder</button>
                </li>
                <li class="nav-item" role="presentation">
                  <!-- BOTON DE REGISTRO -->
                  <button class="nav-link" id="registro-tab" data-bs-toggle="tab" data-bs-target="#registro-tab-pane" type="button" role="tab" aria-controls="registro-tab-pane" aria-selected="false">Registro</button>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <!-- CONTENIDO INICIO DE SESION -->
                <div class="tab-pane fade show active" id="login-tab-pane" role="tabpanel" aria-labelledby="login-tab" tabindex="0">
                  <form action="#" method="POST">
                    <input type="text" placeholder="Usuario:" class="form-control">
                    <input type="text" placeholder="Contraseña:" class="form-control">
                    <input type="submit" value="Acceder" class="btnAcceder">
                  </form>
                </div>
                <!-- CONTENIDO REGISTRO -->
                <div class="tab-pane fade" id="registro-tab-pane" role="tabpanel" aria-labelledby="registro-tab" tabindex="0">
                  <form action="#" method="POST">
                    <div>
                      <!-- DATOS PERSONALES -->
                      <h1>Datos Generales</h1>
                      <input type="text" placeholder="Razón Social:" class="form-control">
                      <input type="text" placeholder="RIF:" class="form-control">
                      <input type="text" placeholder="Domiciolio Fiscal:" class="form-control">
                      <input type="text" placeholder="Dirección Despacho:" class="form-control">
                      <input type="text" placeholder="Teléfonos:" class="form-control">
                      <input type="text" placeholder="Teléfono Móvil:" class="form-control">
                      <input type="text" placeholder="Correo Electrónico:" class="form-control">
                      <div>
                        <label for="">Agente de Retención</label>
                        <input type="radio" name="rbARI" id="">
                        Si
                        <input type="radio" name="rbARI" id="" checked>
                        No
                      </div>
                      <hr class="border-danger border-2">
                      <!-- RELACIONES -->
                      <h1>Relaciones</h1>
                      <input type="text" placeholder="Representante Legal:" class="form-control">
                      <input type="text" placeholder="Contacto Administración:" class="form-control">
                      <input type="text" placeholder="Contacto Compras:" class="form-control">
                      <hr class="border-danger border-2">
                      <!-- REFERENCIAS COMERCIALES -->
                      <h1>Referencias Comerciales</h1>
                      <div class="row">
                        <div class="col-6">
                          <input type="text" placeholder="Proveedor 1:" class="form-control">
                          <input type="text" placeholder="Proveedor 2:" class="form-control">
                          <input type="text" placeholder="Proveedor 3:" class="form-control">
                          <input type="text" placeholder="Proveedor 4:" class="form-control">
                        </div>
                        <div class="col-6">
                          <input type="text" placeholder="Teléfono:" class="form-control">
                          <input type="text" placeholder="Teléfono:" class="form-control">
                          <input type="text" placeholder="Teléfono:" class="form-control">
                          <input type="text" placeholder="Teléfono:" class="form-control">
                        </div>
                      </div>
                      <hr class="border-danger border-2">
                      <!-- REFERENCIAS BANCARIAS -->
                      <h1>Referencias Bancarias</h1>
                      <div class="row">
                        <div class="col-6">
                          <input type="text" placeholder="Banco 1:" class="form-control">
                          <input type="text" placeholder="Banco 2:" class="form-control">
                          <input type="text" placeholder="Banco 3:" class="form-control">
                        </div>
                        <div class="col-6">
                          <input type="text" placeholder="Nro de Cuenta:" class="form-control">
                          <input type="text" placeholder="Nro de Cuenta:" class="form-control">
                          <input type="text" placeholder="Nro de Cuenta:" class="form-control">
                        </div>
                      </div>
                      <hr class="border-danger border-2">
                      <!-- OBSERVACIONES -->
                      <h1>Observaciones</h1>
                      <textarea name="" id="" cols="30" rows="4" placeholder="Comentarios:" class="form-control"></textarea>
                      <input type="text" placeholder="Solicitud Generada por:" class="form-control">
                      <hr class="border-danger border-2">
                      <!-- DOCUMENTOS -->
                      <h1>Documentos</h1>
                      <p>Puede adjuntar,Registro de Comercio, RIF, Foto del Local, C.I de (los) Representante(s) Legal(es), Pedido.</p>
                      <input type="file" placeholder="Solicitud Generada por:" class="form-control">
                      <div class="d-flex flex-sm-row flex-column">
                      <input type="submit" id="btnAdjuntar" value="Adjuntar" accept="gif, .bmp, .jpg, .jpeg, .pdf, .xls, .doc, .png.">
                        <p>Importante: Solo se aceptan archivos del tipo: gif, .bmp, .jpg, .jpeg, .pdf, .xls, .doc, .png.</p>
                      </div>
                    </div>
                    <!-- BOTON DE ENVIAR -->
                    <input type="submit" value="Registrarme" class="btnAcceder">
                  </form>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>