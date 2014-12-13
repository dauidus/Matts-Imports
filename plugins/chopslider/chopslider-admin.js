// JavaScript Document
(function($){
	$(function(){
		//File Viewer
		$(".chopslider-file-viewer").click(function(e){
			e.preventDefault();
			var cLink = $(this)
			$.get(  
				$("#file-viewer-path").text(),
				{
					file : $(this).attr("data-url")
				},
				function(data){
					var content = '<h3 style="height:30px;margin:0">Generated '+cLink.attr("data-code")+' code for the &quot;'+cLink.attr("data-title")+'&quot; (ID '+cLink.attr("data-id")+') Slider:</h3>';
					content +='<pre style="overflow:auto; height:470px;">'+data+'</pre>'
					chopsliderPopup({
						width:800,
						height:500,
						content:content
					})
				}
			)	
		})
		//HTML Editor
		var editorSettings = {
			mode:"specific_textareas", editor_selector:"cs-upload_image", width:"100%", theme:"advanced", skin:"default", theme_advanced_buttons1:"bold, italic, underline, blockquote, separator, strikethrough, bullist, numlist,justifyleft, justifycenter, justifyright, undo, redo, link, unlink, code", theme_advanced_buttons2:"", theme_advanced_buttons3:"", theme_advanced_buttons4:"", language:"en", spellchecker_languages:"+English=en,Danish=da,Dutch=nl,Finnish=fi,French=fr,German=de,Italian=it,Polish=pl,Portuguese=pt,Spanish=es,Swedish=sv", theme_advanced_toolbar_location:"top", theme_advanced_toolbar_align:"left", theme_advanced_statusbar_location:"bottom", theme_advanced_resizing:true, theme_advanced_resize_horizontal:true, dialog_type:"modal", formats:{
					alignleft : [
						{selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles : {textAlign : 'left'}},
						{selector : 'img,table', classes : 'alignleft'}
					],
					aligncenter : [
						{selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles : {textAlign : 'center'}},
						{selector : 'img,table', classes : 'aligncenter'}
					],
					alignright : [
						{selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles : {textAlign : 'right'}},
						{selector : 'img,table', classes : 'alignright'}
					],
					strikethrough : {inline : 'del'}
				}, relative_urls:false, remove_script_host:false, convert_urls:false, apply_source_formatting:false, remove_linebreaks:true, gecko_spellcheck:true, keep_styles:false, entities:"38,amp,60,lt,62,gt", accessibility_focus:true, tabfocus_elements:"major-publishing-actions", media_strict:false, paste_remove_styles:true, paste_remove_spans:true, paste_strip_class_attributes:"all", paste_text_use_dialog:true, extended_valid_elements:"article[*],aside[*],audio[*],canvas[*],command[*],datalist[*],details[*],embed[*],figcaption[*],figure[*],footer[*],header[*],hgroup[*],keygen[*],mark[*],meter[*],nav[*],output[*],progress[*],section[*],source[*],summary,time[*],video[*],wbr", wpeditimage_disable_captions:false, wp_fullscreen_content_css:"http://localhost/wordpress2/wp-includes/js/tinymce/plugins/wpfullscreen/css/wp-fullscreen.css", plugins:"inlinepopups,fullscreen,wplink,wpdialogs", content_css:"http://localhost/wordpress2/wp-content/themes/twentyeleven/editor-style.css"
		}
		
		
		$(".csSwitch2imageType").live('click',function(){
			if ($(this).parents('td').find('textarea').css('display')!='none') return;
			$(this).parents('p').find('input[name="chopslider-slideType[]"]').val('image')
			var newHTMLContent = $(this).parents('td').find('textarea').next('span').find('iframe')[0].contentDocument.body.innerHTML
			$(this).parents('td').find('textarea').val(newHTMLContent).nextAll('span').remove()
			$(this).parents('td').find('textarea').show()
			.end()
			.next('td').html('')
		})
		$(".csSwitch2htmlType").live('click',function(){
			if ($(this).parents('td').find('textarea').css('display')=='none') return;
			$(this).parents('p').find('input[name="chopslider-slideType[]"]').val('html')
			editorSettings.mode="exact";
			editorSettings.elements = $(this).parents('td').find('textarea').attr('id');
			tinyMCE.init(editorSettings)
			$(this).parents('td').next('td').html('<div class="cs-html-thumb">HTML</div> ')
		})
		$(".csSwitch2htmlType:checked").click()
		//Image Uploader
		var csUploadField;
		$('.cs-upload_image_button').live("click",function() {
			csUploadField = $(this).parents("tr").find('.cs-upload_image')
			tb_show('', 'media-upload.php?type=image&TB_iframe=true');
			return false;
		});
		
		window.send_to_editor = function(html) {
			imgurl = $('img',html).attr('src');
			csUploadField.val(imgurl);
			csUploadField.parents("tr").find('td.cs-thumbnail').html('<img src="'+imgurl+'" width="100" />')
			tb_remove();
			var insertedImage = new Image();
			insertedImage.onload = function(){
				$("#chopslider-d-width").val(insertedImage.width)
				$("#chopslider-d-height").val(insertedImage.height)	
			}
			insertedImage.src = imgurl;
			
		}
		//Twitter
		$("#chopslider-tweets").idTwitter({
			username : "chopslider",
			numberOfTweets : 6,
			loadingText : '<li class="tweets_load">Loading tweets...</li>',
			tweetFormat : '<li class="single-tweet">'
						+ '<p class="tweet-text">'
						+ '%tweetText'
						+ '</p>'
						+ '<p class="tweet-date">on %tweetDate</p>'
						+ '</li>'	
		})
		//Check for number of images
		$("#chopslider-addnew-form").submit(function(e){
			var slidesNum = 0;
			$(".cs-upload_image").each(function(){
				var imgPath = $(this).val()	
				if(imgPath!="") slidesNum++;
			})
			if (slidesNum<2) {
				e.preventDefault()
				alert("You need to choose/upload at least 2 images");	
			}
		})
		//Status message
		$(".chopslider-status-close").click(function(){
			$(this).parent(".chopslider-status").slideUp(600)
		})
		//Remove single slide
		$('.chopslider-remove').live("click",function(){
			$(this).parents("tr").remove()
			redefineCsOrdering()
		})
		//Add slide button
		$(".cs-add-new-slide").click(function(){
			$(".cs-slides-table > tbody").append("<tr>"+$(".cs-slide-table-template tr").html()+"</tr>")
			var oldNumID = $(".cs-slide-table-template .chopslider-order-up").prev('input').val()
			var newNum = oldNumID*1+1;	
			$(".cs-slide-table-template .csSwitch2imageType").attr({"name":'chopslider-fakeType['+newNum+']'})
			$(".cs-slide-table-template .csSwitch2htmlType").attr({"name":'chopslider-fakeType['+newNum+']'})
			$(".cs-slide-table-template .cs-upload_image").attr({"id":'cs-textarea-'+newNum})
			redefineCsOrdering()
		})
		//Re-ordering
		$(".chopslider-order-up").live('click',function(e){
			e.preventDefault();
			var tRow = $(this).parents("tr");
			var topRow = tRow.prev("tr");
			tRow.insertBefore(topRow)	
			redefineCsOrdering()
		})
		$(".chopslider-order-down").live('click',function(e){
			e.preventDefault();
			var tRow = $(this).parents("tr");
			var botRow = tRow.next("tr");
			tRow.insertAfter(botRow)
			redefineCsOrdering()	
			
		})
		function redefineCsOrdering() {
			var ordering = 1;
			$(".cs-slides-table > tbody > tr").each(function(){
				$(this).find("td:eq(0) input").val(ordering)
				ordering++;
			})	
		}
		$(".cs-edit-button").live('click',function(){
			var tabrow = $(this).parents("tr");
			$(".cs-slides-table tr").not(tabrow).css({opacity:0.2})
			$(".cs-slide-edit-form").hide()	
			$(this).parent("td").find(".cs-slide-edit-form").fadeIn(300)	
		})
		$(".chopslider-close-form").live('click',function(){
			$(this).parent(".cs-slide-edit-form").fadeOut(300)
			$(".cs-slides-table tr").css({opacity:1})
		})
		//Togglers
		$(".chopslider-expand-tg").click(function(e){
			e.preventDefault();
			var tContent = $(this).parents(".postbox").find(".chopslider-tg-content")
			if( tContent.css('display')=="none" ) {
				tContent.slideDown(600);
				$(this).text("Close")	
			}
			else {
				tContent.slideUp(600);
				$(this).text("Open")
			}
		})
		//Skins
		$(".chopslider-skin-labels label").click(function(){
			$(".chopslider-skin").hide();
			$(".chopslider-skin:eq("+$(this).index()+")").show()	
		})
		var activeSkin = $(".chopslider-skin-labels input:checked").parent("label").index()
		$(".chopslider-skin:eq("+activeSkin+")").show()
		$(".chopslider-selectAll").change(function(e){
			if($(this).is(":checked")) {
				$(this).parents("ul").find("input").attr({'checked':'checked'})	
			}
			else {
				$(this).parents("ul").find("input").removeAttr('checked')	
			}
		})
		//Transitions Select
		$(".cs-transitions input:not(.chopslider-selectAll)").click(function(){
			$(this).parents('.cs-transitions').find(".chopslider-selectAll").removeAttr("checked")
		})
		//Preview
		$(".cs-switch-bg").click(function(){
			if(!$('#chop-slider-white-layer').hasClass('cs-black-layer')) {
				$('#chop-slider-white-layer').addClass('cs-black-layer')	
			}
			else {
				$('#chop-slider-white-layer').removeClass('cs-black-layer')
			}
		})
		$("#cs-generate-preview").click(function(){
			var sliderHeight = $('input[name="chopslider-height"]').val()
			var i=0;
			$(".cs-slides-table .cs-upload_image").each(function(){
				if($(this).val()!="") {
					if (i==0) var csActive = "cs-activeSlide";
					else csActive = "";
					
					var isContentSlide = $(this).parents('td').find('input[name="chopslider-slideType[]"]').val()=="html";
					if (!isContentSlide)
						$(".chopslider").append('<div class="chopslider-slide '+csActive+'"><img src="'+$(this).val()+'"/></div>');
					else 
						$(".chopslider").append('<div class="chopslider-slide cs-content-slide '+csActive+'"><div class="cs-preview-content-slide">'+$(this).val()+'</div></div>');
					i++;	
				}
			})
			if($(".chopslider-slide").length<2) {
				alert ("You need to choose/upload at least 2 images");
				return;	
			}
			
			/* Generate 2D Transitions */
			var t2D = [];
			//Vertical
			var t2Vertical = $("input[name='vertical2d[]']:checked")
			if( $("input[name='vertical2d[]'].chopslider-selectAll").is(":checked") ) {
				t2D.push(csTransitions['vertical']['random'])
			}
			else {
				t2Vertical.each(function(){
					var tIndex = $(this).parents("li").index()-1;
					t2D.push(csTransitions['vertical'][tIndex])	
				})
			}
			//Horizontal
			var t2Horizontal = $("input[name='horizontal2d[]']:checked")
			if( $("input[name='horizontal2d[]'].chopslider-selectAll").is(":checked") ) {
				t2D.push(csTransitions['horizontal']['random'])
			}
			else {
				t2Horizontal.each(function(){
					var tIndex = $(this).parents("li").index()-1;
					t2D.push(csTransitions['horizontal'][tIndex])	
				})
			}
			//Multi
			var t2Multi = $("input[name='multi2d[]']:checked")
			if( $("input[name='multi2d[]'].chopslider-selectAll").is(":checked") ) {
				t2D.push(csTransitions['multi']['random'])
			}
			else {
				t2Multi.each(function(){
					var tIndex = $(this).parents("li").index()-1;
					t2D.push(csTransitions['multi'][tIndex])	
				})
			}
			
			//Half
			var t2Half = $("input[name='half2d[]']:checked")
			if( $("input[name='half2d[]'].chopslider-selectAll").is(":checked") ) {
				t2D.push(csTransitions['half']['random'])
			}
			else {
				t2Half.each(function(){
					var tIndex = $(this).parents("li").index()-1;
					t2D.push(csTransitions['half'][tIndex])	
				})
			}
			//Sexy
			var t2Sexy = $("input[name='sexy2d[]']:checked")
			if( $("input[name='sexy2d[]'].chopslider-selectAll").is(":checked") ) {
				t2D.push(csTransitions['sexy']['random'])
			}
			else {
				t2Sexy.each(function(){
					var tIndex = $(this).parents("li").index()-1;
					t2D.push(csTransitions['sexy'][tIndex])	
				})
			}
			//Slide
			var t2Sslide = $("input[name='slide2d[]']:checked")
			if( $("input[name='slide2d[]'].chopslider-selectAll").is(":checked") ) {
				t2D.push(csTransitions['slide']['random'])
			}
			else {
				t2Sslide.each(function(){
					var tIndex = $(this).parents("li").index()-1;
					t2D.push(csTransitions['slide'][tIndex])	
				})
			}
			if (t2D.length==0) t2D=false;
			
			/* Generate 3D Transitions */
			var t3D = [];
			//Blocks
			var t3Blocks = $("input[name='3dblocks[]']:checked")
			if( $("input[name='3dblocks[]'].chopslider-selectAll").is(":checked") ) {
				t3D.push(csTransitions['3DBlocks']['random'])
			}
			else {
				t3Blocks.each(function(){
					var tIndex = $(this).parents("li").index()-1;
					t3D.push(csTransitions['3DBlocks'][tIndex])	
				})
			}
			//Flips
			var t3Flips = $("input[name='3dflips[]']:checked")
			if( $("input[name='3dflips[]'].chopslider-selectAll").is(":checked") ) {
				t3D.push(csTransitions['3DFlips']['random'])
			}
			else {
				t3Flips.each(function(){
					var tIndex = $(this).parents("li").index()-1;
					t3D.push(csTransitions['3DFlips'][tIndex])	
				})
			}
			//Sphere
			var t3Sphere = $("input[name='3dsphere[]']:checked")
			if( $("input[name='3dsphere[]'].chopslider-selectAll").is(":checked") ) {
				t3D.push(csTransitions['sphere']['random'])
			}
			else {
				t3Sphere.each(function(){
					var tIndex = $(this).parents("li").index()-1;
					t3D.push(csTransitions['sphere'][tIndex])	
				})
			}
			
			
			if(t3D.length==0) t3D=false;
			
			/* Generate noCSS3 Transitions */
			var noCSS3 = [];
			var tnoCSS3 = $("input[name='noCSS3[]']:checked")
			if( $("input[name='noCSS3[]'].chopslider-selectAll").is(":checked") ) {
				noCSS3.push(csTransitions['noCSS3']['random'])
			}
			else {
				tnoCSS3.each(function(){
					var tIndex = $(this).parents("li").index();
					noCSS3.push(csTransitions['noCSS3'][tIndex])	
				})
			}
			if(noCSS3.length==0) noCSS3=false;
			
			/* Generate noCSS3 Transitions */
			var moBile = [];
			var tmoBile = $("input[name='mobile[]']:checked")
			if( $("input[name='mobile[]'].chopslider-selectAll").is(":checked") ) {
				moBile.push(csTransitions['mobile']['random'])
			}
			else {
				tmoBile.each(function(){
					var tIndex = $(this).parents("li").index();
					moBile.push(csTransitions['mobile'][tIndex])	
				})
			}
			if(moBile.length==0) moBile=false;
			
			
			
			$(".chopslider, #chopslider").css({
				width:$('input[name="chopslider-width"]').val(),
				height:$('input[name="chopslider-height"]').val()
			})
			$(".cs-preview-content-slide").css({
				width:$('input[name="chopslider-width"]').val()-80,
				height:$('input[name="chopslider-height"]').val()-80
			})
			$(" #chopslider").css({
				marginLeft: - $('input[name="chopslider-width"]').val()/2,
				top: $(window).scrollTop()+($(window).height()-$('input[name="chopslider-height"]').val())/2
			})
			$("a#cs-slide-next,a#cs-slide-prev").css({top:sliderHeight/2-15})
			$(" #chopslider").fadeIn(600)
			var csFaces = true;
			if( $('select[name="chopslider-showFaces"] option:selected').val() == "false" ) csFaces = false;
			
			$("#chop-slider-white-layer").fadeTo(600,0.9,function(){
				$(".chopslider").chopSlider({
					/* Slide Element */
					slide : ".chopslider-slide",
					/* Controlers */
					nextTrigger : "a#cs-slide-next",
					prevTrigger : "a#cs-slide-prev",
					hideTriggers : true,
					t2D : t2D,
					t3D : t3D,
					noCSS3 : noCSS3,
					mobile : moBile,
					full3D : $('input[name="chopslider-full3D"]').val(),
					/* Captions */
					useCaptions : false,
					/* Autoplay */
					autoplay : false,
					forceParameters : {
						showFaces:csFaces	
					}
				})
				
				$(".cs-close-preview").click(function(){
					$(".cs-slider-loader").remove();
					$("#chop-slider-white-layer").hide();
					$(".chopslider").html("")
					$(" #chopslider").hide()
					$("a#cs-slide-next").die().unbind().undelegate()
					$("a#cs-slide-prev").die().unbind().undelegate()
				})	
			});
	
		})
		//Chop Slider Bulk Actions
		$("input#submit-chopslider-bulk-actions").click(function(e){
			e.preventDefault();
			if ( $("select[name='chopslider-action']").val()=="delete" ) {
				var pHtml = '<div style="text-align:center"><p>Are you sure you want to remove all the selected Sliders?</p>';
				pHtml+='<p><a class="button-primary" href="#" onclick="jQuery(\'#chopslider-ba-form\').submit(); return false;">I\'am Sure</a> <a class="button-secondary chopslider-popup-close" href="#">Cancel</a></p></div>';
				chopsliderPopup({content:pHtml, width:400});
			}
			else {
				$('#chopslider-ba-form').submit()
			}
		})
		$("#chopslider-ba-form input[name='chopslider-id[]'][value='all']").change(function(e){
			if($(this).is(":checked")) {
				$(this).parents("table").find("input[type='checkbox']").attr({'checked':'checked'})	
			}
			else {
				$(this).parents("table").find("input[type='checkbox']").removeAttr('checked')	
			}
		})
		//Single Select
		$("#chopslider-ba-form input[type='checkbox'][value!='all']").click(function(){
			$(this).parents('table').find("input[type='checkbox'][value='all']").removeAttr("checked")
		})
		//Delete Chop Slider
		$(".chopslider_remove").click(function(e){
			e.preventDefault();
			var pHtml = '<div style="text-align:center"><p>Are you sure you want to remove this Chop Slider?</p>';
			pHtml+='<p><a class="button-primary" href="'+$(this).attr("href")+'">I\'am Sure</a> <a class="button-secondary chopslider-popup-close" href="#">Cancel</a></p></div>';
			chopsliderPopup({content:pHtml});	
		})
		//Chop Slider Popup
		$('.chopslider-popup-close').live('click',function(e){
			e.preventDefault();
			$("#chopslider-popup").fadeOut(300,function(){
				$(this).find(".chopslider-popup-content").html('')	
			})	
		})
		function chopsliderPopup(a) {
			var csPopup = $("#chopslider-popup")
			a.width = a.width||300;
			a.height = a.height || "auto";
			$(".chopslider-popup-content").html(a.content)
			var newTop = $(window).scrollTop() + ( $(window).height()-(a.height=="auto" ? $("#chopslider-popup").height() : a.height) - 80 )/2;
			if (newTop<0) newTop = 100;
			var newLeft = ( $(window).width()-a.width-80 )/2
			if (newLeft<0) newLeft = 100;
			$("#chopslider-popup").css({
				width : a.width,
				height: a.height,
				top: newTop,
				left: newLeft
			})
			.fadeIn(450)
		}
		
		$("#chopslider-check-updates").click(function(e){
			e.preventDefault();
			$.getJSON("http://www.idangero.us/cs/versions.php?callback=?",
				function(versions) {
					var newVersion = false;
					if (versions.core != $("#chopslider-version-core").html() ) {
						newVersion = true;
						$("#chopslider-version-core").next(".chopslider-new-version").html(" &nbsp;-&gt; &nbsp;"+versions.core)
					}
					if (versions.library != $("#chopslider-version-library").html() ) {
						newVersion = true;
						$("#chopslider-version-library").next(".chopslider-new-version").html(" &nbsp;-&gt; &nbsp;"+versions.library)
					}
					if (versions.wordpress != $("#chopslider-version-wp").html() ) {
						newVersion = true;
						$("#chopslider-version-wp").next(".chopslider-new-version").html(" &nbsp;-&gt; &nbsp;"+versions.wordpress)
					}
					
					if(newVersion && versions.changelog != "") {
						$("#chopslider-new-versions-changelog").html('<strong>Changelog:</strong><br />'+versions.changelog).slideDown(600)	
					}
					if(newVersion) {
						$("#chopslider-new-versions").html('New updates are available! Please, re-download the Chop Slider 2 where you obtain it').fadeIn(600)	
					}
					else {
						$("#chopslider-new-versions").html('All versions are up to date!').fadeIn(600)
					}
				})
		})
	})
	
})(jQuery);
/*
iDangero.us jQuery Twitter Feed
------------------------
Version - 1.1
*/
(function($) {
	$.fn.idTwitter = function(a,callback) {
		var tweetContainer = this;
		if (tweetContainer.length==0) return;
		this.html(a.loadingText)
		$.getJSON("http://api.twitter.com/1/statuses/user_timeline.json?screen_name="+a.username+"&count="+a.numberOfTweets+"&include_entities=true&include_rts=true&callback=?",
		function(tweetData){
			tweetContainer.html("")
			$.each(tweetData, function(i,tweet) {
				var tweetDate = tweet.created_at.substr(0,20);
				var tweetText = tweet.text;
				for (var i =0; i<tweet.entities.user_mentions.length; i++) {
					var mentioned = tweet.entities.user_mentions[i].screen_name;
					tweetText = tweetText.replace('@'+mentioned,'<a href="http://twitter.com/'+mentioned+'">@'+mentioned+'</a>')	
				}
				for (var i =0; i<tweet.entities.urls.length; i++) {
					var uRL = tweet.entities.urls[i].url;
					tweetText = tweetText.replace(uRL,'<a href="'+uRL+'">'+uRL+'</a>')	
				}
				var readyTweet = a.tweetFormat.replace(/%username/g,a.username)
					readyTweet = readyTweet.replace(/%tweetDate/g,tweetDate)
					readyTweet = readyTweet.replace(/%tweetText/g,tweetText)
				tweetContainer.append(readyTweet);
			})
			if(callback) callback()
		})
	}
})(jQuery);