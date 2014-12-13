<?php
/* We need to remove the Chop Slider's table on uninstallation */
if(!defined ( 'WP_UNINSTALL_PLUGIN' ) ) exit();
$removeDB = get_option('chopslider-settings');
if ($removeDB['remove_db']==1) {
	global $wpdb;
	$chopsliderTableName = $wpdb->prefix . "chopslider";
	$sql = "DROP TABLE " . $chopsliderTableName;
	$wpdb->query($sql);
	delete_option('chopslider-settings');
}
?>