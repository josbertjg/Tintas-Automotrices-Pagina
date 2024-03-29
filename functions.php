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
    //JAVASCRIPT NATIVO
    //PRODUCTOS
    wp_enqueue_script('tintasAuto-productos', get_template_directory_uri() . "/assets/js/productos.js", array('tintasAuto-jquery','tintasAuto-cookies'), '1.3', false);
    //MARCAS
    wp_enqueue_script('tintasAuto-marcas', get_template_directory_uri() . "/assets/js/marcas.js", array('tintasAuto-jquery','tintasAuto-cookies'), '1.4', false);
    //DETALLE
    wp_enqueue_script('tintasAuto-detalle', get_template_directory_uri() . "/assets/js/detalle.js", array('tintasAuto-jquery','tintasAuto-cookies','tintasAuto-marcas'), '1.0', false);
    //INDEX
    wp_enqueue_script('tintasAuto-indexJs', get_template_directory_uri() . "/assets/js/index.js", array('tintasAuto-jquery','tintasAuto-cookies'), '1.26', false);
    //LINEA PARA LOCALIZAR EL PATH DEL AJAX.PHP AUTOMATICAMENTE
    wp_localize_script('tintasAuto-indexJs','ajax_var',['ajaxurl'=>admin_url('admin-ajax.php')]);
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

//CONFIGURACIONES DEL API
add_action('rest_api_init', 'register_rest_images' );
function register_rest_images(){
    register_rest_field( array('post'),
        'fimg_url',
        array(
            'get_callback'    => 'get_rest_featured_image',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}
function get_rest_featured_image( $object, $field_name, $request ) {
    if( $object['featured_media'] ){
        $img = wp_get_attachment_image_src( $object['featured_media'], 'app-thumb' );
        return $img[0];
    }
    return false;
}

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
        'name'          => ('Imagen Marca Anjo'),
        'id'            => 'imgAnjo',
        'description'   => ('Imagen de la marca Anjo'),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => ''
    ));
    register_sidebar(array(
        'name'          => ('Logo Marca Anjo'),
        'id'            => 'logoAnjo',
        'description'   => ('Logo que será mostrado en la página de productos de Anjo'),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => ''
    ));
    register_sidebar(array(
        'name'          => ('Imagen Marca Atlas'),
        'id'            => 'imgAtlas',
        'description'   => ('Imagen de la marca Atlas'),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => ''
    ));
    register_sidebar(array(
        'name'          => ('Logo Marca Atlas'),
        'id'            => 'logoAtlas',
        'description'   => ('Logo que será mostrado en la página de productos de Atlas'),
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
        'name'          => ('Imagen Mision'),
        'id'            => 'imgMision',
        'description'   => ('Imagen de la seccion Mision'),
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
        'name'          => ('Imagen Vision'),
        'id'            => 'imgVision',
        'description'   => ('Imagen en la seccion de Visión'),
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
        'name'          => ('Imagen Valores'),
        'id'            => 'imgValores',
        'description'   => ('Imagen en la seccion de Valores'),
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

/* POST TYPES */

//CATEGORIAS ANJO
function categorias_anjo_post_type(){

    $args=array(

        'labels'=>array(
            'name'=>'Categorias Anjo',
            'singular_name'=>'Categoria Anjo'
        ),
        'hierarchical'=>true,
        'public'=>true,
        'show_in_rest' => true,
        'menu_icon'=>'dashicons-insert-after',
        'supports'=>array('title','thumbnail'),
    );

    register_post_type('categorias_anjo',$args);
};
add_action('init','categorias_anjo_post_type');

//POST TYPE CATEGORIAS INTERMEDIAS ANJO
function categorias_intermedias_anjo_post_type(){

    $args=array(

        'labels'=>array(
            'name'=>'Cat Automotrices',
            'singular_name'=>'Cat Automotriz'
        ),
        'hierarchical'=>true,
        'public'=>true,
        'show_in_rest' => true,
        'menu_icon'=>'dashicons-car',
        'supports'=>array('title'),
    );

    register_post_type('intermedias_anjo',$args);
};
add_action('init','categorias_intermedias_anjo_post_type');

//POST TYPE PARA ANJO
function anjo_post_type(){

    $args=array(

        'labels'=>array(
            'name'=>'Productos Anjo',
            'singular_name'=>'Producto Anjo'
        ),
        'hierarchical'=>false,
        'public'=>true,
        'has_archive'=>true,
        'show_in_rest' => true,
        'menu_icon'=>'dashicons-products',
        'supports'=>array('title','thumbnail','editor'),
        // 'rewrite'=>array('slug'=>'anjo')
    );

    register_post_type('anjo',$args);
};
add_action('init','anjo_post_type');

//CATEGORIAS ATLAS
function categorias_atlas_post_type(){

    $args=array(

        'labels'=>array(
            'name'=>'Categorias Atlas',
            'singular_name'=>'Categoria Atlas'
        ),
        'hierarchical'=>true,
        'public'=>true,
        'show_in_rest' => true,
        'menu_icon'=>'dashicons-insert-after',
        'supports'=>array('title','thumbnail'),
    );

    register_post_type('categorias_atlas',$args);
};
add_action('init','categorias_atlas_post_type');

//POST TYPE PARA ATLAS
function atlas_post_type(){

    $args=array(

        'labels'=>array(
            'name'=>'Productos Atlas',
            'singular_name'=>'Producto Atlas'
        ),
        'hierarchical'=>true,
        'public'=>true,
        'has_archive'=>true,
        'show_in_rest' => true,
        'menu_icon'=>'dashicons-products',
        'supports'=>array('title','thumbnail','editor'),
    );

    register_post_type('atlas',$args);
};
add_action('init','atlas_post_type');

/* TAXONOMIAS */

//CATEGORIAS PARA EL POST TYPE DE ANJO

//PADRE
function categoriasPadre_anjo(){
    $args=array(
        'labels'=>array(
            'name'=>'Categorías Padre',
            'singular_name'=>'Categoría Padre'
        ),
        'hierarchical'=>true,
        'public'=>true,
        'show_in_rest' => true, // This enables the REST API endpoint
        'query_var' => true // This allows us to append the taxonomy param to the custom post api request.
    );
    register_taxonomy('categorias_padre',array('anjo','categorias_anjo','intermedias_anjo'),$args);
};
add_action('init','categoriasPadre_anjo');

//CATEGORIAS INTERMEDIAS
function categoriasIntermedias_anjo(){
    $args=array(
        'labels'=>array(
            'name'=>'Categorias Intermedias',
            'singular_name'=>'Categoría Intermedia'
        ),
        'hierarchical'=>true,
        'public'=>true,
        'show_in_rest' => true, // This enables the REST API endpoint
        'query_var' => true // This allows us to append the taxonomy param to the custom post api request.
    );
    register_taxonomy('cat_intermedia_anjo',array('anjo','categorias_anjo','intermedias_anjo'),$args);
};
add_action('init','categoriasIntermedias_anjo');

//HIJO
function categoriasHijo_anjo(){
    $args=array(
        'labels'=>array(
            'name'=>'Categorías Hijo',
            'singular_name'=>'Categoría Hijo'
        ),
        'hierarchical'=>true,
        'public'=>true,
        'show_in_rest' => true, // This enables the REST API endpoint
        'query_var' => true // This allows us to append the taxonomy param to the custom post api request.
    );
    register_taxonomy('hijo_anjo',array('anjo','categorias_anjo','intermedias_anjo'),$args);
};
add_action('init','categoriasHijo_anjo');

//CATEGORIAS PARA EL POST TYPE DE ATLAS

//PADRE
function categoriasPadre_atlas(){
    $args=array(
        'labels'=>array(
            'name'=>'Categorías Padre',
            'singular_name'=>'Categoría Padre'
        ),
        'hierarchical'=>true,
        'public'=>true,
        'show_in_rest' => true, // This enables the REST API endpoint
        'query_var' => true // This allows us to append the taxonomy param to the custom post api request.
    );
    register_taxonomy('categorias_padre_atlas',array('atlas','categorias_atlas'),$args);
};
add_action('init','categoriasPadre_atlas');

//HIJO
function categoriasHijo_atlas(){
    $args=array(
        'labels'=>array(
            'name'=>'Categorías Hijo',
            'singular_name'=>'Categoría Hijo'
        ),
        'hierarchical'=>true,
        'public'=>true,
        'show_in_rest' => true, // This enables the REST API endpoint
        'query_var' => true // This allows us to append the taxonomy param to the custom post api request.
    );
    register_taxonomy('hijo_atlas',array('atlas','categorias_atlas'),$args);
};
add_action('init','categoriasHijo_atlas');

//CUSTOMIZANDO EL QUERY DE ANJO PARA QUE SE MUESTREN LOS PRODUCTOS DE UNA CATEGORIA PADRE EXPECIFICA

//Función para modificar la consulta de WP_Query
function anjo_query($query) {
    //Verificar que se está en el archive de 'anjo' y que no es una solicitud del administrador
    if ( is_admin() || ! $query->is_main_query() || ! is_post_type_archive( 'anjo' ) || empty( $_GET['catPadre'] ) ) {
        return;
    }

    if($_GET['catPadre']=='automotriz'){
        $tax_query = [
            'relation' => 'AND',          
            [
                'taxonomy' => 'categorias_padre',
                'field'    => 'name',
                'terms'    => $_GET['catPadre'],
                'operator' =>   'IN'
            ],
            [
                'taxonomy'         => 'cat_intermedia_anjo',
                'field'            => 'name',
                'terms'            => $_GET['catIntermedia'],
                'operator' =>   'IN'
            ]
        ];
    }else{
        $tax_query = [
            [
                'taxonomy' => 'categorias_padre',
                'field'    => 'name',
                'terms'    => $_GET['catPadre'],
            ],
        ];
    }

    $query->set( 'tax_query', $tax_query );
    return $query;
}
add_action( 'pre_get_posts', 'anjo_query' );

//CUSTOMIZANDO EL QUERY DE ATLAS PARA QUE SE MUESTREN LOS PRODUCTOS DE UNA CATEGORIA PADRE EXPECIFICA

//Función para modificar la consulta de WP_Query
function atlas_query($query) {
    //Verificar que se está en el archive de 'atlas' y que no es una solicitud del administrador
    if ( is_admin() || ! $query->is_main_query() || ! is_post_type_archive( 'atlas' ) || empty( $_GET['catPadre'] ) ) {
        return;
    }

    $tax_query = [
        [
            'taxonomy' => 'categorias_padre_atlas',
            'field'    => 'name',
            'terms'    => $_GET['catPadre'],
        ],
    ];
    $query->set( 'tax_query', $tax_query );
    return $query;
}
add_action( 'pre_get_posts', 'atlas_query' );
?>