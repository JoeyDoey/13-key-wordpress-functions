<?php
/**
 * @package WordPress
 * @subpackage keyfunctions 1.0
 * 
 * Version: 1.0
 * Updated: April 08 2013
 * Author: (Joe Nyaggah) nyaggah.com				
*/
get_header(); ?>

<section class="main_content">
	<div class="inner">
	
	
	<?php if ( have_posts() ) : ?>
	
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>
	
		<?php 
		// here's our function keyfunctions_index_nav() that outputs the index navigation
		// we want to give it a CSS class name 'index_nav' so we can style as needed
		keyfunctions_index_nav( 'index_nav' ); ?>
		
	<?php else : ?>
	
	<p><?php _e('Sorry, there is nothing here.', 'keyfunctions'); ?></p>
	
	<?php endif; ?>
	
		
	</div>
</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>