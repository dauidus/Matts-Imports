<?php 

/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

- Custom Post Type - Slides
- Page navigation
- Post Meta

- CPT Info Boxes
- Woo Google Mapping
- Slider Button Shortcode
- Get Post image attachments
- WordPress 3.0 New Features Support

-----------------------------------------------------------------------------------*/





/*-----------------------------------------------------------------------------------*/
/* Page navigation */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('woo_pagenav')) {
	function woo_pagenav() { 
	
		if (function_exists('wp_pagenavi') ) { ?>
	    
	<?php wp_pagenavi(); ?>
	    
		<?php } else { ?>    
	    
			<?php if ( get_next_posts_link() || get_previous_posts_link() ) { ?>
	        
	            <div class="nav-entries">
	                <?php next_posts_link( '<div class="nav-prev fl">'. __( 'Older posts', 'woothemes' ) . '</div>' ); ?>
	                <?php previous_posts_link( '<div class="nav-next fr">'. __( 'Newer posts', 'woothemes' ) . '</div>' ); ?>
	                <div class="fix"></div>
	            </div>	
	        
			<?php } ?>
	    
		<?php }   
	}    
}            	
	




/*-----------------------------------------------------------------------------------*/
/* Post Meta */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('woo_post_meta')) {
	function woo_post_meta( ) {
?>
<p class="post-meta">
    <span class="post-date"><span class="small"><?php _e('Posted on', 'woothemes') ?></span> <?php the_time( get_option( 'date_format' ) ); ?></span>
    <span class="post-author"><span class="small"><?php _e('by', 'woothemes') ?></span> <?php the_author_posts_link(); ?></span>
    <span class="post-category"><span class="small"><?php _e('in', 'woothemes') ?></span> <?php the_category(', ') ?></span>
    <?php edit_post_link( __('{ Edit }', 'woothemes'), '<span class="small">', '</span>' ); ?>
</p>
<?php 
	}
}



/*-----------------------------------------------------------------------------------*/
/* Custom Post Type - Info Boxes */
/*-----------------------------------------------------------------------------------*/

add_action('init', 'woo_add_infoboxes');
function woo_add_infoboxes() 
{
  $labels = array(
    'name' => _x('Mini-Features', 'post type general name', 'woothemes'),
    'singular_name' => _x('Mini-Feature', 'post type singular name', 'woothemes'),
    'add_new' => _x('Add New', 'infobox', 'woothemes'),
    'add_new_item' => __('Add New Mini-Feature', 'woothemes'),
    'edit_item' => __('Edit Mini-Feature', 'woothemes'),
    'new_item' => __('New Mini-Feature', 'woothemes'),
    'view_item' => __('View Mini-Feature', 'woothemes'),
    'search_items' => __('Search Mini-Features', 'woothemes'),
    'not_found' =>  __('No Mini-Features found', 'woothemes'),
    'not_found_in_trash' => __('No Mini-Features found in Trash', 'woothemes'), 
    'parent_item_colon' => ''
  );
  
  $infobox_rewrite = get_option('woo_infobox_rewrite');
  if(empty($infobox_rewrite)) $infobox_rewrite = 'infobox';
  
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => array('slug'=> $infobox_rewrite),
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_icon' => get_template_directory_uri() .'/includes/images/box.png',
    'menu_position' => null,
    'supports' => array('title','editor',/*'author','thumbnail','excerpt','comments'*/)
  ); 
  register_post_type('infobox',$args);
}


/*-----------------------------------------------------------------------------------*/
/* Custom Post Type - Feedback */
/*-----------------------------------------------------------------------------------*/

add_action('init', 'woo_add_feedback');
function woo_add_feedback() 
{
  $labels = array(
    'name' => _x('Feedback', 'post type general name', 'woothemes'),
    'singular_name' => _x('Feedback Item', 'post type singular name', 'woothemes'),
    'add_new' => _x('Add New', 'slide', 'woothemes'),
    'add_new_item' => __('Add New Feedback Item', 'woothemes'),
    'edit_item' => __('Edit Feedback Item', 'woothemes'),
    'new_item' => __('New Feedback Item', 'woothemes'),
    'view_item' => __('View Feedback Item', 'woothemes'),
    'search_items' => __('Search Feedback Items', 'woothemes'),
    'not_found' =>  __('No Feedback Items found', 'woothemes'),
    'not_found_in_trash' => __('No Feedback Items found in Trash', 'woothemes'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => false,
    'publicly_queryable' => true,
	'_builtin' => false,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_icon' => get_template_directory_uri() .'/includes/images/feedback.png',
    'menu_position' => null,
    'supports' => array('title','editor',/*'author','thumbnail','excerpt','comments'*/),
  ); 
  register_post_type('feedback',$args);

}



/*-----------------------------------------------------------------------------------*/
/* Woo Google Mapping */
/*-----------------------------------------------------------------------------------*/

function woo_maps_single_output($args){

	// No More API Key needed
	
	if ( !is_array($args) ) 
		parse_str( $args, $args );
		
	extract($args);	
		
	$map_height = get_option('woo_maps_single_height');
	$featured_w = get_option('woo_home_featured_w');
	$featured_h = get_option('woo_home_featured_h');
	   
	$lang = get_option('woo_maps_directions_locale');
	$locale = '';
	if(!empty($lang)){
		$locale = ',locale :"'.$lang.'"';
	}
	$extra_params = ',{travelMode:G_TRAVEL_MODE_WALKING,avoidHighways:true '.$locale.'}';
	
	if(is_home() OR is_front_page()) { $map_height = get_option('woo_home_featured_h'); }
	if(empty($map_height)) { $map_height = 250;}
	
	if(is_home() && !empty($featured_h) && !empty($featured_w)){
	?>
    <div id="single_map_canvas" style="width:<?php echo $featured_w; ?>px; height: <?php echo $featured_h; ?>px"></div>
    <?php } else { ?> 
    <div id="single_map_canvas" style="width:100%; height: <?php echo $map_height; ?>px"></div>
    <?php } ?>
    <script src="<?php bloginfo('template_url'); ?>/includes/js/markers.js" type="text/javascript"></script>
    <script type="text/javascript">
		jQuery(document).ready(function(){
			function initialize() {
				
				
			<?php if($streetview == 'on'){ ?>

				var location = new google.maps.LatLng(<?php echo $lat; ?>,<?php echo $long; ?>);
				
				<?php 
				// Set defaults if no value
				if ($yaw == '') { $yaw = 20; }
				if ($pitch == '') { $pitch = -20; }
				?>
				
				var panoramaOptions = {
  					position: location,
  					pov: {
    					heading: <?php echo $yaw; ?>,
    					pitch: <?php echo $pitch; ?>,
    					zoom: 1
  					}
				};
				
				var map = new google.maps.StreetViewPanorama(document.getElementById("single_map_canvas"), panoramaOptions);
				
		  		google.maps.event.addListener(map, 'error', handleNoFlash);
				
				<?php if(get_option('woo_maps_scroll') == 'true'){ ?>
			  	map.scrollwheel = false;
			  	<?php } ?>
				
			<?php } else { ?>
				
			  	<?php switch ($type) {
			  			case 'G_NORMAL_MAP':
			  				$type = 'ROADMAP';
			  			    break;
			  			case 'G_SATELLITE_MAP':
			  			    $type = 'SATELLITE';
			  			    break;
			  			case 'G_HYBRID_MAP':
			  			    $type = 'HYBRID';
			  			    break;
			  			case 'G_PHYSICAL_MAP':
			  			    $type = 'TERRAIN';
			  			    break;
			  			case 'Normal':
						    $type = 'ROADMAP';
						    break;
						case 'Satellite':
						    $type = 'SATELLITE';
						    break;
						case 'Hybrid':
						    $type = 'HYBRID';
						    break;
						case 'Terrain':
						    $type = 'TERRAIN';
						    break;
						default:
						    $type = 'ROADMAP';
						    break;
			  	} ?>
			  	
			  	var myLatlng = new google.maps.LatLng(<?php echo $lat; ?>,<?php echo $long; ?>);
				var myOptions = {
				  zoom: <?php echo $zoom; ?>,
				  center: myLatlng,
				  mapTypeId: google.maps.MapTypeId.<?php echo $type; ?>
				};
			  	var map = new google.maps.Map(document.getElementById("single_map_canvas"),  myOptions);
				<?php if(get_option('woo_maps_scroll') == 'true'){ ?>
			  	map.scrollwheel = false;
			  	<?php } ?>
			  	
				<?php if($mode == 'directions'){ ?>
			  	directionsPanel = document.getElementById("featured-route");
 				directions = new GDirections(map, directionsPanel);
  				directions.load("from: <?php echo $from; ?> to: <?php echo $to; ?>" <?php if($walking == 'on'){ echo $extra_params;} ?>);
			  	<?php
			 	} else { ?>
			 
			  		var point = new google.maps.LatLng(<?php echo $lat; ?>,<?php echo $long; ?>);
	  				var root = "<?php bloginfo('template_url'); ?>";
	  				var the_link = '<?php echo get_permalink(get_the_id()); ?>';
	  				<?php $title = str_replace(array('&#8220;','&#8221;'),'"',get_the_title(get_the_id())); ?>
	  				<?php $title = str_replace('&#8211;','-',$title); ?>
	  				<?php $title = str_replace('&#8217;',"`",$title); ?>
	  				<?php $title = str_replace('&#038;','&',$title); ?>
	  				var the_title = '<?php echo html_entity_decode($title) ?>'; 
	  				
	  			<?php		 	
			 	if(is_page()){ 
			 		$custom = get_option('woo_cat_custom_marker_pages');
					if(!empty($custom)){
						$color = $custom;
					}
					else {
						$color = get_option('woo_cat_colors_pages');
						if (empty($color)) {
							$color = 'red';
						}
					}			 	
			 	?>
			 		var color = '<?php echo $color; ?>';
			 		createMarker(map,point,root,the_link,the_title,color);
			 	<?php } else { ?>
			 		var color = '<?php echo get_option('woo_cat_colors_pages'); ?>';
	  				createMarker(map,point,root,the_link,the_title,color);
				<?php 
				}
					if(isset($_POST['woo_maps_directions_search'])){ ?>
					
					directionsPanel = document.getElementById("featured-route");
 					directions = new GDirections(map, directionsPanel);
  					directions.load("from: <?php echo htmlspecialchars($_POST['woo_maps_directions_search']); ?> to: <?php echo $address; ?>" <?php if($walking == 'on'){ echo $extra_params;} ?>);
  					
  					
  					
					directionsDisplay = new google.maps.DirectionsRenderer();
					directionsDisplay.setMap(map);
    				directionsDisplay.setPanel(document.getElementById("featured-route"));
					
					<?php if($walking == 'on'){ ?>
					var travelmodesetting = google.maps.DirectionsTravelMode.WALKING;
					<?php } else { ?>
					var travelmodesetting = google.maps.DirectionsTravelMode.DRIVING;
					<?php } ?>
					var start = '<?php echo htmlspecialchars($_POST['woo_maps_directions_search']); ?>';
					var end = '<?php echo $address; ?>';
					var request = {
       					origin:start, 
        				destination:end,
        				travelMode: travelmodesetting
    				};
    				directionsService.route(request, function(response, status) {
      					if (status == google.maps.DirectionsStatus.OK) {
        					directionsDisplay.setDirections(response);
      					}
      				});	
      				
  					<?php } ?>			
				<?php } ?>
			<?php } ?>
			

			  }
			  function handleNoFlash(errorCode) {
				  if (errorCode == FLASH_UNAVAILABLE) {
					alert("Error: Flash doesn't appear to be supported by your browser");
					return;
				  }
				 }

			
		
		initialize();
			
		});
	jQuery(window).load(function(){
			
		var newHeight = jQuery('#featured-content').height();
		newHeight = newHeight - 5;
		if(newHeight > 300){
			jQuery('#single_map_canvas').height(newHeight);
		}
		
	});

	</script>

<?php
}


/*-----------------------------------------------------------------------------------*/
/* Slider Button Shortcode */
/*-----------------------------------------------------------------------------------*/

function slider_button($atts, $content = null) {
   extract(shortcode_atts(array('url' => '#'), $atts));
   return '<a class="btn" href="'.$url.'"><span>' . do_shortcode($content) . '</span></a>';
}
add_shortcode('bizbutton', 'slider_button');


/*-----------------------------------------------------------------------------------*/
/* Get Post image attachments */
/*-----------------------------------------------------------------------------------*/
/* 

Description:

This function will get all the attached post images that have been uploaded via the 
WP post image upload and return them in an array. 

*/
function woo_get_post_images($offset = 1) {
	
	// Arguments
	$repeat = 100; 				// Number of maximum attachments to get 
	$photo_size = 'large';		// The WP "size" to use for the large image

	if ( !is_array($args) ) 
		parse_str( $args, $args );
	extract($args);

	global $post;

	$id = get_the_id();
	$attachments = get_children( array(
	'post_parent' => $id,
	'numberposts' => $repeat,
	'post_type' => 'attachment',
	'post_mime_type' => 'image',
	'order' => 'ASC', 
	'orderby' => 'menu_order date')
	);
	if ( !empty($attachments) ) :
		$output = array();
		$count = 0;
		foreach ( $attachments as $att_id => $attachment ) {
			$count++;  
			if ($count <= $offset) continue;
			$url = wp_get_attachment_image_src($att_id, $photo_size, true);	
			if ( $url[0] != $exclude )
				$output[] = array( "url" => $url[0], "caption" => $attachment->post_excerpt );
		}  
	endif; 
	return $output;
}


/*-----------------------------------------------------------------------------------*/
/* WordPress 3.0 New Features Support */
/*-----------------------------------------------------------------------------------*/

if ( function_exists('wp_nav_menu') ) {
	add_theme_support( 'nav-menus' );
	register_nav_menus( array( 'primary-menu' => __( 'Primary Menu', 'woothemes' ) ) );
}     


/*-----------------------------------------------------------------------------------*/
/* Woo Menu template ajax functions */
/*-----------------------------------------------------------------------------------*/

add_action('wp_head', 'woo_ajax_email_menu' );

function woo_ajax_email_menu() {
  	// Define custom JavaScript function
	?>
	<script type="text/javascript">
		//<![CDATA[
		jQuery.noConflict();
		
		//gets comment form post elements and serializes
		function newValues() {
			  var serializedValues = jQuery("#modal-email-fields").serialize();
			  return serializedValues;
		}
		
		//Ajax write a comment button click event	
		function woo_ajax_email_js()
		{
    		// function body defined below
			
			var serializedReturn = newValues();
			
			var ajax_url = '<?php echo admin_url( "admin-ajax.php" ); ?>';
			
			var data = {
			    action: 'woo_ajax_email_js',
			    data: serializedReturn
			};
			
			jQuery.post(ajax_url, data, function(response) {
				//prepares comment form for adding comment
			    //code here
			});
			
			return false; 
			
		} // end of JavaScript function 
		//]]>
	</script>
	<?php
} // end of PHP function 

add_action( 'wp_ajax_woo_ajax_email_js', 'woo_handle_ajax_email' );
add_action( 'wp_ajax_nopriv_woo_ajax_email_js', 'woo_handle_ajax_email' );

function woo_handle_ajax_email() {

	global $woo_options;

	//variables from the post
	$post_id = $_POST['post_id'];
	//variables from the post
	$data = $_POST['data'];
	parse_str($data, $output);

	$email_friend_address = esc_attr($output['email']);
	$email_friend_yourname = esc_attr($output['yourname']);
	$email_friend_theirname = esc_attr($output['theirname']);
	
	// $page_url = esc_attr($output['url']); // Incorrect formatting function call. http://forum.woothemes.com/topic.php?id=31184 // 2010-11-08.
	$page_url = esc_html( $output['url'] ); // Corrected formatting function call. http://forum.woothemes.com/topic.php?id=31184 // 2010-11-08.
	
	$action = esc_attr($output['action']);
	
	//set error msg	
	$error = "";
	//prepare comment preview results
	
	$myurl = get_option('siteurl'); 
	preg_match("/^(http:\/\/)?([^\/]+)/i", $myurl, $domain_only );
	
	$message_from_name = $email_friend_yourname . ' via ' . get_bloginfo('name');
	$message_from_email = 'no-reply@' . $domain_only[2];
	
	$message_from_name = $woo_options['woo_sendtofriend_from_name'];
	$message_from_email = $woo_options['woo_sendtofriend_from_email'];
	
	$message_from_name = apply_filters( 'woo_diner_sendtofriend_fromname', $message_from_name );
	$message_from_email = apply_filters( 'woo_diner_sendtofriend_fromemail', $message_from_email );
	
	if ($action == 'location') {
		$message_subject = '';
		
		$message_subject_default = 'Check out this Diner : ';
		
		$message_subject = $woo_options['woo_sendtofriend_location_subject'];
		
		$message_subject = apply_filters( 'woo_diner_sendtofriend_location_subject', $message_subject );
	    
	    if ( ! $message_subject ) { $message_subject = $message_subject_default; } // End IF Statement
	    		
		// Original XHTML version.
		// $message_content = '<p>Hi ' .$email_friend_theirname . '</p>' . '<p>I thought you would enjoy this Diner. Find Directions to the Diner here: ' . $page_url . '</p>' . '<p>Kind Regards</p>' . '<p>' . $email_friend_yourname . '</p>';
		
		// Updated plain text version. // 2010-11-08.
		$message_content = '';
		
		$message_content_default = 'Hi ' .$email_friend_theirname . "\n\n" . 'I thought you would enjoy this Diner. Find Directions to the Diner here: ' . $page_url . "\n\n" . 'Kind Regards,' . "\n" . $email_friend_yourname;
		
		$message_content = $woo_options['woo_sendtofriend_location_message'];
		
		$message_content = apply_filters( 'woo_diner_sendtofriend_location_message', $message_content );
		
		if ( ! $message_content ) { $message_content = $message_content_default; } // End IF Statement
		
	} else {
		$message_subject = '';
		
		$message_subject_default = 'Check out this menu : ';
	    

	    $message_subject = $woo_options['woo_sendtofriend_menu_subject'];
	    
	    $message_subject = apply_filters( 'woo_diner_sendtofriend_menu_subject', $message_subject );
	    
	    if ( ! $message_subject ) { $message_subject = $message_subject_default; } // End IF Statement
	    
	    // Original XHTML version.	
		// $message_content = '<p>Hi ' .$email_friend_theirname . '</p>' . '<p>I thought you would enjoy this menu. Check it out here: ' . $page_url . '</p>' . '<p>Kind Regards</p>' . '<p>' . $email_friend_yourname . '</p>';
		
		// Updated plain text version. // 2010-11-08.
		$message_content = '';
		
		$message_content_default = 'Hi ' .$email_friend_theirname . "\n\n" . 'I thought you would enjoy this menu. Check it out here: ' . $page_url . "\n\n" . 'Kind Regards,' . "\n" . $email_friend_yourname;
		
		$message_content = $woo_options['woo_sendtofriend_menu_message'];
		
		$message_content = apply_filters( 'woo_diner_sendtofriend_menu_message', $message_content );
		
		if ( ! $message_content ) { $message_content = $message_content_default; } // End IF Statement

	} // End IF Statement
	
	// Replace the "shortcodes" with dynamic data.
	
	$codes = array(
					'%theirname%' => $email_friend_theirname, 
					'%yourname%' => $email_friend_yourname, 
					'%url%' => $page_url
				  );
				  
	$strings = array( 'message_from_name', 'message_subject', 'message_content' );
				  
	foreach ( $codes as $c => $d ) {
	
		foreach ( $strings as $s  ) {
		
			if ( $c == '%url%' && $s == 'message_subject' ) {} else {
		
				${$s} = str_replace( $c, $d, ${$s} );
		
			} // End IF Statement
		
		} // End FOREACH Loop
	
	} // End FOREACH Loop
	
	$message_headers = 'From: ' . $message_from_name . ' <' . $message_from_email . '>' . "\r\n";
	
	$message_headers = apply_filters( 'woo_diner_sendtofriend_headers', $message_headers );
			
	$message_addresses = $email_friend_address;
	$results = wp_mail( $message_addresses, $message_subject, $message_content, $message_headers );

	//check for errors
	if( $error ) {
   		die( "alert('$error')" );
	} 
	// Compose JavaScript for return
	die( $results );
}

function woo_curPageURL() {
	$pageURL = 'http';
 	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 	$pageURL .= "://";
 	if ($_SERVER["SERVER_PORT"] != "80") {
  		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 	} else {
  		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 	}
 return $pageURL;
}


/*-----------------------------------------------------------------------------------*/
/* END */
/*-----------------------------------------------------------------------------------*/
    
?>