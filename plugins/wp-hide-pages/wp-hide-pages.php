<?php
/*
Plugin Name: WP Hide Pages
Plugin URI: http://nxsn.com/
Description: Hides selected pages. You can manage this from your admin panel, so you don't need to open template 
codes to add exclude parameter to wp_list_pages function. Essentially it adds exclude parameter to wp_list_pages 
function but it's so easy now. You can manage via admin panel.
Version: 1.0
Author: Huseyin Berberoglu
Author URI: http://nxsn.com
 */
add_filter('wp_list_pages_excludes', 'wphp_list_pages_excludes',1);
function wphp_list_pages_excludes( $exclude_array ) {
    $wphp_options = get_option('wphp_options');
    $wphp_exclude = $wphp_options['excluded'];
    $wphp_array = ( $wphp_exclude ) ? explode(',', $wphp_exclude) : array();
    $exclude_array = array_merge( $exclude_array, $wphp_array );
    return $exclude_array;
}

/* for admin page */
function wphp_config() { include('wphp-admin.php'); }
function wphp_config_page() {
    if ( function_exists('add_submenu_page') )
        add_options_page(__('Hide Pages'), __('Hide Pages'), 'manage_options', 'wp-hide-pages', 'wphp_config');
}
add_action('admin_menu', 'wphp_config_page');
/* eof for admin page */
?>
