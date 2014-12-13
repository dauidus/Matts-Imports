<?php

function chopSliderReplaceQuotes($a) {
	return str_replace(array("\'", '\"'), array("'", '"'), $a);
};

$newChopSlider = array();
$newChopSlider['images'] = array();
$newChopSlider['links'] = array();
$newChopSlider['captions'] = array();
$newChopSlider['slideType'] = array();

foreach( $_POST['chopslider-image'] as $cs_image ) {
	array_push($newChopSlider['images'],  $cs_image);
};
foreach( $_POST['chopslider-slideType'] as $cs_type ) {
	array_push($newChopSlider['slideType'],  $cs_type);
};
foreach( $_POST['chopslider-link'] as $cs_link ) {
	array_push($newChopSlider['links'],  $cs_link);
};
foreach( $_POST['chopslider-caption'] as $cs_caption ) {
	$cs_caption = chopSliderReplaceQuotes($cs_caption);
	array_push($newChopSlider['captions'],  htmlentities($cs_caption, ENT_QUOTES, "UTF-8") );
};
/* Remove All Elements without images or HTML content */
foreach ( $newChopSlider['images'] as $csKey => $csValue ) {
	if ( empty( $csValue ) ) {
		unset ( $newChopSlider['captions'][$csKey] );
		unset ( $newChopSlider['links'][$csKey] );
		unset ( $newChopSlider['images'][$csKey] );
		unset ( $newChopSlider['slideType'][$csKey] );
	}
	if ( $newChopSlider['slideType'][$csKey]=="html" ) {
		$newChopSlider['images'][$csKey] = chopSliderReplaceQuotes($newChopSlider['images'][$csKey]);	
	}
};

/* Main Parameters */
$newChopSlider['title'] = chopSliderReplaceQuotes($_POST['chopslider-title']);
$newChopSlider['width'] = $_POST['chopslider-width'];
$newChopSlider['height'] = $_POST['chopslider-height'];
/* Autoplay */
$newChopSlider['autoplay'] = $_POST['chopslider-autoplay'];
$newChopSlider['autoplayDelay'] = $_POST['chopslider-autoplayDelay'];
/* Captions */
$newChopSlider['useCaptions'] = $_POST['chopslider-useCaptions'];
$newChopSlider['hideCaptions'] = $_POST['chopslider-hideCaptions'];
$newChopSlider['captionTransform'] = chopSliderReplaceQuotes($_POST['chopslider-captionTransform']);
$newChopSlider['showCaptionIn'] = $_POST['chopslider-showCaptionIn'];
/* Controllers */
$newChopSlider['navigationArrows'] = $_POST['chopslider-navigationArrows'];
$newChopSlider['hideTriggers'] = $_POST['chopslider-hideTriggers'];
$newChopSlider['pagination'] = $_POST['chopslider-pagination'];
$newChopSlider['hidePagination'] = $_POST['chopslider-hidePagination'];
$newChopSlider['prevTrigger'] = $_POST['chopslider-prevTrigger'];
$newChopSlider['nextTrigger'] = $_POST['chopslider-nextTrigger'];
$newChopSlider['sliderPagination'] = $_POST['chopslider-sliderPagination'];
/* Skin */
$newChopSlider['skin'] = $_POST['chopslider-skin'];
/* Extended Options */
$newChopSlider['addClass'] = chopSliderReplaceQuotes($_POST['chopslider-addClass']);
$newChopSlider['loaderIndex'] = chopSliderReplaceQuotes($_POST['chopslider-loaderIndex']);
$newChopSlider['full3D'] = chopSliderReplaceQuotes($_POST['chopslider-full3D']);
$newChopSlider['showFaces'] = $_POST['chopslider-showFaces'];
$newChopSlider['onStart'] = chopSliderReplaceQuotes($_POST['chopslider-onStart']);
$newChopSlider['onEnd'] = chopSliderReplaceQuotes($_POST['chopslider-onEnd']);

/* 2D Transitions */

$newChopSlider['t2D'] = array();

//Vertical 2D
if ( !empty($_POST['vertical2d']) ) {
	$chopSliderVertical2D = implode(",",$_POST['vertical2d']);
	$chopSliderVertical2D = str_replace("\'","'",$chopSliderVertical2D);
	if ( strpos ( $chopSliderVertical2D, "random" ) > 0 ) $chopSliderVertical2D = "csTransitions['vertical']['random']";
	$newChopSlider['vertical2d'] = array_map( "chopSliderReplaceQuotes", $_POST['vertical2d'] ) ;
	array_push( $newChopSlider['t2D'] , $chopSliderVertical2D);
}
else $newChopSlider['vertical2d'] = "";
//Horizontal 2D
if ( !empty($_POST['horizontal2d']) ) {
	$chopSliderHorizontal2D = implode(",",$_POST['horizontal2d']);
	$chopSliderHorizontal2D = str_replace("\'","'",$chopSliderHorizontal2D);
	if ( strpos ( $chopSliderHorizontal2D, "random" ) > 0 ) $chopSliderHorizontal2D = "csTransitions['horizontal']['random']";
	$newChopSlider['horizontal2d'] = array_map( "chopSliderReplaceQuotes", $_POST['horizontal2d'] ) ;
	array_push( $newChopSlider['t2D'] , $chopSliderHorizontal2D);
}
else $newChopSlider['horizontal2d'] = "";
//Multi 2D
if ( !empty($_POST['multi2d']) ) {
	$chopSliderMulti2D = implode(",",$_POST['multi2d']);
	$chopSliderMulti2D = str_replace("\'","'",$chopSliderMulti2D);
	if ( strpos ( $chopSliderMulti2D, "random" ) > 0 ) $chopSliderMulti2D = "csTransitions['multi']['random']";
	$newChopSlider['multi2d'] = array_map( "chopSliderReplaceQuotes", $_POST['multi2d'] ) ;
	array_push( $newChopSlider['t2D'] , $chopSliderMulti2D);
}
else $newChopSlider['multi2d'] = "";
//Half 2D
if ( !empty($_POST['half2d']) ) {
	$chopSliderHalf2D = implode(",",$_POST['half2d']);
	$chopSliderHalf2D = str_replace("\'","'",$chopSliderHalf2D);
	if ( strpos ( $chopSliderHalf2D, "random" ) > 0 ) $chopSliderHalf2D = "csTransitions['half']['random']";
	$newChopSlider['half2d'] = array_map( "chopSliderReplaceQuotes", $_POST['half2d'] ) ;
	array_push( $newChopSlider['t2D'] , $chopSliderHalf2D);
}
else $newChopSlider['half2d'] = "";
//Sexy 2D
if ( !empty($_POST['sexy2d']) ) {
	$chopSliderSexy2D = implode(",",$_POST['sexy2d']);
	$chopSliderSexy2D = str_replace("\'","'",$chopSliderSexy2D);
	if ( strpos ( $chopSliderSexy2D, "random" ) > 0 ) $chopSliderSexy2D = "csTransitions['sexy']['random']";
	$newChopSlider['sexy2d'] = array_map( "chopSliderReplaceQuotes", $_POST['sexy2d'] ) ;
	array_push( $newChopSlider['t2D'] , $chopSliderSexy2D);
}
else $newChopSlider['slide2d'] = "";
//Slide 2D
if ( !empty($_POST['slide2d']) ) {
	$chopSliderSlide2D = implode(",",$_POST['slide2d']);
	$chopSliderSlide2D = str_replace("\'","'",$chopSliderSlide2D);
	if ( strpos ( $chopSliderSlide2D, "random" ) > 0 ) $chopSliderSlide2D = "csTransitions['slide']['random']";
	$newChopSlider['slide2d'] = array_map( "chopSliderReplaceQuotes", $_POST['slide2d'] ) ;
	array_push( $newChopSlider['t2D'] , $chopSliderSlide2D);
}
else $newChopSlider['slide2d'] = "";

//Push them all into one array and then convert to string for JS
foreach ( $newChopSlider['t2D'] as $chopsliderKey => $chopsliderValue ) {
	if ($chopsliderValue == "") unset ( $newChopSlider['t2D'][$chopsliderKey] );
};
$newChopSlider['t2D'] = "[" . implode( ", ", $newChopSlider['t2D'] ) . "]";

/* 3D Transitions */

$newChopSlider['t3D'] = array();
//3D Blocks
if ( !empty($_POST['3dblocks']) ) {
	$chopSlider3DBlocks = implode(",",$_POST['3dblocks']);
	$chopSlider3DBlocks = str_replace("\'","'",$chopSlider3DBlocks);
	if ( strpos ( $chopSlider3DBlocks, "random" ) > 0 ) $chopSlider3DBlocks = "csTransitions['3DBlocks']['random']";
	$newChopSlider['3dblocks'] = array_map( "chopSliderReplaceQuotes", $_POST['3dblocks'] ) ;
	array_push( $newChopSlider['t3D'] , $chopSlider3DBlocks);
}
else $newChopSlider['3dblocks'] = "";
//3D Flips
if ( !empty($_POST['3dflips']) ) {
	$chopSlider3DFlips = implode(",",$_POST['3dflips']);
	$chopSlider3DFlips = str_replace("\'","'",$chopSlider3DFlips);
	if ( strpos ( $chopSlider3DFlips, "random" ) > 0 ) $chopSlider3DFlips = "csTransitions['3DFlips']['random']";
	$newChopSlider['3dflips'] = array_map( "chopSliderReplaceQuotes", $_POST['3dflips'] ) ;
	array_push( $newChopSlider['t3D'] , $chopSlider3DFlips);
}
else $newChopSlider['3dflips'] = "";

//3D Spheres
if ( !empty($_POST['3dsphere']) ) {
	$chopSlider3DSphere = implode(",",$_POST['3dsphere']);
	$chopSlider3DSphere = str_replace("\'","'",$chopSlider3DSphere);
	if ( strpos ( $chopSlider3DSphere, "random" ) > 0 ) $chopSlider3DSphere = "csTransitions['sphere']['random']";
	$newChopSlider['3dsphere'] = array_map( "chopSliderReplaceQuotes", $_POST['3dsphere'] ) ;
	array_push( $newChopSlider['t3D'] , $chopSlider3DSphere);
}
else $newChopSlider['3dsphere'] = "";

//Push them all into one array and then convert to string for JS
foreach ( $newChopSlider['t3D'] as $chopsliderKey => $chopsliderValue ) {
	if ($chopsliderValue == "") unset ( $newChopSlider['t3D'][$chopsliderKey] );
};
$newChopSlider['t3D'] = "[" . implode( ", ", $newChopSlider['t3D'] ) . "]";

/* NoCSS3 Transitions */

$newChopSlider['noCSS3'] = array();

if ( !empty($_POST['noCSS3']) ) {
	$chopSliderNoCSS3 = implode(",",$_POST['noCSS3']);
	$chopSliderNoCSS3 = str_replace("\'","'",$chopSliderNoCSS3);
	if ( strpos ( $chopSliderNoCSS3, "random" ) > 0 ) $chopSliderNoCSS3 = "csTransitions['noCSS3']['random']";
	$newChopSlider['NoCSS3'] = array_map( "chopSliderReplaceQuotes", $_POST['noCSS3'] ) ;
	array_push( $newChopSlider['noCSS3'] , $chopSliderNoCSS3);
}
else $newChopSlider['NoCSS3'] = "";
//Push them all into one array and then convert to string for JS
foreach ( $newChopSlider['noCSS3'] as $chopsliderKey => $chopsliderValue ) {
	if ($chopsliderValue == "") unset ( $newChopSlider['noCSS3'][$chopsliderKey] );
};
$newChopSlider['noCSS3'] = "[" . implode( ", ", $newChopSlider['noCSS3'] ) . "]";

/* Mobile Transitions */

$newChopSlider['mobile'] = array();

if ( !empty($_POST['mobile']) ) {
	$chopSliderNoCSS3 = implode(",",$_POST['mobile']);
	$chopSliderNoCSS3 = str_replace("\'","'",$chopSliderNoCSS3);
	if ( strpos ( $chopSliderNoCSS3, "random" ) > 0 ) $chopSliderNoCSS3 = "csTransitions['mobile']['random']";
	$newChopSlider['Mobile'] = array_map( "chopSliderReplaceQuotes", $_POST['mobile'] ) ;
	array_push( $newChopSlider['mobile'] , $chopSliderNoCSS3);
}
else $newChopSlider['Mobile'] = "";
//Push them all into one array and then convert to string for JS
foreach ( $newChopSlider['mobile'] as $chopsliderKey => $chopsliderValue ) {
	if ($chopsliderValue == "") unset ( $newChopSlider['mobile'][$chopsliderKey] );
};
$newChopSlider['mobile'] = "[" . implode( ", ", $newChopSlider['mobile'] ) . "]";

if( isset( $_POST['create-chopslider'] ) ) {
	/*
	Now we need to add all information into DB table
	*/
	global $wpdb;
	$new_chopslider_row = $wpdb->insert( 
		CHOPSLIDER_TABLE_NAME, 
		array( 'title' => $newChopSlider['title'], 'options' => serialize($newChopSlider), 'version' => '1', 'created' => current_time('mysql') ) 
	);
	
	
	if( $new_chopslider_row ) {
		$chopslider_status = 'Congratulations! New Chop Slider was successfully added!';
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
		$chopslider_status = 'Error occured while adding new Chop Slider!';
		$chopslider_status_class = 'error';
	};
	
	$wpdb->flush();
	
};

if( isset( $_POST['save-edited-chopslider'] ) ) {
	/*
	Now we need to update all information into DB table
	*/
	global $wpdb;
	$update_chopslider_row = $wpdb->update( 
		CHOPSLIDER_TABLE_NAME, 
		array( 'title' => $newChopSlider['title'], 'options' => serialize($newChopSlider), 'version' => $_POST['chopslider-new-version'], 'created' => current_time('mysql') ), 
		array( 'chopslider_id' => $_POST['chopslider_id'] ) 
	);
	$wpdb->flush();
	
	if( $update_chopslider_row ) {
		$chopslider_status = 'Chop Slider "' . $newChopSlider['title'] . '" was successfully updated!';
		$chopslider_status_class = 'updated';
		//And to rebuild aprropriate files and scripts
		chopslider_build_script_files($_POST['chopslider_id']);
	}
	else {
		$chopslider_status = 'Error occured while updating Chop Slider "' . $newChopSlider['title'] . '" !';
		$chopslider_status_class = 'error';
	};
	
}
?>