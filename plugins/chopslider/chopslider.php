<?php
/*
Plugin Name: Chop Slider 2
Plugin URI: http://www.idangero.us/cs/
Description: Animated jQuery image slider with over the 190 predefined and ready to use amazing and unique effects with realistic 3D transitions and full 3D mode. The Wordpress version is based on the jQuery Chop Slider 2
Version: 1.2
Author: Vladimir Kharlampidi, The iDangero.us
Author URI: http://www.idangero.us/
*/

/*  
Copyright 2011 Vladimir Kharlampidi, The iDangero.us  (email: cs@idangero.us)
*/
include_once ('chopslider-versions-state.php');
define('CHOPSLIDER_VERSION_CORE',$chopsliderVersions['core']);
define('CHOPSLIDER_VERSION_WP',$chopsliderVersions['wp']);
define('CHOPSLIDER_VERSION_LIBRARY',$chopsliderVersions['library']);
define('CHOPSLIDER_PLUGIN_URL', plugin_dir_url( __FILE__ ));
global $wpdb;
define('CHOPSLIDER_TABLE_NAME', $wpdb->prefix . "chopslider");
$wpdb->flush();

// Init Chop Slider admin menus and pages
add_action('admin_menu', 'chopslider_admin_menu');

// Init Chop Slider Settings
add_action('admin_init', 'chopslider_settings');
function chopslider_settings() {
	register_setting( 'chopslider_settings', 'chopslider-settings' );
	add_settings_section('chopslider_settings_section', 'Chop Slider Settings', 'chopslider_settings_html', 'general');
	add_settings_field('chopslider_remove_db', '<p>Remove ChopSlider database on plugin delete:</p><span class="cs-tip">Set to "Do not remove" if you are going to remove Chop Slider before update to the new version</span>', 'cs_setting_removeDB', 'general', 'chopslider_settings_section');
	add_settings_field('chopslider_permissions', '<p>Permissions:</p><span class="cs-tip">Switch to "Administrator" if you are using Multiple Sites and want to allow for the sites administrators to mananage sliders.</span>', 'cs_setting_permissions', 'general', 'chopslider_settings_section');
	
	$testOption = get_option('chopslider-settings');
	if(!is_array($testOption)) {
		add_option( 'chopslider-settings', Array('remove_db'=>1, 'permissions'=>'edit_pages') );	
	}
}
function chopslider_settings_html() {
		
}
function cs_setting_removeDB() {
	$options = get_option('chopslider-settings');
	echo '<select name="chopslider-settings[remove_db]">
	<option value="1" '.($options['remove_db']==1 ? 'selected="selected"' : "").'>Remove</option>
	<option value="0" '.($options['remove_db']==0 ? 'selected="selected"' : "").'>Do not remove</option>
	</select>
	';
}
function cs_setting_permissions() {
	$options = get_option('chopslider-settings');
	echo '<select name="chopslider-settings[permissions]">
	<option value="edit_pages" '.($options['permissions']=='edit_pages' ? 'selected="selected"' : "").'>Super Admin</option>
	<option value="delete_pages" '.($options['permissions']=='delete_pages' ? 'selected="selected"' : "").'>Administrator</option>
	<option value="edit_pages" '.($options['permissions']=='edit_pages' ? 'selected="selected"' : "").'>Author</option>
	</select>
	';
}

// Chop Slider Admin Pages
function chopslider_admin_menu() {
	$opt = get_option('chopslider-settings');
	$role = $opt['permissions'];
    // Add a new top-level Chop Slider's page:
    $chop_slider_manage_page = add_menu_page('Chop Slider 2', 'Chop Slider 2', $role, 'chopslider', 'chopslider_manage_page', plugin_dir_url( __FILE__ )."images/admin/icon.png");
	add_action('admin_print_styles-' . $chop_slider_manage_page, 'chopslider_admin_init');
	
    // Add a submenu for the "Add New" page:
    $chop_slider_addnew_page = add_submenu_page('chopslider', 'Add New Chop Slider', 'Add New', $role, 'chopslider-add-slider', 'chopslider_addnew_page');
	add_action('admin_print_styles-' . $chop_slider_addnew_page, 'chopslider_medialibrary');
	
	// Add a submenu for the "Transitions Library" page:
    $chop_slider_tl_page = add_submenu_page('chopslider', 'Chop Slider Transitions Library', 'Transitions Library', $role, 'chopslider-transitions', 'chopslider_tl_page');
	add_action('admin_print_styles-' . $chop_slider_tl_page, 'chopslider_tranisitons_init');
	
	// Add a submenu for the "Edit" page:
    $chop_slider_edit_page = add_submenu_page('null', 'Edit Chop Slider', 'Edit Chop Slider', $role, 'chopslider-edit-slider', 'chopslider_edit_page');
	add_action('admin_print_styles-' . $chop_slider_edit_page, 'chopslider_medialibrary');
	
}
// Scripts and Styles for all Custom Pages
function chopslider_admin_init(){
	wp_register_style('chopslider-admin.css', CHOPSLIDER_PLUGIN_URL . 'chopslider-admin.css', array(), CHOPSLIDER_VERSION_WP);
	wp_enqueue_style('chopslider-admin.css');
	wp_register_script('chopslider-admin.js', CHOPSLIDER_PLUGIN_URL . 'chopslider-admin.js', array('jquery'), CHOPSLIDER_VERSION_WP);
	wp_enqueue_script('chopslider-admin.js');
}
// Scripts and Styles for the Transitions Library Page
function chopslider_tranisitons_init(){
	wp_register_style('chopslider-transitions-library.css', CHOPSLIDER_PLUGIN_URL . 'chopslider-transitions-library.css', array(), CHOPSLIDER_VERSION_WP);
	wp_enqueue_style('chopslider-transitions-library.css');
	wp_register_script('jquery.id.chopslider-'.CHOPSLIDER_VERSION_CORE.'.pro.min.js', CHOPSLIDER_PLUGIN_URL . 'scripts/jquery.id.chopslider-'.CHOPSLIDER_VERSION_CORE.'.pro.min.js', array('jquery'));
	wp_enqueue_script('jquery.id.chopslider-'.CHOPSLIDER_VERSION_CORE.'.pro.min.js');
	wp_register_script('jquery.id.cstransitions-'.CHOPSLIDER_VERSION_LIBRARY.'.min.js', CHOPSLIDER_PLUGIN_URL . 'scripts/jquery.id.cstransitions-'.CHOPSLIDER_VERSION_LIBRARY.'.min.js', array('jquery'));
	wp_enqueue_script('jquery.id.cstransitions-'.CHOPSLIDER_VERSION_LIBRARY.'.min.js');
	wp_register_script('chopslider-transitions-library.js', CHOPSLIDER_PLUGIN_URL . 'chopslider-transitions-library.js', array('jquery'), CHOPSLIDER_VERSION_WP);
	wp_enqueue_script('chopslider-transitions-library.js');
}
// Scripts and Styles for the Add and Edit pages with a medialibrary and TinyMCE
function chopslider_medialibrary() {
	chopslider_admin_init();
	
	if (function_exists('wp_tiny_mce')) wp_tiny_mce();
	
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('jquery');
	wp_enqueue_style('thickbox');
	wp_register_script('jquery.id.chopslider-'.CHOPSLIDER_VERSION_CORE.'.pro.min.js', CHOPSLIDER_PLUGIN_URL . 'scripts/jquery.id.chopslider-'.CHOPSLIDER_VERSION_CORE.'.pro.min.js', array('jquery'));
	wp_enqueue_script('jquery.id.chopslider-'.CHOPSLIDER_VERSION_CORE.'.pro.min.js');
	wp_register_script('jquery.id.cstransitions-'.CHOPSLIDER_VERSION_LIBRARY.'.min.js', CHOPSLIDER_PLUGIN_URL . 'scripts/jquery.id.cstransitions-'.CHOPSLIDER_VERSION_LIBRARY.'.min.js', array('jquery'));
	wp_enqueue_script('jquery.id.cstransitions-'.CHOPSLIDER_VERSION_LIBRARY.'.min.js');
}
// Scripts and Styles for the Transitions Builder page
function chopslider_transition_builder() {
	chopslider_admin_init();
	chopslider_medialibrary();
	wp_register_style('chopslider-transition-builder.css', CHOPSLIDER_PLUGIN_URL . 'transition-builder/chopslider-transition-builder.css', array(), CHOPSLIDER_VERSION_WP);
	wp_enqueue_style('chopslider-transition-builder.css');
	wp_register_style('jquery-ui.css', CHOPSLIDER_PLUGIN_URL . 'jqueryui/smoothness/jquery-ui-1.8.16.custom.css', array(), CHOPSLIDER_VERSION_WP);
	wp_enqueue_style('jquery-ui.css');
	wp_register_script('jquery-ui.js', CHOPSLIDER_PLUGIN_URL . 'jqueryui/jquery-ui-1.8.16.custom.min.js', array('jquery'), CHOPSLIDER_VERSION_WP);
	wp_enqueue_script('jquery-ui.js');
	wp_register_script('chopslider-transition-builder.js', CHOPSLIDER_PLUGIN_URL . 'transition-builder/chopslider-transition-builder.js', array('jquery'), CHOPSLIDER_VERSION_WP);
	wp_enqueue_script('chopslider-transition-builder.js');
	
}
// ChopSlider Management (Home) Page
function chopslider_manage_page() {
    include_once dirname( __FILE__ ) . "/chopslider-admin-manage.php";
}
// Chop Slider "Transtions Library" Page
function chopslider_tl_page() {
    include_once dirname( __FILE__ ) . "/chopslider-transitions-library.php";
}
// Chop Slider "Add New" Page
function chopslider_addnew_page() {
    include_once dirname( __FILE__ ) . "/chopslider-admin-new.php";
}
// Chop Slider "Edit" Page
function chopslider_edit_page() {
    include_once dirname( __FILE__ ) . "/chopslider-admin-edit.php";
}
// Chop Slider "Custom Transitions" Page
function chopslider_transitions_manage_page() {
    include_once dirname( __FILE__ ) . "/transition-builder/chopslider-effects-manage.php";
}
// Chop Slider "Transition Builder" Page
function chopslider_tb_page() {
    include_once dirname( __FILE__ ) . "/transition-builder/chopslider-transition-builder.php";
}
// New Data Table If Not Created
function chopslider_add_new_table() {
	global $wpdb;
	$cs_table_name = CHOPSLIDER_TABLE_NAME;
	if($wpdb->get_var("SHOW TABLES LIKE '$cs_table_name'") != $cs_table_name) {
		$sql = "CREATE TABLE " . $cs_table_name . " (
			  `chopslider_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			  `title` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
			  `options` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
			  `additional` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
			  `version` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
			  `created` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
			)  CHARACTER SET utf8 COLLATE utf8_general_ci;";
		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}
};
chopslider_add_new_table();


/**
 * ------- Chop Slider custom Editor button ------- 
*/
function add_chopslider_button() {
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     return;
   // Add only in Rich Editor mode
   if ( get_user_option('rich_editing') == 'true') {
     add_filter("mce_external_plugins", "add_chopslider_tinymce_plugin");
     add_filter('mce_buttons', 'register_chopslider_button');
   }
}
function register_chopslider_button($buttons) {
   array_push($buttons, "|", "chopslider");
   return $buttons;
}

function add_chopslider_tinymce_plugin($plugin_array) {
   $plugin_array['chopslider'] = CHOPSLIDER_PLUGIN_URL.'editor_plugin.js';
   return $plugin_array;
} 
add_action('init', 'add_chopslider_button'); 

/**
 * ------- Function to rebuild small html file for the Editor's iFrame window to select a Slider to insert a shortcode ------- 
*/
//We need to check if we run Chop Slider first time and need to create Editor's dialog file
if( ! is_file(dirname( __FILE__ ) . '/editor/editor-dialog.php') )	{
	chopslider_update_editor_dialog();
}
function chopslider_update_editor_dialog() {
	$chopslider_dialog = '
	<script>
	function insertCS(id) {
		window.parent.tinymce.execCommand(\'mceInsertContent\', false, \'[chopslider id="\'+id+\'"]\');
		window.parent.tinymce.activeEditor.windowManager.close(window)
	}
	</script>
	<p style="font-size:13px;">Choose the Chop Slider you want to insert:</p>
	<ul>
	';
	global $wpdb;
	$chopslider_result = $wpdb->get_results('SELECT chopslider_id, title FROM ' . CHOPSLIDER_TABLE_NAME . ' ORDER BY chopslider_id DESC'); 
	
	foreach ($chopslider_result as $single_chopslider)  {
		$chopslider_dialog.='
		<li  style="font-size:13px;"><a style="color:#21759B" href="#" onclick="insertCS(' . $single_chopslider -> chopslider_id . '); return false;">' . $single_chopslider -> title . '</a></li>	
		';
	}
	$chopslider_dialog .="</ul>";
	$wpdb->flush();
	
	$fp = fopen( dirname( __FILE__ ) . '/editor/editor-dialog.php', 'w');
	
	if( fwrite ( $fp, $chopslider_dialog ) ) $status = '';
	else $status = '';
	fclose($fp);
}

/**
 * ------- Chop Slider Short Code ------- 
*/

class Chopslider_Shortcode {
	static $add_script;
	function init() {
		add_shortcode('chopslider', array(__CLASS__, 'handle_chopslider_shortcode'));
		add_action('wp_footer', array(__CLASS__, 'reg_print_chopslider_scripts'));
	}
	
	function handle_chopslider_shortcode($atts) {
		extract(shortcode_atts(array( "id" => '' ), $atts));
		global $wpdb;
		$chopslider_result = $wpdb->get_row('SELECT chopslider_id, version FROM ' . CHOPSLIDER_TABLE_NAME . ' WHERE chopslider_id =' . $id);
		if (!$chopslider_result) return;
		
		self::$add_script = true;
		
		$scHTML = file_get_contents( dirname( __FILE__ ).'/scripts/chopslider-' . $id . '.php' );
		echo '<link rel="stylesheet" type="text/css" href="'.CHOPSLIDER_PLUGIN_URL.'css/chopslider-' . $id . '.css?ver=' . $chopslider_result->version . '"/>';
		wp_register_script('chopslider-' . $id . '.js', CHOPSLIDER_PLUGIN_URL . 'scripts/chopslider-' . $id . '.js', array('jquery'), $chopslider_result->version);
		wp_print_scripts('chopslider-' . $id . '.js');
		return $scHTML;
	}
	function reg_print_chopslider_scripts() {
		if ( ! self::$add_script )
			return;
		wp_register_script('jquery.id.chopslider-'.CHOPSLIDER_VERSION_CORE.'.pro.min.js', CHOPSLIDER_PLUGIN_URL . 'scripts/jquery.id.chopslider-'.CHOPSLIDER_VERSION_CORE.'.pro.min.js', array('jquery'));
		wp_register_script('jquery.id.cstransitions-'.CHOPSLIDER_VERSION_LIBRARY.'.min.js', CHOPSLIDER_PLUGIN_URL . 'scripts/jquery.id.cstransitions-'.CHOPSLIDER_VERSION_LIBRARY.'.min.js', array('jquery'));
		wp_print_scripts('jquery.id.chopslider-'.CHOPSLIDER_VERSION_CORE.'.pro.min.js');
		wp_print_scripts('jquery.id.cstransitions-'.CHOPSLIDER_VERSION_LIBRARY.'.min.js');
	}
}
Chopslider_Shortcode::init();

/**
 * ------- Chop Slider Custom Template Tag ------- 
*/
function chop_slider($id) {
	if( ! is_file(dirname( __FILE__ ) . '/scripts/chopslider-' . $id . '.php') )
		return;
	//Get the Slider version	
	global $wpdb;
	$chopslider_version = $wpdb->get_var('SELECT version FROM ' . CHOPSLIDER_TABLE_NAME . ' WHERE chopslider_id =' . $id);
	$wpdb->flush();
	//Print Styles
	echo '<link rel="stylesheet" type="text/css" href="'.CHOPSLIDER_PLUGIN_URL.'css/chopslider-' . $id . '.css?ver=' . $chopslider_version . '"/>';
	//HTML Content of Slider
	include (dirname( __FILE__ ) . '/scripts/chopslider-' . $id . '.php');
	//Print Libraries Scripts in Footer
	add_action('wp_footer', 'reg_print_chopslider_scripts');
	if ( !function_exists("reg_print_chopslider_scripts") ) {
		function reg_print_chopslider_scripts($id){
			wp_register_script('jquery.id.chopslider-'.CHOPSLIDER_VERSION_CORE.'.pro.min.js', CHOPSLIDER_PLUGIN_URL . 'scripts/jquery.id.chopslider-'.CHOPSLIDER_VERSION_CORE.'.pro.min.js', array('jquery'));
			wp_register_script('jquery.id.cstransitions-'.CHOPSLIDER_VERSION_LIBRARY.'.min.js', CHOPSLIDER_PLUGIN_URL . 'scripts/jquery.id.cstransitions-'.CHOPSLIDER_VERSION_LIBRARY.'.min.js', array('jquery'));
			wp_print_scripts('jquery.id.chopslider-'.CHOPSLIDER_VERSION_CORE.'.pro.min.js');
			wp_print_scripts('jquery.id.cstransitions-'.CHOPSLIDER_VERSION_LIBRARY.'.min.js');
		}
	}
	//And the Configuration script
	wp_register_script('chopslider-' . $id . '.js', CHOPSLIDER_PLUGIN_URL . 'scripts/chopslider-' . $id . '.js', array('jquery'), $chopslider_version);
	wp_print_scripts('chopslider-' . $id . '.js');
}

/**
 * ------- Chop Slider Widget ------- 
*/
class ChopSlider extends WP_Widget {
	/** constructor */
	function ChopSlider() {
		parent::WP_Widget( 
			false, 
			$name = 'Chop Slider 2', 
			array('description' => "Animated jQuery image slider with over the 150 predefined and ready to use transitions effects" ) 
		);
	}
	/** @see WP_Widget::widget */
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title; 
		global $wpdb;
		$chopslider_result = $wpdb->get_row('SELECT chopslider_id, version FROM ' . CHOPSLIDER_TABLE_NAME . ' WHERE chopslider_id =' . $instance['id']);
		$wpdb->flush();
		if ($chopslider_result) {
			echo '<link rel="stylesheet" type="text/css" href="'.CHOPSLIDER_PLUGIN_URL.'css/chopslider-' . $instance['id'] . '.css?ver=' . $chopslider_result->version . '"/>'; 
			wp_register_script('chopslider-' . $instance['id'] . '.js', CHOPSLIDER_PLUGIN_URL . 'scripts/chopslider-' . $instance['id']. '.js', array('jquery'), $chopslider_result->version);
			wp_print_scripts('chopslider-' . $instance['id'] . '.js');
			include ('scripts/chopslider-' . $instance['id'] . '.php');
			
			add_action('wp_footer', 'reg_print_chopslider_scripts');
			
			
			if(!function_exists('reg_print_chopslider_scripts')) {
				function reg_print_chopslider_scripts() {
					wp_register_script('jquery.id.chopslider-'.CHOPSLIDER_VERSION_CORE.'.pro.min.js', CHOPSLIDER_PLUGIN_URL . 'scripts/jquery.id.chopslider-'.CHOPSLIDER_VERSION_CORE.'.pro.min.js', array('jquery'));
					wp_register_script('jquery.id.cstransitions-'.CHOPSLIDER_VERSION_LIBRARY.'.min.js', CHOPSLIDER_PLUGIN_URL . 'scripts/jquery.id.cstransitions-'.CHOPSLIDER_VERSION_LIBRARY.'.min.js', array('jquery'));
					wp_print_scripts('jquery.id.chopslider-'.CHOPSLIDER_VERSION_CORE.'.pro.min.js');
					wp_print_scripts('jquery.id.cstransitions-'.CHOPSLIDER_VERSION_LIBRARY.'.min.js');
				}
			}
		}
		echo $after_widget;
	}
	
	/** @see WP_Widget::update */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['id'] = strip_tags($new_instance['id']);
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

	/** @see WP_Widget::form */
	function form( $instance ) {
		if ( $instance ) {
			$id = esc_attr( $instance[ 'id' ] );
			$title = esc_attr( $instance[ 'title' ] );
		}
		else {
			$id = 0;
			$title = __( 'New title', 'text_domain' );
		}
		?>
        <p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>Select Chop Slider: <br />
        <select name="<?php echo $this->get_field_name('id'); ?>">
        <?php
		global $wpdb;
		$chopslider_result = $wpdb->get_results('SELECT chopslider_id, title FROM ' . CHOPSLIDER_TABLE_NAME . ' ORDER BY chopslider_id DESC'); 
		foreach ($chopslider_result as $single_chopslider){
			if ( $single_chopslider -> chopslider_id == $id) $selected = 'selected = "selected"';
			else $selected = '';
		?>	
            <option <?php echo $selected ?> value="<?php echo $single_chopslider -> chopslider_id ?>"><?php echo $single_chopslider -> title ?></option>
        <?php } ?>
        </select>
		</p>
        
		<?php 
	}

}
// register ChopSlider widget
add_action( 'widgets_init', create_function( '', 'return register_widget("ChopSlider");' ) );


/**
 * ------------------ Function to build and save Chop Slider configuration JavaScript, CSS and HTML Content files ------------------- 
*/
function chopslider_build_script_files($id) {
	global $wpdb;
	$chopSliderRes = $wpdb->get_row("SELECT * FROM ". CHOPSLIDER_TABLE_NAME ." WHERE chopslider_id =".$id);
	$chopSlider = unserialize($chopSliderRes->options);
	
	//JavaScript File
	$scriptContent="";
	include("builders/js-builder.php");
	
	$fp = fopen( dirname( __FILE__ ) . '/scripts/chopslider-' . $id . '.js', 'w+');
	if( fwrite ( $fp, $scriptContent ) ) $status = '';
	else $status = '';
	fclose($fp);
	
	
	//HTML File
	$chopSlider = unserialize($chopSliderRes->options);
	$htmlContent="";
	include("builders/html-builder.php");
	
	$fp = fopen( dirname( __FILE__ ) . '/scripts/chopslider-' . $id . '.php', 'w+');
	if( fwrite ( $fp, $htmlContent ) ) $status = '';
	else $status = '';
	fclose($fp);
	
	//CSS File
	$chopSlider = unserialize($chopSliderRes->options);
	$cssContent="";
	include("builders/css-builder.php");
	
	$fp = fopen( dirname( __FILE__ ) . '/css/chopslider-' . $id . '.css', 'w+');
	if( fwrite ( $fp, $cssContent ) ) $status = '';
	else $status = '';
	fclose($fp);
}
/* End Of File-builder function */
/* Re-Build All Files */
if ($_GET['rebuild']=='yes') {
	global $wpdb;
	$chopslider_rb_result = $wpdb->get_results('SELECT * FROM ' . CHOPSLIDER_TABLE_NAME . ' ORDER BY chopslider_id DESC'); 
	foreach ($chopslider_rb_result as $chopslider_rb) {
		chopslider_build_script_files($chopslider_rb->chopslider_id);
		$update_chopslider_row = $wpdb->update( 
			CHOPSLIDER_TABLE_NAME, 
			array( 'version' => ($chopslider_rb->version+1), 'created' => current_time('mysql') ), 
			array( 'chopslider_id' => $chopslider_rb->chopslider_id ) 
		);	
	}
	
	header("Location: admin.php?page=chopslider&rebuild=ok");	
}
?>