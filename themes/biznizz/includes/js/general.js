// JavaScript Document

jQuery.noConflict();
jQuery(document).ready(function(){
	
	/*-----------------------------------------------------------------------------------*/
/* Portfolio Carousel (jCarouselLite) */
/*-----------------------------------------------------------------------------------*/

if ( jQuery( '.portfolio-carousel' ).length ) {
	if ( jQuery( '.portfolio-carousel .slides li' ).length > 1 ) {
		
		var visibleSlides = 5;
		var autoSpeed = parseInt( woo_slider_settings.auto );
		var slideSpeed = parseInt( woo_slider_settings.speed );
		
		// Make sure the slider doesn't freak out if there are fewer than 5 items.
		if ( jQuery( '.portfolio-carousel .slides li' ).length < 5 ) {
			visibleSlides = jQuery( '.portfolio-carousel .slides li' ).length;
		}
	
		jQuery( '.portfolio-carousel' ).jCarouselLite({
		
			btnNext: '#carousel-inner .btn-next', 
			btnPrev: '#carousel-inner .btn-prev', 
			auto: autoSpeed, 
			speed: slideSpeed, 
			visible: visibleSlides, 
			circular: false
		
		});
		
		jQuery( '#carousel-inner .btn-prev' ).addClass( 'disabled' );
		jQuery( '#carousel-inner .btn-next' ).click( function () {
			jQuery( '#carousel-inner .btn-prev.disabled' ).removeClass( 'disabled' );
		});

	}
}

		
	//FAKE ROTATED BACKGROUNDS
	
	jQuery('#loopedSlider .image, #more-info .image, #content.location .map').each(function(){
	
		jQuery(this).append('<div class="fakebg"></div>');
		jQuery(this).append('<div class="fakebg second"></div>');
	
	});
	
	//ALT STYLING FOR LIST WIDGETS
	
	jQuery('.widget_woo_specials li:odd, .widget_woo_staff li:odd').addClass('alt');
	
	
	//CLEAR FORM FIELD ON FOCUS
	
	var name = jQuery('#content.location .text input.txt').val();
	
	if (name == '') { jQuery('#content.location .text input.txt').val('Name') };
	
	jQuery('#content.location .text input.txt').focus(function() {
		var val = jQuery(this).val();
		if(val == 'Enter your address'){	jQuery(this).val(''); }
	});
	
	jQuery('#content.location .text input.txt').blur(function() {
		var val = jQuery(this).val();
		if(val == ''){	jQuery(this).val('Enter your address'); }
	});
	
	//RESERVATION CONFIRMATION MODAL BUTTONS
	
	jQuery('.ui-dialog-buttonpane button:contains(Cancel)').addClass('inactive');
	
	//STAFF WIDGET AVATAR
	
	jQuery('.widget_woo_staff img.avatar').each(function(){
		jQuery(this).addClass('thumb');
	});
	
	//BUSINESS HOURS WIDGET
	
	jQuery('.widget-wootable-businesshours li:last').css('border-bottom','none');
	
});