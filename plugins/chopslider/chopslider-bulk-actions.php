<?php

global $chopslider_status;
global $chopslider_status_class;
/* ----- Remove Sliders ----- */
if ( $_POST['chopslider-action'] == "delete" ) {
	if ( in_array( "all", $_POST['chopslider-id'] ) ) {
		foreach ( $_POST['chopslider-id'] as $chopslider_id ) {
			if ( $chopslider_id != "all") 
				chopslider_remove_sliders ( $chopslider_id );	
		}
	}
	else {
		foreach ( $_POST['chopslider-id'] as $chopslider_id ) {
			chopslider_remove_sliders ( $chopslider_id );	
		}
	}
}
/* ----- Copy Sliders ----- */
if ( $_POST['chopslider-action'] == "copy" ) {
	if ( in_array( "all", $_POST['chopslider-id'] ) ) {
		foreach ( $_POST['chopslider-id'] as $chopslider_id ) {
			if ( $chopslider_id != "all") 
				chopslider_copy_sliders ( $chopslider_id );	
		}
	}
	else {
		foreach ( $_POST['chopslider-id'] as $chopslider_id ) {
			chopslider_copy_sliders ( $chopslider_id );	
		}
	}	
	
}
function chopslider_copy_sliders ( $chopslider_id ) {
	global $wpdb;
	global $chopslider_status;
	global $chopslider_status_class;
	
	$oldSlider = $wpdb->get_row('SELECT * FROM ' . CHOPSLIDER_TABLE_NAME . ' where chopslider_id =' . $chopslider_id, ARRAY_A);
	unset($oldSlider['chopslider_id']);
	$oldSlider['title'] = $oldSlider['title']." Copy";
	$oldSlider['created'] = current_time('mysql');
	$oldSlider['version'] = 1;
	$newOptions = unserialize($oldSlider['options']);
	$newOptions['title'] = $oldSlider['title'];
	$oldSlider['options'] = serialize ( $newOptions );
	$new_chopslider_row = $wpdb->insert( 
		CHOPSLIDER_TABLE_NAME, 
		$oldSlider 
	);
	if( $new_chopslider_row ) {
		$chopslider_status .= 'Congratulations! New Chop Slider was successfully added!<br/>';
		$chopslider_status_class = 'updated';
		$new_chopslider_ID = $wpdb->get_var(
			"
			SELECT MAX(chopslider_id) from " . CHOPSLIDER_TABLE_NAME . "
			"
		);
		//And build aprropriate files and scripts
		chopslider_build_script_files($new_chopslider_ID);
	}
	else {
		$chopslider_status .= 'Error occured while adding new Chop Slider!<br/>';
		$chopslider_status_class = 'error';
	};
		
}

function chopslider_remove_sliders ( $chopslider_id ) {
	global $wpdb;
	global $chopslider_status;
	global $chopslider_status_class;
	$delete_chopslider = $wpdb->query(
		"
		DELETE FROM " . CHOPSLIDER_TABLE_NAME . " 
		WHERE chopslider_id = '" . $chopslider_id . "'
		"
	);
	if( $delete_chopslider ) {
		 $chopslider_status .= 'Chop Slider ID "' . $chopslider_id . '" was successfully removed! <br />';
		$chopslider_status_class = 'updated';
	}
	else {
		$chopslider_status .= 'Error occured while removing Chop Slider ID "' . $chopslider_id . '" ! Seems to be you are trying to remove already removed Chop Slider! <br />';
		$chopslider_status_class = 'error';
		return;
	};
	$wpdb->flush();
	unlink( dirname( __FILE__ ) . '/scripts/chopslider-' . $chopslider_id . '.js' );
	unlink( dirname( __FILE__ ) . '/scripts/chopslider-' . $chopslider_id . '.php' );
	unlink( dirname( __FILE__ ) . '/css/chopslider-' . $chopslider_id . '.css' );
}
?>