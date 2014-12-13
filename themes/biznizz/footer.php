<?php global $woo_options; ?>


<div id="foot">    
    <div id="footer">


        
	<?php if ( woo_active_sidebar('footer-1') ||
			   woo_active_sidebar('footer-2') || 
			   woo_active_sidebar('footer-3') || 
			   woo_active_sidebar('footer-4') ) : ?>
	<div id="footer-widgets" class="col-full">

		<div class="block">
        	<?php woo_sidebar('footer-1'); ?>    
		</div>
		<div class="block">
        	<?php woo_sidebar('footer-2'); ?>    
		</div>
		<div class="block">
        	<?php woo_sidebar('footer-3'); ?>    
		</div>
		<div class="block last">
        	<?php woo_sidebar('footer-4'); ?>    
		</div>
		<div class="fix"></div>

	</div><!-- /#footer-widgets  -->
    <?php endif; ?>
    
		<div class="col-full">
		
			<div class="col-left">

				<div id="copyright">
				<?php if($woo_options['woo_footer_left'] == 'true'){
				
						echo stripslashes($woo_options['woo_footer_left_text']);	
		
				} else { ?>
					<p><span><?php bloginfo(); ?></span> &copy; 2011-<?php echo date('Y'); ?>. <?php _e('All Rights Reserved.', 'woothemes') ?></p>
				<?php } ?>
				</div>
				
			</div><!-- /.col-left  -->
			

			
				<div id="credit">

					<a id="dd" href="http://www.dauidusdesign.com/" target="_blank"><div id="dauidusdesign">from the studio of<br />Dauidus Design</div></a>

				</div>
                
						

			
		</div><!-- /.col-full  -->
		
	</div><!-- /#footer  -->
</div>


</div><!-- /#wrapper -->



<?php wp_footer(); ?>
<?php woo_foot(); ?>
</body>
</html>