(function() {
	//var dm = tinymce.activeEditor.controlManager.createDropMenu('somemenu');
    tinymce.create('tinymce.plugins.chopSlider', {
        init : function(ed, url) {
			
			ed.addCommand('chopsliderDialog', function() {
				ed.windowManager.open({
						title : "Insert Chop Slider",
						file : url + '/editor/editor-dialog.php',
						width : 620 + ed.getLang('example.delta_width', 0),
						height : 220 + ed.getLang('example.delta_height', 0),
						inline : 1
				});
			});
            ed.addButton('chopslider', {
            	title : 'Insert Chop Slider',
            	image : url+'/images/admin/chopslider-button.png',
				cmd : 'chopsliderDialog'
                
            });
        },
        createControl : function(n, cm) {
            switch (n) {
				case 'mylistbox':
					var mlb = cm.createListBox('mylistbox', {
						 title : 'My list box',
						 onselect : function(v) {
							 tinyMCE.activeEditor.windowManager.alert('Value selected:' + v);
						 }
					});
	
					// Add some values to the list box
					mlb.add('Some item 1', 'val1');
					mlb.add('some item 2', 'val2');
					mlb.add('some item 3', 'val3');
	
					// Return the new listbox instance
					return mlb;
			}
        },
        getInfo : function() {
            return {
                longname : "Chop Slider Shortcode",
                author : 'Vladimir Kharlampidi, The iDangero.us',
                authorurl : 'http://www.idangero.us/',
                infourl : 'http://www.idangero.us/cs/',
                version : "1.0"
            };
        }
    });
    tinymce.PluginManager.add('chopslider', tinymce.plugins.chopSlider);
})();