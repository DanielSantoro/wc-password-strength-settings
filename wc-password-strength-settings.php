<?php
/*
 Plugin Name: WC Password Strength Settings
 Plugin URI: https://github.com/DanielSantoro/wc-password-strength-settings
 Description: Allows administrators to set the required password strength or disable it entirely from the WooCommerce Accounts menu.
 Author: Daniel Santoro
 Author URI: http://danielsantoro.com
 Version: 1.0.1
 License: GPLv2 or later
 */
add_filter( 'woocommerce_get_settings_account','ds_woo_account_setting' );
function ds_woo_account_setting($settings) {
    $settings[]=array( 'title' => __( 'User Password Strength Settings', 'woocommerce' ), 'type' => 'title', 'id' => 'account_password_options' );
    $settings[]=array(
                'title'    => __( 'Strength Requirement', 'woocommerce' ),
                'desc'     => __( 'Select the minimum strength of your user passwords. Level 4 = Default.', 'woocommerce' ),
                'id'       => 'woocommerce_myaccount_password_strength',
                'type'     => 'select',
                'default'  => '',
                'class'    => 'wc-enhanced-select',
                'css'      => 'min-width:350px;',
                'desc_tip' => true,
                'options'  =>array(
                    '0'=>__( 'Level 1 - Anything (disables password requirement)', 'woocommerce' ),
                    '1'=>__( 'Level 2 - Weakest', 'woocommerce' ),
                    '2'=>__( 'Level 3 - Weak', 'woocommerce' ),
                    '3'=>__( 'Level 4 - Medium', 'woocommerce' ),
                    '4'=>__( 'Level 5 - Strong', 'woocommerce' ),
                ),
            );

    $settings[]=array(
				'title'    => __( 'Very weak password label', 'woocommerce' ),
				'desc'     => __( 'Set label for very weak password', 'woocommerce' ),
				'id'       => 'woocommerce_password_strength_label_2',
				'type'     => 'text',
				'css'      => 'min-width:350px;',
				'placeholder'  => 'Password Strength: Very Weak',
				'desc_tip' => true,
			);

    $settings[]=array(
				'title'    => __( 'Weak password label', 'woocommerce' ),
				'desc'     => __( 'Set Label for weak password', 'woocommerce' ),
				'id'       => 'woocommerce_password_strength_label_3',
				'type'     => 'text',
				'css'      => 'min-width:350px;',
				'placeholder'  => 'Password Strength: Weak',
				'desc_tip' => true,
			);

    $settings[]=array(
				'title'    => __( 'Medium password label', 'woocommerce' ),
				'desc'     => __( 'Set Label for medium password', 'woocommerce' ),
				'id'       => 'woocommerce_password_strength_label_4',
				'type'     => 'text',
				'css'      => 'min-width:350px;',
				'placeholder'  => 'Password Strength: Medium',
				'desc_tip' => true,
			);

    $settings[]=array(
				'title'    => __( 'Strong password label', 'woocommerce' ),
				'desc'     => __( 'Set Label for strong password', 'woocommerce' ),
				'id'       => 'woocommerce_password_strength_label_5',
				'type'     => 'text',
				'css'      => 'min-width:350px;',
				'placeholder'  => 'Password Strength: Strong',
				'desc_tip' => true,
			);

        $settings[]=array(
				'title'    => __( 'Password error', 'woocommerce' ),
				'desc'     => __( 'Set password error message', 'woocommerce' ),
				'id'       => 'woocommerce_password_error',
				'type'     => 'text',
				'css'      => 'min-width:350px;',
				'placeholder'  => 'Please enter a stronger password.',
				'desc_tip'  => true,
			);

        $settings[]=array(
				'title'    => __( 'Password hint', 'woocommerce' ),
				'desc'     => __( 'Set password hint message', 'woocommerce' ),
				'id'       => 'woocommerce_password_hint',
				'type'     => 'text',
				'css'      => 'min-width:350px;',
				'placeholder'  => 'Password should be at least seven characters long.',
				'desc_tip' => true,
			);

    $settings[]=array( 'type' => 'sectionend', 'id' => 'account_password_options' );
    return $settings;
}
add_filter( 'woocommerce_min_password_strength','ds_change_password_strength', 30 );
function ds_change_password_strength() {
    $strength=get_option( 'woocommerce_myaccount_password_strength', null );
    return intval($strength);
    
}
add_action( 'wp_enqueue_scripts',  'ds_load_scripts',99 );
function ds_load_scripts() {
    wp_localize_script( 'wc-password-strength-meter', 'pwsL10n', array(
        'empty' => __( get_option( 'woocommerce_password_strength_label_1', null ) ),
        'short' => __( get_option( 'woocommerce_password_strength_label_2', null ) ),
        'bad' => __( get_option( 'woocommerce_password_strength_label_3', null ) ),
        'good' => __( get_option( 'woocommerce_password_strength_label_4', null ) ),
        'strong' => __( get_option( 'woocommerce_password_strength_label_5', null ) ),
        'mismatch' => __( 'Your passwords do not match, please re-enter them' )
    ) );
}

add_filter( 'wc_password_strength_meter_params', 'ds_strength_meter_custom_strings' );
function ds_strength_meter_custom_strings( $data ) {
    $data_new = array(
        'i18n_password_error'   => esc_attr__( get_option( 'woocommerce_password_error', null ), 'woocommerce' ),
        'i18n_password_hint'    => esc_attr__( get_option( 'woocommerce_password_hint', null ), 'woocommerce' ),
    );

    return array_merge( $data, $data_new );
}
