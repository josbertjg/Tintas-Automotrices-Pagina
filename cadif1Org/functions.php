<?php

function cadif1Org_theme_support(){
    // Añadiendo el titulo dinamicamente
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme','cadif1Org_theme_support');

function cadif1Org_menus(){
    $locations = array(
        'primary' => "Menu del blog",
        'footer' => "Menu del footer"
    );

    register_nav_menus($locations);
    add_theme_support('custom-fields');
}

add_action('init','cadif1Org_menus');

function cadif1Org_register_styles(){

    $version = wp_get_theme()->get('Version');

    wp_enqueue_style('cadif1org-style', get_template_directory_uri() . "/style.css", array('cadif1org-bootstrap'), $version, 'all');
    wp_enqueue_style('cadif1org-bootstrap', "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css", array(), '5.1.3', 'all');

}

add_action('wp_enqueue_scripts', 'cadif1Org_register_styles');

function cadif1Org_register_scripts(){
    wp_enqueue_script('cadif1org-fontawesome', 'https://kit.fontawesome.com/c8b5ffbcfa.js' , array(), '1.0', false);
    wp_enqueue_script('cadif1org-jquery', get_template_directory_uri() . "/assets/js/jquery-3.6.0.min.js", array(), '3.6.0', false);
    wp_enqueue_script('cadif1org-mainJS', get_template_directory_uri() . "/assets/js/main.js", array(), '1.4', false);
    //LINEA PARA LOCALIZAR EL PATH DEL AJAX.PHP AUTOMATICAMENTE
    wp_localize_script('cadif1org-mainJS','cadif1org_vars',['ajaxurl'=>admin_url('admin-ajax.php')]);
    wp_enqueue_script('cadif1org-popper', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', array(), '1.3', true);
    wp_enqueue_script('cadif1org-SweetAlert2', '//cdn.jsdelivr.net/npm/sweetalert2@11', array(), '2', true);

}

add_action('wp_enqueue_scripts', 'cadif1Org_register_scripts');

//REGISTRANDO LOS WIDGETS
function cadif1Org_register_widgets(){
    register_sidebar(array(
        'name'          => ('projet'),
        'id'            => 'projet',
        'description'   => ('Esta es la seccion por debajo del slider'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<span class="widget-title"> <i>',
        'after_title'   => '</i></span>'
    ));

    register_sidebar(array(
        'name'          => ('laFundacion'),
        'id'            => 'laFundacion',
        'description'   => ('Este es el texto que va en el GRID de la fundación '),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>'
    ));

    register_sidebar(array(
        'name'          => ('mision'),
        'id'            => 'mision',
        'description'   => ('Esta es la seccion en el GRID de mision'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>'
    ));

    register_sidebar(array(
        'name'          => ('vision'),
        'id'            => 'vision',
        'description'   => ('Esta es la seccion en el GRID de vision'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>'
    ));

    register_sidebar(array(
        'name'          => ('eventos'),
        'id'            => 'eventos',
        'description'   => ('Esta es la seccion evento en las targetas'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>'
    ));

    register_sidebar(array(
        'name'          => ('impulsos'),
        'id'            => 'impulsos',
        'description'   => ('Esta es la seccion impulsos en las targetas'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>'
    ));

    register_sidebar(array(
        'name'          => ('entrenamiento'),
        'id'            => 'entrenamiento',
        'description'   => ('Esta es la seccion entrenamiento en las targetas'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>'
    ));

    register_sidebar(array(
        'name'          => ('donativos'),
        'id'            => 'donativos',
        'description'   => ('Este es el parrafo en donativos'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>'
    ));

    register_sidebar(array(
        'name'          => ('participa'),
        'id'            => 'participa',
        'description'   => ('Este es el parrafo en participa'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>'
    ));
}

add_action('widgets_init','cadif1Org_register_widgets');

//REGISTRANDO EL POST TYPE PARA LOS PARTICIPANTES
function contactos_post_type() {

	$labels = array(
		'name'                  => _x( 'Participantes', 'Post Type General Name', 'participantes_domain' ),
		'singular_name'         => _x( 'Participante', 'Post Type Singular Name', 'participante_domain' ),
		'menu_name'             => __( 'Participantes', 'participantes_domain' ),
		'name_admin_bar'        => __( 'Participantes', 'participantes_domain' ),
		'archives'              => __( 'Archivo participantes', 'participantes_domain' ),
		'attributes'            => __( 'Atributos participantes', 'participantes_domain' ),
		'parent_item_colon'     => __( 'participante padre:', 'participantes_domain' ),
		'all_items'             => __( 'Todas', 'participantes_domain' ),
		'add_new_item'          => __( 'Agregar nueva', 'participantes_domain' ),
		'add_new'               => __( 'Agregar', 'participantes_domain' ),
		'new_item'              => __( 'Nueva', 'participantes_domain' ),
		'edit_item'             => __( 'Editar', 'participantes_domain' ),
		'update_item'           => __( 'Actualizar', 'participantes_domain' ),
		'view_item'             => __( 'Ver participante', 'participantes_domain' ),
		'view_items'            => __( 'Ver participantes', 'participantes_domain' ),
		'search_items'          => __( 'Buscar participante', 'participantes_domain' ),
		'not_found'             => __( 'No encontrado', 'participantes_domain' ),
		'not_found_in_trash'    => __( 'No encontrado en la papelera', 'participantes_domain' ),
		'featured_image'        => __( 'Imagen detacada', 'participantes_domain' ),
		'set_featured_image'    => __( 'Asignar imagen destacada', 'participantes_domain' ),
		'remove_featured_image' => __( 'Remover imagen', 'participantes_domain' ),
		'use_featured_image'    => __( 'Usar como imagen detacada', 'participantes_domain' ),
		'insert_into_item'      => __( 'Insertar en participante', 'participantes_domain' ),
		'uploaded_to_this_item' => __( 'Subir a participante', 'participantes_domain' ),
		'items_list'            => __( 'Lista participante', 'participantes_domain' ),
		'items_list_navigation' => __( 'Navegación participantes', 'participantes_domain' ),
		'filter_items_list'     => __( 'Fitro participantes', 'participantes_domain' ),
	);
	$args = array(
		'label'                 => __( 'Participante', 'participantes_domain' ),
		'description'           => __( 'Contenido de participantes', 'participantes_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
		'taxonomies'            => array(),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-format-aside',
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'page',
		'show_in_rest'          => false,
        'capabilities' => array(
            'create_posts' => false,
        ),
        'map_meta_cap' =>true,
	);
	register_post_type( 'contactos_post_type', $args );

}
add_action( 'init', 'contactos_post_type', 0 );

//PROCESAR EL FORMULARIO DE PARTICIPANTE

add_action( 'wp_ajax_nopriv_process_form', 'send_mail_data' );
add_action( 'wp_ajax_process_form', 'send_mail_data' );

// Funcion callback
function send_mail_data() {

	$name = sanitize_text_field($_POST['name']);
	$email = sanitize_email($_POST['email']);
	$message = sanitize_textarea_field($_POST['message']);

	$adminmail = "josbertjg@gmail.com"; //email destino
	$subject = 'Formulario de participantes'; //asunto
	$headers = "Reply-to: " . $name . " <" . $email . ">";

	//Cuerpo del mensaje
	$msg = "Nombre: " . $name . "\n";
	$msg .= "E-mail: " . $email . "\n\n";
	$msg .= "Mensaje: \n\n" . $message . "\n";

	$sendmail = wp_mail( $adminmail, $subject, $msg, $headers);

	if ($sendmail){
		wp_insert_post([
			'post_title'	=>'Mensaje de '. $name,
			'post_type'		=>'contactos_post_type',
			'post_content'	=> $msg,
			'post_status' 	=> 'private',
			]);
	}
    echo $sendmail;
}
?>