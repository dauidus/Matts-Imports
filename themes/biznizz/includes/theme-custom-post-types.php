<?php

/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

- WooThemes WooMenu Staff Roles Setup
- WooThemes WooMenu Taxonomy Search Functions

-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* WooThemes Diner Custom Post Types Setup */
/*-----------------------------------------------------------------------------------*/

$includes_path = TEMPLATEPATH . '/includes/custom-post-types/';
require_once ($includes_path . 'custom-post-type-menu.php');		// Menu CPT






/*-----------------------------------------------------------------------------------*/
/* WooThemes WooMenu Staff Roles Setup */
/*-----------------------------------------------------------------------------------*/

//add a new role if it doesnt exist
if ( get_option('woo_staff_user_role_enable') == 'true' ) {
	woo_add_staff_role();
} else {
	//remove user role if exists - woo_diner_staff
	$staff_role = 'woo_diner_staff';
	$existing_role = get_role( $staff_role );
	
	if ( isset( $existing_role ) ) {
		$removed_role = remove_role( $staff_role );
	} 
}

//adds staff role
function woo_add_staff_role() {
	
	$staff_role = 'woo_diner_staff';
	$staff_name = get_option('woo_staff_role_name');
	$theme_staff_role = get_option('woo_staff_role_default');
	$existing_role = get_role( $staff_role );
	
	if ( isset( $existing_role ) ) {
		$role = get_role( $theme_staff_role );
		$staff_capabilities = $role->capabilities;
		$existing_role->capabilities = $staff_capabilities;
		
	} else {
		if ( ($theme_staff_role != '') && ($theme_staff_role != 'Select a Role:') ) {
			//get existing role for theme setting - default is editor
			$role = get_role( $theme_staff_role );
			$staff_capabilities = $role->capabilities;
	
			/* Sanitize the new role, removing any unwanted characters. */
			$new_role = strip_tags( $staff_role );
			$new_role = str_replace( array( '-', ' ', '&nbsp;' ) , '_', $new_role );
			$new_role = preg_replace('/[^A-Za-z0-9_]/', '', $new_role );
			$new_role = strtolower( $new_role );

			/* Sanitize the new role name/label. We just want to strip any tags here. */
			$new_role_name = strip_tags( $staff_name ); // Should we use something like the WP user sanitation method?

			/* Add a new role with the data input. */
			$new_role_added = add_role( $new_role, $new_role_name, $staff_capabilities );
	
		}
	}
}





//add_action( 'show_user_profile', 'woo_staff_extra_profile_fields' );
//add_action( 'edit_user_profile', 'woo_staff_extra_profile_fields' );

//extra user fields output
function woo_staff_extra_profile_fields( $user ) { ?>

	<h3><?php _e('Additional Contact Information', 'woothemes'); ?></h3>

	<table class="form-table">

		<tr>
			<th><label for="contact-number"><?php _e('Contact Number', 'woothemes'); ?></label></th>

			<td>
				<input type="text" name="contact-number" id="contact-number" value="<?php echo esc_attr( get_the_author_meta( 'contact_number', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Please enter your Contact Number', 'woothemes'); ?></span>
			</td>
		</tr>

	</table>
<?php }

add_action( 'personal_options_update', 'woo_staff_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'woo_staff_save_extra_profile_fields' );

//handle save of extra user fields
function woo_staff_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_usermeta( $user_id, 'contact_number', $_POST['contact-number'] );
}

/*-----------------------------------------------------------------------------------*/
/* WooThemes WooMenu Taxonomy Search Functions */
/*-----------------------------------------------------------------------------------*/

//search taxonomies for a match against a search term and returns array of success count
function woo_taxonomy_matches($term_name, $term_id, $post_id = 0, $keyword_to_search = '') {
	$return_array = array();
	$return_array['success'] = false;
	$return_array['keywordcount'] = 0;
	$terms = get_the_terms( $post_id , $term_name );
	$success = false;
	$keyword_count = 0;
	if ($term_id == 0) {
		$success = true;
	}
	$counter = 0;
	// Loop over each item
	if ($terms) {
		foreach( $terms as $term ) {

			if ($term->term_id == $term_id) {
				$success = true;
			}
			if ( $keyword_to_search != '' ) {
				$keyword_count = substr_count( strtolower( $term->name ) , strtolower( $keyword_to_search ) );
				if ( $keyword_count > 0 ) {
					$success = true;
					$counter++;
				}
			} else {
				//If search term is blank
				$location_tax_names =  get_term_by( 'id', $term_id, 'location' );
 				//locations
				if ($location_tax_names) {
					$location_tax_name = $location_tax_names->slug;
					if ($location_tax_name != '') {
						$location_myposts = get_posts('nopaging=true&post_type=woo_menu&location='.$location_tax_name);
						foreach($location_myposts as $location_mypost) {
							if ($location_mypost->ID == $post_id) {
								$success = true;
	        					$counter++;
							} 
						}
					}
				}
			}
		}
	}
	$return_array['success'] = $success;
	if ($counter == 0) {
		$return_array['keywordcount'] = $keyword_count;
	} else { 
		$return_array['keywordcount'] = $counter;
	}
	
	return $return_array;
}


?>