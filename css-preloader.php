<?php
/*
Plugin Name: Css Only Preloader
Plugin URI: http://dopetheme.com
Description: Add Css Only Preloader to your WordPress website easily.
Version: 1.0
Author: Fahem Ahmed
Author URI: http://f4h3m.com
License: GPLv2 or later
Text Domain: cssonly-preloader
Domain Path: /languages/
*/


// Load Require File

require_once('options/options.php');


// Load Textdomain

function slideup_load_textdomain()
{
    load_plugin_textdomain("cssonly-preloader", false, dirname(__FILE__) . "/languages");
}
add_action("plugins_loaded", "slideup_load_textdomain");


// Add Settings Page Link to Plugin Name bellow

function my_plugin_action_links( $links ) {
    $links = array_merge( array(
        '<a href="' . esc_url( admin_url( '/options-general.php?page=csspreloader' ) ) . '">' . __( 'Settings', 'cssonly-preloader' ) . '</a>'
    ), $links );
    return $links;
}
add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'my_plugin_action_links' );


// Enqueue Assets

function cssPreload_loadassets(){
    wp_enqueue_style("cssPreload-css", plugins_url('/assets/css/cssPreload.css', __FILE__));
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script('cssPreload-js', plugins_url('/assets/js/cssPreload.js', __FILE__), 'jquery', 1.0, true);
}
add_action("wp_enqueue_scripts", "cssPreload_loadassets");


// Enqueue Admin Specific Assets

function cssPreloader_backend_enqueue($screen){
    if('settings_page_csspreloader' == $screen){
        wp_enqueue_script('cssPreloadbackend-js', plugins_url('/assets/js/cssPreload-backend.js', __FILE__));
        $cm_settings['codeEditor'] = wp_enqueue_code_editor(array('type' => 'text/css','type' => 'html' ));
        wp_localize_script('jquery', 'cm_settings', $cm_settings);
        wp_enqueue_script('wp-theme-plugin-editor');
        wp_enqueue_style('wp-codemirror');
    }
}
add_action("admin_enqueue_scripts", "cssPreloader_backend_enqueue");


// Load Preloader Markup

function cssPreload_loadmarkup(){
        if(get_option('csspreloader_html')&& get_option('csspreloader_css')){
    ?>
    <!--  Start Preloader markup  -->
    <div class="preloader-area">
        <div class="preloader-wrap">
            <?php echo get_option('csspreloader_html');?>
        </div>
    </div>
    <!--  End Preloader markup  -->
<?php  }}
add_action("wp_footer", "cssPreload_loadmarkup");

// Load Preloader Css

function cssPreload_laodstyle(){
    if(get_option('csspreloader_html')&& get_option('csspreloader_css')) {?>
        <!--   Start Preloader Css  -->
        <style type="text/css" id="preload-css">
            <?php  echo get_option('csspreloader_css');?>
        </style>
        <!--   End Preloader Css  -->
    <?php }
}
add_action("wp_head","cssPreload_laodstyle");