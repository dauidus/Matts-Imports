<?php
/*
Template Name: Location
*/
?>

<?php get_header(); ?>
    <script type="text/javascript">
    jQuery(document).ready(function(){
		
		// Make the directions popup draggable. // 2010-11-14.
		jQuery('#directions').css('cursor', 'move');
		jQuery('#directions').draggable();
		
		jQuery('#emailtofriend').click(function(){
		
			jQuery('#content.location #directions').toggle();
			if(jQuery('#overlay').length > 0){
        		jQuery('#overlay').remove();
        	} else {
        		jQuery('body').append('<div id="overlay"></div>');
        		var doc_height = jQuery(document).height();
        		jQuery('#overlay').height(doc_height);
        		jQuery('#overlay').click(function(){
        			jQuery('#content.location #directions').toggle();
        			jQuery(this).remove();
        		});
        	}
   			jQuery('#modal-email').dialog('open');
   		});
		
		var yourname = jQuery( "#yourname" ),
			email = jQuery( "#email" ),
			theirname = jQuery( "#theirname" ),
			allFields = jQuery( [] ).add( yourname ).add( email ).add( theirname ),
			tips = jQuery( ".validateTips" );

		function updateTips( t ) {
			tips
				.text( t )
				.addClass( "ui-state-highlight" );
			setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1500 );
			}, 500 );
		}

		function checkLength( o, n, min, max ) {
			if ( o.val().length > max || o.val().length < min ) {
				o.addClass( "ui-state-error" );
				updateTips( "Length of " + n + " must be between " +
					min + " and " + max + "." );
				return false;
			} else {
				return true;
			}
		}

		function checkRegexp( o, regexp, n ) {
			if ( !( regexp.test( o.val() ) ) ) {
				o.addClass( "ui-state-error" );
				updateTips( n );
				return false;
			} else {
				return true;
			}
		}

		jQuery('#modal-email').hide();
	
		// Initialise the dialog box
		jQuery('#modal-email').dialog({
								autoOpen: false, 
								title: 'Send to a friend', 
								resizable: false,
								height: 175,
								width: 300, 
								modal: true, 
								buttons: {
									Confirm: function() {
										//jQuery('#modal-email-fields').validate();
										
										var bValid = true;
										allFields.removeClass( 'ui-state-error' );

										bValid = bValid && checkLength( yourname, "your name", 3, 16 );
										bValid = bValid && checkLength( theirname, "your friends name", 5, 16 );
										bValid = bValid && checkLength( email, "email", 6, 80 );
										
										bValid = bValid && checkRegexp( yourname, /^[a-z]([0-9a-z _])+$/i, "Your name may consist of a-z, 0-9, underscores, begin with a letter." );
										bValid = bValid && checkRegexp( theirname, /^[a-z]([0-9a-z _])+$/i, "Your friends name may consist of a-z, 0-9, underscores, begin with a letter." );
										// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
										bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
										
										if ( bValid ) {
											woo_ajax_email_js();
											jQuery( this ).dialog( "close" );
										}

	 									
									}, 
									Cancel: function() {
										jQuery(this).dialog("close");
										
									}
								}
							});
		
	});
    </script>   
    <div id="content" class="page location col-full">
    
    	<div class="text">
    	
    		<h2 class="title"><?php _e('Location', 'woothemes'); ?></h2>
    		
    		<address><?php echo nl2br(get_option('woo_diner_address')); ?></address>
    		
    		<h3><?php _e('Directions', 'woothemes'); ?></h3>
    		
    		<p><?php _e('Enter your current location below to generate door-to-door directions to Matt\'s Imports. (we do not save any information entered on this page)', 'woothemes'); ?></p>
    		
    		<form id="directions-form" name="directions-form" method="post" action="#">
    		
    			<input class="txt" type="text" name="address" value="<?php _e('Enter your address', 'woothemes'); ?>" style="margin-bottom:0px;" />
                
    			
    			<a style="margin-top:15px;" class="button" href="#" ><?php _e('Generate Directions', 'woothemes'); ?></a>
    		
    		</form>
    	
    		<script type="text/javascript">	

				var directionsDisplay;
				var directionsService = new google.maps.DirectionsService();
				var map;
				
				function initialize_directions(fromdir, todir) {
				  directionsDisplay = new google.maps.DirectionsRenderer();
				  var chicago = new google.maps.LatLng(41.850033, -87.6500523);
				  var myOptions = {
				    zoom:7,
				    mapTypeId: google.maps.MapTypeId.ROADMAP,
				    center: chicago
				  }
				  map = new google.maps.Map(document.getElementById("featured_overview"), myOptions);
				  directionsDisplay.setMap(map);
				  directionsDisplay.setPanel(document.getElementById("direction-result"));
				  calcRoute(fromdir, todir)
				}
				
				function calcRoute(fromdir, todir) {
				  var start = fromdir;
				  var end = todir;
				  var request = {
				    origin:start,
				    destination:end,
				    travelMode: google.maps.TravelMode.DRIVING
				  };
				  directionsService.route(request, function(response, status) {
				    if (status == google.maps.DirectionsStatus.OK) {
				      directionsDisplay.setDirections(response);
				    } else if (status == google.maps.DirectionsStatus.INVALID_REQUEST) {
 		  				jQuery('#direction-result').show().html('The request was invalid. Please try again.');
 					} else if (status == google.maps.DirectionsStatus.MAX_WAYPOINTS_EXCEEDED) {
   						jQuery('#direction-result').show().html('Too many Waypoints were provided in the request. The total allowed waypoints is 8, plus the origin and destination.');
 					} else if (status == google.maps.DirectionsStatus.OVER_QUERY_LIMIT) {
   						jQuery('#direction-result').show().html('The webpage has gone over the requests limit in too short a period of time.');
   					} else if (status == google.maps.DirectionsStatus.REQUEST_DENIED) {
   						jQuery('#direction-result').show().html('The webpage is not allowed to use the directions service.');
   					} else if (status == google.maps.DirectionsStatus.ZERO_RESULTS) {
   						jQuery('#direction-result').show().html('No route could be found between the origin and destination.');
 		 			} else if (status == google.maps.DirectionsStatus.NOT_FOUND) {
   						jQuery('#direction-result').show().html('At least one of the origin, destination, or waypoints could not be geocoded.');
 		 			} else {
 		 				jQuery('#direction-result').show().html('An unknown error occurred. Please try again');
					}
				  });
				}
  				
    	jQuery(document).ready(function(){
    		//DIRECTIONS LIGHTBOX
	
			jQuery('#content.location .text .button').click(function(){
    	
        		jQuery('#content.location #directions').toggle();
        		
        		var fromdir = jQuery('#directions-form input.txt').val();
        		var todir = '<?php echo get_option('woo_diner_map_latitude').', '.get_option('woo_diner_map_longitude'); ?>';
        		
        		jQuery('#direction-result').text('');
        		initialize_directions(fromdir, todir);
        		
        		if(jQuery('#overlay').length > 0){
        			jQuery('#overlay').remove();
        		} else {
        			jQuery('body').append('<div id="overlay"></div>');
        			var doc_height = jQuery(document).height();
        			jQuery('#overlay').height(doc_height);
        			jQuery('#overlay').click(function(){
        				jQuery('#content.location #directions').toggle();
        				jQuery(this).remove();
        			});
        		}
        
    
    		});
    		
    		//PRINT EVENT
    		jQuery('#print-directions').click(function(){
    			w=window.open();
				w.document.write(jQuery('#direction-result').html());
				w.print();
				w.close();
    		});
    		
    		

    	
		});
		</script>
		
    	</div><!-- /.text -->
    	
    	<div class="map">
    		
    		<div class="fakebg"></div>
                <div class="fakebg second"></div>
            <div class="map-frame">
            
    			<div class="woo_map_single_output">
                    <?php
                            				
							$zoom = get_option('woo_diner_map_zoom_level');
							if(empty($zoom)) $zoom = '6';
							$type = get_option('woo_diner_map_type');
							switch ($type) {
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
							}
							
							$center = get_option('woo_diner_map_latitude').', '.get_option('woo_diner_map_longitude');
		
							// No More API Key needed
							
							?>
							<div id="featured_overview" style="height:390px; width:550px"></div>
							<?php		
			
							/* Maps Bit */	
							if(!empty($center)) { $center_final = $center; }
		
							?>
							<script src="<?php bloginfo('template_url'); ?>/includes/js/markers.js" type="text/javascript"></script>
							<script type="text/javascript">
							// Creates a marker and returns
    						jQuery(document).ready(function(){
    							
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
	  								var the_link = '<?php echo get_permalink(); ?>';
	  								<?php $title = str_replace(array('&#8220;','&#8221;'),'"',get_the_title()); ?>
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
						
                    </div>
                
            </div>

    	
    	</div><!-- /.map -->
    	
    	<div id="directions">
    		
    		<h4>
    			<?php _e('Directions', 'woothemes'); ?>
    			<span>
    				<a id="print-directions" class="print" href="#" title="<?php _e('Print Directions', 'woothemes'); ?>"><?php _e('Print', 'woothemes'); ?></a> <a id="emailtofriend" class="email" href="#" title="Email Directions"><?php _e('Email', 'woothemes'); ?></a>
    			</span>
    		</h4>
    		
    		<p id="direction-result"><?php _e('Directions go here', 'woothemes'); ?></p>
    		
    	</div>
        <div id="modal-email">
			<form id="modal-email-fields" method="post" action="">
				<fieldset>
					<p class="validateTips"><?php _e('All form fields are required.', 'woothemes'); ?></p>
					<p class="form-field">
						<label for="yourname"><?php _e('Your Name', 'woothemes'); ?></label>
						<input type="text" name="yourname" id="yourname" class="text ui-widget-content ui-corner-all input-text required" />
					</p>
					<p class="form-field">
						<label for="theirname"><?php _e('Your Friends Name', 'woothemes'); ?></label>
						<input type="text" name="theirname" id="theirname" class="text ui-widget-content ui-corner-all input-text required" />
					</p>
					<p class="form-field">
						<label for="email"><?php _e('Email', 'woothemes'); ?></label>
						<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all input-text required email" />
						<input type="hidden" name="url" id="url" value="<?php echo woo_curPageURL(); ?>" />
						<input type="hidden" name="action" id="action" value="location" />
					</p>
				</fieldset>
			</form>
	
		</div>    
    </div><!-- /#content -->
		
<?php get_footer(); ?>