<?php 
/*
Plugin Name: Quick Maintenance Mode
Plugin URI: https://qmms.devlloplugins.com
Description: Use this plugin to show a preview of your book content. This plugin integrates seamlessly into the standard Woocommerce experience, enabling customers to preview what they are buying before purchasing to avoid unnecessary disappointment.
Version: 0.1
Author: Devllo
Author URI: https://devlloplugins.com/
Text Domain: qmms
*/

// If this file is called directly, abort. //
if ( ! defined( 'WPINC' ) ) {die;} // end if

// Let's Initialize Everything
function ng_maintenance_mode() {
	global $pagenow;
	if ( $pagenow !== 'wp-login.php' && ! current_user_can( 'manage_options' ) && ! is_admin() ) {
		header( $_SERVER["SERVER_PROTOCOL"] . ' 503 Service Temporarily Unavailable', true, 503 );
		header( 'Content-Type: text/html; charset=utf-8' );
        if ( file_exists( plugin_dir_path( __FILE__ ) . 'quick-maintenance-mode-init.php' ) ) {
            require_once( plugin_dir_path( __FILE__ ) . 'quick-maintenance-mode-init.php' );
            }
            die();	}
}

add_action( 'wp_loaded', 'ng_maintenance_mode' );




register_activation_hook(   __FILE__, array( 'qmms_CLEANUP_NEW_CONTENT', 'on_activation' ) );
register_deactivation_hook( __FILE__, array( 'qmms_CLEANUP_NEW_CONTENT', 'on_deactivation' ) );

add_action( 'plugins_loaded', array( 'qmms_CLEANUP_NEW_CONTENT', 'init' ) );
class qmms_CLEANUP_NEW_CONTENT
{
    protected static $instance;

    public static function init()
    {
        is_null( self::$instance ) AND self::$instance = new self;
        return self::$instance;
    }

    public static function on_activation()
    {
    if ( ! current_user_can( 'activate_plugins' ) )
            return;
        $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
        check_admin_referer( "activate-plugin_{$plugin}" );
        
    }

    public static function on_deactivation()
    {
        if ( ! current_user_can( 'activate_plugins' ) )
            return;
        $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
        check_admin_referer( "deactivate-plugin_{$plugin}" );

    }


    public function __construct()
    {
        # INIT the plugin: Hook your callbacks
    }
    
}