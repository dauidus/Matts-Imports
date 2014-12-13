<?php
/* ----- Function to remove Chop Slider ----- */
global $chopslider_status;
global $chopslider_status_class;
chopslider_remove_slider( $_GET['remove_chopslider'] );
function chopslider_remove_slider ( $chopslider_id ) {
	global $wpdb;
	global $chopslider_status;
	global $chopslider_status_class;
	$delete_chopslider = $wpdb->query(
		"
		DELETE FROM " . CHOPSLIDER_TABLE_NAME . " 
		WHERE chopslider_id = '" . $_GET['remove_chopslider'] . "'
		"
	);
	if( $delete_chopslider ) {
		 $chopslider_status = 'Chop Slider ID "' . $_GET['remove_chopslider'] . '" was successfully removed!';
		$chopslider_status_class = 'updated';
	}
	else {
		$chopslider_status = 'Error occured while removing Chop Slider ID "' . $_GET['remove_chopslider'] . '" ! Seems to be you are trying to remove already removed Chop Slider!';
		$chopslider_status_class = 'error';
		return;
	};
	unlink( dirname( __FILE__ ) . '/scripts/chopslider-' . $chopslider_id . '.js' );
	unlink( dirname( __FILE__ ) . '/scripts/chopslider-' . $chopslider_id . '.php' );
	unlink( dirname( __FILE__ ) . '/css/chopslider-' . $chopslider_id . '.css' );
}
?>