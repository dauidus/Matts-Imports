<?php
global $wpdb;
$chopslider_result = $wpdb->get_row('SELECT * FROM ' . CHOPSLIDER_TABLE_NAME . ' WHERE chopslider_id =' . $_GET['id']); 
$wpdb->flush();
$chopslider = unserialize ($chopslider_result -> options);

function chopslider_checked($val1, $val2) {
	if ( $val1 == $val2 )
		echo 'checked="checked"';	
};
function chopslider_isTransition($array, $val) {
	if ( is_array($array) ) {
		if ( in_array ( $val, $array ) )
			echo 'checked="checked"';	
	}
};
function chopslider_selected($val1, $val2) {
	if ( $val1 == $val2 )
		echo 'selected="selected"';	
};
?>

<div class="wrap chopslider-form">
  <div class="metabox-holder">
    <h2>Edit Chop Slider &quot;<?php echo $chopslider['title'] ?>&quot;</h2>
    <form method="post" action="admin.php?page=chopslider">
      <input type="hidden" name="chopslider_id" value="<?php echo $_GET['id'] ?>" />
      <input type="hidden" name="chopslider-new-version" value="<?php  echo ( $chopslider_result -> version + 1 ) ?>" />
      <div class="postbox">
        <h3 class="hndle"><span>Title</span></h3>
        <div class="inside">
          <table class="form-table">
            <tbody>
              <tr>
                <th scope="row"><label for="chopslider-title">Title <span class="description">(required) :</span></label></th>
                <td><input type="text" name="chopslider-title" id="chopslider-title" aria-required="true" value="<?php echo $chopslider['title'] ?>" style="width:300px" /></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="postbox">
        <h3 class="hndle"><span>Dimension</span></h3>
        <div class="inside">
          <table class="form-table">
            <tbody>
              <tr class="form-field">
                <th scope="row"><label>Dimension <span class="description">(required) :</span></label>
                  <br />
                  <span class="cs-tip">Must be the same as the dimension of images</span></th>
                <td><input type="text" name="chopslider-width" id="chopslider-d-width"  aria-required="true" value="<?php echo $chopslider['width'] ?>" style="width:50px" />
                  x
                  <input type="text" name="chopslider-height" id="chopslider-d-height"  aria-required="true" value="<?php echo $chopslider['height'] ?>" style="width:50px" />
                  in px</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <h3 class="chop-slider-form-title">Slides / Images</h3>
      <table style="width:800px" cellpadding="0" cellspacing="0" class="wp-list-table widefat cs-slides-table">
        <thead>
          <tr>
            <th class="manage-column column-cb" scope="col">Ordering</th>
            <th class="manage-column" scope="col">Image URL / HTML Content</th>
            <th class="manage-column" scope="col">Thumbnail</th>
            <th>Choose / Upload</th>
            <th>Edit Slide</th>
            <th>Remove</th>
          </tr>
        </thead>
        <tbody>
          <?php 
		$chopslider_i = 1;
		foreach ($chopslider['images'] as $chopslider_key => $chopslider_image) {
		?>
          <tr>
            <td><div style="width:80px"><input type="text" readonly="readonly" size="2" value="<?php echo $chopslider_i ?>">
              <a class="chopslider-order-up" href="#"></a> <a class="chopslider-order-down" href="#"></a></div></td>
            <td>
            <p>
                <label><input type="radio" <?php if($chopslider['slideType'][$chopslider_key]!="html") echo 'checked="checked"'; ?> class="csSwitch2imageType" name="chopslider-fakeType[<?php echo $chopslider_i ?>]" /> Image</label> 
                &nbsp;&nbsp;&nbsp; 
                <label><input type="radio" <?php if($chopslider['slideType'][$chopslider_key]=="html") echo 'checked="checked"'; ?> class="csSwitch2htmlType" name="chopslider-fakeType[<?php echo $chopslider_i ?>]"  /> HTML Content</label>
                <input type="hidden" name="chopslider-slideType[]" value="image" />
                
            </p>
            <textarea id="cs-textarea-<?php echo $chopslider_i ?>" rows="2" name="chopslider-image[]" class="cs-upload_image" style="width:300px"><?php echo $chopslider_image ?></textarea>
            </td>
            <td class="cs-thumbnail">
            
            <?php if($chopslider['slideType'][$chopslider_key]=="html") { ?>
            	<div class="cs-html-thumb">HTML</div> 
			<?php } else { ?>
            <img src="<?php echo $chopslider_image ?>" width="100" />
            <?php } ?>
            </td>
            <td><input class="cs-upload_image_button button-primary" type="button" value="Choose Image" /></td>
            <td class="chopslider-edit"><input type="button" value="Edit" class="button-primary cs-edit-button">
              <div>
                <div class="cs-slide-edit-form">
                  <div class="chopslider-close-form"></div>
                  <p>Link URL:<br />
                    <input name="chopslider-link[]" type="text" value="<?php echo $chopslider['links'][$chopslider_key] ?>"/>
                  </p>
                  <p>Caption Text/HTML:<br />
                    <textarea name="chopslider-caption[]" rows="4" ><?php echo $chopslider['captions'][$chopslider_key] ?></textarea>
                  </p>
                </div>
              </div></td>
            <td><input type="button" value="X" style="color:red" class="button-secondary chopslider-remove"></td>
          </tr>
          <?php
			$chopslider_i++;
		}
		?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="6"><input type="button" value="Add New Slide" class="button-primary cs-add-new-slide"></td>
          </tr>
        </tfoot>
      </table>
      <div class="postbox">
        <h3 class="hndle"><span>Autoplay Settings</span></h3>
        <div class="inside">
          <table class="form-table">
            <tbody>
              <tr>
                <th scope="row"><label>Autoplay :</label></th>
                <td><select name="chopslider-autoplay">
                    <option value="false" <?php chopslider_selected( 'false', $chopslider['autoplay'] ) ?> >Disabled</option>
                    <option value="true" <?php chopslider_selected( 'true', $chopslider['autoplay'] ) ?> >Enabled</option>
                  </select></td>
              </tr>
              <tr>
                <th scope="row"><label>Autoplay Delay :</label></th>
                <td><input type="text" name="chopslider-autoplayDelay" value="<?php echo $chopslider['autoplayDelay'] ?>" style="width:50px"> ms</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="postbox">
        <h3 class="hndle"><span>Captions Settings</span></h3>
        <div class="inside">
          <table class="form-table">
            <tbody>
              <tr>
                <th scope="row"><label>Captions :</label></th>
                <td><select name="chopslider-useCaptions">
                    <option value="false" <?php chopslider_selected( 'false', $chopslider['useCaptions'] ) ?> >Disabled</option>
                    <option value="true" <?php chopslider_selected( 'true', $chopslider['useCaptions'] ) ?> >Enabled</option>
                  </select></td>
              </tr>
              <tr>
                <th scope="row"><label>Hide Captions :</label>
                  <br />
                  <span class="cs-tip">If "hide", then the Caption's container will be hidden in the beginning  of transition and shown after the transition will be completed</span></th>
                <td><select name="chopslider-hideCaptions">
                    <option value="true" <?php chopslider_selected( 'true', $chopslider['hideCaptions'] ) ?> >Hide</option>
                    <option value="false" <?php chopslider_selected( 'false', $chopslider['hideCaptions'] ) ?> >Do not hide</option>
                  </select></td>
              </tr>
              <tr>
                <th scope="row"><label>Caption 2D Transform Effect :</label>
                  <br />
                  <span class="cs-tip">Initial CSS3 Transform property of the caption before it will appear.<br />
                  <strong>If you leave it blank the caption will appear with simple fade effect</strong>.<br />
                  <strong>Format : scale(X, Y) translate(Xpx, Ypx) rotate(0deg)</strong><br />
                  <strong>For example : scale(0,0) translate(-600px, 0px) rotate(45deg)</strong> </span></th>
                <td><input type="text" name="chopslider-captionTransform" value="<?php echo $chopslider['captionTransform'] ?>" style="width:300px"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="postbox">
        <h3 class="hndle"><span>Controllers / Navigation</span></h3>
        <div class="inside">
          <table class="form-table">
            <tbody>
              <tr>
                <th scope="row"><label>Navigation Arrows :</label></th>
                <td><select name="chopslider-navigationArrows">
                    <option value="true" <?php chopslider_selected( 'true', $chopslider['navigationArrows'] ) ?> >Enabled</option>
                    <option value="false" <?php chopslider_selected( 'false', $chopslider['navigationArrows'] ) ?> >Disabled</option>
                  </select></td>
              </tr>
              <tr>
                <th scope="row"><label>Hide Navigation Arrows :</label>
                  <br />
                  <span class="cs-tip">If "hide", then the navigation arrows will be hidden in the beginning  of transition and shown after the transition will be completed</span></th>
                <td><select name="chopslider-hideTriggers">
                    <option value="true" <?php chopslider_selected( 'true', $chopslider['hideTriggers'] ) ?> >Hide</option>
                    <option value="false" <?php chopslider_selected( 'false', $chopslider['hideTriggers'] ) ?> >Do not hide</option>
                  </select></td>
              </tr>
              <tr>
                <th scope="row"><label>Pagination :</label></th>
                <td><select name="chopslider-pagination">
                    <option value="true" <?php chopslider_selected( 'true', $chopslider['pagination'] ) ?> >Enabled</option>
                    <option value="false" <?php chopslider_selected( 'false', $chopslider['pagination'] ) ?> >Disabled</option>
                  </select></td>
              </tr>
              <tr>
                <th scope="row"><label>Hide Pagination :</label>
                  <br />
                  <span class="cs-tip">If "hide", then the pagination "buttons" will be hidden in the beginning  of transition and shown after the transition will be completed</span></th>
                <td><select name="chopslider-hidePagination">
                    <option value="true" <?php chopslider_selected( 'true', $chopslider['hidePagination'] ) ?> >Hide</option>
                    <option value="false" <?php chopslider_selected( 'false', $chopslider['hidePagination'] ) ?> >Do not hide</option>
                  </select></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <h2>Transition Effects</h2>
      <div class="chopslider-inner">
        <p>Chop Slider comes with flexible 3-level effects degradation. It is based on features detection and with this feature Chop Slider will work in all browsers.<br />
          So the "top" effects level is the 3D Transforms (3D Blocks and 3D Flips), but it currently works in Webkit browsers - Chrome and Safari.</p>
        <p><strong>First level of degradation.</strong> If visitor's browser do not support 3D Transforms then Chop Slider will automatically switch the Transition to 2D Transforms (2D Vertical, Horizontal, Multi, Half and Sexy) - it is the most common case, and these transitions are supported by all modern browsers except Internet Explorer.</p>
        <p><strong>Second level of degradation.</strong> If visitor's browser do not support CSS3 2D Transforms then Chop Slider will switch the transition to the so called "No CSS3" transition effect. It is a little bit simple than previous (without rotation), but will look still awesome.</p>
        <p><strong>Third level of degradation</strong>. If user will visit site from his mobile device, then Chop Slider will switch the transition effect to the most simple "Mobile" transition</p>
      </div>
      <div class="postbox">
        <h3 class="hndle"><span>Transitions Library</span></h3>
        <div class="inside">
          <?php
	  /* We need to include file with a number of available transitions */
	  include dirname( __FILE__ ) . "/chopslider-transitions-state.php";	
	  ?>
          <p class="chopslider-inner">To preview all these transitions you can open "Transitions Library": <a href="?page=chopslider-transitions" id="cs-transitions-library" target="_blank" class="button-primary">Open Transitions Library</a> <em>(will be opened in a new browser window)</em></p>
        </div>
      </div>
      <div class="postbox">
        <h3 class="hndle"><span>Choose the 2D and 3D transitions</span></h3>
        <div class="inside">
          <p class="chopslider-inner">3D Transitions at the moment work only in Webkit browsers.</p>
          <ul class="cs-transitions">
            <li><strong>2D Vertical</strong></li>
            <?php
	$chopslider_i = 0;
	for ( $chopslider_i; $chopslider_i <= ($chopsliderTransitions['vertical2d'] - 1 ); $chopslider_i++ ) {
		$chopslider_transition = "csTransitions['vertical'][$chopslider_i]";
	?>
            <li>
              <label>
                <input type="checkbox" name="vertical2d[]" value="<?php echo $chopslider_transition ?>" <?php chopslider_isTransition($chopslider['vertical2d'], $chopslider_transition) ?> />
                Vertical <?php echo $chopslider_i ?></label>
            </li>
            <?php
	}
	?>
            <li>-------</li>
            <li>
              <label>
                <input class="chopslider-selectAll" type="checkbox" name="vertical2d[]" value="csTransitions['vertical']['random']" <?php chopslider_isTransition($chopslider['vertical2d'], "csTransitions['vertical']['random']") ?> />
                <strong>Select All</strong></label>
            </li>
          </ul>
          <ul class="cs-transitions">
            <li><strong>2D Horizontal</strong></li>
            <?php
	$chopslider_i = 0;
	for ( $chopslider_i; $chopslider_i <= ($chopsliderTransitions['horizontal2d'] - 1 ) ; $chopslider_i++ ) {
		$chopslider_transition = "csTransitions['horizontal'][$chopslider_i]";
	?>
            <li>
              <label>
                <input type="checkbox" name="horizontal2d[]" value="<?php echo $chopslider_transition ?>" <?php chopslider_isTransition($chopslider['horizontal2d'], $chopslider_transition) ?> />
                Horizontal <?php echo $chopslider_i ?></label>
            </li>
            <?php
	}
	?>
            <li>-------</li>
            <li>
              <label>
                <input class="chopslider-selectAll" type="checkbox" name="horizontal2d[]" value="csTransitions['horizontal']['random']" <?php chopslider_isTransition($chopslider['horizontal2d'], "csTransitions['horizontal']['random']") ?>/>
                <strong>Select All</strong></label>
            </li>
          </ul>
          <ul class="cs-transitions">
            <li><strong>2D Multi</strong></li>
            <?php
	$chopslider_i = 0;
	for ( $chopslider_i; $chopslider_i <= ($chopsliderTransitions['multi2d'] - 1 ); $chopslider_i++ ) {
		$chopslider_transition = "csTransitions['multi'][$chopslider_i]";
	?>
            <li>
              <label>
                <input type="checkbox" name="multi2d[]" value="<?php echo $chopslider_transition ?>" <?php chopslider_isTransition($chopslider['multi2d'], $chopslider_transition) ?>/>
                Multi <?php echo $chopslider_i ?></label>
            </li>
            <?php
	}
	?>
            <li>-------</li>
            <li>
              <label>
                <input class="chopslider-selectAll" type="checkbox" name="multi2d[]" value="csTransitions['multi']['random']" <?php chopslider_isTransition($chopslider['multi2d'], "csTransitions['multi']['random']") ?>/>
                <strong>Select All</strong></label>
            </li>
          </ul>
          <ul class="cs-transitions">
            <li><strong>2D Half</strong></li>
            <?php
	$chopslider_i = 0;
	for ( $chopslider_i; $chopslider_i <= ($chopsliderTransitions['half2d'] - 1 ) ; $chopslider_i++ ) {
		$chopslider_transition = "csTransitions['half'][$chopslider_i]";
	?>
            <li>
              <label>
                <input type="checkbox" name="half2d[]" value="<?php echo $chopslider_transition ?>" <?php chopslider_isTransition($chopslider['half2d'], $chopslider_transition) ?>/>
                Half <?php echo $chopslider_i ?></label>
            </li>
            <?php
	}
	?>
            <li>-------</li>
            <li>
              <label>
                <input class="chopslider-selectAll" type="checkbox" name="half2d[]" value="csTransitions['half']['random']" <?php chopslider_isTransition($chopslider['half2d'], "csTransitions['half']['random']" ) ?>/>
                <strong>Select All</strong></label>
            </li>
          </ul>
          <ul class="cs-transitions">
            <li><strong>2D "Sexy"</strong></li>
            <?php
	$chopslider_i = 0;
	for ( $chopslider_i; $chopslider_i <= ($chopsliderTransitions['sexy2d'] - 1 ) ; $chopslider_i++ ) {
		$chopslider_transition = "csTransitions['sexy'][$chopslider_i]";
	?>
            <li>
              <label>
                <input type="checkbox" name="sexy2d[]" value="<?php echo $chopslider_transition ?>" <?php chopslider_isTransition($chopslider['sexy2d'], $chopslider_transition) ?>/>
                Sexy <?php echo $chopslider_i ?></label>
            </li>
            <?php
	}
	?>
            <li>-------</li>
            <li>
              <label>
                <input class="chopslider-selectAll" type="checkbox" name="sexy2d[]" value="csTransitions['sexy']['random']" <?php chopslider_isTransition($chopslider['sexy2d'], "csTransitions['sexy']['random']" ) ?>/>
                <strong>Select All</strong></label>
            </li>
          </ul>
          <ul class="cs-transitions">
            <li><strong>2D Slide </strong></li>
            <?php
	$chopslider_i = 0;
	for ( $chopslider_i; $chopslider_i <= ($chopsliderTransitions['slide2d'] - 1 ) ; $chopslider_i++ ) {
		$chopslider_transition = "csTransitions['slide'][$chopslider_i]";
	?>
            <li>
              <label>
                <input type="checkbox" name="slide2d[]" value="csTransitions['slide'][<?php echo $chopslider_i ?>]" <?php chopslider_isTransition($chopslider['slide2d'], $chopslider_transition) ?>/>
                Slide <?php echo $chopslider_i ?></label>
            </li>
            <?php
	}
	?>
            <li>-------</li>
            <li>
              <label>
                <input class="chopslider-selectAll" type="checkbox" name="slide2d[]" value="csTransitions['slide']['random']" <?php chopslider_isTransition($chopslider['slide2d'], "csTransitions['slide']['random']" ) ?>/>
                <strong>Select All</strong></label>
            </li>
          </ul>
          
          <ul class="cs-transitions">
            <li><strong>3D Blocks</strong></li>
            <?php
	$chopslider_i = 0;
	for ( $chopslider_i; $chopslider_i <= ($chopsliderTransitions['3dblocks'] - 1 ) ; $chopslider_i++ ) {
		$chopslider_transition = "csTransitions['3DBlocks'][$chopslider_i]";
	?>
            <li>
              <label>
                <input type="checkbox" name="3dblocks[]" value="<?php echo $chopslider_transition ?>" <?php chopslider_isTransition($chopslider['3dblocks'], $chopslider_transition) ?>/>
                3D Blocks <?php echo $chopslider_i ?></label>
            </li>
            <?php
	}
	?>
            <li>-------</li>
            <li>
              <label>
                <input class="chopslider-selectAll" type="checkbox" name="3dblocks[]" value="csTransitions['3DBlocks']['random']" <?php chopslider_isTransition($chopslider['3dblocks'], "csTransitions['3DBlocks']['random']") ?>/>
                <strong>Select All</strong></label>
            </li>
          </ul>
          <ul class="cs-transitions">
            <li><strong>3D Flips</strong></li>
            <?php
	$chopslider_i = 0;
	for ( $chopslider_i; $chopslider_i <= ($chopsliderTransitions['3dflips'] - 1 ) ; $chopslider_i++ ) {
		$chopslider_transition = "csTransitions['3DFlips'][$chopslider_i]";
	?>
            <li>
              <label>
                <input type="checkbox" name="3dflips[]" value="<?php echo $chopslider_transition ?>"<?php chopslider_isTransition($chopslider['3dflips'], $chopslider_transition) ?> />
                3D Flips <?php echo $chopslider_i ?></label>
            </li>
            <?php
	}
	?>
            <li>-------</li>
            <li>
              <label>
                <input class="chopslider-selectAll" type="checkbox" name="3dflips[]" value="csTransitions['3DFlips']['random']" <?php chopslider_isTransition($chopslider['3dflips'], "csTransitions['3DFlips']['random']") ?>/>
                <strong>Select All</strong></label>
            </li>
          </ul>
          <ul class="cs-transitions">
            <li><strong>3D Sphere</strong></li>
            <?php
	$chopslider_i = 0;
	for ( $chopslider_i; $chopslider_i <= ($chopsliderTransitions['3dsphere'] - 1 ) ; $chopslider_i++ ) {
		$chopslider_transition = "csTransitions['sphere'][$chopslider_i]";
	?>
            <li>
              <label>
                <input type="checkbox" name="3dsphere[]" value="<?php echo $chopslider_transition ?>"<?php chopslider_isTransition($chopslider['3dsphere'], $chopslider_transition) ?> />
                Sphere <?php echo $chopslider_i ?></label>
            </li>
            <?php
	}
	?>
            <li>-------</li>
            <li>
              <label>
                <input class="chopslider-selectAll" type="checkbox" name="3dsphere[]" value="csTransitions['sphere']['random']" <?php chopslider_isTransition($chopslider['3dsphere'], "csTransitions['sphere']['random']") ?>/>
                <strong>Select All</strong></label>
            </li>
          </ul>
          <div style="clear:both"></div>
        </div>
      </div>
      <div class="postbox">
        <h3 class="hndle"><span>Choose the "noCSS3" transitions <a class="chopslider-expand-tg" href="#">Open</a></span></h3>
        <div class="inside">
          <div class="chopslider-tg-content">
            <p class="chopslider-inner">These transitions will be applied for the old browsers or for the browsers that do not support CSS3 transitions (like Internet Explorer). If you will not choose "noCSS3" transitions, then the 2D Transitions from the previous section will be used with a nice degradation mode.</p>
            <ul class="cs-transitions" style="float:none">
              <?php
	$chopslider_i = 0;
	for ( $chopslider_i; $chopslider_i <= ($chopsliderTransitions['noCSS3'] - 1 ) ; $chopslider_i++ ) {
		$chopslider_transition = "csTransitions['noCSS3'][$chopslider_i]";
	?>
              <li>
                <label>
                  <input type="checkbox" name="noCSS3[]" value="<?php echo $chopslider_transition ?>" <?php chopslider_isTransition($chopslider['NoCSS3'], $chopslider_transition) ?>/>
                  noCSS3 <?php echo $chopslider_i ?></label>
              </li>
              <?php
	}
	?>
              <li>-------</li>
              <li>
                <label>
                  <input class="chopslider-selectAll" type="checkbox" name="noCSS3[]" value="csTransitions['noCSS3']['random']" <?php chopslider_isTransition($chopslider['NoCSS3'], "csTransitions['noCSS3']['random']") ?>/>
                  <strong>Select All</strong></label>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="postbox">
        <h3 class="hndle"><span>Choose the "Mobile" transitions <a class="chopslider-expand-tg" href="#">Open</a></span></h3>
        <div class="inside">
          <div class="chopslider-tg-content">
            <p class="chopslider-inner">These transitions will be used for the mobile devices. If you will not choose any "mobile" transitions, then the 2D Transitions from the previous section will be used in a degradation mode if the mobile browser do not support 3D or 2D CSS3 transforms. It is recommended to leave these transitions empty, because even the iOS devices support 3D transforms and transitions</p>
            <ul class="cs-transitions" style="float:none">
              <?php
	$chopslider_i = 0;
	for ( $chopslider_i; $chopslider_i <= ($chopsliderTransitions['mobile'] - 1 ) ; $chopslider_i++ ) {
		$chopslider_transition = "csTransitions['mobile'][$chopslider_i]";
	?>
              <li>
                <label>
                  <input type="checkbox" name="mobile[]" value="<?php echo $chopslider_transition ?>" <?php chopslider_isTransition($chopslider['Mobile'], $chopslider_transition) ?>/>
                  Mobile <?php echo $chopslider_i ?></label>
              </li>
              <?php
	}
	?>
              <li>-------</li>
              <li>
                <label>
                  <input class="chopslider-selectAll" type="checkbox" name="mobile[]" value="csTransitions['mobile']['random']" <?php chopslider_isTransition($chopslider['Mobile'], "csTransitions['mobile']['random']") ?>/>
                  <strong>Select All</strong></label>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="postbox">
        <h3 class="hndle"><span>Choose the Visual Skin <a class="chopslider-expand-tg" href="#">Close</a></span></h3>
        <div class="inside">
          <div class="chopslider-tg-content" style="display:block">
            <p class="chopslider-skin-labels">
              <label>
                <input type="radio" name="chopslider-skin" value="clean-white" <?php chopslider_checked('clean-white', $chopslider['skin']) ?> />
                Clean White</label>
              <label>
                <input type="radio" name="chopslider-skin" value="clean-black" <?php chopslider_checked('clean-black', $chopslider['skin']) ?> />
                Clean Black</label>
              <label>
                <input type="radio" name="chopslider-skin" value="minimal" <?php chopslider_checked('minimal', $chopslider['skin']) ?> />
                Minimal</label>
              <label>
                <input type="radio" name="chopslider-skin" value="black-back" <?php chopslider_checked('black-back', $chopslider['skin']) ?> />
                Black-Back</label>
              <label>
                <input type="radio" name="chopslider-skin" value="big-caption" <?php chopslider_checked('big-caption', $chopslider['skin']) ?> />
                Big Caption</label>
            </p>
            <p style="text-align:center; font-style:italic; width:800px; margin:0 auto">All Skin's elements are dynamic, it is mean that if you will not use (for example) Captions, then the Captions container will not be shown. Also note that some skins, like "Minimal", do not support Captions and if you want to use captions with this Skin you need to use custom container with Captions (see extended parameters)</p>
            <div class="chopslider-skins" >
              <div class="chopslider-skin"><img src="<?php echo plugin_dir_url( __FILE__ )  ?>images/skins/1-clean-white.jpg"/></div>
              <div class="chopslider-skin"><img src="<?php echo plugin_dir_url( __FILE__ )  ?>images/skins/2-clean-black.jpg"/></div>
              <div class="chopslider-skin"><img src="<?php echo plugin_dir_url( __FILE__ )  ?>images/skins/3-minimal.jpg"/></div>
              <div class="chopslider-skin"><img src="<?php echo plugin_dir_url( __FILE__ )  ?>images/skins/4-black-back.jpg"/></div>
              <div class="chopslider-skin"><img src="<?php echo plugin_dir_url( __FILE__ )  ?>images/skins/5-big-caption.jpg"/></div>
            </div>
          </div>
        </div>
      </div>
      <div class="postbox">
        <h3 class="hndle"><span>Extended Parameters (Fro Pro Users Only) <a class="chopslider-expand-tg" href="#">Open</a></span></h3>
        <div class="inside">
          <div class="chopslider-tg-content">
            <table class="form-table">
              <tbody>
                <tr>
                  <th scope="row"><label>Additional CSS class :</label>
                    <br />
                    <span class="cs-tip">This CSS class will be added to the Slider's container. You can use it for custom CSS styling<br />
                    <strong>For example : my-slider</strong> (without dot "." !)</span></th>
                  <td><input type="text" name="chopslider-addClass" value="<?php echo $chopslider['addClass'] ?>" style="width:300px"></td>
                </tr>
                <tr>
                  <th scope="row"><label>Custom "Left Arrow" Element :</label>
                    <br />
                    <span class="cs-tip">If you want to use your own element for the "Left Arrow" you need to specify here CSS selector of this element. And do not forget to add this element on your site.<br />
                    <strong>For example : a#slide-prev</strong></span></th>
                  <td><input type="text" name="chopslider-prevTrigger" value="<?php echo $chopslider['prevTrigger'] ?>" style="width:300px"></td>
                </tr>
                <tr>
                  <th scope="row"><label>Custom "Right Arrow" Element :</label>
                    <br />
                    <span class="cs-tip">The same as previous one but for the "Right Arrow"<br />
                    <strong>For example : a#slide-next</strong></span></th>
                  <td><input type="text" name="chopslider-nextTrigger" value="<?php echo $chopslider['nextTrigger'] ?>" style="width:300px"></td>
                </tr>
                <tr>
                  <th scope="row"><label>Custom "Pagination" Element :</label>
                    <br />
                    <span class="cs-tip">If you want to use your own pagination "button" element you need to specify here CSS selector of this element.<br />
                    You need to add not only one element. Number of these elements must be equal to the number of slides.<br />
                    <strong>For example : span.pagination-button</strong></span></th>
                  <td><input type="text" name="chopslider-sliderPagination" value="<?php echo $chopslider['sliderPagination'] ?>" style="width:300px"></td>
                </tr>
                <tr>
                  <th scope="row"><label>Custom Container With Captions :</label>
                    <br />
                    <span class="cs-tip">If you want to use your own container (element) to show captions in you need to specify here CSS selector of this element.<br />
                    <strong>For example : div#my-captions</strong></span></th>
                  <td><input type="text" name="chopslider-showCaptionIn" value="<?php echo $chopslider['showCaptionIn'] ?>" style="width:300px"></td>
                </tr>
                <tr>
                  <th scope="row"><label>Loader Z-Index :</label>
                    <br />
                    <span class="cs-tip">z-index CSS property for the so called Slider Loader Container </span> </th>
                  <td><input type="text" name="chopslider-loaderIndex" value="<?php echo $chopslider['loaderIndex'] ?>" style="width:300px"></td>
                </tr>
                <tr>
                  <th scope="row"><label>Full 3D Mode :</label>
                    <br />
                    <span class="cs-tip">Initial CSS3 3D Transform property for the container with Slides.<br />
                    <strong>1. If you leave it blank the "Full 3D Mode" will be disabled</strong><br />
                    <strong>2. Full 3D Mode works properly only with 3D Flips transitions</strong><br />
                    <strong>3. For example : rotateX(40deg) rotateY(60deg)</strong></span> </th>
                  <td><input type="text" name="chopslider-full3D" value="<?php echo $chopslider['full3D'] ?>" style="width:300px"></td>
                </tr>
                <tr>
                  <th scope="row"><label>Render 3D Back-Faces :</label>
                    <br />
                    <span class="cs-tip">If enabled, then Chop Slider will add 3D back-faces to make the 3D effects more realistic</span></th>
                  <td><select name="chopslider-showFaces">
                      <option value="true" <?php chopslider_selected( 'true', $chopslider['showFaces'] ) ?> >Enabled</option>
                      <option value="false" <?php chopslider_selected( 'false', $chopslider['showFaces'] ) ?> >Disabled</option>
                    </select></td>
                </tr>
                <tr>
                  <th scope="row"><label>On Start Callback Function :</label>
                    <br />
                    <span class="cs-tip">Name of Javascript function that will be executed in the beginning of transition<br />
                    <strong>For example : myOnStartFunction()</strong></span> </th>
                  <td><input type="text" name="chopslider-onStart" value="<?php echo $chopslider['onStart'] ?>" style="width:300px"></td>
                </tr>
                <tr>
                  <th scope="row"><label>On End Callback Function :</label>
                    <br />
                    <span class="cs-tip">Name of Javascript function that will be executed when the transition will be completed<br />
                    <strong>For example : myOnEndFunction()</strong></span> </th>
                  <td><input type="text" name="chopslider-onEnd" value="<?php echo $chopslider['onEnd'] ?>" style="width:300px"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <h2>Preview</h2>
      <div class="chopslider-inner">
        <p>Click the "Generate Preview" button to watch the transitions effects you've chose before with the selected/uploaded images. Please note that the generated preview will not use Autoplay, Captions, Pagination and other options. It is intended to show how the chosen transitions will look with the selected / uploaded images.</p>
        <p>
          <input type="button" class="button-secondary" value="Generate Preview" id="cs-generate-preview" />
        </p>
      </div>
      <h2>Save Chop Slider</h2>
      <input type="submit" value="Save Chop Slider" class="button-primary" name="save-edited-chopslider">
      <a class="button-secondary" href="admin.php?page=chopslider">Cancel</a>
    </form>
    
    <!--New Slide Template-->
    <table class="cs-slide-table-template">
      <tbody>
        <tr>
          <td><input type="text" readonly="readonly" size="2" value="<?php echo count($chopslider['images'])+1 ?>">
            <a class="chopslider-order-up" href="#"></a> <a class="chopslider-order-down" href="#"></a></td>
          <td>
          <p>
                <label><input type="radio" checked="checked" class="csSwitch2imageType" name="chopslider-fakeType[<?php echo count($chopslider['images'])+1 ?>]" /> Image</label> 
                &nbsp;&nbsp;&nbsp; 
                <label><input type="radio" class="csSwitch2htmlType" name="chopslider-fakeType[<?php echo count($chopslider['images'])+1 ?>]"  /> HTML Content</label>
                <input type="hidden" name="chopslider-slideType[]" value="image" />
                
            </p>
          <textarea id="cs-textarea-<?php echo count($chopslider['images'])+1 ?>" rows="2" name="chopslider-image[]" class="cs-upload_image" style="width:300px"></textarea>
          </td>
          <td class="cs-thumbnail"></td>
          <td><input class="cs-upload_image_button button-primary" type="button" value="Choose Image" /></td>
          <td class="chopslider-edit"><input type="button" value="Edit" class="button-primary cs-edit-button">
            <div>
              <div class="cs-slide-edit-form">
                <div class="chopslider-close-form"></div>
                <p>Link URL:<br />
                  <input name="chopslider-link[]" type="text"/>
                </p>
                <p>Caption Text/HTML:<br />
                  <textarea name="chopslider-caption[]" rows="4"></textarea>
                </p>
              </div>
            </div></td>
          <td><input type="button" value="X" style="color:red"  class="button-secondary chopslider-remove"></td>
        </tr>
      </tbody>
    </table>
    <!--Chop Slider Preview-->
    <div id="chop-slider-white-layer">
      <div class="cs-close-preview">Close Preview</div>
      <div class="cs-switch-bg">Switch Background</div>
    </div>
    <div id="chopslider"> <a id="cs-slide-prev" href="#"></a> <a id="cs-slide-next" href="#"></a>
      <div class="chopslider"> </div>
    </div>
  </div>
</div>
