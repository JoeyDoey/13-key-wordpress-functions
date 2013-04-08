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
		// here's our function keyfunctions_single_nav() that outputs the prev/next post nav links
		// we want to give it a CSS class name 'single_nav' so we can style as needed
		keyfunctions_single_nav( 'single_nav' ); ?>
		
	<?php else : ?>
	
	<p><?php _e('Sorry, there is nothing here.', 'keyfunctions'); ?></p>
	
	<?php endif; ?>
	
	
	<?php comments_template( '', true ); ?>
	
		
	</div>
</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>