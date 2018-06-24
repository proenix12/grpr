<?php
/*
Plugin Name: GDPR Field Label
Plugin URI: https://contactform7.com/
Description: Just another contact form plugin. Simple but flexible.
Author: George
Author URI: https://ideasilo.wordpress.com/
Text Domain: contact-form-7
Domain Path: /languages/
Version: 0.0.1
*/

define( 'GDPR_VERSION', '0.0.1' );

define( 'GDPR_REQUIRED_WP_VERSION', '4.9' );

define( 'GDPR_PLUGIN', __FILE__ );

define( 'GDPR_PLUGIN_BASENAME', plugin_basename( GDPR_PLUGIN ) );

define( 'GDPR_PLUGIN_NAME', trim( dirname( GDPR_PLUGIN_BASENAME ), '/' ) );

define( 'GDPR_PLUGIN_DIR', untrailingslashit( dirname( GDPR_PLUGIN ) ) );

define( 'GDPR_PLUGIN_MODULES_DIR', GDPR_PLUGIN_DIR . '/modules' );

require_once GDPR_PLUGIN_DIR . '/settings.php';

function add_my_css_and_my_js_files(){
    wp_enqueue_style( 'your-stylesheet-name', plugins_url('/css/style.css', __FILE__), false, '1.0.0', 'all');
}
add_action('wp_enqueue_scripts', "add_my_css_and_my_js_files");






























// function wpdocs_register_my_custom_menu_page(){
//     add_menu_page( 
//         __( 'Custom Menu Title', 'textdomain' ),
//         'Gdpr Field Label',
//         'manage_options',
//         'custompage',
//         'test',
//         plugins_url( '/images/GDPR_Popup_message-512.png' ),
//         6
//     ); 
// }
// add_action( 'admin_menu', 'wpdocs_register_my_custom_menu_page' );
 
// /**
//  * Display a custom menu page
//  */
// function test()
// {
//     $a = 1;
//     $l_a = "a";

//     //$l_a = 'a';

//     echo $$l_a;
// }


// function my_custom_menu_page(){
//     echo '<script>
//     jQuery(document).ready(function(){
//        var test =  jQuery("#test").length;

//        if(test){
//            console.log("testtttttt");
//     }

//     });
//     </script>';
// }
// add_action('wp_head', 'my_custom_menu_page');