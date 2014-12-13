<?php
if( isset( $_POST['create-chopslider'] ) || isset( $_POST['save-edited-chopslider'] ) ) {
	include_once dirname( __FILE__ ) . "/chopslider-admin-form-handler.php";
	chopslider_update_editor_dialog();
}
?>
<?php
if(!empty ( $_GET['remove_chopslider'] ) ) {
	include_once dirname( __FILE__ ) . "/chopslider-admin-remove.php";
	chopslider_update_editor_dialog();
}
?>
<?php
if(!empty ( $_POST['chopslider-action'] ) ) {
	include_once dirname( __FILE__ ) . "/chopslider-bulk-actions.php";
	chopslider_update_editor_dialog();
}
?>
<?php
global $wpdb;
$chopslider_result = $wpdb->get_results('SELECT * FROM ' . CHOPSLIDER_TABLE_NAME . ' ORDER BY chopslider_id DESC'); 
$wpdb->flush();
?>
<?php
if($_GET['rebuild']=="ok") {
	$chopslider_status_class = 'updated';
	$chopslider_status = "All files were successfully regenerated and updated!";
}

?>
<div class="wrap">
  <h2>Chop Slider 2</h2>
  <?php if ( !empty( $chopslider_status ) ) : ?>
  <div class="chopslider-status <?php echo $chopslider_status_class ?>">
    <h3><?php echo $chopslider_status ?></h3>
    <div class="chopslider-status-close">close</div>
  </div>
  <?php endif; ?>
  <?php if ( $chopslider_result ) { ?>
  <p style="text-align:left"><a class="button-primary" href="?page=chopslider-add-slider">Add New Chop Slider</a></p>
  <span id="file-viewer-path" style="display:none"><?php echo plugin_dir_url( __FILE__ )."chopslider-fileviewer.php" ?></span>
  <form id="chopslider-ba-form" method="post" action="">
    <table cellpadding="0" cellspacing="0" class="wp-list-table widefat">
      <thead>
        <tr>
          <th class="check-column"><input type="checkbox" value="all" name="chopslider-id[]" /></th>
          <th scope="col">Title</th>
          <th>Shortcode</th>
          <th>Template Tag</th>
          <th>Images</th>
          <th>Files</th>
          <th>Version</th>
          <th>Created / Updated</th>
          <th>Edit</th>
          <th>Remove</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($chopslider_result as $single_chopslider) : ?>
        <tr>
          <td style="vertical-align:top"><input type="checkbox" value="<?php echo $single_chopslider -> chopslider_id ?>" name="chopslider-id[]" /></td>
          <td class="title column-title"><?php echo $single_chopslider -> title ?></td>
          <td>[chopslider id="<?php echo $single_chopslider -> chopslider_id ?>"]</td>
          <td>&lt;?php chop_slider(<?php echo $single_chopslider -> chopslider_id ?>) ?&gt;</td>
          <td><?php 
			$chopslider_options = unserialize($single_chopslider->options);
			foreach ($chopslider_options['images'] as $key=>$chopslider_image):
			if($chopslider_options['slideType'][$key]=="html") echo '<div class="cs-html-thumb">HTML</div> ';
			else {
		?>
            <img class="cs-manage-slide-thumb" src="<?php echo $chopslider_image?>" width="100" />
            <?php 
			}
			endforeach ?></td>
          <td><a 
          	href="#" 
            class="chopslider-file-viewer" 
            data-url="<?php echo plugin_dir_url( __FILE__ )."css/chopslider-".$single_chopslider->chopslider_id.".css" ?>"
            data-id="<?php echo $single_chopslider -> chopslider_id ?>" 
            data-title="<?php echo $single_chopslider -> title ?>"
            data-code="CSS"
          ><strong>CSS</strong></a> | <a 
          	href="#" 
            class="chopslider-file-viewer" 
            data-url="<?php echo plugin_dir_url( __FILE__ )."scripts/chopslider-".$single_chopslider->chopslider_id.".php" ?>"
            data-id="<?php echo $single_chopslider -> chopslider_id ?>" 
            data-title="<?php echo $single_chopslider -> title ?>"
            data-code="HTML"
          ><strong>HTML</strong></a></td>
          <td><?php echo $single_chopslider->version ?></td>
          <td><?php echo $single_chopslider->created ?></td>
          <td><a href="?page=chopslider-edit-slider&amp;id=<?php echo $single_chopslider -> chopslider_id ?>" class="button-primary">Edit</a></td>
          <td><a href="?page=chopslider&amp;remove_chopslider=<?php echo $single_chopslider -> chopslider_id ?>" class="button-secondary chopslider_remove" style="color:red">X</a></td>
        </tr>
        <?php endforeach ?>
      </tbody>
      <tfoot>
        <tr>
          <td><input type="checkbox" value="all" name="chopslider-id[]" /></td>
          <td colspan="9"><select name="chopslider-action" style="width:150px">
              <option value="" selected="selected">Bulk Actions</option>
              <option value="copy">Copy</option>
              <option value="delete">Delete</option>
            </select>
            <input id="submit-chopslider-bulk-actions" name="chopslider-bulk-actions" type="submit" class="button-secondary" value="Apply" /></td>
        </tr>
      </tfoot>
    </table>
  </form>
  <p style="text-align:left"><a class="button-primary" href="?page=chopslider-add-slider">Add New Chop Slider</a></p>
  <h3 style="font-weight:normal; font-style:italic">Legend</h3>
  <p><span class="chopslider-help"></span><strong>Shortcode</strong> - You can use this shortcode to insert created Slider into the Post or on some Page. Just Copy and Paste it to the Text Editor.</p>
  <p><span class="chopslider-help"></span><strong>Template Tag</strong> - If you want to integrate Chop Slider into the Theme code, you need to call the PHP function <strong>chop_slider($id)</strong> with the ID number of required Chop Slider.</p>
  <p><span class="chopslider-help"></span><strong>Files</strong> - Click on the file type to open the window (file-viewer) with a content of generated file. You can use this information to know what CSS classes you need to use for custom styling.</p>
  <p><span class="chopslider-help"></span><strong>Version</strong> - Version of created Chop Slider. It is used to refresh caching of the generated scripts.</p>
  <?php }
  else {
  ?>
  <p>Seems to be you have not created Chop Sliders. Click the button bellow to create your first Chop Slider:</p>
  <p style="text-align:left"><a class="button-primary" href="?page=chopslider-add-slider">Add New Chop Slider</a></p>
  <?php } ?>
  <h2>Chop Slider Dashboard</h2>
  <div class="metabox-holder">
    <div class="postbox-container" style="width:49.5%"> 
      <!-- Versions -->
      <div class="postbox" style="margin-top:0px;">
        <h3 class="hndle"><span>Chop Slider Plugins Versions</span></h3>
        <div class="inside">
          <?php include ("chopslider-versions-state.php") ?>
          <p>Chop Slider 2 Wordpress Plugin : <strong>v<span id="chopslider-version-wp"><?php echo $chopsliderVersions['wp'] ?></span> <span class="chopslider-new-version"></span></strong> </p>
          <p>jQuery Chop Slider (core plugin) : <strong>v<span id="chopslider-version-core"><?php echo $chopsliderVersions['core'] ?></span> <span class="chopslider-new-version"></span></strong> </p>
          <p>Transitions Library : <strong>v<span id="chopslider-version-library"><?php echo $chopsliderVersions['library'] ?></span> <span class="chopslider-new-version"></span></strong> </p>
          <p><a href="#" id="chopslider-check-updates" class="button-secondary">Check For Updates</a></p>
          <p id="chopslider-new-versions" style="display:none"></p>
          <p id="chopslider-new-versions-changelog" style="display:none"></p>
        </div>
      </div>
      <!-- Twitter -->
      <div class="postbox" style="margin-top:0">
        <h3 class="hndle"><span>Chop Slider on Twitter</span></h3>
        <div class="inside">
          <ul id="chopslider-tweets">
          </ul>
        </div>
      </div>
    </div>
    <div class="postbox-container" style="width:49.5%"> 
      <!-- Transitions State -->
      <div class="postbox" style="margin-top:0px;">
        <h3 class="hndle"><span>Plugin Settings</span> <a class="chopslider-expand-tg" href="#">Open</a></h3>
        <div class="inside">
          <div class="chopslider-tg-content">
          <form action="options.php" method="post">
            <div class="chopslider-settings">
				<?php settings_fields( 'chopslider_settings' );?>
                <?php do_settings_sections( 'general' ); ?>
                </div>
                <p class="submit" style="padding:0; margin-top:0">
                  <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
                </p>
            <div class="chopslider-settings">
            	<h4>Re-build Generated Files</h4>
            </div>
            <p>You can re-build all generated HTML, CSS and JS files for the created sliders if they are some reason corrupted, or after update the Chop Slider to a new version:</p>
            <p><a class="button-secondary" href="?page=chopslider&amp;rebuild=yes">Re-build all files</a></p>
          </form>
          </div>
        </div>
      </div>
      <!-- Transitions State -->
      <div class="postbox" style="margin-top:0px;">
        <h3 class="hndle"><span>Transitions Library State</span></h3>
        <div class="inside">
          <?php include ("chopslider-transitions-state.php") ?>
          <?php 
		  $transitionsAmount = 0;
		  foreach ($chopsliderTransitions as $transitionNumber) {
			$transitionsAmount += $transitionNumber;  
		  }
		  ?>
          <p>There are <strong><?php echo $transitionsAmount ?></strong> available transitions:</p>
          <ul class="styled-list">
            <li>2D Vertical : <?php echo $chopsliderTransitions['vertical2d'] ?></li>
            <li>2D Horizontal : <?php echo $chopsliderTransitions['horizontal2d'] ?></li>
            <li>2D Multi : <?php echo $chopsliderTransitions['multi2d'] ?></li>
            <li>2D Half Transitions : <?php echo $chopsliderTransitions['half2d'] ?></li>
            <li>2D Sexy : <?php echo $chopsliderTransitions['sexy2d'] ?></li>
            <li>3D Blocks : <?php echo $chopsliderTransitions['3dblocks'] ?></li>
            <li>3D Flips : <?php echo $chopsliderTransitions['3dflips'] ?></li>
            <li>3D Spheres : <?php echo $chopsliderTransitions['3dsphere'] ?></li>
            <li>noCSS3 : <?php echo $chopsliderTransitions['noCSS3'] ?></li>
            <li>mobile : <?php echo $chopsliderTransitions['mobile'] ?></li>
          </ul>
          <p><a href="?page=chopslider-transitions" class="button-secondary">Open Transitions Library</a></p>
        </div>
      </div>
      <!-- Docs -->
      <div class="postbox"  >
        <h3 class="hndle"><span>Tutorial Videos</span></h3>
        <div class="inside">
          <p><strong>Integration With Shortcodes</strong><br />
            How to create and integrate Chop Slider 2 to the Post or Page using shortcodes with official Wordpress plugin just for 3 minutes!<br />
            <a href="http://www.youtube.com/watch?v=kGLLx-s4i38" target="_blank"><em>Watch this video</em></a> </p>
          <p><strong>Integration With Widget</strong><br />
            How to create and integrate Chop Slider 2 to Wordpress theme with a Chop Slider 2 widget just for 3 minutes!<br />
            <a href="http://www.youtube.com/watch?v=8KaYwsFbhdc" target="_blank"><em>Watch this video</em></a> </p>
          <p><strong>Integration With Template Tag</strong><br />
            How to create, and integrate Chop Slider 2 to the Wordpress theme with Chop Slider 2 Wordpress plugin<br />
            <a href="http://www.youtube.com/watch?v=jpOKr_j7tBg" target="_blank"><em>Watch this video</em></a> </p>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="chopslider-popup">
  <div id="chopslider-popup-close" class="chopslider-popup-close"></div>
  <div class="chopslider-popup-content"></div>
</div>
