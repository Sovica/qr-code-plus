<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://kopamnos.com
 * @since      1.0.0
 *
 * @package    Qr_Code_Plus
 * @subpackage Qr_Code_Plus/admin/partials
 */
?>

<div class="wrap">
    <h2><?php esc_attr_e( 'Qr Code Plus Settings', 'wp_admin_style' ); ?></h2>
    <form method="post" name="qrplus_options" action="options.php">
        
         <?php 
            $options = get_option($this->plugin_name);
            $qr_size = $options['qr_size'];
            $qr_text = $options['qr_text'];
            $qr_color = $options['qr_color'];
            $qr_render = $options['qr_render'];
            $qr_radius = $options['qr_radius'];
            $qr_ecLevel = $options['qr_ecLevel'];
            $qr_quiet = $options['qr_quiet'];
            settings_fields($this->plugin_name); 
            do_settings_sections($this->plugin_name);
         ?>
         
        <fieldset>
            <p><b>Input your default Qr code size in pixels:</b></p>
            <legend class="screen-reader-text"><span><?php _e('Input your default Qr code size in pixels:', $this->plugin_name);?></span></legend>
            <input type="number" class="regular-text" name="<?php echo $this->plugin_name; ?>[qr_size]" value="<?php if(!empty($qr_size)) echo $qr_size;?>"/>
        </fieldset>
        
         <fieldset>
            <p><b>Input default text for QR code content. If left empty your <a href="https://codex.wordpress.org/Using_Permalinks" target="_blank">permalinks</a> will be used.</b></p>
            <legend class="screen-reader-text"><span><?php _e('Input default text for QR code content. If left empty your permalinks will be used.', $this->plugin_name);?></span></legend>
            <input type="text" class="regular-text" name="<?php echo $this->plugin_name; ?>[qr_text]" value="<?php if(!empty($qr_text)) echo $qr_text;?>"/>
        </fieldset>
        
		<fieldset>
		 <p><b>Choose your Qr code renderer method below.</b></p>
			<legend class="screen-reader-text"><span><?php _e('Select your Qr code renderer method', $this->plugin_name);?></span></legend>
				<label><input type="radio" name="<?php echo $this->plugin_name; ?>[qr_render]" value="canvas"<?php checked( 'canvas' == $qr_render ); ?> /> <?php _e( 'Use canvas to render your Qr codes. (Recommended method)', $this->plugin_name ); ?></label><br />
				<label><input type="radio" name="<?php echo $this->plugin_name; ?>[qr_render]" value="image"<?php checked( 'image' == $qr_render ); ?> />	<?php _e( 'Use an image tag to render your Qr codes.', $this->plugin_name ); ?></label><br />
				<label><input type="radio" name="<?php echo $this->plugin_name; ?>[qr_render]" value="div"<?php checked( 'div' == $qr_render ); ?> />	<?php _e( 'Use a DIV tag to render your Qr codes. Use this only if you want to support older browsers.', $this->plugin_name ); ?></label><br />
			</legend>
		</fieldset>
        
        <fieldset>
            <p><b>Select your Qr code color:</b></p>
            <legend class="screen-reader-text"><span><?php _e('Select your Qr code color:', $this->plugin_name);?></span></legend>
            <input type="text" value="<?php echo $qr_color;?>" name="<?php echo $this->plugin_name; ?>[qr_color]" class="my-color-field" data-default-color="#effeff" />
        </fieldset>
        
        <br />
        
        <fieldset>
            <legend class="screen-reader-text"><span><?php _e('Select corner radius for QR code edges.', $this->plugin_name);?></span></legend>
                <select name="<?php echo $this->plugin_name; ?>[qr_radius]" id="qrplus-radius">
                      <option value="0" <?php selected( $qr_radius, 0 ); ?> >0</option>
                      <option value="1" <?php selected( $qr_radius, 1 ); ?> >1</option>
                      <option value="2" <?php selected( $qr_radius, 2 ); ?> >2</option>
                      <option value="3" <?php selected( $qr_radius, 3 ); ?> >3</option>
                      <option value="4" <?php selected( $qr_radius, 4 ); ?> >4</option>
                      <option value="5" <?php selected( $qr_radius, 5 ); ?> >5</option>
                </select>
            </legend>
            <label><?php _e( 'Select corner radius for QR code edges. 0 - no radius. 5 - Large radius.', $this->plugin_name ); ?></label>
         </fieldset>

        <fieldset>
            <input type="hidden" name="<?php echo $this->plugin_name; ?>[qr_ecLevel]" value="<?php if(!empty($qr_ecLevel)) echo $qr_ecLevel;?>"/>
            <input type="hidden" name="<?php echo $this->plugin_name; ?>[qr_quiet]" value="<?php if(!empty($qr_quiet)) echo $qr_quiet;?>"/>
        </fieldset>

        <?php submit_button(__('Save all changes', $this->plugin_name), 'primary','submit', TRUE); ?>
    </form>
</div>