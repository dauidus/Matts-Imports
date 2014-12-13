<?php
/*
Template Name: Staff
*/

get_header();
?>

    <div id="content" class="page col-full">
		<div id="main" class="fullwidth">

   			<?php if ( have_posts() ) : $count = 0; ?>
   			<?php while ( have_posts() ) : the_post(); $count++; ?>
   			    <?php
//custom field
$menu_additional_info = get_post_meta( $post->ID, 'menu_additional_info', true );
$menu_pdf = get_post_meta( $post->ID, 'menu_pdf', true );
?>
   			    <div class="post">

   			        <h1 class="title"><?php the_title(); ?></h1>

   			        <div class="entry">
   			        	<?php the_content(); ?>
   			       	</div><!-- /.entry -->

   			    </div><!-- /.post -->

   			<?php endwhile; endif; ?>

   		</div><!-- /.post-wrap -->

   		<div id="menu" class="full-width-menu">

   			<table>

   			    <thead>
   			    	<tr>
   			    		<th colspan="3"></th>
   			    	</tr>
   			    </thead>
   			    <?php if ( $term->description != '' ) { ?>
   			    <tfoot>
   			    	<tr class="asterix-info">
   			    		<td  colspan="3"><span id="info-1">*</span> <?php echo $term->description; ?></td>
   			    	</tr>
   			    </tfoot>
   			    <?php } ?>
   			    <tbody>


				<?php
$args = array( 'orderby' => 'registered', 'role' => 'owner', 'exclude' => 'dauidite' );
$authors = get_users( $args );
?> 

         <?php
         $c = 0; // set up a counter so we know which post we're currently showing
         $extra_class = 'even' // set up a variable to hold an extra CSS class
         ?>
    
<?php foreach( $authors as $author ) {  ?>   

<?php
         $c++; // increment the counter
         if( $c % 2 != 0) {
	  // we're on an odd post
	   $extra_class = 'odd';
         } else {
         $extra_class = 'even'; }
         ?>
         

   			    	<tr <?php post_class($extra_class) ?>>
   			    		<td class="image"> <?php echo get_avatar( $author->ID, '170' ); ?></td>
   			    		<td class="details">
   			    			<h3><?php the_author_meta( 'user_firstname', $author->ID ); ?> <?php the_author_meta( 'user_lastname', $author->ID ); ?></h3>
   			    			<?php the_author_meta( 'description', $author->ID ); ?>
   			    		</td>
   			    	</tr>

   			    <?php } ?>


        		<?php
$args = array( 'orderby' => 'registered', 'role' => 'author', 'exclude' => 'dauidite' );
$authors = get_users( $args );
?> 

         <?php
         $c = 0; // set up a counter so we know which post we're currently showing
         $extra_class = 'even' // set up a variable to hold an extra CSS class
         ?>
    
<?php foreach( $authors as $author ) {  ?>   

<?php
         $c++; // increment the counter
         if( $c % 2 != 0) {
	  // we're on an odd post
	   $extra_class = 'odd';
         } else {
         $extra_class = 'even'; }
         ?>
         

   			    	<tr <?php post_class($extra_class) ?>>
   			    		<td class="image"> <?php echo get_avatar( $author->ID, '170' ); ?></td>
   			    		<td class="details">
   			    			<h3><?php the_author_meta( 'user_firstname', $author->ID ); ?> <?php the_author_meta( 'user_lastname', $author->ID ); ?></h3>
   			    			<?php the_author_meta( 'description', $author->ID ); ?>
   			    		</td>
   			    	</tr>

   			    <?php } ?>

   			    </tbody>


   			</table>

   		</div><!-- /#menu -->

    </div><!-- /#content -->

<?php get_footer(); ?>