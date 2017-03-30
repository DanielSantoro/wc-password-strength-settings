<?php
/*
 Plugin Name: WC Password Strength Settings
 Plugin URI: https://github.com/DanielSantoro/wc-password-strength-settings
 Description: Allows administrators to set the required password strength or disable it entirely from the WooCommerce Accounts menu.
 Author: Daniel Santoro
 Author URI: http://danielsantoro.com
 Version: 1.0.2
 License: GPLv2 or later
 */

load_plugin_textdomain( 'wc-password-strength-settings', false, 'wc-password-strength-settings/languages/' );

add_filter('woocommerce_get_settings_account','ds_woo_account_setting');
function ds_woo_account_setting( $settings ) {
    $settings[] = array( 'title' => __( 'User Password Strength Settings', 'wc-password-strength-settings' ), 'type' => 'title', 'id' => 'account_password_options' );
    $settings[] = array(
                'title'    => __( 'Strength Requirement', 'wc-password-strength-settings' ),
                'desc'     => __( 'Select the minimum strength of your user passwords. Level 4 = Default.', 'wc-password-strength-settings' ) ,
                'id'       => 'woocommerce_myaccount_password_strength',
                'type'     => 'select',
                'default'  => 3,
                'class'    => 'wc-enhanced-select',
                'css'      => 'min-width:300px;',
                'desc_tip' => true,
                'options'  => array(
                    '0' => __( 'Level 1 - Anything', 'wc-password-strength-settings' ),
                    '1' => __( 'Level 2 - Weakest', 'wc-password-strength-settings' ),
                    '2' => __( 'Level 3 - Weak', 'wc-password-strength-settings' ),
                    '3' => __( 'Level 4 - Medium', 'wc-password-strength-settings' ),
                    '4' => __( 'Level 5 - Strong', 'wc-password-strength-settings' )
                )
            );
    $settings[] = array( 'type' => 'sectionend', 'id' => 'account_password_options' );

    return $settings;
}

add_filter('woocommerce_min_password_strength', 'ds_change_password_strength', 30);
function ds_change_password_strength() {
    $strength = get_option( 'woocommerce_myaccount_password_strength', 3 );

    return intval($strength);
}
