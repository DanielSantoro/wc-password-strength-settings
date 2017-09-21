<?php
/*
 Plugin Name: WC Password Strength Settings
 Plugin URI: https://danielsantoro.com/project/woocommerce-password-strength-settings-plugin
 Description: Allows administrators to set the required password strength for new accounts, change messaging and display options, or disable requirements entirely from the WooCommerce Accounts menu.
 Author: Daniel Santoro
 Author URI: https://danielsantoro.com
 Version: 2.0.1
 License: GPLv2 or later
 Text Domain: wc-password-strength-settings
 Domain Path: /languages
 WC requires at least: 3.0.0
 WC tested up to: 3.2.0
 */

/**
 * Plugin Definitions
 * 
 * @package WC Password Strength Settings
 * @since 1.2.0
 */
if( !defined( 'WCPSS_DIR' ) ) {
  define( 'WCPSS_DIR', dirname( __FILE__ ) );           // Plugin directory
}
if( !defined( 'WCPSS_VERSION' ) ) {
  define( 'WCPSS_VERSION', '2.0.1' );                   // Plugin Version
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
 * Add custom action links on the plugin screen.
 */
define( 'project_domain', 'https://danielsantoro.com' );
define( 'analytics_source', '?utm_source=pw-strength-plugin&utm_medium=plugin-overview-link' );
define( 'github', 'https://github.com/DanielSantoro/wc-password-strength-settings/' );
function wcpss_add_plugin_links( $links ) {
    $new_links = '<a href="'.github.'wiki/Documentation/" target="_blank">' . __( 'Documentation' ) . '</a>' . ' | ' . '<a href="'.project_domain.'/support/'.analytics_source.'" target="_blank">' . __( 'Support' ) . '</a>';
    array_push( $links, $new_links );
  	return $links;
}
$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'wcpss_add_plugin_links' );


/**
 * Activation & Deactivation Hooks
 */
register_activation_hook( __FILE__, 'wcpss_install' );

function wcpss_install(){
  
}

register_deactivation_hook( __FILE__, 'wcpss_uninstall');

function wcpss_uninstall(){
  
}

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
    
}

/**
 * Change Password Hint Text based on  User Input
 */
add_filter( 'password_hint', 'wcpss_change_password_hint' );
function wcpss_change_password_hint( $hint ) {
  
  $disable_hint_text  = get_option( 'woocommerce_disable_hint_text' );
  if( !empty( $disable_hint_text ) ) {
    $woocommerce_hint_text  = get_option( 'woocommerce_hint_text' );
    $hint = $woocommerce_hint_text;
  }
  return $hint;
}

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
}

/**
 * Localization - Non-functional since 2.0. Needs re-work, legacy code saved as placeholder.
 */

// add_filter( 'wc_password_strength_meter_params', 'wcpss_strength_meter_custom_strings' );
// function wcpss_strength_meter_custom_strings( $data ) {
//     $data_new = array(
//         'i18n_password_error'   => esc_attr__( get_option( 'woocommerce_password_error', null ), 'woocommerce' ),
//         'i18n_password_hint'    => esc_attr__( get_option( 'woocommerce_password_hint', null ), 'woocommerce' ),
//     );
//     return array_merge( $data, $data_new );
// }