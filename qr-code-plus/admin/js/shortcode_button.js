jQuery(document).ready(function($) {

    tinymce.create('tinymce.plugins.qrplus_plugin', {
        init : function(ed, url) {
                // Register command for when button is clicked
                ed.addCommand('qrplus_insert_shortcode', function() {
                  
                        content =  '[qrplus_code]';


                    tinymce.execCommand('mceInsertContent', false, content);
                });

            // Register buttons - trigger above command when clicked
             ed.addButton('qrplus_button', {title : 'Insert shortcode', cmd : 'qrplus_insert_shortcode', image: url + '/qr_code.png' });
        },   
    });

    // Register our TinyMCE plugin
    // first parameter is the button ID1
    // second parameter must match the first parameter of the tinymce.create() function above
    tinymce.PluginManager.add('qrplus_button', tinymce.plugins.qrplus_plugin);
});