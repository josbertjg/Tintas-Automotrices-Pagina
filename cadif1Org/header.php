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
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div id="nav-content" class="container-fluid">
              <a class="navbar-brand" href="#">
                <?php

                  if(function_exists('the_custom_logo')){
                    //buscando y gaurdando la ruta del logo cargado en wordpress
                    $custom_logo_id = get_theme_mod('custom_logo');
                    $logo = wp_get_attachment_image_src($custom_logo_id);
                  }
                
                ?>
                <img src="<?php echo $logo[0] ?>" alt="cadif1-logo">
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">

                <?php
                
                  wp_nav_menu(
                    array(
                      'menu' => 'primary',
                      'container' => '',
                      'theme_location' => 'primary',
                      'items_wrap' => '<ul id="" class="navbar-nav mb-2 mb-lg-0">%3$s</ul>'
                    )
                  );

                ?>
                
              </div>
            </div>
          </nav>
    </header>