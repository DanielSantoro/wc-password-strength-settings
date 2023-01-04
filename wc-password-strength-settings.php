<?php
/*
 Plugin Name: Password Strength Settings for WooCommerce
 Plugin URI: https://danielsantoro.com/project/woocommerce-password-strength-settings-plugin
 Description: Allows administrators to set the required password strength for new accounts, change messaging and display options, or disable requirements entirely from the "WooCommerce &rsaquo; Settings &rsaquo; Accounts & Privacy" menu.
 Author: Daniel Santoro
 Author URI: https://danielsantoro.com
 Version: 3.0.0
 License: GPLv2 or later
 Text Domain: wc-password-strength-settings
 Domain Path: /languages
 WC requires at least: 5.5
 WC tested up to: 6.7.1
 */

/**
 * Plugin Definitions
 * 
 * @package Password Strength Settings for WooCommerce
 * @since 1.2.0
 */
if( !defined( 'WCPSS_DIR' ) ) {
  define( 'WCPSS_DIR', dirname( __FILE__ ) );           // Plugin directory
}
if( !defined( 'WCPSS_VERSION' ) ) {
  define( 'WCPSS_VERSION', '2.2.2' );                   // Plugin Version
}
if( !defined( 'WCPSS_URL' ) ) {
  define( 'WCPSS_URL', plugin_dir_url( __FILE__ ) );    // Plugin URL
}
if( !defined( 'WCPSS_INC_DIR' ) ) {
  define( 'WCPSS_INC_DIR', WCPSS_DIR.'/includes' );     // Plugin 'include' directory
}
if( !defined( 'WCPSS_INC_URL' ) ) {
  define( 'WCPSS_INC_URL', WCPSS_URL.'includes' );      // Plugin 'include' directory URL
}
if( !defined( 'WCPSS_ADMIN_DIR' ) ) {
  define( 'WCPSS_ADMIN_DIR', WCPSS_INC_DIR.'/admin' );  // Plugin 'admin' directory
}
if(!defined('WCPSS_PREFIX')) {
  define('WCPSS_PREFIX', 'WCPSS');                      // Plugin Prefix
}
if(!defined('WCPSS_VAR_PREFIX')) {
  define('WCPSS_VAR_PREFIX', '_WCPSS_');                // Variable Prefix
}

/**
 * Add then print additional links to the plugin meta row
 */
function wcpss_plugin_meta_links( $links, $file ) {
	if ( $file === 'wc-password-strength-settings/wc-password-strength-settings.php' ) {
		$links[] = '<a href="https://github.com/DanielSantoro/wc-password-strength-settings/wiki/" target="_blank" title="Read the Documentation"><span class="dashicons dashicons-info"></span> Documentation</a>';
    $links[] = '<a href="https://danielsantoro.com/support/?utm_source=pw-strength-plugin&utm_medium=plugin-overview-link" target="_blank" title="Contact Support"><span class="dashicons dashicons-editor-help"></span> Support</a>';
	}
	return $links;
}
add_filter( 'plugin_row_meta', 'wcpss_plugin_meta_links', 10, 2 );


/**
 * Activation & Deactivation Hooks
 */
register_activation_hook( __FILE__, 'wcpss_install' );

function wcpss_install(){
  
};

register_deactivation_hook( __FILE__, 'wcpss_uninstall');

function wcpss_uninstall(){
  
};

/**
 * Make Translation Ready
 */
function wcpss_plugin_init() {
  load_plugin_textdomain( 'wc-password-strength-settings', false, 'wc-password-strength-settings/languages' );
}
add_action('init', 'wcpss_plugin_init');

/**
 * Global Class
 */
global $wcpss_admin;

/**
 * Administration Panel Class
 */
include_once( WCPSS_ADMIN_DIR.'/class-wcpss-admin.php' );
$wcpss_admin = new wcpss_Admin();
$wcpss_admin->add_hooks();

/**
 * Enforce Password Strength
 */
add_filter('woocommerce_min_password_strength','wcpss_change_password_strength',30);
function wcpss_change_password_strength() {
    $strength=get_option( 'woocommerce_myaccount_password_strength', null );
    return intval($strength);
    
};

/**
 * Change Password Hint Text based on User Input
 */
add_filter( 'password_hint', 'wcpss_change_password_hint' );
function wcpss_change_password_hint( $hint ) {
  
  $disable_hint_text  = get_option( 'woocommerce_disable_hint_text' );
  if( !empty( $disable_hint_text ) ) {
    $woocommerce_hint_text  = get_option( 'woocommerce_hint_text' );
    $hint = $woocommerce_hint_text;
  }
  return $hint;
};

/** 
 * Display Custom Messaging
 */
add_action( 'wp_enqueue_scripts',  'wcpss_load_scripts',99 );
function wcpss_load_scripts() {
    wp_localize_script( 'wc-password-strength-meter', 'pwsL10n', array(
        'empty' => __( get_option( 'woocommerce_password_strength_label_1', null ) ),
        'short' => __( get_option( 'woocommerce_password_strength_label_2', null ) ),
        'bad' => __( get_option( 'woocommerce_password_strength_label_3', null ) ),
        'good' => __( get_option( 'woocommerce_password_strength_label_4', null ) ),
        'strong' => __( get_option( 'woocommerce_password_strength_label_5', null ) ),
        'mismatch' => __( 'Your passwords do not match, please re-enter them.' )
    ) );
};

// add plugin upgrade notification
add_action('in_plugin_update_message-wc-password-strength-settings/wc-password-strength-settings.php', 'wcpss_showUpgradeNotification', 10, 2);

function wcpss_showUpgradeNotification($currentPluginMetadata, $newPluginMetadata){
   // check "upgrade_notice"
   if (isset($newPluginMetadata->upgrade_notice) && strlen(trim($newPluginMetadata->upgrade_notice)) > 0){
        echo esc_html( '<p style="background-color: #e2e3e5; padding: 10px; color: #383d41; margin-top: 10px; border: thin solid #d6d8db;"><strong>Update Notice:</strong>' );
        echo esc_html($newPluginMetadata->upgrade_notice);
        echo esc_html( '</p>' );
   }
}
