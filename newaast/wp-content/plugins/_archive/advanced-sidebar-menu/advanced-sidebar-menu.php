<?php
/*
Plugin Name: Advanced Sidebar Menu
Plugin URI: http://lipeimagination.info/wordpress/advanced-sidebar-menu/
Description: Creates dynamic menu based on child/parent relationship.
Author: Mat Lipe
Version: 3.2.3
Author URI: http://lipeimagination.info
Since: 6/4/12
Email: mat@lipeimagination.info

*/


#-- Bring in the functions
require( 'functions.php' );
$asm = new advanced_sidebar_menu_functions();

#-- Version 3.2 notice
add_action( 'init', array( $asm, 'validate_3_2' ) );



#-- Bring in the Widgets
require( 'widgets/init.php' );


#-- Define Constants
define( 'ADVANCED_SIDEBAR_WIDGETS_DIR', plugin_dir_path(__FILE__) . 'widgets/' );
define( 'ADVANCED_SIDEBAR_VIEWS_DIR', plugin_dir_path(__FILE__) . 'views/' );
define( 'ADVANCED_SIDEBAR_DIR', plugin_dir_path(__FILE__) );


#-- Bring in the JQuery
add_action( 'admin_print_scripts', 'advanced_sidebar_menu_script');
function advanced_sidebar_menu_script(){
         wp_enqueue_script(
                apply_filters( 'asm_script', 'advanced-sidebar-menu-script' ),  //Allows developers to overright the name of the script
                plugins_url( 'advanced-sidebar-menu.js', __FILE__ ),
                array('jquery'),  //The scripts this depends on 
                '1.1.0'   //The Version of your script
                             
        );

};




