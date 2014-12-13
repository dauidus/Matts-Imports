<?php

//Enable WooSEO on these custom Post types
$seo_post_types = array('post','page');
define("SEOPOSTTYPES", serialize($seo_post_types));

//Global options setup
add_action('init','woo_global_options');
function woo_global_options(){
	// Populate WooThemes option in array for use in theme
	global $woo_options;
	$woo_options = get_option('woo_options');
}

add_action( 'admin_head','woo_options' );  
if (!function_exists('woo_options')) {
function woo_options() {
	
// VARIABLES
$themename = "Biznizz";
$manualurl = 'http://www.woothemes.com/support/theme-documentation/biznizz/';
$shortname = "woo";

$GLOBALS['template_path'] = get_bloginfo('template_directory');

//Access the WordPress Categories via an Array
$woo_categories = array();  
$woo_categories_obj = get_categories('hide_empty=0');
foreach ($woo_categories_obj as $woo_cat) {
    $woo_categories[$woo_cat->cat_ID] = $woo_cat->cat_name;}
$categories_tmp = array_unshift($woo_categories, "Select a category:");    
       
//Access the WordPress Pages via an Array
$woo_pages = array();
$woo_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($woo_pages_obj as $woo_page) {
    $woo_pages[$woo_page->ID] = $woo_page->post_name; }
$woo_pages_tmp = array_unshift($woo_pages, "Select a page:");       

// Image Alignment radio box
$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 

// Image Links to Options
$options_image_link_to = array("image" => "The Image","post" => "The Post"); 

//Testing 
$options_select = array("one","two","three","four","five"); 
$options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five"); 

//URL Shorteners
if (_iscurlinstalled()) {
	$options_select = array("Off","TinyURL","Bit.ly");
	$short_url_msg = 'Select the URL shortening service you would like to use.'; 
} else {
	$options_select = array("Off");
	$short_url_msg = '<strong>cURL was not detected on your server, and is required in order to use the URL shortening services.</strong>'; 
}

//Stylesheets Reader
$alt_stylesheet_path = TEMPLATEPATH . '/styles/';
$alt_stylesheets = array();

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}

//More Options


$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
$map_types = array('Normal','Satellite','Hybrid','Terrain'); // 2010-11-08.

// $map_types = array('G_NORMAL_MAP' => 'Normal','G_SATELLITE_MAP' => 'Satellite','G_HYBRID_MAP' => 'Hybrid','G_PHYSICAL_MAP' => 'Terrain'); // 2010-11-08.

$zoom = array("0","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");

// THIS IS THE DIFFERENT FIELDS
$options = array();   

$options[] = array( "name" => "General Settings",
					"type" => "heading",
					"icon" => "general");
                        
$options[] = array( "name" => "Theme Stylesheet",
					"desc" => "Select your themes alternative color scheme.",
					"id" => $shortname."_alt_stylesheet",
					"std" => "default.css",
					"type" => "select",
					"options" => $alt_stylesheets);

$options[] = array( "name" => "Custom Logo",
					"desc" => "Upload a logo for your theme, or specify an image URL directly.",
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload");    
                                                                                     
$options[] = array( "name" => "Text Title",
					"desc" => "Enable text-based Site Title and Tagline. Setup title & tagline in Settings->General.",
					"id" => $shortname."_texttitle",
					"std" => "false",
					"class" => "collapsed",
					"type" => "checkbox");

$options[] = array( "name" => "Site Title",
					"desc" => "Change the site title (must have 'Text Title' option enabled).",
					"id" => $shortname."_font_site_title",
					"std" => array('size' => '40','unit' => 'px','face' => 'Georgia','style' => '','color' => '#222222'),
					"class" => "hidden",
					"type" => "typography");  

$options[] = array( "name" => "Site Description",
					"desc" => "Change the site description (must have 'Text Title' option enabled).",
					"id" => $shortname."_font_tagline",
					"std" => array('size' => '14','unit' => 'px','face' => 'Georgia','style' => 'italic','color' => '#999999'),
					"class" => "hidden last",
					"type" => "typography");  
					          
$options[] = array( "name" => "Custom Favicon",
					"desc" => "Upload a 16px x 16px <a href='http://www.faviconr.com/'>ico image</a> that will represent your website's favicon.",
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload"); 
                                               
$options[] = array( "name" => "Tracking Code",
					"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");        

$options[] = array( "name" => "RSS URL",
					"desc" => "Enter your preferred RSS URL. (Feedburner or other)",
					"id" => $shortname."_feed_url",
					"std" => "",
					"type" => "text");
                    
$options[] = array( "name" => "E-Mail URL",
					"desc" => "Enter your preferred E-mail subscription URL. (Feedburner or other). This will show up in the 'Subscribe' widget.",
					"id" => $shortname."_subscribe_email",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Contact Form E-Mail",
					"desc" => "Enter your E-mail address to use on the Contact Form Page Template. Add the contact form by adding a new page and selecting 'Contact Form' as page template.",
					"id" => $shortname."_contactform_email",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Custom CSS",
                    "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea");

$options[] = array( "name" => "Post/Page Comments",
					"desc" => "Select if you want to enable/disable comments on posts and/or pages. ",
					"id" => $shortname."_comments",
					"type" => "select2",
					"options" => array("post" => "Posts Only", "page" => "Pages Only", "both" => "Pages / Posts", "none" => "None") );                                                          
    
$options[] = array( "name" => "Post Content",
					"desc" => "Select if you want to show the full content or the excerpt on posts. ",
					"id" => $shortname."_post_content",
					"type" => "select2",
					"options" => array("excerpt" => "The Excerpt", "content" => "Full Content" ) );                                                          

$options[] = array( "name" => "Post Author Box",
					"desc" => "This will enable the post author box on the single posts page. Edit description in Users > Your Profile.",
					"id" => $shortname."_post_author",
					"std" => "true",
					"type" => "checkbox");    					 

$options[] = array( "name" => "Styling Options",
					"type" => "heading",
					"icon" => "styling");   
					
$options[] = array( "name" =>  "Body Background Color",
					"desc" => "Pick a custom color for background color of the theme e.g. #697e09",
					"id" => "woo_body_color",
					"std" => "",
					"type" => "color");
					
$options[] = array( "name" => "Body background image",
					"desc" => "Upload an image for the theme's background",
					"id" => $shortname."_body_img",
					"std" => "",
					"type" => "upload");
					
$options[] = array( "name" => "Background image repeat",
                    "desc" => "Select how you would like to repeat the background-image",
                    "id" => $shortname."_body_repeat",
                    "std" => "no-repeat",
                    "type" => "select",
                    "options" => $body_repeat);

$options[] = array( "name" => "Background image position",
                    "desc" => "Select how you would like to position the background",
                    "id" => $shortname."_body_pos",
                    "std" => "top",
                    "type" => "select",
                    "options" => $body_pos);

$options[] = array( "name" =>  "Link Color",
					"desc" => "Pick a custom color for links or add a hex color code e.g. #697e09",
					"id" => "woo_link_color",
					"std" => "",
					"type" => "color");   

$options[] = array( "name" =>  "Link Hover Color",
					"desc" => "Pick a custom color for links hover or add a hex color code e.g. #697e09",
					"id" => "woo_link_hover_color",
					"std" => "",
					"type" => "color");                    

$options[] = array( "name" =>  "Button Color",
					"desc" => "Pick a custom color for buttons or add a hex color code e.g. #697e09",
					"id" => "woo_button_color",
					"std" => "",
					"type" => "color");          
					
$options[] = array( "name" => "Typography",
					"type" => "heading",
					"icon" => "typography");   

$options[] = array( "name" => "Enable Custom Typography",
					"desc" => "Enable the use of custom typography for your site. Custom styling will be output in your sites HEAD.",
					"id" => $shortname."_typography",
					"std" => "false",
					"type" => "checkbox"); 									   

$options[] = array( "name" => "General Typography",
					"desc" => "Change the general font.",
					"id" => $shortname."_font_body",
					"std" => array('size' => '12','unit' => 'px','face' => 'Arial','style' => '','color' => '#555555'),
					"type" => "typography");  

$options[] = array( "name" => "Navigation",
					"desc" => "Change the navigation font.",
					"id" => $shortname."_font_nav",
					"std" => array('size' => '14','unit' => 'px','face' => 'Arial','style' => '','color' => '#555555'),
					"type" => "typography");  

$options[] = array( "name" => "Post Title",
					"desc" => "Change the post title.",
					"id" => $shortname."_font_post_title",
					"std" => array('size' => '24','unit' => 'px','face' => 'Arial','style' => 'bold','color' => '#222222'),
					"type" => "typography");  

$options[] = array( "name" => "Post Meta",
					"desc" => "Change the post meta.",
					"id" => $shortname."_font_post_meta",
					"std" => array('size' => '12','unit' => 'px','face' => 'Arial','style' => '','color' => '#999999'),
					"type" => "typography");  
					          
$options[] = array( "name" => "Post Entry",
					"desc" => "Change the post entry.",
					"id" => $shortname."_font_post_entry",
					"std" => array('size' => '14','unit' => 'px','face' => 'Arial','style' => '','color' => '#555555'),
					"type" => "typography");  

$options[] = array( "name" => "Widget Titles",
					"desc" => "Change the widget titles.",
					"id" => $shortname."_font_widget_titles",
					"std" => array('size' => '16','unit' => 'px','face' => 'Arial','style' => 'bold','color' => '#555555'),
					"type" => "typography");  

$options[] = array( "name" => "Diner Settings",
					"icon" => "misc",
					"type" => "heading"); 

$options[] = array( "name" => "Currency Symbol",
                    "desc" => "Specify the currency that your meal prices will be shown in.",
                    "id" => $shortname."_diner_currency",
                    "std" => "$",
                    "type" => "text");

$options[] = array( "name" => "Enable Reservation in header",
					"desc" => "Check this box to enable the Reservation area in the header",
					"id" => $shortname."_reservations",
					"std" => "true",
					"type" => "checkbox");

$options[] = array( "name" => "Reservations Text",
					"desc" => "Enter the reservations area heading.",
					"id" => $shortname."_reservations_heading",
					"std" => "Reservations",
					"type" => "text"); 

$options[] = array( "name" => "Reservations Text",
					"desc" => "Enter the reservations area second line e.g. phone number.",
					"id" => $shortname."_reservations_text",
					"std" => "+23 456 789",
					"type" => "text"); 

$options[] = array( "name" => "Reservations Button Text",
					"desc" => "Enter the reservations area button text ",
					"id" => $shortname."_reservations_button",
					"std" => "Book Online",
					"type" => "text"); 

$options[] = array( "name" => "Enable Homepage Intro Area",
					"desc" => "Enable the homepage intro area",
					"id" => $shortname."_info_home",
					"std" => "true",
					"type" => "checkbox");

$options[] = array( "name" => "Homepage Intro - Heading",
					"desc" => "Enter the heading text for the information message about your Diner.",
					"id" => $shortname."_diner_intro_text_header",
					"std" => "Some more information",
					"type" => "textarea"); 
					
$options[] = array( "name" => "Homepage Intro - Message",
					"desc" => "Enter some information text about your Diner.",
					"id" => $shortname."_diner_intro_text",
					"std" => "An introduction message for visitors to your Diners website.",
					"type" => "textarea"); 

$options[] = array( "name" => "Homepage Intro Message Image",
					"desc" => "Upload an image that will be displayed next to the information text. Image dimensions: <strong>275x245px</strong>",
					"id" => $shortname."_diner_intro_text_image",
					"std" => get_bloginfo('template_directory')."/images/temp-moreinfo.jpg",
					"type" => "upload");
					
$options[] = array( "name" => "Booking Page Header Description",
					"desc" => "Enter the booking page description.",
					"id" => $shortname."_page_booking_desc",
					"std" => "Use the form below to reserve a table at our restaurant",
					"type" => "text"); 		


/* Slider */
$options[] = array( "name" => "Homepage Slider",
					"icon" => "slider",
					"type" => "heading");
					
$options[] = array( "name" => "Enable Slider",
                    "desc" => "Enable the slider on the homepage.",
                    "id" => $shortname."_slider",
                    "std" => "true",
                    "type" => "checkbox");

$options[] = array(    "name" => "Slider Entries",
                    "desc" => "Select the number of entries that should appear in the home page slider.",
                    "id" => $shortname."_slider_entries",
                    "std" => "3",
                    "type" => "select",
                    "options" => $other_entries);

$options[] = array( "name" => "Effect",
					"desc" => "Select the animation effect. ",
					"id" => $shortname."_slider_effect",
					"type" => "select2",
					"options" => array("slide" => "Slide", "fade" => "Fade") );     

$options[] = array( "name" => "Animation Speed",
                    "desc" => "The time in <b>seconds</b> the animation between frames will take.",
                    "id" => $shortname."_slider_speed",
                    "std" => "0.6",
					"type" => "select",
					"options" => array( '0.0', '0.1', '0.2', '0.3', '0.4', '0.5', '0.6', '0.7', '0.8', '0.9', '1.0', '1.1', '1.2', '1.3', '1.4', '1.5', '1.6', '1.7', '1.8', '1.9', '2.0' ) );

$options[] = array( "name" => "Hover Pause",
                    "desc" => "Hovering over slideshow will pause it",
                    "id" => $shortname."_slider_hover",
                    "std" => "false",
                    "type" => "checkbox"); 

$options[] = array( "name" => "Randomize",
                    "desc" => "Select to randomize slides.",
                    "id" => $shortname."_slider_random",
                    "std" => "false",
                    "type" => "checkbox"); 
                                        
$options[] = array( "name" => 'Auto Height',
						"desc" => 'Set the slider to adjust automatically depending on the height of the current slide contents.',
						"id" => $shortname."_slider_autoheight",
						"std" => "false",
						"type" => "checkbox");   

$options[] = array( "name" => "Slider Height",
                    "desc" => "The fixed height in pixels of the slider if the Auto Height feature is disabled.",
                    "id" => $shortname."_slider_fixed_height",
                    "std" => "320",
                    "type" => "text");

$options[] = array(    "name" => "Auto Start",
                    "desc" => "Set the slider to start sliding automatically.",
                    "id" => $shortname."_slider_auto",
                    "std" => "false",
                    "type" => "checkbox");   
                                        
$options[] = array(    "name" => "Auto Slide Interval",
                    "desc" => "The time in <b>seconds</b> each slide pauses for, before sliding to the next.",
                    "id" => $shortname."_slider_interval",
                    "std" => "6",
					"type" => "select",
					"options" => array( '1', '2', '3', '4', '5', '6', '7', '8', '9', '10' ) );
                    
$options[] = array( "name" => __( 'Show Title with Image Background', 'woothemes' ),
					"desc" => __( 'Show the post title when using an image as slider background.', 'woothemes' ),
					"id" => $shortname."_slider_title",
					"std" => "false",
					"type" => "checkbox");  
					
$options[] = array( "name" => __( 'Show Excerpt with Image Background', 'woothemes' ),
					"desc" => __( 'Show the post excerpt when using an image as slider background.', 'woothemes' ),
					"id" => $shortname."_slider_content",
					"std" => "false",
					"type" => "checkbox"); 
					
$options[] = array( "name" => "Next/Previous",
                    "desc" => "Select to display next/previous buttons.",
                    "id" => $shortname."_slider_nextprev",
                    "std" => "true",
                    "type" => "checkbox"); 

$options[] = array( "name" => "Pagination",
                    "desc" => "Select to display pagination.",
                    "id" => $shortname."_slider_pagination",
                    "std" => "true",
                    "type" => "checkbox");         	

$options[] = array( "name" => "Homepage Layout",
					"icon" => "homepage",
					"type" => "heading");

$options[] = array( "name" => "Mini-Features Area",
          "desc" => "Enable the front page Mini-Features features area.",
          "id" => $shortname."_mini_features",
          "std" => "true",
          "type" => "checkbox");
					
$options[] = array( "name" => "Enable \"Latest from the Blog\"",
                    "desc" => "Enable the Latest from the Blog area on the homepage.",
                    "id" => $shortname."_latest",
                    "std" => "true",
                    "type" => "checkbox");

$options[] = array( "name" => "Number of blog entries",
                    "desc" => "Select the number of entries that should appear in the Latest from the Blog area.",
                    "id" => $shortname."_latest_entries",
                    "std" => "3",
                    "type" => "select",
                    "options" => $other_entries);										

$options[] = array( "name" => "Homepage content #1",
          			"desc" => "(Optional) Select a page that you'd like to display on the front page <strong>above the mini features area</strong>.",
          			"id" => $shortname."_main_page1",
         			"std" => "Select a page:",
					"type" => "select",
					"options" => $woo_pages);   

$options[] = array( "name" => "Homepage content #2",
          			"desc" => "(Optional) Select a page that you'd like to display on the front page <strong>below the mini features area.</strong>",
          			"id" => $shortname."_main_page2",
          			"std" => "Select a page:",
					"type" => "select",
					"options" => $woo_pages);  

$options[] = array( "name" => "Portfolio",
                    "icon" => "portfolio",
					"type" => "heading");    

$options[] = array(	"name" => "Use Lightbox?",
					"desc" => "Show the portfolio URL or large image in a javascript lightbox.",
					"id" => $shortname."_portfolio_lightbox",
					"std" => "true",
					"type" => "checkbox");

$options[] = array(	"name" => "Use Dynamic Image Resizer?",
					"desc" => "Use the dynamic image resizer (thumb.php) to resize the portfolio thumbnail. Remember to CHMOD your cache folder to 777. <a href='http://www.woothemes.com/2008/10/troubleshooting-image-resizer-thumbphp/'>Need help?</a>",
					"id" => $shortname."_portfolio_resize",
					"std" => "false",
					"type" => "checkbox");		

$options[] = array( "name" => "Portfolio Tags",
					"desc" => "Enter comma seperated tags for portfolio sorting (e.g. web, print, icons). You must add these tags to the portfolio items you want to sort.",
					"id" => $shortname."_portfolio_tags",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Dynamic Images",
					"type" => "heading",
					"icon" => "image");    
				    				   
$options[] = array( "name" => 'Dynamic Image Resizing',
					"desc" => "",
					"id" => $shortname."_wpthumb_notice",
					"std" => 'There are two alternative methods of dynamically resizing the thumbnails in the theme, <strong>WP Post Thumbnail</strong> or <strong>TimThumb - Custom Settings panel</strong>. We recommend using WP Post Thumbnail option.',
					"type" => "info");					

$options[] = array( "name" => "WP Post Thumbnail",
					"desc" => "Use WordPress post thumbnail to assign a post thumbnail. Will enable the <strong>Featured Image panel</strong> in your post sidebar where you can assign a post thumbnail.",
					"id" => $shortname."_post_image_support",
					"std" => "true",
					"class" => "collapsed",
					"type" => "checkbox" );

$options[] = array( "name" => "WP Post Thumbnail - Dynamic Image Resizing",
					"desc" => "The post thumbnail will be dynamically resized using native WP resize functionality. <em>(Requires PHP 5.2+)</em>",
					"id" => $shortname."_pis_resize",
					"std" => "true",
					"class" => "hidden",
					"type" => "checkbox" );

$options[] = array( "name" => "WP Post Thumbnail - Hard Crop",
					"desc" => "The post thumbnail will be cropped to match the target aspect ratio (only used if 'Dynamic Image Resizing' is enabled).",
					"id" => $shortname."_pis_hard_crop",
					"std" => "true",
					"class" => "hidden last",
					"type" => "checkbox" );

$options[] = array( "name" => "TimThumb - Custom Settings Panel",
					"desc" => "This will enable the <a href='http://code.google.com/p/timthumb/'>TimThumb</a> (thumb.php) script which dynamically resizes images added through the <strong>custom settings panel below the post</strong>. Make sure your themes <em>cache</em> folder is writable. <a href='http://www.woothemes.com/2008/10/troubleshooting-image-resizer-thumbphp/'>Need help?</a>",
					"id" => $shortname."_resize",
					"std" => "true",
					"type" => "checkbox" );

$options[] = array( "name" => "TimThumb - Automatic Image Thumbnail",
					"desc" => "If no thumbnail is specifified then the first uploaded image in the post is used (TimThumb must be enabled).",
					"id" => $shortname."_auto_img",
					"std" => "false",
					"type" => "checkbox" );
					
$options[] = array( "name" => "Thumbnail Image Dimensions",
					"desc" => "Enter an integer value i.e. 250 for the desired size which will be used when dynamically creating the images.",
					"id" => $shortname."_image_dimensions",
					"std" => "",
					"type" => array( 
									array(  'id' => $shortname. '_thumb_w',
											'type' => 'text',
											'std' => 100,
											'meta' => 'Width'),
									array(  'id' => $shortname. '_thumb_h',
											'type' => 'text',
											'std' => 100,
											'meta' => 'Height')
								  ));
                                                                                                
$options[] = array( "name" => "Thumbnail Image alignment",
					"desc" => "Select how to align your thumbnails with posts.",
					"id" => $shortname."_thumb_align",
					"std" => "alignleft",
					"type" => "radio",
					"options" => $options_thumb_align); 

$options[] = array( "name" => "Show thumbnail in Single Posts",
					"desc" => "Show the attached image in the single post page.",
					"id" => $shortname."_thumb_single",
					"class" => "collapsed",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" => "Single Image Dimensions",
					"desc" => "Enter an integer value i.e. 250 for the image size. Max width is 576.",
					"id" => $shortname."_image_dimensions",
					"std" => "",
					"class" => "hidden last",
					"type" => array( 
									array(  'id' => $shortname. '_single_w',
											'type' => 'text',
											'std' => 200,
											'meta' => 'Width'),
									array(  'id' => $shortname. '_single_h',
											'type' => 'text',
											'std' => 200,
											'meta' => 'Height')
								  ));

$options[] = array( "name" => "Single Post Image alignment",
					"desc" => "Select how to align your thumbnail with single posts.",
					"id" => $shortname."_thumb_single_align",
					"std" => "alignright",
					"type" => "radio",
					"class" => "hidden",
					"options" => $options_thumb_align); 

$options[] = array( "name" => "Add thumbnail to RSS feed",
					"desc" => "Add the the image uploaded via your Custom Settings to your RSS feed",
					"id" => $shortname."_rss_thumb",
					"std" => "false",
					"type" => "checkbox");  




// Map Settings Theme Options
           
$options[] = array( "name" => "Map Settings",
					"icon" => "maps",
				    "type" => "heading");    

$options[] = array( "name" => "Disable Mousescroll",
					"desc" => "Turn off the mouse scroll action for all the Google Maps on the site. This could improve usability on your site.",
					"id" => $shortname."_maps_scroll",
					"std" => "",
					"type" => "checkbox");

$options[] = array( "name" => "Single Page Map Height",
					"desc" => "Height in pixels for the maps displayed on Single.php pages.",
					"id" => $shortname."_maps_single_height",
					"std" => "250",
					"type" => "text");

$options[] = array( "name" => "Enable Latitude & Longitude Coordinates:",
					"desc" => "Enable or disable coordinates in the head of single posts pages.",
					"id" => $shortname."_coords",
					"std" => "true",
					"type" => "checkbox");
					
$options[] = array( "name" => "Default Map Zoom Level",
					"desc" => "Set this to adjust the default in the post & page edit backend.",
					"id" => $shortname."_maps_default_mapzoom",
					"std" => "9",
					"type" => "select2",
					"options" => $zoom);

$options[] = array( "name" => "Default Map Type",
					"desc" => "Set this to the default rendered in the post backend.",
					"id" => $shortname."_maps_default_maptype",
					"std" => "Normal",
					"type" => "select2",
					"options" => array('G_NORMAL_MAP' => 'Normal','G_SATELLITE_MAP' => 'Satellite','G_HYBRID_MAP' => 'Hybrid','G_PHYSICAL_MAP' => 'Terrain'));

$options[] = array( "name" => "Directions Locale",
					"desc" => "Set the locale (translation language) for the directions created by Google maps.",
					"id" => $shortname."_maps_directions_locale",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Location Map",
					"icon" => "maps",
					"type" => "heading"); 

$options[] = array( "name" => "Address",
					"desc" => "Enter the address of your Diner.",
					"id" => $shortname."_diner_address",
					"std" => "",
					"type" => "textarea"); 
										
$options[] = array( "name" => "Latitude",
                    "desc" => "Specify the latitude of your Diner.",
                    "id" => $shortname."_diner_map_latitude",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => "Longitude",
                    "desc" => "Specify the longitude of your Diner.",
                    "id" => $shortname."_diner_map_longitude",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => "Point of View: Yaw",
                    "desc" => "Specify the Yaw for the Google Map.",
                    "id" => $shortname."_diner_map_pov_yaw",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => "Point of View: Pitch",
                    "desc" => "Specify the Pitch for the Google Map.",
                    "id" => $shortname."_diner_map_pov_pitch",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => "Zoom Level",
                    "desc" => "Select the zoom level for the Google map.",
                    "id" => $shortname."_diner_map_zoom_level",
                    "std" => "6",
                    "type" => "select",
                    "options" => $other_entries);

$options[] = array( "name" => "Map Type",
                    "desc" => "Select the type of map for the Google map.",
                    "id" => $shortname."_diner_map_type",
                    "std" => "Normal",
                    "type" => "select",
                    "options" => $map_types);

					
//Footer
$options[] = array( "name" => "Footer Customization",
					"type" => "heading",
					"icon" => "footer");    
					
					
$options[] = array( "name" => "Custom Affiliate Link",
					"desc" => "Add an affiliate link to the WooThemes logo in the footer of the theme.",
					"id" => $shortname."_footer_aff_link",
					"std" => "",
					"type" => "text");	
									
$options[] = array( "name" => "Enable Custom Footer (Left)",
					"desc" => "Activate to add the custom text below to the theme footer.",
					"id" => $shortname."_footer_left",
					"class" => "collapsed",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" => "Custom Text (Left)",
					"desc" => "Custom HTML and Text that will appear in the footer of your theme.",
					"id" => $shortname."_footer_left_text",
					"class" => "hidden last",
					"std" => "<p></p>",
					"type" => "textarea");
						
$options[] = array( "name" => "Enable Custom Footer (Right)",
					"desc" => "Activate to add the custom text below to the theme footer.",
					"id" => $shortname."_footer_right",
					"class" => "collapsed",
					"std" => "false",
					"type" => "checkbox");    

$options[] = array( "name" => "Custom Text (Right)",
					"desc" => "Custom HTML and Text that will appear in the footer of your theme.",
					"id" => $shortname."_footer_right_text",
					"class" => "hidden last",
					"std" => "<p></p>",
					"type" => "textarea");                       
                                              
// Add extra options through function
if ( function_exists("woo_options_add") )
	$options = woo_options_add($options);

if ( get_option('woo_template') != $options) update_option('woo_template',$options);      
if ( get_option('woo_themename') != $themename) update_option('woo_themename',$themename);   
if ( get_option('woo_shortname') != $shortname) update_option('woo_shortname',$shortname);
if ( get_option('woo_manual') != $manualurl) update_option('woo_manual',$manualurl);


// Woo Metabox Options
// Start name with underscore to hide custom key from the user
$woo_metaboxes = array();

global $post;

if ( ( get_post_type() == 'post') || ( !get_post_type() ) ) {

	$woo_metaboxes[] = array (	"name" => "image",
								"label" => "Image",
								"type" => "upload",
								"desc" => "Upload an image or enter an URL.");
	
	if ( get_option('woo_resize') == "true" ) {						
		$woo_metaboxes[] = array (	"name" => "_image_alignment",
									"std" => "Center",
									"label" => "Image Crop Alignment",
									"type" => "select2",
									"desc" => "Select crop alignment for resized image",
									"options" => array(	"c" => "Center",
														"t" => "Top",
														"b" => "Bottom",
														"l" => "Left",
														"r" => "Right"));
	}

	$woo_metaboxes[] = array (  "name"  => "embed",
					            "std"  => "",
					            "label" => "Embed Code",
					            "type" => "textarea",
					            "desc" => "Enter the video embed code for your video (YouTube, Vimeo or similar)");
					            
} // End post

if ( ( get_post_type() == 'slide') || ( !get_post_type() ) ) {


					         
	$woo_metaboxes[] = array (	"name" => "image",
								"label" => "Image",
								"type" => "upload",
								"desc" => "Upload an image or enter an URL.");					         
					            

	$woo_metaboxes[] = array( 	"name" => "slide_layout",
								"label" => "Slider Overlay Layout",
								"desc" => "Specify where you want the slider overlay content to display",
								"std" => "right",
								"type" => "select2",
									"options" => array(	"left" => "Left",
														"right" => "Right",
														"none" => "None"));
	$woo_metaboxes[] = array (	"name" => "slide-url",
								"label" => "Slide URL",
								"type" => "text",
								"desc" => "Enter a URL for the slide to click through to.");
	
} // End post

if( get_post_type() == 'infobox' || !get_post_type()){	

$woo_metaboxes[] = array (	
				"name" => "mini",
				"label" => "Mini-features Icon",
				"type" => "upload",
				"desc" => "Upload icon for use with the Mini-Feature on the homepage (optimal size: 32x32px) (optional)"
			);
 
$woo_metaboxes[] = array (	
				"name" => "mini_excerpt",
				"label" => "Mini-features Excerpt",
				"type" => "textarea",
				"desc" => "Enter the text to show in your Mini-Feature. "
			);

$woo_metaboxes[] = array (	
				"name" => "mini_readmore",
				"std" => "",
				"label" => "Mini-features URL",
				"type" => "text",
				"desc" => "Add an URL for your Read More button in your Mini-Feature on homepage (optional)"
			);

} // End mini

if( get_post_type() == 'portfolio' || !get_post_type()){

$woo_metaboxes['portfolio'] = array (	"name" => "portfolio",
							"label" => "Portfolio Thumbnail",
							"type" => "upload",
							"desc" => "Upload an image for use in the portfolio (optimal size: 450x210)");

$woo_metaboxes['portfolio-large'] = array (	"name" => "portfolio-large",
							"label" => "Portfolio Large",
							"type" => "upload",
							"desc" => "Add an URL OR upload an image for use as the large portfolio image");

} // End portfolio

if( get_post_type() == 'feedback' || !get_post_type()){

$woo_metaboxes['feedback_citation'] = array ( "name" => "feedback_citation",
							"label" => "Citation",
							"type" => "text",
							"desc" => "Enter a citation for this feedback post.");

} // End portfolio


if( get_post_type() == 'woo_location' || !get_post_type()){
	
	/*$woo_metaboxes[] = array (	"name" => "currency",
								"std" => get_option('woo_diner_currency'),
								"label" => "Currency",
								"type" => "text",
								"desc" => "This locations currency. This will override the default currency of the theme for this location.");*/
	
	$woo_metaboxes[] = array (	"name" => "head_office",
								"std" => "false",
								"label" => "Is Head Office",
								"type" => "checkbox",
								"desc" => "Choose if this location is your head office");
															
}


// Add extra metaboxes through function
if ( function_exists("woo_metaboxes_add") )
	$woo_metaboxes = woo_metaboxes_add($woo_metaboxes);
    
if ( get_option('woo_custom_template') != $woo_metaboxes) update_option('woo_custom_template',$woo_metaboxes);      

}
}



?>