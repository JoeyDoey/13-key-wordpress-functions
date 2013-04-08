<?php
/**
 * @package WordPress
 * @subpackage keyfunctions 1.0
 * 
 * Version: 1.0
 * Updated: April 08 2013
 * Author: (Joe Nyaggah) nyaggah.com				
*/
?>

<section class="sidebar">

	<?php if ( !dynamic_sidebar('Main Sidebar') ) : ?>

			
		<aside>
			<h3><?php _e('Search', 'keyfunctions');?></h3>
			<?php get_search_form( 'true' ); ?>
		</aside>
		
		<aside>
			<h3><?php _e('Categories', 'keyfunctions');?></h3>	
		    <ul>
		    	<?php wp_list_categories('title_li='); ?>
		    </ul>
		</aside>
		
	    
		<aside>
			<h3><?php _e('Archives', 'keyfunctions');?></h3>
		    <ul>
		    	<?php wp_get_archives('type=monthly'); ?>
		    </ul>
		</aside>
	
	
		<?php if ( function_exists('wp_tag_cloud') ) : ?>
		<aside>
			<h3><?php _e('Tags', 'keyfunctions');?></h3>
			<?php wp_tag_cloud('smallest=11&largest=22&format=list'); ?>
		</aside>
		<?php endif; ?>		    
	    
	<?php endif; ?>

</section>		