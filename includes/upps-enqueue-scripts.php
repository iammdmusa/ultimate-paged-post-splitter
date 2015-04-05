<?php
/**
 * Created by PhpStorm.
 * User: Md.Musa
 * Date: 2/14/2015
 * Time: 9:08 PM
 */

//Enqueue Scripts and Styles
function ultimate_paged_post_scripts() {
    if(is_single() || is_page() ){
        wp_enqueue_script('jquery');
        $plugin_url = plugins_url('ultimate-paged-post-splitter');
        wp_enqueue_script('jquery-upps',$plugin_url . '/assets/js/upps-scripts.js' , 'jquery', '', true);
        $upps_options_array = array( 'scroll_up' => get_option( 'upps_scroll_up') );
        wp_localize_script( 'jquery-upps', 'upps_options_object', $upps_options_array );
        if(get_option( 'upps_style_sheet')){
            wp_enqueue_style('upps-style',$plugin_url . '/assets/css/upps-style.css');
        }
    }
}

add_action( 'wp_enqueue_scripts', 'ultimate_paged_post_scripts' ); // wp_enqueue_scripts action hook to link only on the front-end

function upps_admin_enqueue_script() {
    $plugin_url = plugins_url('ultimate-paged-post-splitter');
    wp_enqueue_style('mdc-chosen-main', $plugin_url . '/assets/css/upps-admin-style.css');
}

add_action('admin_enqueue_scripts', 'upps_admin_enqueue_script');