<?php
//We already have $chopSlider Array with all variables;
//This file is used to generate HTML files on Slider create/update only

/* For Clean skins */
if( $chopSlider['skin'] == 'clean-white' || $chopSlider['skin'] == 'clean-black') {

	$htmlContent = '
<div class="chopslider-' . $id . ' chopslider ' . $chopSlider['addClass'] . '">
	<div class="chopslider-slides-' . $id . ' chopslider-slides">';
		$__i=0;
		foreach ($chopSlider['images'] as $key => $singleImage) {
			$__i++;
			if ( $__i==1) $activeClass = "cs-activeSlide-$id";
			else $activeClass = "";
			if ($chopSlider['slideType'][$key]=="html") $contentSlide = 'cs-content-slide';
			else $contentSlide="";
			$htmlContent .='
		<div class="chopslider-slide-' . $id . ' chopslider-slide ' . $activeClass . ' '.$contentSlide.'">';
			if (!$contentSlide) {
				if ( !empty ($chopSlider['links'][$key]) ) $htmlContent .='<a href="' . $chopSlider['links'][$key] . '">';	
				$htmlContent .='<img src="' . $singleImage . '" width="' . $chopSlider['width'] . '" height="' . $chopSlider['height'] . '" alt=" "/>';
				if ( !empty ($chopSlider['links'][$key]) ) $htmlContent .='</a>';
			}
			else $htmlContent .=$singleImage;
			$htmlContent.='</div>';
		}
$htmlContent.='	
	</div>';
	if ( (empty($chopSlider['nextTrigger']) && empty($chopSlider['nextTrigger'])) && $chopSlider['navigationArrows'] == 'true') {
		$htmlContent.='
	<a class="chopslider-next" href="#" ></a>';
		$htmlContent.='
	<a class="chopslider-prev" href="#" ></a>';	
	}
	if ( $chopSlider['useCaptions'] == 'true' ) {
		$htmlContent.='
	<div>';
		foreach ( $chopSlider['captions'] as $capText ) {
			$htmlContent.='
		<div class="chopslider-descr-' . $id . ' chopslider-descr">'. html_entity_decode($capText) .'</div>';	
			
		}
		$htmlContent.='
	</div>';
		if ( empty ($chopSlider['showCaptionIn']) ) {
			$htmlContent.='
	<div class="chopslider-caption chopslider-caption-'. $id .'"></div>';
		}
	}
	if ( $chopSlider['pagination'] == 'true' && empty( $chopSlider['sliderPagination'] ) ) {
		$htmlContent.='
	<div class="chopslider-pagination-wrap">';
		foreach ( $chopSlider['images'] as $capText ) {
			$htmlContent.='
		<span class="chopslider-pagination-' . $id . ' chopslider-pagination"></span>';
			
		}
		$htmlContent.='
	</div>';
	}
$htmlContent.='	
</div>	
';		
}
//End of Clean skins

/* For Minimal skin */
if( $chopSlider['skin'] == 'minimal') {

	$htmlContent = '
<div class="chopslider-' . $id . ' chopslider ' . $chopSlider['addClass'] . '">
	<div class="chopslider-slides-' . $id . ' chopslider-slides">';
		$__i=0;
		foreach ($chopSlider['images'] as $key => $singleImage) {
			$__i++;
			if ( $__i==1) $activeClass = "cs-activeSlide-$id";
			else $activeClass = "";
			if ($chopSlider['slideType'][$key]=="html") $contentSlide = 'cs-content-slide';
			else $contentSlide="";
			
			$htmlContent .='
		<div class="chopslider-slide-' . $id . ' chopslider-slide ' . $activeClass . ' '.$contentSlide.'">';
			if (!$contentSlide) {
				if ( !empty ($chopSlider['links'][$key]) ) $htmlContent .='<a href="' . $chopSlider['links'][$key] . '">';	
				$htmlContent .='<img src="' . $singleImage . '" width="' . $chopSlider['width'] . '" height="' . $chopSlider['height'] . '" alt=" "/>';
				if ( !empty ($chopSlider['links'][$key]) ) $htmlContent .='</a>';
			}
			else $htmlContent.=$singleImage;
			$htmlContent.='</div>';
		}
$htmlContent.='	
	</div>';
	$chopsliderUseNativeArrows = (empty($chopSlider['nextTrigger']) && empty($chopSlider['nextTrigger'])) && $chopSlider['navigationArrows'] == 'true';
	$chopsliderUseNativePagination = $chopSlider['pagination'] == 'true' && empty( $chopSlider['sliderPagination'] );
	if ( $chopsliderUseNativeArrows ||  $chopsliderUseNativePagination) {
		$htmlContent.='
	<div class="chopslider-controls">
		';
		if ( $chopsliderUseNativeArrows ) {
			$htmlContent.='
		<a class="chopslider-prev" href="#" ></a>';
		}
		if ( $chopsliderUseNativePagination ) {
			$htmlContent.='
		<div class="chopslider-pagination-wrap">';
			foreach ( $chopSlider['images'] as $capText ) {
				$htmlContent.='
			<span class="chopslider-pagination-' . $id . ' chopslider-pagination"></span>';
			}
			$htmlContent.='
		</div>';
		}
		if ( $chopsliderUseNativeArrows ) {
			$htmlContent.='
		<a class="chopslider-next" href="#" ></a>';
		}
		$htmlContent.='
	</div>
		';
	}
	if ( $chopSlider['useCaptions'] == 'true' ) {
		$htmlContent.='
	<div>';
		foreach ( $chopSlider['captions'] as $capText ) {
			$htmlContent.='
		<div class="chopslider-descr-' . $id . ' chopslider-descr">'. html_entity_decode($capText) .'</div>';	
			
		}
		$htmlContent.='
	</div>';
		
	}
	
$htmlContent.='	
</div>	
';	
}
//End of Minimal skin

/* For Black-Back and Big-Caption skin */
if( $chopSlider['skin'] == 'black-back' || $chopSlider['skin'] == 'big-caption') {

	$htmlContent = '
<div class="chopslider-' . $id . ' chopslider ' . $chopSlider['addClass'] . '">
	<div class="chopslider-slides-' . $id . ' chopslider-slides">';
		$__i=0;
		foreach ($chopSlider['images'] as $key => $singleImage) {
			$__i++;
			if ( $__i==1) $activeClass = "cs-activeSlide-$id";
			else $activeClass = "";
			if ($chopSlider['slideType'][$key]=="html") $contentSlide = 'cs-content-slide';
			else $contentSlide="";
			$htmlContent .='
		<div class="chopslider-slide-' . $id . ' chopslider-slide ' . $activeClass . ' '.$contentSlide.'">';
			if (!$contentSlide) {
				if ( !empty ($chopSlider['links'][$key]) ) $htmlContent .='<a href="' . $chopSlider['links'][$key] . '">';	
				$htmlContent .='<img src="' . $singleImage . '" width="' . $chopSlider['width'] . '" height="' . $chopSlider['height'] . '" alt=" "/>';
				if ( !empty ($chopSlider['links'][$key]) ) $htmlContent .='</a>';
			}
			else $htmlContent.=$singleImage;
			$htmlContent.='</div>';
		}
$htmlContent.='	
	</div>';
	if ($chopSlider['skin']=='big-caption') {
		$htmlContent.='
	<div class="chopslider-shadow"></div>
	';
	}
	$chopsliderUseNativeArrows = (empty($chopSlider['nextTrigger']) && empty($chopSlider['nextTrigger'])) && $chopSlider['navigationArrows'] == 'true';
	$chopsliderUseNativePagination = $chopSlider['pagination'] == 'true' && empty( $chopSlider['sliderPagination'] );
	if ( $chopsliderUseNativeArrows ||  $chopsliderUseNativePagination) {
		$htmlContent.='
	<div class="chopslider-controls">
		';
		if ( $chopsliderUseNativeArrows ) {
			$htmlContent.='
		<a class="chopslider-prev" href="#" ></a>';
		}
		if ( $chopsliderUseNativePagination ) {
			$htmlContent.='
		<div class="chopslider-pagination-wrap">';
			foreach ( $chopSlider['images'] as $capText ) {
				$htmlContent.='
			<span class="chopslider-pagination-' . $id . ' chopslider-pagination"></span>';
			}
			$htmlContent.='
		</div>';
		}
		if ( $chopsliderUseNativeArrows ) {
			$htmlContent.='
		<a class="chopslider-next" href="#" ></a>';
		}
		$htmlContent.='
	</div>
		';
	}
	if ( $chopSlider['useCaptions'] == 'true' ) {
		$htmlContent.='
	<div>';
		foreach ( $chopSlider['captions'] as $capText ) {
			$htmlContent.='
		<div class="chopslider-descr-' . $id . ' chopslider-descr">'. html_entity_decode($capText) .'</div>';	
			
		}
		$htmlContent.='
	</div>';
		if ( empty ($chopSlider['showCaptionIn']) ) {
			$htmlContent.='
	<div class="chopslider-caption chopslider-caption-'. $id .'"></div>';
		}
	
	}
	
	
$htmlContent.='	
</div>	
';	
}
//End of Black-Back skin
?>