<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * WC Password Strength Admin Panel Class (In Account Settings)
 *
 * @package WC Password Strength Settings
 * @since 2.0.0
 */

class wcpss_Admin {

	//class constructor
	function __construct() {
	}	

	/**
	 * Includes JavaScript File for Settings fields
	 *
	 * @package WC Password Strength Settings
	 * @since 2.0.0
	 */

	public function wcpss_add_required_scripts() {

		if( is_admin() && isset($_GET['page']) && isset($_GET['tab'] ) && $_GET['page'] == 'wc-settings' && $_GET['tab'] == 'account' ){ 

        	// Adds the color picker CSS File
        	wp_enqueue_style( 'wp-color-picker' ); 

        	// Includes jQuery file with WordPress Color Picker dependency
        	wp_enqueue_script( 'wcpss-script-handle', WCPSS_INC_URL.'/wcpss-script.js', array( 'wp-color-picker' ), false, true );
    	}
	}

	public function wcpss_display_settings() {
		
		$woocommerce_level_2 = get_option( 'wcpss_color_2' );
		$woocommerce_level_3 = get_option( 'wcpss_color_3' );
		$woocommerce_level_4 = get_option( 'wcpss_color_4' );
		$woocommerce_level_5 = get_option( 'wcpss_color_5' );
		$wcpss_disable_emoticons = get_option( 'woocommerce_disable_emoticons' );
		// $wcpss_disable_hint_text = get_option( 'woocommerce_disable_hint_text')	
		
		$css ='<style>';
			if( !empty( $woocommerce_level_2 ) ) {
				$css .= '.woocommerce-password-strength.short {color: '.$woocommerce_level_2.'}';
			}
			if( !empty( $woocommerce_level_3 ) ) {
				$css .= '.woocommerce-password-strength.bad {color: '.$woocommerce_level_3.'}';
			}
			if( !empty( $woocommerce_level_4 ) ) {
				$css .= '.woocommerce-password-strength.good {color: '.$woocommerce_level_4.'}';
			}
			if( !empty( $woocommerce_level_5 ) ) {
				$css .= '.woocommerce-password-strength.strong {color: '.$woocommerce_level_5.'}';
			}						
			if(  $wcpss_disable_emoticons = true ) {
				$css .= '.woocommerce-password-strength:after, .woocommerce-password-strength.good:after, .woocommerce-password-strength.strong:after {display: none;}';
			} 
			/* THIS ISN'T REQUIRED, AS THE HINT TEXT WILL NOT DISPLAY IF THE VALUE IS EMPTY
			if( !empty( $wcpss_disable_hint_text ) ) {
				$css .= '.woocommerce-password-hint{display: none;}';
			}*/

		$css .='</style>';
		
		echo $css;
	}
	
	function wcpss_account_options( $settings ) {
		
		$dynamic_settings = array(
    		array(
				'title' => __( 'User Password Strength Settings', 'woocommerce' ), 
				'type' => 'title',
				'class' => 'title',
				'id' => 'account_password_options' 
    		),
			array(
			    'title'    => __( 'Strength Requirement', 'woocommerce' ),
			    'desc'     => __( 'Select the minimum strength of your user passwords. Level 4 = Default.', 'woocommerce' ),
			    'id'       => 'woocommerce_myaccount_password_strength',
			    'type'     => 'select',
			    'default'  => '',
			    'class'    => 'wc-enhanced-select',
			    'css'      => 'min-width:350px;',
			    'desc_tip' => true,
			    'options'  =>array(
			        '0'=>__( 'Level 1 - Anything', 'woocommerce' ),
			        '1'=>__( 'Level 2 - Weakest', 'woocommerce' ),
			        '2'=>__( 'Level 3 - Weak', 'woocommerce' ),
			        '3'=>__( 'Level 4 - Medium', 'woocommerce' ),
			        '4'=>__( 'Level 5 - Strong', 'woocommerce' ),
			    )
			),
			array(
				'title'    => __( 'Level 1 Message', 'woocommerce' ),
				'desc'     => __( 'Usually is not displayed - can be left as-is.', 'woocommerce' ),
				'id'       => 'woocommerce_password_strength_label_1',
				'type'     => 'text',
				'css'      => 'min-width:350px;',
				'default'  => 'empty',
				'placeholder' => 'Please enter a password to use for your account.',
				'desc_tip' => true,
			),
			array(
				'title'    => __( 'Level 2 Message', 'woocommerce' ),
				'desc'     => __( 'Will display when level 2 strength requirements are met.', 'woocommerce' ),
				'id'       => 'woocommerce_password_strength_label_2',
				'type'     => 'text',
				'css'      => 'min-width:350px;',
				'default'  => 'Short: Your password is too short.',
				'placeholder'  => 'Your password is too short.',
				'desc_tip' => true,
			),
			array(
				'title'    => __( 'Level 2 Text Color', 'wcpss' ),				
				'id'       => 'wcpss_color_2',
				'class' => 'color-field',
				'type'     => 'text',
				'desc'		=> __( 'Text color when the password strength hits level 2. Leave blank for default.', 'woocommerce' ),
				'desc_tip'	=>	true,
				'default'	=> '#e2401c',
				'placeholder'	=> ''
			),
			array(
				'title'    => __( 'Level 3 Message', 'woocommerce' ),
				'desc'     => __( 'Will display when level 3 strength requirements are met.', 'woocommerce' ),
				'id'       => 'woocommerce_password_strength_label_3',
				'type'     => 'text',
				'css'      => 'min-width:350px;',
				'default'  => 'Password Strength: Weak',
				'placeholder'  => 'Password Strength: Weak',
				'desc_tip' => true,
			),
			array(
				'title'    => __( 'Level 3 Text Color', 'wcpss' ),				
				'id'       => 'wcpss_color_3',
				'class' => 'color-field',
				'type'     => 'text',
				'desc'		=> __( 'Text color when the password strength hits level 3. Leave blank for default.', 'woocommerce' ),
				'desc_tip'	=>	true,
				'default'	=> '#e2401c',
				'placeholder'	=> ''
			),
			array(
				'title'    => __( 'Level 4 Message', 'woocommerce' ),
				'desc'     => __( 'Will display when level 4 strength requirements are met.', 'woocommerce' ),
				'id'       => 'woocommerce_password_strength_label_4',
				'type'     => 'text',
				'css'      => 'min-width:350px;',
				'default'  => 'Password Strength: OK',
				'placeholder'  => 'Password Strength: OK',
				'desc_tip' => true,
			),
			array(
				'title'    => __( 'Level 4 Text Color', 'wcpss' ),				
				'id'       => 'wcpss_color_4',
				'class' => 'color-field',
				'type'     => 'text',
				'desc'		=> __( 'Text color when the password strength hits level 4. Leave blank for default.', 'woocommerce' ),
				'desc_tip'	=>	true,
				'default'	=> '#3d9cd2',
				'placeholder'	=> ''
			),
			array(
				'title'    => __( 'Level 5 Message', 'woocommerce' ),
				'desc'     => __( 'Will display when level 5 strength requirements are met.', 'woocommerce' ),
				'id'       => 'woocommerce_password_strength_label_5',
				'type'     => 'text',
				'css'      => 'min-width:350px;',
				'default'  => 'Password Strength: Strong',
				'placeholder'  => 'Password Strength: Strong',
				'desc_tip' => true,
			),
			array(
				'title'    => __( 'Level 5 Text Color', 'wcpss' ),				
				'id'       => 'wcpss_color_5',
				'class' => 'color-field',
				'type'     => 'text',
				'desc'		=> __( 'Text color when the password strength hits level 5. Leave blank for default.', 'woocommerce' ),
				'desc_tip'	=>	true,
				'default'	=> '#0f834d',
				'placeholder'	=> ''
			),
			array(
				'title'    => __( 'Error Message', 'woocommerce' ),
				'desc'     => __( 'Will display if there is an error in the user-selected password.', 'woocommerce' ),
				'id'       => 'woocommerce_password_error',
				'type'     => 'text',
				'css'      => 'min-width:350px;',
				'default'  => 'Please try again.',
				'placeholder'  => 'Please try again.',
				'desc_tip'  => true,
			),
			array(
				'title'    => __( 'Error Text Color', 'woocommerce' ),				
				'id'       => 'wcpss_color_error',
				'class' => 'color-field',
				'type'     => 'text',
				'desc'		=> __( 'Text color if there is an error message. Leave blank for default.', 'woocommerce' ),
				'desc_tip'	=>	true,
				'default'	=> '#e2401c',
				'placeholder'	=> ''
			),
			array(
				'title'    => __( "Hint Text (Leave Blank to Disable)", 'woocommerce' ),				
				'id'       => 'woocommerce_hint_text',
				'type'     => 'text',
				'desc'		=> __( 'Text to encourage users to make a stronger password. Will only appear on passwords with a level lower than 4.', 'woocommerce' ),
				'default'	=>	'Hint: The password should be at least twelve characters long. To make it stronger, use upper and lower case letters, numbers, and symbols like ! " ? $ % ^ & ).',
				'placeholder'	=> 'Hint: The password should be at least twelve characters long. To make it stronger, use upper and lower case letters, numbers, and symbols like ! " ? $ % ^ & ).',
				'css'	=> 'min-width:350px;',
				'desc_tip'	=> true,
			),
			// THIS FIELD IS PRESENT, BUT NOT MEANT FOR USER DISPLAY
			// array(
			// 	'title'    => __( 'Disable Hint', 'woocommerce' ),				
			// 	'id'       => 'woocommerce_disable_hint_text',
			// 	'type'     => 'checkbox',
			// 	'desc'	=> __( 'If checked, the hint text will be hidden (even custom hint text).', 'woocommerce' ),
			// 	'desc_tip'	=> true,
			// ),
			array(
				'title'    => __( 'Disable Emoticons', 'woocommerce' ),				
				'id'       => 'woocommerce_disable_emoticons',
				'type'     => 'checkbox',
				'desc'	=> __( 'If checked, the smiley face emoticons will be hidden.', 'woocommerce' ),
				'desc_tip'	=> true,
			),
			array( 'type' => 'sectionend', 'id' => 'account_page_wcpss_options' ),
			
		);
		
		$settings = array_merge( $settings, $dynamic_settings );
		
		return $settings;
	}

	/**
	 * Adding Hooks
	 *
	 * @package WC Password Strength Settings
	 * @since 2.0.0
	 */
	function add_hooks(){		
		
		add_action( 'admin_enqueue_scripts', array( $this, 'wcpss_add_required_scripts' ) );				
		add_filter( 'woocommerce_get_settings_account', array( $this, 'wcpss_account_options' ) );
		add_action( 'wp_head', array( $this,'wcpss_display_settings') );
	}
}