(function($) {

    jQuery(document).ready(function($) {
        wp.codeEditor.initialize($('#csspreloader_html'), cm_settings);
        wp.codeEditor.initialize($('#csspreloader_css'), cm_settings);
    })

})(jQuery);