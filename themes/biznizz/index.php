<?php get_header(); ?>
<?php global $woo_options; ?>

    

    <div id="content" class="col-full" style="margin-bottom:0px;">
    
		<div style="width:260px; margin:0 0 0 30px; float:left;">
        
        <br />
        
        <img src="<?php bloginfo('template_directory'); ?>/images/asevolvo.jpg" style="align:center;" />
        
        <br /><br />
        
        <div><?php echo do_shortcode('[video_lightbox_youtube video_id=q8oyUE1oMnU width=853 height=480 alt="Matt\'s Imports video" title="Matt\'s Imports video" anchor="http://mattsimports.dev/wp-content/themes/biznizz/images/youtubevideo.jpg"]'); ?></div>
                                
        
        	Check out our friendly welcome video.
        
        <br />
                                
        </div>
        
        <div style="width:640px; float:right;">  
        	<div class="chop">
        		<div class="fakebg"></div>
                <div class="fakebg second"></div>
                    
            			<div class="chops">
							<?php chop_slider(1) ?>  
           				 </div> 
                         
             </div>
		</div><!-- /div -->

    <div class="fix"></div>
        
        
        <div id="main" class="col-left" style="margin-top:-5px;">
        
	        <?php if ( $woo_options['woo_main_page1'] && $woo_options['woo_main_page1'] <> "Select a page:" ) { ?>
	        <div id="main-page1">
				<?php query_posts('page_id=' . get_page_id($woo_options['woo_main_page1'])); ?>
	            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>		        					
			    <div class="entry"><?php the_content(); ?></div>
	            <?php endwhile; endif; ?>
	            <div class="fix"></div>
	        </div><!-- /#main-page1 -->
	        <?php } ?>	
            
        </div><!-- /#main -->
        	        
        <?php get_sidebar(); ?>
        
        <div class="fix"></div>

    </div><!-- /#content -->

      
        <div style="margin: 0px auto;" >
        
            <?php if ($woo_options['woo_mini_features'] == "true"): ?>

            <div id="mini-features">
            	<div class="mini-bg">
                
    <div id="content" class="col-full" style="margin:0px auto; padding:0 0 0 0; background: none; border: none; ">
	        
	        
            
                
                                                      
	                <div>
                    
                    	<ul id="sti-menu" class="sti-menu">
                        
                        
							<?php query_posts('post_type=infobox&order=RAND&posts_per_page=4'); ?>
                            <?php if (have_posts()) : while (have_posts()) : the_post(); $counter++; ?>		        					
                    
                                <?php 
                                    $icon = get_post_meta($post->ID, 'mini', true); 
                                    $excerpt = stripslashes(get_post_meta($post->ID, 'mini_excerpt', true)); 
                                    $button = get_post_meta($post->ID, 'mini_readmore', true);
                                ?>
                                
                                
                            <?php if ( $button ) { ?>    
                        

                                <li data-hovercolor="#fff">
                                    <a href="<?php echo $button; ?>">
                                        <h2 data-type="mText" class="sti-item"><?php echo get_the_title(); ?></h2>
                                        <p data-type="sText" class="sti-item"><?php echo $excerpt; ?></p>
                                        <span data-type="icon" class="sti-icon sti-item" style="position:absolute; top:10px; left:97px; width:48px; height:48px; background:url(<?php echo $icon; ?>) no-repeat;"></span>
                                    </a>
                                </li>
                            
                            
                            <?php } ?>       
                   
                            <?php endwhile; endif; ?>            
                        
                       
                        </ul>
                        
	            	</div>
                    

    </div><!-- /#content -->

	            <div class="fix"></div>
                
                </div>
	        </div><!-- /#mini-features -->

	        <?php endif; ?>	
        
        </div>
        
  
  		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/jquery.iconmenu.js"></script>
		<script type="text/javascript">
			$j = jQuery.noConflict(true);
			$j(function() {
				$j('#sti-menu').iconmenu({
					animMouseenter	: {
						'mText' : {speed : 400, easing : 'easeOutBack', delay : 200, dir : -1},
						'sText' : {speed : 400, easing : 'easeOutBack', delay : 400, dir : -1},
						'icon'  : {speed : 400, easing : 'easeOutBack', delay : 0, dir : -1}
					},
					animMouseleave	: {
						'mText' : {speed : 200, easing : 'easeInExpo', delay : 150, dir : 1},
						'sText' : {speed : 200, easing : 'easeInExpo', delay : 300, dir : 1},
						'icon'  : {speed : 200, easing : 'easeInExpo', delay : 0, dir : 1}
					}
				});
			});
		</script>
        
        

    <div id="content" class="col-full" style="margin: 80px auto 50px auto; padding: 30px 0 10px 0;" >            

		<div id="mainhalf" class="col-left">             
            
            <?php if ( $woo_options['woo_main_page2'] && $woo_options['woo_main_page2'] <> "Select a page:" ) { ?>
	        <div id="main-page2" class="home-page">
				<?php query_posts('page_id=' . get_page_id($woo_options['woo_main_page2'])); ?>
	            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>		        					
			    <div class="entry"><?php the_content(); ?></div>
	            <?php endwhile; endif; ?>
	            <div class="fix"></div>
	        </div><!-- /#main-page2 -->
	        <?php } ?>
            
		</div><!-- /#main -->
        
        
        <div id="sidebarhalf" class="col-right">
        	<div class="secondary">
        		<?php woo_sidebar('secondary'); ?>
            </div>
		</div><!-- /#sidebar -->
        
        
    </div><!-- /#content -->
    
    
		
<?php get_footer(); ?>