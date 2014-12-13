(function($) {
	$(function(){
		$("#chopslider").chopSlider({
			/* Slide Element */
			slide : ".chopslider-slide",
			/* Controlers */
			nextTrigger : "a#slide-next",
			prevTrigger : "a#slide-prev",
			hideControls : true,
			sliderPagination : ".slider-pagination",
			/* Captions */
			useCaptions : false,
			/* Autoplay */
			autoplay : false,
			/* Default Parameters */
			t2D : csTransitions['vertical'][0],
			t3D : false,
			/* For Mobile Devices */
			mobile: false,
			/* For Old and IE Browsers */
			noCSS3:false
		})
		
		$(".vertical a").click(function(e){
			e.preventDefault();
			if($.chopSlider.isAnimating()) return;
			$(".active-transition").removeClass("active-transition")
			$(this).addClass("active-transition")
			$.chopSlider.redefine({  t2D : csTransitions['vertical'][$(this).index()-1], t3D : false, noCSS3:false, mobile:false  })	
		})
		$(".horizontal a").click(function(e){
			e.preventDefault();
			if($.chopSlider.isAnimating()) return;
			$(".active-transition").removeClass("active-transition")
			$(this).addClass("active-transition")
			$.chopSlider.redefine({  t2D : csTransitions['horizontal'][$(this).index()-1], t3D : false, noCSS3:false, mobile:false  })	
		})
		$(".multi a").click(function(e){
			e.preventDefault();
			if($.chopSlider.isAnimating()) return;
			$(".active-transition").removeClass("active-transition")
			$(this).addClass("active-transition")
			$.chopSlider.redefine({  t2D : csTransitions['multi'][$(this).index()-1], t3D : false, noCSS3:false, mobile:false  })	
		})
		$(".half a").click(function(e){
			e.preventDefault();
			if($.chopSlider.isAnimating()) return;
			$(".active-transition").removeClass("active-transition")
			$(this).addClass("active-transition")
			$.chopSlider.redefine({  t2D : csTransitions['half'][$(this).index()-1], t3D : false, noCSS3:false, mobile:false  })	
		})
		$(".sexy a").click(function(e){
			e.preventDefault();
			if($.chopSlider.isAnimating()) return;
			$(".active-transition").removeClass("active-transition")
			$(this).addClass("active-transition")
			$.chopSlider.redefine({  t2D : csTransitions['sexy'][$(this).index()-1], t3D : false, noCSS3:false, mobile:false  })	
		})
		$(".slide a").click(function(e){
			e.preventDefault();
			if($.chopSlider.isAnimating()) return;
			$(".active-transition").removeClass("active-transition")
			$(this).addClass("active-transition")
			$.chopSlider.redefine({  t2D : csTransitions['slide'][$(this).index()-1], t3D : false, noCSS3:false, mobile:false  })	
		})
		$(".3DBlocks a").click(function(e){
			e.preventDefault();
			if($.chopSlider.isAnimating()) return;
			if(!$.chopSlider.has3D()) { 
				alert("Sorry! Your browser do not support 3D transitions");
				return
			}
			$(".active-transition").removeClass("active-transition")
			$(this).addClass("active-transition")
			$.chopSlider.redefine({  t2D : csTransitions['vertical'][0], t3D : csTransitions['3DBlocks'][$(this).index()-1], noCSS3:false, mobile:false  })	
		})
		$(".3DFlips a").click(function(e){
			e.preventDefault();
			if($.chopSlider.isAnimating()) return;
			if(!$.chopSlider.has3D()) { 
				alert("Sorry! Your browser do not support 3D transitions");
				return
			}
			$(".active-transition").removeClass("active-transition")
			$(this).addClass("active-transition")
			$.chopSlider.redefine({  t2D : csTransitions['vertical'][0], t3D : csTransitions['3DFlips'][$(this).index()-1], noCSS3:false, mobile:false  })	
		})
		$(".sphere a").click(function(e){
			e.preventDefault();
			if($.chopSlider.isAnimating()) return;
			if(!$.chopSlider.has3D()) { 
				alert("Sorry! Your browser do not support 3D transitions");
				return
			}
			$(".active-transition").removeClass("active-transition")
			$(this).addClass("active-transition")
			$.chopSlider.redefine({  t2D : csTransitions['vertical'][0], t3D : csTransitions['sphere'][$(this).index()-1], noCSS3:false, mobile:false  })	
		})
		$(".noCSS3 a").click(function(e){
			e.preventDefault();
			if($.chopSlider.isAnimating()) return;
			if($.chopSlider.hasCSS3()) {
				alert('Sorry, but you can preview these transtions only on the browser that do not support CSS3 Transitions');
				return;	
			}
			$(".active-transition").removeClass("active-transition")
			$(this).addClass("active-transition")
			$.chopSlider.redefine({  t2D : csTransitions['vertical'][0], t3D : false, noCSS3:csTransitions['noCSS3'][$(this).index()], mobile:false  })	
		})
		$(".mobile a").click(function(e){
			e.preventDefault();
			if($.chopSlider.isAnimating()) return;
			$(".active-transition").removeClass("active-transition")
			$(this).addClass("active-transition")
			$.chopSlider.redefine({  t2D : csTransitions['mobile'][$(this).index()], t3D : false, noCSS3:false, mobile:csTransitions['mobile'][$(this).index()]  })	
		})
	})
})(jQuery);
