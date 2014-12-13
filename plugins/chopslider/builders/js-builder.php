<?php
//We already have $chopSlider Array with all variables;
//This file is used to generate JavaScript files on Slider create/update only

	if( empty( $chopSlider['full3D'] ) ) $chopSlider['full3D']  = '';
	if( $chopSlider['t2D'] == "[]" )  $chopSlider['t2D'] = 'false';
	if( $chopSlider['t3D'] == "[]" )  $chopSlider['t3D'] = 'false';
	if( $chopSlider['mobile'] == "[]" )  $chopSlider['mobile'] = 'false';
	if( $chopSlider['noCSS3'] == "[]" )  $chopSlider['noCSS3'] = 'false';
	
	if( $chopSlider['navigationArrows'] == "true" ) {
		if( empty( $chopSlider['nextTrigger'] ) ) $chopSlider['nextTrigger']  = '.chopslider-'.$id.' a.chopslider-next';
		if( empty( $chopSlider['prevTrigger'] ) ) $chopSlider['prevTrigger']  = '.chopslider-'.$id.' a.chopslider-prev';
	}
	else {
		$chopSlider['nextTrigger'] = '';
		$chopSlider['prevTrigger'] = '';
	}
	
	if( $chopSlider['pagination'] == "true" ) {
		if( empty( $chopSlider['sliderPagination'] ) ) $chopSlider['sliderPagination']  = '.chopslider-pagination-'.$id;
	}
	else {
		$chopSlider['sliderPagination']  = 'false';
	}
	
	if( empty( $chopSlider['showCaptionIn'] ) ) $chopSlider['showCaptionIn']  = '.chopslider-'.$id.' .chopslider-caption-'.$id;
	
	
	$scriptContent = "
jQuery(function(){
	jQuery('.chopslider-slides-$id').chopSlider({
		loaderIndex : '$chopSlider[loaderIndex]',
		/* Slide Element */
		slide : '.chopslider-slide-$id',
		activeSlideClass: 'cs-activeSlide-$id',
		/* Autoplay */
		autoplay : $chopSlider[autoplay],
		autoplayDelay : $chopSlider[autoplayDelay],
		/* Controlers */
		nextTrigger : '$chopSlider[nextTrigger]',
		prevTrigger : '$chopSlider[prevTrigger]',
		hideTriggers : $chopSlider[hideTriggers],
		/* Pagination */
		sliderPagination : '$chopSlider[sliderPagination]',
		hidePagination : $chopSlider[hidePagination],
		activePaginationClass : 'cs-active-pagination-$id',
		/* Captions */
		useCaptions : $chopSlider[useCaptions],
		hideCaptions : $chopSlider[hideCaptions],
		everyCaptionIn : '.chopslider-descr-".$id."',
		showCaptionIn : '$chopSlider[showCaptionIn]',
		captionTransform : '$chopSlider[captionTransform]',
		/* Transitions */
		t2D: $chopSlider[t2D],
		t3D: $chopSlider[t3D],
		full3D : '$chopSlider[full3D]',
		mobile: $chopSlider[mobile],
		noCSS3: $chopSlider[noCSS3],
		/* Callbacks */
		onStart: function(){ $chopSlider[onStart] },
		onEnd: function(){ $chopSlider[onEnd] },
		forceParameters : {
			showFaces: $chopSlider[showFaces]	
		}
	})
})	
";	
?>