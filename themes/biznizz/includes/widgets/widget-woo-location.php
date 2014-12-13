<?php
/*---------------------------------------------------------------------------------*/
/* Location Widget */
/*---------------------------------------------------------------------------------*/


class Woo_Location extends WP_Widget {

	function Woo_Location() {
		/*
		$widget_ops = array('description' => 'DIsplay your Restaurant Location' );
		parent::WP_Widget(false, __('Woo - Location', 'woothemes'),$widget_ops);
		*/
		
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_woo_location', 'description' => __('Display your Shop Location', 'woothemes' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'woo_location' );

		/* Create the widget. */
		$this->WP_Widget( 'woo_location', __('Woo - Location', 'woothemes' ), $widget_ops, $control_ops );    
	}

	function widget($args, $instance) { 
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base );
		$pageid = $instance['pageid'];

        echo $before_widget; ?>
       	
       	<?php echo $before_title .$title. $after_title; ?>
        <?php
        	$address_text = get_option('woo_diner_address');
        ?>
        <span class="location-address"><?php echo $address_text; ?></span>
        
        <div class="mapwidget">
        <div class="fakebg"></div>
            <div class="fakebg second"></div>
        <div class="location-map">
            
        	<?php
                            				
							// $zoom = get_option('woo_diner_map_zoom'); // Incorrect option call. 2010-11-04.
							$zoom = '10';
							
							// $type = get_post_meta($pageid,'map_type',true); // Call for map type when on the location page.
							$type_in_db = get_option( 'woo_diner_map_type' );
							
							switch ( $type_in_db ) {
								
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
							
							} // End SWITCH Statement
							
							if(empty($type)) $type = 'G_NORMAL_MAP';
							$center = get_option('woo_diner_map_latitude').', '.get_option('woo_diner_map_longitude');
		
							// No More API Key needed
							
							?>
							<div id="featured_overview" style="height:175px; width:290px"></div>
							<?php		
			
							/* Maps Bit */	
							if(!empty($center)) { $center_final = $center; }
		
							?>
							<script src="<?php bloginfo('template_url'); ?>/includes/js/markers.js" type="text/javascript"></script>
							<script type="text/javascript">
							// Creates a marker and returns
    						jQuery(document).ready(function(){
    							
    							// alert( GBrowserIsCompatible() ); // DEBUG
    							
								function initialize() {
								
									
									var myLatlng = new google.maps.LatLng(<?php echo $center_final; ?>);
									var myOptions = {
									  zoom: <?php echo $zoom; ?>,
									  center: myLatlng,
									  mapTypeId: google.maps.MapTypeId.<?php echo $type; ?>
									};
									
									var map = new google.maps.Map(document.getElementById("featured_overview"),  myOptions);
									<?php if(get_option('woo_maps_scroll') == 'true'){ ?>
			  						map.scrollwheel = false;
			  						<?php } ?>
			  						
      								var point = new google.maps.LatLng(<?php echo $center; ?>);
	  								var root = "<?php bloginfo('template_url'); ?>";
	  								var the_link = '<?php echo get_permalink($pageid); ?>';
	  								<?php $title = str_replace(array('&#8220;','&#8221;'),'"',get_the_title($pageid)); ?>
	  								<?php $title = str_replace('&#8211;','-',$title); ?>
	  								<?php $title = str_replace('&#8217;',"`",$title); ?>
	  								<?php $title = str_replace('&#038;','&',$title); ?>
	  								var the_title = '<?php echo html_entity_decode($title) ?>'; 
	  										
	  								var color = 'blue';
	  								createMarker(map,point,root,the_link,the_title,color);
      								
								}
								initialize();
							});
						</script>
						
        	
        	<a class="button inactive" href="<?php echo get_permalink($pageid); ?>" title="Directions">Get Directions to Matt's</a>
        
        </div><!-- /.location-map -->
		</div>

        <?php
			
		echo $after_widget;

	}

	function update($new_instance, $old_instance) {                
		return $new_instance;
	}

	function form($instance) {
	
		$title = esc_attr($instance['title']);
		$pageid = esc_attr($instance['pageid']);
		?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','woothemes'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>
        <p>
			<label for="<?php echo $this->get_field_id('pageid'); ?>"><?php _e('Location Page Template:','woothemes'); ?></label>
			<?php $args = array(
								'show_option_none'  => __('Select a Page:'), 
    							'depth'            => 0,
    							'child_of'         => 0,
    							'selected'         => $pageid,
    							'echo'             => 1,
    							'name'             => $this->get_field_name('pageid'),
    							'id'               => $this->get_field_name('pageid'),
    							); ?>
    		<?php wp_dropdown_pages($args); ?>
    							
		</p>
        <?php
	
	}
} 

register_widget('Woo_Location');


?>