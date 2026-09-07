<?php
add_theme_support('menus');
add_theme_support('post-thumbnails');
add_theme_support('widgets');
add_theme_support('shortcodes');
//add_theme_support('woocommerce');
add_theme_support('title-tag');


## Общие CSS стили для админ-панели. Нужно создать файл 'wp-admin.css' в папке темы
add_action( 'admin_enqueue_scripts', function(){
    wp_enqueue_style( 'my-wp-admin', get_template_directory_uri() .'/assets/css/wp-admin.css' );
}, 99 );

/*Disabled posr revision*/
function my_revisions_to_keep( $revisions ) {
    return 0;
}
add_filter( 'wp_revisions_to_keep', 'my_revisions_to_keep' );

/*Allow html in wp_mail*/
function wpse27856_set_content_type(){
    return "text/html";
}
add_filter( 'wp_mail_content_type','wpse27856_set_content_type' );


add_filter('wpcf7_autop_or_not', '__return_false');


//denied access to wp-admin for non administrator users
// some errors sometimes
function blockusers_init() { 
    if ( is_admin() && (is_user_logged_in() && !current_user_can( 'administrator' )) && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) { 
        wp_redirect( home_url() ); 
        exit; 
    } 
}
//add_action( 'init', 'blockusers_init' ); 


// remove version from scripts and styles
function remove_version_scripts_styles($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'remove_version_scripts_styles', 9999);
add_filter('script_loader_src', 'remove_version_scripts_styles', 9999);






add_filter( 'plugin_action_links', 'disable_plugin_deactivation', 10, 2 );
function disable_plugin_deactivation( $actions, $plugin_file ) {
    unset( $actions['edit'] );

    $important_plugins = array(
        'advanced-custom-fields-pro/acf.php',
        //'contact-form-7/wp-contact-form-7.php',
    );
    if ( in_array( $plugin_file, $important_plugins ) ) {
        unset( $actions['deactivate'] );
        $actions[ 'info' ] = '<b class="musthave_js">Обязателен для сайта</b>';
    }

    return $actions;
}

add_filter( 'admin_print_footer_scripts-plugins.php', 'disable_plugin_deactivation_hide_checkbox' );
function disable_plugin_deactivation_hide_checkbox( $actions ){
    ?>
    <script>
        jQuery(function($){
            $('.musthave_js').closest('tr').find('input[type="checkbox"]').remove();
        });
    </script>
    <?php
}

function filter_plugin_updates( $update ) {
    global $DISABLE_UPDATE; // см. wp-config.php
    if( !is_array($DISABLE_UPDATE) || count($DISABLE_UPDATE) == 0 ){  return $update;  }
    foreach( $update->response as $name => $val ){
        foreach( $DISABLE_UPDATE as $plugin ){
            if( stripos($name,$plugin) !== false ){
                unset( $update->response[ $name ] );
            }
        }
    }
    return $update;
}
add_filter( 'site_transient_update_plugins', 'filter_plugin_updates' );

$DISABLE_UPDATE = array('acf');




//Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-block-style' );
} 
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );

/*Clean some html*/
remove_action('wp_head','feed_links_extra', 3); 
remove_action('wp_head','feed_links', 2); 
remove_action('wp_head','rsd_link');  
remove_action('wp_head','wlwmanifest_link'); 
remove_action('wp_head','wp_generator');  
remove_action('wp_head','start_post_rel_link',10);
remove_action('wp_head','index_rel_link');
remove_action('wp_head','adjacent_posts_rel_link_wp_head', 10 );
remove_action('wp_head','wp_shortlink_wp_head', 10 );
remove_action( 'wp_head', 'rest_output_link_wp_head');
remove_action( 'wp_head', 'wp_oembed_add_discovery_links');
remove_action( 'template_redirect', 'rest_output_link_header', 11 );
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
add_filter('the_generator', '__return_empty_string'); 
remove_action( 'wp_head', 'wp_resource_hints', 2); 
remove_action( 'wp_head','locale_stylesheet');
add_filter('show_admin_bar', '__return_false');
?>