<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://kopamnos.com
 * @since      1.0.0
 *
 * @package    Qr_Code_Plus
 * @subpackage Qr_Code_Plus/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Qr_Code_Plus
 * @subpackage Qr_Code_Plus/admin
 * @author     Igor <damic.igor@gmail.com>
 */
class Qr_Code_Plus_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}
	
	public function add_plugin_admin_menu() {

	    /**
	     * Add a settings page for this plugin to the Settings menu.
	     */
	     
	    add_options_page( 'Qr Code Plus Settings', 'Qr Code Plus', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')
	    );
}

	/**
	* Add settings action link to the plugins page.
	*/
	 
	public function add_action_links( $links ) {

	   $settings_link = array(
	    '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
	   );
	   return array_merge(  $settings_link, $links );
	
	}
	
	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	 
	public function display_plugin_setup_page() {
	    include_once( 'partials/qr-code-plus-admin-display.php' );
	}
	
	public function options_update() {
    	register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
 	}
 	
    public function qrplus_defaults() {
        $defaultOptions = array(
            'qr_size' => 150,
            'qr_color' => '#000000',
            'qr_render' => 'canvas',
            'qr_text' => '',
            'qr_ecLevel' => 'L',
            'qr_quiet' => 1,
            'qr_radius' => 0
        );
        add_option('qr-code-plus', $defaultOptions);
    }
	
	public function validate($input) {
	    // Validate all fields
	    $valid = array();
	    if ( empty($input['qr_size']) ) {
	    	add_settings_error(
                'qr_size',
                'qr_color_texterror',            
                'Please enter a valid QR code size',
                'error'
            );
	    }
	    
	    $valid['qr_size'] = absint($input['qr_size']);
	    $valid['qr_text'] = sanitize_text_field($input['qr_text']);
	    
	    $valid['qr_color'] = (isset($input['qr_color']) && !empty($input['qr_color'])) ? sanitize_text_field($input['qr_color']) : '';
	     if ( !empty($valid['qr_color']) && !preg_match( '/^#[a-f0-9]{6}$/i', $valid['qr_color']  ) ) { // if user insert a HEX color with #
                    add_settings_error(
                            'qr_color',
                            'qr_color_texterror',
                            'Please enter a valid hex value color',
                            'error'
                    );
                }
                
        $valid['qr_render'] = $input['qr_render'];
        $valid['qr_radius'] = absint($input['qr_radius']);
        $valid['qr_ecLevel'] = sanitize_text_field($input['qr_ecLevel']);
        $valid['qr_quiet'] = absint($input['qr_quiet']);
	    return $valid;
	 }
	 
	 function qrplus_enqueue_color_picker( $hook_suffix ) {

		if ($hook_suffix == 'settings_page_qr-code-plus') {
		    wp_enqueue_style( 'wp-color-picker' );
		    wp_enqueue_script('Qr_Code_Plus_Admin', plugin_dir_url(  dirname(__FILE__) ) . 'admin/js/qrplus-colorpicker.js', array('wp-color-picker'), false, true);
		}
	    
	}
	
    //This callback registers our plug-in
    public static function qrplus_register_tinymce_plugin($plugin_array) {
    	
        $plugin_array['qrplus_button'] = plugin_dir_url(  dirname(__FILE__) ) . 'admin/js/shortcode_button.js';
        return $plugin_array;
        
    }

    //This callback adds our button to the toolbar
    public static function qrplus_add_tinymce_button($buttons) {

        $buttons[] = "qrplus_button";
        return $buttons;
        
    } 
    
}

