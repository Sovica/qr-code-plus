<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://kopamnos.com
 * @since      1.0.0
 *
 * @package    Qr_Code_Plus
 * @subpackage Qr_Code_Plus/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Qr_Code_Plus
 * @subpackage Qr_Code_Plus/public
 * @author     Igor <damic.igor@gmail.com>
 */
 
class Qr_Code_Plus_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->qr_plus_options = get_option($this->plugin_name);
		add_shortcode('qrplus_code', array ( $this, 'qrplus_shortcode') );

	}

	// Dynmically calculate the QR code version needed depending on the content
	private function qrplus_calculateversion ( $fill ){
		
			$charcount = strlen($fill);
			$ranges = ["1"=>[1,25], "2"=>[26,47], "3"=>[48,77], "4"=>[78,114], "5"=>[115,154], "6"=>[155,195], "7"=>[196,224], "8"=>[225,279], "9"=>[280,335], "10"=>[336,395]];
			foreach($ranges as $version => $range){
				if(($range[0] <= $charcount) && ($charcount <= $range[1])){
					return $version;
				}
			}
			
	}
	
	public function qrplus_shortcode( $atts ){

		//Only load the JS file if a shortcode is present. 
		wp_enqueue_script('Qr_Code_Plus_Public', plugin_dir_url(  dirname(__FILE__) ) . 'public/js/qr-code-plus-public.js', array('jquery'), '1.0', true);

		$a = shortcode_atts( array(
		    'size' => $this->qr_plus_options["qr_size"],
		    'fill' => $this->qr_plus_options["qr_color"],
		    'render' => $this->qr_plus_options["qr_render"],
		    'text' => $this->qr_plus_options["qr_text"],
		    'ecLevel' => $this->qr_plus_options["qr_ecLevel"],
		    'quiet' => $this->qr_plus_options["qr_quiet"],
		    'radius' => $this->qr_plus_options["qr_radius"]
		), $atts );
		
		global $wp;
		$current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
		
		if ($a['text'] == '' || empty($a['text'])){
			$a['text'] = $current_url;
		}
		
		$a['radius'] = $a['radius']/10;
		$version = $this->qrplus_calculateversion($a['text']);

		//Add support for multiple shortcodes on a single post/page with different DIV ID's
		STATIC $i = 0;
		$i++;
		
		$output='';
		
		// Output shortcode 
		$output .= '<div class="qrplus_container" id="qrcode_'.$i.'">';
		$output .= '</div>';
		$output .= '<script>jQuery(document).ready(function(){jQuery("#qrcode_'.$i.'").qrcode({';
		$output .= 'render: "'.$a['render'].'",';
		$output .= 'size: '.$a['size'].',';
		$output .= 'fill: "'.$a['fill'].'",';
		$output .= 'minVersion: '.$version.',';
		$output .= 'mode: 0,';
		$output .= 'ecLevel: "'.$a['ecLevel'].'",';
		$output .= 'quiet: '.$a['quiet'].',';
		$output .= 'radius: '.$a['radius'].',';
		$output .= 'text: "'.$a['text'].'"';
		$output .= '});});</script>';
	    return $output;

		}

}