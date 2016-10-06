<?php

/**
 * Widget functionality of the plugin
 *
 * @link       http://kopamnos.com
 * @since      1.0.0
 *
 * @package    Qr_Code_Plus
 * @subpackage Qr_Code_Plus/admin
 */

class Qr_Code_Plus_Widget extends WP_Widget {
	
	protected $defaults;

	public function __construct() {

		// No way to pass dynamically yet :(
		$this->plugin_name = 'qr-code-plus';
		$options = get_option($this->plugin_name);
		
		$this->defaults = array(
			'size'          => $options['qr_size'],
			'text'	     => $options['qr_text'],
			'render'           => $options['qr_render'],
			'color'           => $options['qr_color'],
			'radius'    => $options['qr_radius'],
			'ecLevel'       => $options['qr_ecLevel'],
			'quiet'           => $options['qr_quiet']
		);
		
		$widget_ops = array( 
			'classname' => 'qrplus_widget',
			'description' => 'Insert QR codes using this widget.',
		);
		parent::__construct( 'qrplus_widget', 'Qr Code Plus Widget', $widget_ops );
		
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
	
	// Frontend rendering for the QR widget
	public function widget( $args, $instance ) {
		
		wp_enqueue_script('Qr_Code_Plus_Widget', plugin_dir_url(  dirname(__FILE__) ) . 'public/js/qr-code-plus-public.js', array('jquery'), '1.0', true);
		
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		global $wp;
		$current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
		
		if ($instance['text'] == '' || empty($instance['text'])){
			$instance['text'] = $current_url;
		}
		$instance['radius'] = $instance['radius']/10;
		$version = $this->qrplus_calculateversion($instance['text']);
		
		STATIC $j = 0;
		$j++;
		
		$output='';
		
		// Output QR embed code 
		$output .= '<div class="qrplus_container" id="qrcode__'.$j.'">';
		$output .= '</div>';
		$output .= '<script>jQuery(document).ready(function(){jQuery("#qrcode__'.$j.'").qrcode({';
		$output .= 'render: "'.$instance['render'].'",';
		$output .= 'size: '.$instance['size'].',';
		$output .= 'fill: "'.$instance['color'].'",';
		$output .= 'minVersion: '.$version.',';
		$output .= 'mode: 0,';
		$output .= 'ecLevel: "'.$instance['ecLevel'].'",';
		$output .= 'quiet: '.$instance['quiet'].',';
		$output .= 'radius: '.$instance['radius'].',';
		$output .= 'text: "'.$instance['text'].'"';
		$output .= '});});</script>';
	    echo $output;
	    
	}
			
	// Admin area of QR widget
	public function form( $instance ) {
		
		$instance = wp_parse_args( (array) $instance, $this->defaults );
		
		?>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>"><?php _e( 'Input your default Qr code size in pixels:', $this->plugin_name ); ?>:</label>
			<input type="number" id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>" value="<?php echo esc_attr( $instance['size'] ); ?>" class="widefat" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php _e( 'Input default text for QR code content. If left empty your permalinks will be used.', $this->plugin_name ); ?>:</label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" value="<?php echo esc_attr( $instance['text'] ); ?>" class="widefat" />
		</p>
		
		<fieldset>
			<legend><?php _e( 'Choose your Qr code renderer method below.', $this->plugin_name ); ?></legend>
			<p>
																								
				<label><input type="radio" name="<?php echo esc_attr( $this->get_field_name( 'render' ) ); ?>" value="canvas"<?php checked( 'canvas' == $instance['render'] ); ?> /> <?php _e( 'Use canvas to render your Qr codes.', $this->plugin_name ); ?></label><br />
				<label><input type="radio" name="<?php echo esc_attr( $this->get_field_name( 'render' ) ); ?>" value="image"<?php checked( 'image' == $instance['render'] ); ?> />	<?php _e( 'Use an image tag to render your Qr codes.', $this->plugin_name ); ?></label><br />
				<label><input type="radio" name="<?php echo esc_attr( $this->get_field_name( 'render' ) ); ?>" value="div"<?php checked( 'div' == $instance['render'] ); ?> />	<?php _e( 'Use a DIV tag to render your Qr codes.', $this->plugin_name ); ?></label><br />
			</p>
		</fieldset>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'color' ) ); ?>"><?php _e( 'Input HEX value for Qr code color:', $this->plugin_name ); ?></label>
			<input type="text" maxlength="7" id="<?php echo esc_attr( $this->get_field_id( 'color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'color' ) ); ?>" value="<?php echo esc_attr( $instance['color'] ); ?>" class="widefat" />
		</p>
		
		<fieldset>
            <legend class="screen-reader-text"><span><?php _e('Select corner radius for QR code edges.', $this->plugin_name);?></span></legend>
                <select name="<?php echo esc_attr( $this->get_field_name( 'radius' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'radius' ) ); ?>">
                      <option value="0" <?php selected( $instance['radius'], 0 ); ?> >0</option>
                      <option value="1" <?php selected( $instance['radius'], 1 ); ?> >1</option>
                      <option value="2" <?php selected( $instance['radius'], 2 ); ?> >2</option>
                      <option value="3" <?php selected( $instance['radius'], 3 ); ?> >3</option>
                      <option value="4" <?php selected( $instance['radius'], 4 ); ?> >4</option>
                      <option value="5" <?php selected( $instance['radius'], 5 ); ?> >5</option>
                </select>
            </legend>
            <label><?php _e( 'Select corner radius for QR code edges.', $this->plugin_name ); ?></label>
         </fieldset>
         <br />
		<?php 
	}
		
	public function update( $new_instance, $old_instance ) {

		return $new_instance;

	}
	
	public function qrplus_load_widget() {
		
		register_widget( 'Qr_Code_Plus_Widget' );
		
	}

}


