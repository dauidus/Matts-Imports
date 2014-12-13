/*-----------------------------------------------------------------------------------

FILE INFORMATION

Description: JavaScript on the frontend for the WooTable WordPress plugin.
Date Created: 2010-08-11.
Author: Matty.
Since: 0.0.0.1


TABLE OF CONTENTS

- Integrate the jQueryUI datepicker
- Widget-specific AJAX call
- Widget-specific AJAX call on `select`s
- Form AJAX call on `select`s

- function wootable_widget_confirmation_message ()

-----------------------------------------------------------------------------------*/

jQuery(function($) {

/*----------------------------------------
Integrate the jQueryUI datepicker
----------------------------------------*/
	
	var correctDate = jQuery( 'form[name="wootable-booking-form"] input.input-reservation_date_real' ).attr( 'value' );
	
	var currentDate = new Date();
	var currentDay = currentDate.getDate()+1;
	var currentMonth = currentDate.getMonth();
	var currentYear = currentDate.getFullYear();
	
	var unavailableDates = ["1-1-2013","1-2-2013","1-3-2013","1-4-2013","1-5-2013","1-6-2013","1-7-2013","1-8-2013","1-9-2013","1-10-2013","1-11-2013","1-12-2013","12-21-2013","12-22-2013","12-23-2013","12-24-2013","12-25-2013","12-26-2013","12-27-2013","12-28-2013","12-29-2013","12-30-2013","12-31-2013","1-1-2014","1-2-2014","1-3-2014","1-4-2014","1-5-2014",
		"11-21-2014", "11-22-2014", "11-23-2014", "11-24-2014", "11-25-2014", "11-26-2014", "11-27-2014", "11-28-2014",
		"12-24-2014", "12-25-2014", "12-26-2014", "12-27-2014", "12-28-2014", "12-29-2014", "12-30-2014", "12-31-2014",
		"1-1-2015", "1-2-2015"
	];

function unavailable(date) {
  dmy = (date.getMonth()+1) + "-" + date.getDate() + "-" + date.getFullYear();
  if ($.inArray(dmy, unavailableDates) < 0) {
    return [true,"","Book Now"];
  } else {
    return [false,"","Booked Out"];
  }
}
	
	jQuery( '#wootable-calendar' ).datepicker( { 
		dateFormat: 'yy-mm-dd', 
		altField: '#reservation_date', 
		minDate: new Date( currentYear, currentMonth, currentDay ), 
		maxDate: new Date( currentYear, currentDate.getMonth()+3, currentDay ),
		beforeShowDay: $.datepicker.noWeekends,
		beforeShowDay: unavailable,
		onSelect: function ( dateText, inst ) {
				
			var timeText = jQuery(this).parents('form').find('.reservation_time').val();
			var peopleText = jQuery(this).parents('form').find('.number_of_people').val();
			var pageId = jQuery(this).parents('form').find('.input-page_id').val();
			var isUpdate = jQuery(this).parents('form').find('.input-is_update').val();
			
			// Can't use '#' in jQuery 1.4.4, so get the URL to the page we're currently on. Cast it as a string.
			var ajax_url = String( document.location );
			
			// Run an AJAX call to get the possible reservation times for the date selected.
			jQuery.ajax({
			   type: "POST",
			   url: ajax_url,
			   data: { 'date' : dateText, 'time' : timeText, 'ajax' : 1, 'ajax-action' : 'get_times', 'page_id' : pageId, 'is_admin' : isUpdate },
			   success: function( data ) {
			     
			     jQuery('form[name="wootable-booking-form"] .reservation_time').replaceWith(data);
			     
			     // Change the confirmation message.
			     // wootable_widget_confirmation_message( dateText, timeText, peopleText, 'form[name="wootable-booking-form"] .confirmation_message', 'form[name="wootable-booking-form"]', 'generate_confirmation_message' );
			     
			   }
			 });
			
		} 
		} ).datepicker( 'setDate', correctDate );

/*----------------------------------------
Widget-specific AJAX call
----------------------------------------*/
	
	jQuery( '.widget-wootable-makereservation #wootable-calendar-widget' ).datepicker( {
		dateFormat: 'yy-mm-dd', 
		altField: '#reservation_date', 
		minDate: new Date( currentYear, currentMonth, currentDay ), 
		onSelect: function ( dateText, inst ) {
			
			// Set `this` to a temporary variable for use later on in the AJAX response.
			var _this = jQuery(this);
				
			var timeText = jQuery(this).parents('form').find('.reservation_time').val();
			var peopleText = jQuery(this).parents('form').find('.number_of_people').val();
			
			// Can't use '#' in jQuery 1.4.4, so get the URL to the page we're currently on. Cast it as a string.
			var ajax_url = String( document.location );
			
			// Run an AJAX call to get the possible reservation times for the date selected.
			jQuery.ajax({
			   type: "POST",
			   url: ajax_url,
			   data: { 'date' : dateText, 'time' : timeText, 'ajax' : 1, 'ajax-action' : 'get_times' },
			   success: function( data ) {
			     
			     jQuery('.widget-wootable-makereservation .reservation_time').replaceWith(data);
			     
			     // Make sure we get the latest times when adjusting the datepicker, not the values
			     // from the previous date selection.
			     
			     var timeText = _this.parents('form').find('.reservation_time').val();
				 var peopleText = _this.parents('form').find('.number_of_people').val();
			     
			     // Change the confirmation message.
			     // wootable_widget_confirmation_message( dateText, timeText, peopleText, 'form[name="wootable-booking-form"] .confirmation_message', 'form[name="wootable-booking-form"]', 'generate_confirmation_message' );
			     
			     // Change the confirmation message.
				 wootable_widget_confirmation_message( dateText, timeText, peopleText, '.widget-wootable-makereservation .confirmation_message', '.widget-wootable-makereservation form', 'generate_confirmation_message_widget' );
			     
			   }
			 });
			
			// Change the confirmation message.
			// wootable_widget_confirmation_message( dateText, timeText, peopleText, '.widget-wootable-makereservation .confirmation_message', '.widget-wootable-makereservation form', 'generate_confirmation_message_widget' );
			
		}
	
	} );

/*----------------------------------------
Widget-specific AJAX call on `select`s
----------------------------------------*/
	
	jQuery( '.widget-wootable-makereservation select' ).change( function () {
	
		var dateText = jQuery(this).parents('form').find('#reservation_date').val();
		var timeText = jQuery(this).parents('form').find('.reservation_time').val();
		var peopleText = jQuery(this).parents('form').find('.number_of_people').val();
		
		// Change the confirmation message.
		wootable_widget_confirmation_message( dateText, timeText, peopleText, '.widget-wootable-makereservation .confirmation_message', '.widget-wootable-makereservation form', 'generate_confirmation_message_widget' );
		
	});

}); // End jQuery()

/*----------------------------------------
wootable_widget_confirmation_message()
----------------------------------------*/

function wootable_widget_confirmation_message ( dateText, timeText, peopleText, selectorText, formElement, ajaxAction ) {

	var formAction = jQuery( formElement ).attr('action');

	// Run an AJAX call to get the possible reservation times for the date selected.
	jQuery.ajax({
	   type: "POST",
	   url: formAction,
	   data: { 'ajax' : 1, 'ajax-action' : ajaxAction, 'date' : dateText, 'time' : timeText, 'people' : peopleText },
	   success: function( response ) {
	     
	     jQuery( selectorText ).replaceWith(response);
	     
	   }
	 });
	
} // End wootable_widget_confirmation_message()