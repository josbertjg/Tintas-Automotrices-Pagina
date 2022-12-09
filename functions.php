<?php
//SOPORTES DEL TEMA
function tintasAuto_theme_support(){
    // Añadiendo el titulo dinamicamente
    add_theme_support('title-tag');
    //ESPECIFIACIONES DEL LOGO (HACIENDO QUE EL HEIGHT Y EL WIDTH SEAN FLEXIBLES)
    $defaults = array(
        'flex-height'          => true,
		'flex-width'           => true,
	);
    //LOGO DINAMICO DE LA PAGINA
	add_theme_support( 'custom-logo', $defaults );
    //IMAGENES DE LOS POST
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme','tintasAuto_theme_support');

//MENU
function tintasAuto_menus(){
    $locations = array(
        'primary' => "Menu Principal de la página"
    );

    register_nav_menus($locations);
    add_theme_support('custom-fields');
}

add_action('init','tintasAuto_menus');

//ESTILOS DEL TEMA
function tintasAuto_register_styles(){

    $version = wp_get_theme()->get('Version');

    //CSS NATIVO
    wp_enqueue_style('tintasAuto-style', get_template_directory_uri() . "/style.css", array('tintasAuto-bootstrap'), $version, 'all');
    //CSS BOOTSTRAP
    wp_enqueue_style('tintasAuto-bootstrap', "https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css", array(), '5.2.2', 'all');
    //CSS BOOTSTRAP ICONS
    wp_enqueue_style('tintasAuto-bootstrap-icons', "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css", array(), '1.9.1', 'all');
    //CSS SWIPERJS
    wp_enqueue_style('tintasAuto-swiper', "https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css", array(), '8', 'all');
}

add_action('wp_enqueue_scripts', 'tintasAuto_register_styles');

//SCRIPTS DEL TEMA
function tintasAuto_register_scripts(){
    //JQUERY
    wp_enqueue_script('tintasAuto-jquery', get_template_directory_uri() . "/assets/js/jquery-3.6.1.min.js", array(), '3.6.1', false);
    //JAVASCRIPT
    wp_enqueue_script('tintasAuto-functions', get_template_directory_uri() . "/assets/js/functions.js", array('tintasAuto-jquery','tintasAuto-cookies'), '1.1', false);
    wp_enqueue_script('tintasAuto-indexJs', get_template_directory_uri() . "/assets/js/index.js", array('tintasAuto-jquery','tintasAuto-functions','tintasAuto-cookies'), '1.8', false);
    //LINEA PARA LOCALIZAR EL PATH DEL AJAX.PHP AUTOMATICAMENTE
    wp_localize_script('tintasAuto-indexJs','ajax_var',['ajaxurl'=>admin_url('admin-ajax.php')]);
    //ID DE LA CATEGORIA DE DISTRIBUIDORES
    wp_localize_script('tintasAuto-indexJs','dis_id_cat',['distribuidor_id'=>get_cat_ID ( 'distribuidor' )]);
    //URL BASE
    wp_localize_script('tintasAuto-functions','url_base',['url'=>get_template_directory_uri()]);
    //BOOTSTRAP JAVASCRIPT
    wp_enqueue_script('tintasAuto-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js', array(), '1', true);
    //SWIPER JAVASCRIPT
    wp_enqueue_script('tintasAuto-swiper', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js', array(), '1', true);
    //SWEETALERT
    wp_enqueue_script('tintasAuto-sweetAlert2', '//cdn.jsdelivr.net/npm/sweetalert2@11', array(), '2', true);
    //LIB DE COOKIES
    wp_enqueue_script('tintasAuto-cookies', get_template_directory_uri() . "/assets/js/js.cookie.min.js", array(), '1', true);
}

add_action('wp_enqueue_scripts', 'tintasAuto_register_scripts');

// //REGISTRANDO LOS WIDGETS
function tintasAuto_register_widgets(){
    register_sidebar(array(
        'name'          => ('Imagen Ventana de Ingreso'),
        'id'            => 'imgModalIngreso',
        'description'   => ('Imagen de la ventana emergente de ingreso o registro'),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => ''
    ));
    register_sidebar(array(
        'name'          => ('Imagen Ventana de Distribuidores'),
        'id'            => 'imgModalDistribuidores',
        'description'   => ('Imagen de la ventana emergente de búsqueda de distribuidores'),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => ''
    ));
    register_sidebar(array(
        'name'          => ('Sobre Nosotros'),
        'id'            => 'SobreNosotros',
        'description'   => ('Contenido en la seccion de Sobre Nosotros'),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => ''
    ));
    register_sidebar(array(
        'name'          => ('Mision'),
        'id'            => 'Mision',
        'description'   => ('Contenido en la seccion de Misión'),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => ''
    ));
    register_sidebar(array(
        'name'          => ('Vision'),
        'id'            => 'Vision',
        'description'   => ('Contenido en la seccion de Visión'),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => ''
    ));
    register_sidebar(array(
        'name'          => ('Valores'),
        'id'            => 'Valores',
        'description'   => ('Contenido en la seccion de Valores'),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => ''
    ));
    register_sidebar(array(
        'name'          => ('Contacto'),
        'id'            => 'Contacto',
        'description'   => ('Aqui van el titulo y el texto de la seccion de contacto'),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => ''
    ));
    register_sidebar(array(
        'name'          => ('Imagen de Contacto'),
        'id'            => 'imgContacto',
        'description'   => ('Imagen de la seccion de Contacto'),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => ''
    ));
}

add_action('widgets_init','tintasAuto_register_widgets');

// ENVIAR FORMULARIO
//DECLARANDO FUNCIONES CALLBACK DEL LLAMADO AJAX
add_action( 'wp_ajax_nopriv_formulario', 'send_mail_data' );
add_action( 'wp_ajax_formulario', 'send_mail_data' );

function send_mail_data() { //FUNCION CALLBACK DEL FORMULARIO

	$name = sanitize_text_field($_POST['name']);
	$email = sanitize_email($_POST['email']);
	$message = sanitize_textarea_field($_POST['message']);

	$adminmail = "tintasautomotrices.ventas@gmail.com"; //email destino
	$subject = 'Formulario de participantes'; //asunto
	$headers = "Reply-to: " . $name . " <" . $email . ">";

	//Cuerpo del mensaje
	$msg = "Nombre: " . $name . "\n";
	$msg .= "E-mail: " . $email . "\n\n";
	$msg .= "Mensaje: \n\n" . $message . "\n";

	$sendmail = wp_mail( $adminmail, $subject, $msg, $headers);

    if($sendmail){
        echo 1;
    }else{
        echo 0;
    }
    die;
}
?>