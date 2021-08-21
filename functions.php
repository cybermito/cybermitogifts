<?php 

function init_template(){

    add_theme_support('post-thumbnails');
    add_theme_support( 'title-tag');

    register_nav_menus(
        array(
            'top_menu' => 'Menú Principal'
        )
    );

}

add_action('after_setup_theme', 'init_template');


function assets(){
    wp_register_style('bootstrap','https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css', '', '4.4.1','all');
    wp_register_style('montserrat', 'https://fonts.googleapis.com/css?family=Montserrat&display=swap','','1.0', 'all');
    wp_enqueue_style('estilos', get_stylesheet_uri(), array('bootstrap','montserrat'),'1.0', 'all');
   
    wp_register_script('popper','https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js','','1.16.0', true);
    wp_enqueue_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', array('jquery','popper'),'4.4.1', true);
    wp_enqueue_script('custom', get_template_directory_uri().'/assets/js/custom.js', '', '1.0', true);
}

add_action('wp_enqueue_scripts','assets');

//Registramos un sidebar para poder incorporar los widgets.
function sidebar(){
    register_sidebar(
        array(
            'name' => 'Pie de página',
            'id'   => 'footer',
            'description' => 'Zona de Widgets para pie de página',
            'before_title' => '<p>',
            'after_title'  => '</p>',
            'before_widget' => '<div id="%1$s" class="%2$s">',
            'after_widget'  => '</div>',
        )
        );
}

add_action('widgets_init', 'sidebar');

//Registramos un nuevo post-type que va a ser los productos de nuestra web.
function productos_type(){
    $labels = array(
        'name' => 'Productos',
        'singular_name' => 'Producto',
        'manu_name' => 'Productos',
    );

    $args = array(
        'label'  => 'Productos', 
        'description' => 'Productos de Platzi',
        'labels'       => $labels,
        'supports'   => array('title','editor','thumbnail', 'revisions'),
        'public'    => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon'     => 'dashicons-cart',
        'can_export' => true,
        'publicly_queryable' => true,
        'rewrite'       => true,
        'show_in_rest' => true

    );    
    register_post_type('producto', $args);
}

add_action('init', 'productos_type');

//Registramos una nueva Taxonomía personalizada
function pgRegisterTax() { //Creamos una función para registrar nuestar nueva taxonomía. 
    //Creamos una lista de argumentos que nos va permitir registrar dicha taxonomía personalizada. 
    $args = array(
        'hierarchical' => true, //Nos permite definir si la categoría pueda tener subcategorías.
        'labels' => array( //Nombre que va a tener la taxonomía en los distintos puntos del sitio. 
            'name' => 'Categorías de Productos', //Nombre en plural 
            'singular name' => 'Categoría de Productos' //Nombre en singular
        ),
        'show_in_na_menu' => true, //Queremos que se muestre en el menú de navegación de la web.
        'show_admin_column' => true, //Queremos que se muestre en el menú de administración (backend)
        'rewrite' => array( //Nos permite especificar como queremos que se reescriba la ruta de los archivos de categoría de productos. 
            'slug'=> 'categoria-productos' //poner en formato url.
        )
        );
    register_taxonomy('categoria-productos', array('producto'), $args); //con este comando registramos la taxonomía.
    //Los atributos que recibe register_taxonomy son (slug, los post-types que le asignamos la taxonomía, los argumentos que recibe).
}
add_action('init', 'pgRegisterTax'); //Establecemos el hook en el arranque del sistema.