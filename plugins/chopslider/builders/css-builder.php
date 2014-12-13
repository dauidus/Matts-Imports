<?php
//We already have $chopSlider Array with all variables;
//This file is used to generate CSS files on Slider create/update only

/* Clean White skin */
if($chopSlider['skin']=='clean-black') {
	$cssContent = "
.chopslider-$id {
	position:relative;
	width:$chopSlider[width]px;
	height:$chopSlider[height]px;
	display:block;
	z-index:2;
}
.chopslider-$id .chopslider-slides {
	width:$chopSlider[width]px;
	height:$chopSlider[height]px;
	position:relative;
}
.chopslider-$id .chopslider-slide {
	position:absolute;
	left:0px;
	top:0px;
	width:$chopSlider[width]px;
	height:$chopSlider[height]px;
	display:none;
}
.chopslider-$id .chopslider-slide img {
	width:$chopSlider[width]px;
	height:$chopSlider[height]px;
	max-width:$chopSlider[width]px;
}
.chopslider-$id .cs-activeSlide-$id { display:block; }
.chopslider-$id .chopslider-next {
	position:absolute;
	width:30px;
	height:30px;
	top:". ($chopSlider['height']/2-15) ."px;
	right:10px;
	z-index:4;
	background:url(../images/skins/clean-black/sl-control.png) left bottom no-repeat;	
}
.chopslider-$id .chopslider-prev {
	position:absolute;
	width:30px;
	height:30px;
	top:". ($chopSlider['height']/2-15) ."px;
	left:10px;
	z-index:4;
	background:url(../images/skins/clean-black/sl-control.png) left top no-repeat;	
}
.chopslider-$id .chopslider-descr {
	display:none;
}
.chopslider-$id .chopslider-caption-$id {
	background: url(../images/skins/clean-black/caption-bg.png) repeat;
	bottom: 10px;
	color: #fff;
	display: none;
	left: 10px;
	padding:10px 20px;
	position: absolute;
	max-width: " . ($chopSlider['width']-100) . "px;
	-moz-border-radius:5px;
	-webkit-border-radiuso:5px;
	border-radius:5px;
	font-size:13px;
}
.chopslider-$id .chopslider-pagination-wrap {
	position:absolute;
	right:10px;
	top:10px;	
	padding:10px;
	background: url(../images/skins/clean-black/caption-bg.png) repeat;
	-moz-border-radius:5px;
	-webkit-border-radiuso:5px;
	border-radius:5px
}
.chopslider-$id .chopslider-pagination {
	display:block;
	float:left;
	width:10px;
	height:10px;
	margin:0 2px;
	background:url(../images/skins/clean-black/pagination.png) no-repeat left bottom;
	cursor:pointer
}
.chopslider-$id .cs-active-pagination-$id {
	background:url(../images/skins/clean-black/pagination.png) no-repeat left top;
}
";
}
/* Clean Black skin */
if($chopSlider['skin']=='clean-white') {
	$cssContent = "
.chopslider-$id {
	position:relative;
	width:$chopSlider[width]px;
	height:$chopSlider[height]px;
	display:block;
	z-index:2;
}
.chopslider-$id .chopslider-slides {
	width:$chopSlider[width]px;
	height:$chopSlider[height]px;
	position:relative;	
}
.chopslider-$id .chopslider-slide {
	position:absolute;
	left:0px;
	top:0px;
	width:$chopSlider[width]px;
	height:$chopSlider[height]px;
	display:none;
}
.chopslider-$id .chopslider-slide img {
	width:$chopSlider[width]px;
	height:$chopSlider[height]px;
	max-width:$chopSlider[width]px;
}
.chopslider-$id .cs-activeSlide-$id { display:block; }
.chopslider-$id .chopslider-next {
	position:absolute;
	width:38px;
	height:38px;
	top:". ($chopSlider['height']/2-19) ."px;
	right:5px;
	z-index:4;
	background:url(../images/skins/clean-white/sl-control.png) left bottom no-repeat;	
}
.chopslider-$id .chopslider-prev {
	position:absolute;
	width:38px;
	height:38px;
	top:". ($chopSlider['height']/2-19) ."px;
	left:5px;
	z-index:4;
	background:url(../images/skins/clean-white/sl-control.png) left top no-repeat;	
}
.chopslider-$id .chopslider-descr {
	display:none;
}
.chopslider-$id .chopslider-caption-$id {
	background: url(../images/skins/clean-white/caption-bg.png) repeat;
	bottom: 0px;
	color: #fff;
	display: none;
	left: 0px;
	padding:10px 20px;
	position: absolute;
	width: " . ($chopSlider['width']-40) . "px;
	font-size:13px;
}
.chopslider-$id .chopslider-pagination-wrap {
	position:absolute;
	left:10px;
	top:10px;	
	padding:0px;
}
.chopslider-$id .chopslider-pagination {
	display:block;
	float:left;
	width:10px;
	height:10px;
	margin-right:5px;
	background:url(../images/skins/clean-white/pagination.png) no-repeat left bottom;
	cursor:pointer
}
.chopslider-$id .cs-active-pagination-$id {
	background:url(../images/skins/clean-white/pagination.png) no-repeat left top;
}
";
}
/* Minimal skin */
if($chopSlider['skin']=='minimal') {
	$chopSlider['controller-width'] = 0;
	if($chopSlider['pagination'] == 'true' && empty( $chopSlider['sliderPagination'] )) {
		foreach($chopSlider['images'] as $image) {
			$chopSlider['controller-width'] = $chopSlider['controller-width'] + 16; 	
		}
		$chopSlider['controller-width'] = $chopSlider['controller-width'] + 20;
	}
	if( (empty($chopSlider['nextTrigger']) && empty($chopSlider['nextTrigger'])) && $chopSlider['navigationArrows'] == 'true' ) {
		$chopSlider['controller-width'] = $chopSlider['controller-width'] + 60;
	}
	$cssContent = "
.chopslider-$id {
	position:relative;
	width:$chopSlider[width]px;
	height:$chopSlider[height]px;
	display:block;
	z-index:2;
}
.chopslider-$id .chopslider-slides {
	width:$chopSlider[width]px;
	height:$chopSlider[height]px;	
	position:relative;
}
.chopslider-$id .chopslider-slide {
	position:absolute;
	left:0px;
	top:0px;
	width:$chopSlider[width]px;
	height:$chopSlider[height]px;
	display:none;
}
.chopslider-$id .chopslider-slide img {
	width:$chopSlider[width]px;
	height:$chopSlider[height]px;
	max-width:$chopSlider[width]px;
}
.chopslider-$id .cs-activeSlide-$id { display:block; }
.chopslider-$id .chopslider-controls {
	position:absolute;
	left:50%;
	bottom:10px;
	height:30px;
	width:" . $chopSlider['controller-width'] . "px;	
	margin-left: " . -$chopSlider['controller-width']/2 . "px;		
}
.chopslider-$id .chopslider-next {
	width:30px;
	height:30px;
	z-index:4;
	background:url(../images/skins/minimal/right-arrow.png) left top no-repeat;	
	display:block;
	float:left;
}
.chopslider-$id .chopslider-prev {
	width:30px;
	height:30px;
	z-index:4;
	background:url(../images/skins/minimal/left-arrow.png) left top no-repeat;
	display:block;
	float:left;
}
.chopslider-$id .chopslider-descr {
	display:none;
}
.chopslider-$id .chopslider-pagination-wrap {
	float:left;
	padding:9px 10px;
	background:url(../images/skins/minimal/bg.png) repeat;
}
.chopslider-$id .chopslider-pagination {
	display:block;
	float:left;
	width:12px;
	height:12px;
	margin:0px 2px;
	background:url(../images/skins/minimal/pagination.png) no-repeat left bottom;
	cursor:pointer
}
.chopslider-$id .cs-active-pagination-$id {
	background:url(../images/skins/minimal/pagination.png) no-repeat left top;
}
";
}

/* Black-Back skin */
if($chopSlider['skin']=='black-back') {
	$chopSlider['controller-width'] = 0;
	if($chopSlider['pagination'] == 'true' && empty( $chopSlider['sliderPagination'] )) {
		foreach($chopSlider['images'] as $image) {
			$chopSlider['controller-width'] = $chopSlider['controller-width'] + 16; 	
		}
		$chopSlider['controller-width'] = $chopSlider['controller-width'] + 20;
	}
	if( (empty($chopSlider['nextTrigger']) && empty($chopSlider['nextTrigger'])) && $chopSlider['navigationArrows'] == 'true' ) {
		$chopSlider['controller-width'] = $chopSlider['controller-width'] + 60;
	}
	$cssContent = "
.chopslider-$id {
	position:relative;
	width:" . ( $chopSlider['width'] + 20 ) . "px;
	height:" . ( $chopSlider['height'] + 50 ) . "px;
	background:#333;
	display:block;
	z-index:2;
}
.chopslider-$id .chopslider-slides {
	width:$chopSlider[width]px;
	height:$chopSlider[height]px;
	position:absolute;
	left:10px;
	top:10px;	
	position:relative;
}
.chopslider-$id .chopslider-slide {
	position:absolute;
	left:0px;
	top:0px;
	width:$chopSlider[width]px;
	height:$chopSlider[height]px;
	display:none;
	-moz-box-shadow:0px 2px 5px #000;
	-webkit-box-shadow:0px 2px 5px #000;
	box-shadow:0px 2px 5px #000;
}
.chopslider-$id .chopslider-slide img {
	width:$chopSlider[width]px;
	height:$chopSlider[height]px;
	max-width:$chopSlider[width]px;
}
.chopslider-$id .cs-activeSlide-$id { display:block; }
.chopslider-$id .chopslider-controls {
	position:absolute;
	right:10px;
	bottom:5px;
	height:30px;
	width:" . $chopSlider['controller-width'] . "px;	
	margin-left: " . -$chopSlider['controller-width']/2 . "px;		
}
.chopslider-$id .chopslider-next {
	width:30px;
	height:30px;
	z-index:4;
	background:url(../images/skins/bb/right-arrow.png) left top no-repeat;	
	display:block;
	float:left;
}
.chopslider-$id .chopslider-prev {
	width:30px;
	height:30px;
	z-index:4;
	background:url(../images/skins/bb/left-arrow.png) left top no-repeat;
	display:block;
	float:left;
}
.chopslider-$id .chopslider-descr {
	display:none;
}
.chopslider-$id .chopslider-pagination-wrap {
	float:left;
	padding:9px 10px;
}
.chopslider-$id .chopslider-pagination {
	display:block;
	float:left;
	width:12px;
	height:12px;
	margin:0px 2px;
	background:url(../images/skins/bb/pagination.png) no-repeat left bottom;
	cursor:pointer
}
.chopslider-$id .cs-active-pagination-$id {
	background:url(../images/skins/bb/pagination.png) no-repeat left top;
}
.chopslider-$id .chopslider-caption-$id {
	bottom: 0px;
	color: #fff;
	display: none;
	left: 0px;
	padding:10px 20px;
	position: absolute;
	width: " . ($chopSlider['width']-$chopSlider['controller-width']-40) . "px;
	font-size:13px;
}
";
}

/* Big-Caption skin */
if($chopSlider['skin']=='big-caption') {
	$chopSlider['controller-width'] = 0;
	if($chopSlider['pagination'] == 'true' && empty( $chopSlider['sliderPagination'] )) {
		foreach($chopSlider['images'] as $image) {
			$chopSlider['controller-width'] = $chopSlider['controller-width'] + 16; 	
		}
		$chopSlider['controller-width'] = $chopSlider['controller-width'] + 20;
	}
	if( (empty($chopSlider['nextTrigger']) && empty($chopSlider['nextTrigger'])) && $chopSlider['navigationArrows'] == 'true' ) {
		$chopSlider['controller-width'] = $chopSlider['controller-width'] + 60;
	}
	$cssContent = "
.chopslider-$id {
	position:relative;
	width:" . $chopSlider['width'] . "px;
	height:" . ( $chopSlider['height'] + 50 ) . "px;
	display:block;
	z-index:2;
}
.chopslider-$id .chopslider-slides {
	width:$chopSlider[width]px;
	height:$chopSlider[height]px;
	z-index:2;
	position:relative;
}
.chopslider-$id .chopslider-slide {
	position:absolute;
	left:0px;
	top:0px;
	width:$chopSlider[width]px;
	height:$chopSlider[height]px;
	display:none;
}
.chopslider-$id .chopslider-slide img {
	width:$chopSlider[width]px;
	height:$chopSlider[height]px;
	max-width:$chopSlider[width]px;
}
.chopslider-$id .cs-activeSlide-$id { display:block; }
.chopslider-$id .chopslider-controls {
	position:absolute;
	left:50%;
	bottom:5px;
	height:30px;
	width:" . $chopSlider['controller-width'] . "px;	
	margin-left: " . -$chopSlider['controller-width']/2 . "px;	
	z-index:2;	
}
.chopslider-$id .chopslider-next {
	width:30px;
	height:30px;
	z-index:4;
	background:url(../images/skins/big-caption/right-arrow.png) left top no-repeat;	
	display:block;
	float:left;
}
.chopslider-$id .chopslider-prev {
	width:30px;
	height:30px;
	z-index:4;
	background:url(../images/skins/big-caption/left-arrow.png) left top no-repeat;
	display:block;
	float:left;
}
.chopslider-$id .chopslider-descr {
	display:none;
}
.chopslider-$id .chopslider-pagination-wrap {
	float:left;
	padding:9px 10px;
}
.chopslider-$id .chopslider-pagination {
	display:block;
	float:left;
	width:12px;
	height:12px;
	margin:0px 2px;
	background:url(../images/skins/big-caption/pagination.png) no-repeat left bottom;
	cursor:pointer
}
.chopslider-$id .cs-active-pagination-$id {
	background:url(../images/skins/big-caption/pagination.png) no-repeat left top;
}
.chopslider-$id .chopslider-caption-$id {
	top: -10px;
	color: #fff;
	display: none;
	right: 10px;
	padding:30px 20px;
	position: absolute;
	width: 160px;
	height : " . ($chopSlider['height']-40) . "px;
	font-size:13px;
	background:url(../images/skins/big-caption/caption-bg.png) repeat left top;
	z-index:2;
}
.chopslider-$id .chopslider-shadow {
	position:absolute;
	width:566px;
	height:49px;
	left:50%;
	margin-left:-283px;
	background:url(../images/skins/big-caption/shadow.png) no-repeat left top;
	bottom:25px;
	z-index:1;	
}
";
}
?>