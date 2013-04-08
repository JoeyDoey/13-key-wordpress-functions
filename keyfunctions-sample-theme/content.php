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


<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<h2>
		<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'keyfunctions' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
			<?php the_title(); ?>
		</a>
	</h2>
	
	<dl class="meta_data">
		
		<dt><?php _e('Author:', 'keyfunctions'); ?></dt>
		<dd><?php the_author_posts_link(); ?></dd>
		
		<dt><?php _e('Date:', 'keyfunctions'); ?></dt>
		<dd><?php the_time('F j, Y') ?></dd>
		
		<dt><?php _e('Comments:', 'keyfunctions'); ?></dt>
		<dd><?php comments_popup_link('0', '1', '%'); ?></dd>
		
		<dt><?php _e('Category:', 'keyfunctions'); ?></dt>
		<dd><?php the_category(' , '); ?></dd>
		
		<dt><?php _e('Tags:', 'keyfunctions'); ?></dt>
		<dd><?php the_tags(' ', ', ', ' '); ?></dd>
		
		
	</dl>

	
	<?php if ( is_singular() ): ?>
	
	
		<?php if ( has_post_thumbnail()) { ?>
			<figure class="singular_thumbnail">
				<?php the_post_thumbnail( 'large'); ?>
			</figure>
		<?php }?>			
	
	
		<?php the_content(); ?>
		
		<?php $args = array(
			// if this is a paginated post
			'before'           => '<p>' . __('Pages:', 'keyfunctions'),
			'after'            => '</p>',
			'link_before'      => '',
			'link_after'       => '',
			'next_or_number'   => 'number',
			'nextpagelink'     => __('Next page', 'keyfunctions'),
			'previouspagelink' => __('Previous page', 'keyfunctions'),
			'pagelink'         => '%',
			'echo'             => 1 ); 
			wp_link_pages( $args );
		?>
		

	<?php else : ?>
	
		<?php if ( has_post_thumbnail()) { ?>
		<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'keyfunctions' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark" class="featured_image">
			<?php the_post_thumbnail( 'thumbnail'); ?>
		</a>
		<?php }?>			
		
		<?php the_excerpt('Read more...'); ?>

	<?php endif; ?>
	
	
	<br />
	
				
</article>				                                    

