<?php

// Edited By STRIKE - 2025

add_action('after_setup_theme', function () {

    register_nav_menus([
        'main_menu' => 'Main menu'
    ]);

    load_theme_textdomain('kp', get_template_directory() . '/languages');

});


function jquery_script_method() {
    wp_deregister_script( 'jquery' );
    wp_deregister_script( 'jquery-core' ); 
    wp_deregister_script( 'jquery-migrate' );
    wp_register_script( 'jquery', '//code.jquery.com/jquery-3.6.0.min.js', array(), '3.6.0', false );
    wp_enqueue_script( 'jquery' );  
} 
add_action('wp_enqueue_scripts', 'jquery_script_method');


function theme_method(){
    wp_enqueue_style( 'reset', '//cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css' );
	wp_enqueue_style( 'normalize', '//cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css' );
    wp_enqueue_style( 'swiper', '//unpkg.com/swiper@8/swiper-bundle.min.css' );
    wp_enqueue_style('theme_css', get_template_directory_uri() . '/assets/css/style.min.css');
    wp_enqueue_style( 'custom_style', get_stylesheet_uri() ); //base template style

    wp_enqueue_script('lozad', '//cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js', array('jquery'), false, true);
    wp_enqueue_script('ss', '//cdnjs.cloudflare.com/ajax/libs/smooth-scrollbar/8.7.4/smooth-scrollbar.js', array('jquery'), false, true);
	wp_enqueue_script('circletype', '//cdn.jsdelivr.net/npm/circletype@2.3.0/dist/circletype.min.js', array('jquery'), false, true);
	wp_enqueue_script('swiper', '//unpkg.com/swiper@8/swiper-bundle.min.js', array('jquery'), false, true);
	wp_enqueue_script('imask', '//cdnjs.cloudflare.com/ajax/libs/imask/6.4.2/imask.min.js', array('jquery'), false, true);
	if(is_front_page() || is_page_template('page_templates/cookies.php')) wp_enqueue_script('cookie_js', '//cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js', array('jquery'), false, true);
    wp_enqueue_script('theme_js', get_template_directory_uri() . '/assets/js/app.js', array('jquery'), false, true);

}
add_action( 'wp_enqueue_scripts', 'theme_method' );


require_once locate_template( 'inc/theme_functions.php' );
require_once locate_template( 'inc/post_types.php' );
require_once locate_template( 'inc/ajax.php' );

//добавление страницы Опции плагина ACF
if(function_exists('acf_add_options_page')){
    acf_add_options_page(array(
        'page_title'    => 'Site Options',
        'menu_title'    => 'Site Options',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

?>