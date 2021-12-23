<?php 
/*
*
*	***** Woocommerce Book preview *****
*
*	This file initializes all qmms Core components
*	
*/
// If this file is called directly, abort. //
if ( ! defined( 'WPINC' ) ) {die;} // end if
// Define Our Constants
define('QMMS_CORE_INC',dirname( __FILE__ ).'/assets/inc/');
define('QMMS_CORE_CSS',plugins_url( 'assets/css/', __FILE__ ));
define('QMMS_CORE_JS',plugins_url( 'assets/js/', __FILE__ ));
/*
*
*  Register CSS
*
*/
function qmms_register_core_css(){
wp_enqueue_style('qmms-core', QMMS_CORE_CSS . 'quick-maintenance-mode-sht.css',null,time(),'all');
};
add_action( 'wp_enqueue_scripts', 'qmms_register_core_css' );    
/*
*
*  Register JS/Jquery Ready
*
*/
function qmms_register_core_js(){
// Register Core Plugin JS	
wp_enqueue_script('qmms-core', QMMS_CORE_JS . 'quick-maintenance-mode.js','jquery',time(),true);
};
add_action( 'wp_enqueue_scripts', 'qmms_register_core_js' );    
/*
*
*  Includes
*
*/ 
// Load the Functions
if ( file_exists( QMMS_CORE_INC . 'quick-maintenance-mode-functions.php' ) ) {
	require_once QMMS_CORE_INC . 'quick-maintenance-mode-functions.php';
}     

