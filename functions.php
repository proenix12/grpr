<?php
function some_test() {

    wp_enqueue_script( 'ajax-script', get_template_directory_uri() . '/assets/js/ajax.js', array('jquery') );

    wp_localize_script( 'ajax-script', 'admin_url', 
            array(
                'url'   => admin_url( 'admin-ajax.php' ),
                'nonce' => wp_create_nonce( "process_reservation_nonce" ),
            )
    );
}
add_action( 'wp_enqueue_scripts', 'some_test' );

add_action( 'wp_ajax_jobs_form_handle', 'jobs_form_handle' );
add_action( 'wp_ajax_nopriv_jobs_form_handle', 'jobs_form_handle' );
function jobs_form_handle()
{

$uploadOk = 1;
$to = 'georgi.nqgolov@gmail.com';
$subject = 'The subject';
$body = 'The email body content';
$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$uploadedfile = $_FILES['file'];
$attachments = array();
foreach ($uploadedfile['name'] as $key => $value) {
	$file = array(
    	'name'     => $uploadedfile[ 'name' ][ $key ],
    	'type'     => $uploadedfile[ 'type' ][ $key ],
    	'tmp_name' => $uploadedfile[ 'tmp_name' ][ $key ],
    	'error'    => $uploadedfile[ 'error' ][ $key ],
    	'size'     => $uploadedfile[ 'size' ][ $key ]
    );

	$get_pathinfo = pathinfo($file['tmp_name'] . $file['name']);
    $file_extension = $get_pathinfo['extension'];

    if($file_extension != "cv" && $file_extension != "docx" && $file_extension != "pdf") {
        $file_err =  "Sorry, only .cv, .docx, .pdf files are allowed.";
        $uploadOk = 0;
    }else{
        if($file["size"] <= 50000000){
			$temp = explode(".", $file["name"]);
			$extension = end($temp);
			$newname= $file["name"].".".$extension;
			rename($file["tmp_name"],$newname);
			$attachments[] = $newname ;
        }else{
            $file_err =  "Large files";
            $uploadOk = 0;
        }
    }
}

if(uploadOk == 1){
	if(wp_mail('georgi.nqgolov@gmail.com', 'test', $body, $headers, $attachments)){

	}
}

}

/**
 * Storefront engine room
 *
 * @package storefront
 */

/**
 * Assign the Storefront version to a var
 */
$theme              = wp_get_theme( 'storefront' );
$storefront_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

$storefront = (object) array(
	'version' => $storefront_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-storefront.php',
	'customizer' => require 'inc/customizer/class-storefront-customizer.php',
);

require 'inc/storefront-functions.php';
require 'inc/storefront-template-hooks.php';
require 'inc/storefront-template-functions.php';

if ( class_exists( 'Jetpack' ) ) {
	$storefront->jetpack = require 'inc/jetpack/class-storefront-jetpack.php';
}

if ( storefront_is_woocommerce_activated() ) {
	$storefront->woocommerce = require 'inc/woocommerce/class-storefront-woocommerce.php';

	require 'inc/woocommerce/storefront-woocommerce-template-hooks.php';
	require 'inc/woocommerce/storefront-woocommerce-template-functions.php';
}

if ( is_admin() ) {
	$storefront->admin = require 'inc/admin/class-storefront-admin.php';

	require 'inc/admin/class-storefront-plugin-install.php';
}

/**
 * NUX
 * Only load if wp version is 4.7.3 or above because of this issue;
 * https://core.trac.wordpress.org/ticket/39610?cversion=1&cnum_hist=2
 */
if ( version_compare( get_bloginfo( 'version' ), '4.7.3', '>=' ) && ( is_admin() || is_customize_preview() ) ) {
	require 'inc/nux/class-storefront-nux-admin.php';
	require 'inc/nux/class-storefront-nux-guided-tour.php';

	if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.0.0', '>=' ) ) {
		require 'inc/nux/class-storefront-nux-starter-content.php';
	}
}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woocommerce/theme-customisations
 */


 function add_my_custom_scripts(){
	wp_enqueue_script('my-scripts', get_template_directory_uri('') . '/assets/js/test.js' );
 }
 add_action( 'wp_enqueue_scripts', 'add_my_custom_scripts');