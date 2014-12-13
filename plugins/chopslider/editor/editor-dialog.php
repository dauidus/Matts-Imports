
	<script>
	function insertCS(id) {
		window.parent.tinymce.execCommand('mceInsertContent', false, '[chopslider id="'+id+'"]');
		window.parent.tinymce.activeEditor.windowManager.close(window)
	}
	</script>
	<p style="font-size:13px;">Choose the Chop Slider you want to insert:</p>
	<ul>
	
		<li  style="font-size:13px;"><a style="color:#21759B" href="#" onclick="insertCS(1); return false;">Home Page</a></li>	
		</ul>