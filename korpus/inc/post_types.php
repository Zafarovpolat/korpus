<?php
add_action( 'init', 'kp_taxonomy' );
function kp_taxonomy(){
    register_taxonomy( 'services_type', array('services'), [
        'label'                 => '', 
        'labels'                => [
            'name'              => 'Services Types',
            'singular_name'     => 'Service Type',
            'menu_name'         => 'Services Types',
        ],
        'description'           => '', 
        'public'                => true,
        'hierarchical'          => true,
        'capabilities'          => array(),
        'meta_box_cb'           => 'post_categories_meta_box', 
        'show_admin_column'     => false,
        //'rewrite'                 => array('slug' => 'services')
    ] );
	
	register_taxonomy( 'team_group', array('team'), [
        'label'                 => '', 
        'labels'                => [
            'name'              => 'Team Groups',
            'singular_name'     => 'Team Group',
            'menu_name'         => 'Team Groups',
        ],
        'description'           => '', 
        'public'                => true,
        'hierarchical'          => true,
        'capabilities'          => array(),
        'meta_box_cb'           => 'post_categories_meta_box', 
        'show_admin_column'     => false,
        //'rewrite'                 => array('slug' => 'services')
    ] );
 
}


function create_post_type() { 
    register_post_type( 'services', 
        array(
            'labels' => array(
                'name' => __( 'Services' ), 
                'singular_name' => __( 'Service' ), 
                'menu_name' => 'Services'
            ),
            'show_in_rest' => true,
            'public' => true,
            'menu_position' => 5, 
            //'rewrite' => array('slug' => 'product'), 
            'supports' => array('title') 
        )
    );
	
	register_post_type( 'team', 
        array(
            'labels' => array(
                'name' => __( 'Team' ), 
                'singular_name' => __( 'Team member' ), 
                'menu_name' => 'Team'
            ),
            'show_in_rest' => true,
            'public' => true,
            'menu_position' => 5, 
            //'rewrite' => array('slug' => 'product'), 
            'supports' => array('title', 'thumbnail', 'editor') 
        )
    );
}
add_action( 'init', 'create_post_type' );


?>