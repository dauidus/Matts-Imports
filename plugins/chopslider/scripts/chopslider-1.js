
jQuery(function(){
	jQuery('.chopslider-slides-1').chopSlider({
		loaderIndex : '10000',
		/* Slide Element */
		slide : '.chopslider-slide-1',
		activeSlideClass: 'cs-activeSlide-1',
		/* Autoplay */
		autoplay : true,
		autoplayDelay : 10000,
		/* Controlers */
		nextTrigger : '',
		prevTrigger : '',
		hideTriggers : false,
		/* Pagination */
		sliderPagination : '.chopslider-pagination-1',
		hidePagination : true,
		activePaginationClass : 'cs-active-pagination-1',
		/* Captions */
		useCaptions : true,
		hideCaptions : true,
		everyCaptionIn : '.chopslider-descr-1',
		showCaptionIn : '.chopslider-1 .chopslider-caption-1',
		captionTransform : '',
		/* Transitions */
		t2D: [csTransitions['half'][20]],
		t3D: [csTransitions['3DFlips'][8],csTransitions['3DFlips'][10]],
		full3D : '',
		mobile: [csTransitions['mobile'][1]],
		noCSS3: [csTransitions['noCSS3']['random']],
		/* Callbacks */
		onStart: function(){  },
		onEnd: function(){  },
		forceParameters : {
			showFaces: true	
		}
	})
})	
