<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

<title><?php woo_title(); ?></title>
<?php woo_meta(); ?>
<?php global $woo_options; ?>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/includes/prettyPhoto.css" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( $woo_options['woo_feed_url'] ) { echo $woo_options['woo_feed_url']; } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	

    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/css/jquery-ui-1.7.1.custom.css" />




<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favico.png"/>


<meta name="viewport" content="width=1000" />

<?php 
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	if (preg_match('/iphone/i', $user_agent))
	  echo
		'<script type="text/javascript" charset="utf-8">
			addEventListener(\'load\', function() {
				setTimeout(hideAddressBar, 0);
			}, false);
			function hideAddressBar() {
				window.scrollTo(0, 1);
			}
		</script>';
?>

      
<?php wp_head(); ?>
<?php woo_head(); ?>

<?php
if( ( is_home() || is_page_template('template-location.php') || is_active_widget( false,false,'woo_location', true ) ) ){ ?>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>   
<?php } ?>





</head>

<body>


<div id="wrapper">
    
    <div id="header-out">
    
	    <div id="header">
	               
			<div id="top" class="col-full">
            
            <div id="plate"></div>
            <a href="http://www.yelp.com/biz/matts-imports-cypress" target="_blank"><div id="offer"></div></a>
		 		       
				<div id="logo" class="col-left">
			       
					<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('description'); ?>">
						<div id="logoimage"></div>
					</a>

		        
		        <?php if( is_singular() && !is_front_page() ) : ?>
					<span class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></span>
		        <?php else : ?>
					<h1 class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
		        <?php endif; ?>
					<span class="site-description"><?php bloginfo('description'); ?></span>
			      	
				</div><!-- /#logo -->
                
				<div id="volvoblue"></div>
			    
			    <div id="proudly">We are proudly based in Cypress, CA</div>    
		        <div id="phonenumber">(714) 826-1068</div>       
		    
		   		<div class="fix"></div>
		    
		    </div><!-- /#top -->
		    		    
	       
		</div><!-- /#header -->
        

	</div><!-- /#header-out -->    
    


    <div id="navigation">
    <div class="col-full">
		<?php
		if ( function_exists('has_nav_menu') && has_nav_menu('primary-menu') ) {
			wp_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'main-nav', 'menu_class' => 'nav fl', 'theme_location' => 'primary-menu' ) );
		} 
		?>

    </div>
	</div><!-- /#navigation -->
    
<div class="fix"></div>
    
