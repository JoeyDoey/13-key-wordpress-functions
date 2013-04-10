<?php
/**
 *
 * ----------------------------------------------------------
 * 13 key WordPress functions to jump-start theme development
 * ----------------------------------------------------------
 *
 * This file nails down 13+ of the key WordPress functions
 * that'll help get your development process started and moving 
 * along apace.
 *
 * @package WordPress
 * @subpackage keyfunctions 1.0
 * 
 * Version: 1.0
 * Updated: April 08 2013
 * Author: (Joe Nyaggah) nyaggah.com				 
 */





/*
 * =======================================================================================================================================
 * CUSTOM MENU SUPPORT
 * =======================================================================================================================================
 * With this function, we'll register and define 2 menus: 'Main Menu' and 'Secondary Menu'.
 * Note that we are also making the 'Main Menu' and 'Secondary Menu' strings translatable
 * by using a text domain which, in our case, we're calling 'keyfunctions'
*/
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  'main_menu' => __( 'Main Menu', 'keyfunctions' ),
		  'secondary_menu' =>  __( 'Secondary Menu', 'keyfunctions' ),
		)
	);
}




/*
 * =======================================================================================================================================
 * STYLE THE VISUAL EDITOR
 * =======================================================================================================================================
 * This function allows you to use custom CSS to style the WordPress TinyMCE visual editor.
 * As a placeholder, we'll be using the styles in the editor-style.css file of the Twenty Twelve theme.
 *
 * Find also in the theme directory, a file called editor-style-rtl.css (again with styles from Twenty Twelve as a placeholder)
 * that helps us get some styles in place for Right-To-Left languages
 */
add_editor_style();




/*
 * =======================================================================================================================================
 * CUSTOM AVATAR SUPPORT
 * =======================================================================================================================================
 * This function tells WordPress that we want to add a new avatar called "Panda Bear" to the list of possible avatars for our site.
 * We're also placing this new image, named "avatar.png" in the "images" directory.
*/

if ( !function_exists('keyfunctions_avatar') ) {
	function keyfunctions_avatar( $avatar_defaults ) {
		$new_default_avatar = get_template_directory_uri() . '/images/avatar.png';
		$avatar_defaults[$new_default_avatar] = 'Panda Bear';
		return $avatar_defaults;
	}
	add_filter( 'avatar_defaults', 'keyfunctions_avatar' );
}



/*
 * =======================================================================================================================================
 * POST FORMATS
 * =======================================================================================================================================
 * with this function we add post formats and define which (of the 9 available) we'll be taking advantage of
*/
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );
}




/*
 * =======================================================================================================================================
 * POST AND PAGE IMAGE THUMBNAILING
 * =======================================================================================================================================
 * This functions adds Featured Image function to our theme. Defines the sizes
*/

if ( function_exists( 'add_theme_support' ) ) { 
	
	add_theme_support( 'post-thumbnails' );
	
	// regular thumbnails
	add_image_size( 'regular', 400, 350, true );

	// medium thumbnails
	add_image_size( 'medium', 650, 500, true );
	
	// large size thumbnails
	add_image_size( 'large', 960, '' );
	
}




/*
 * =======================================================================================================================================
 * ATTACHMENT DISPLAY SETTINGS
 * =======================================================================================================================================
 * This functions adds our above defined image sizes to the Attachment Display Settings interface
*/
function keyfunctions_show_image_sizes($sizes) {
    $sizes['regular'] = __( 'Regular', 'keyfunctions' );
    $sizes['medium'] = __( 'Medium', 'keyfunctions' );
    $sizes['large'] = __( 'Large', 'keyfunctions' );
    return $sizes;
}
add_filter('image_size_names_choose', 'keyfunctions_show_image_sizes');




/*
 * =======================================================================================================================================
 * ADD FEED LINKS
 * =======================================================================================================================================
 * This function adds RSS feed links to <head> for posts and comments.
*/
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'automatic-feed-links' );
}




/*
 * =======================================================================================================================================
 * TRANSLATION (load text domain)
 * =======================================================================================================================================
 * With this function you take the first step towards making your theme available for translation
*/
add_action('after_setup_theme', 'keyfunctions_setup');
function keyfunctions_setup(){
    load_theme_textdomain('keyfunctions', get_template_directory() . '/languages');
}




/*
 * =======================================================================================================================================
 * SET A CONTENT WIDTH
 * =======================================================================================================================================
 * Content Width is a feature in themes that allows you to set the maximum allowed width for 
 * videos, images, and other oEmbed content in a theme.
*/
if ( ! isset( $content_width ) ) $content_width = 960;




/*
 * =======================================================================================================================================
 * DYNAMIC SIDEBAR
 * =======================================================================================================================================
*/
if(function_exists('register_sidebar')){
	register_sidebar(array(
		'name' => __( 'Main Sidebar', 'keyfunctions' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
} 




/*
 * =======================================================================================================================================
 * CUSTOM MORE LINK (FORMAT)
 * =======================================================================================================================================
*/
function new_excerpt_more($more) {
       global $post;
	return '...<br /><br /><a href="'. get_permalink($post->ID) . '" class="read_more">read more &rarr;</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');




/*
 * =======================================================================================================================================
 *  BASIC PAGINATION & CONTENT NAVIGATION
 * =======================================================================================================================================
 * Display navigation to next/previous pages when applicable
*/

// while in index (listing) view
function keyfunctions_index_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>" class="content_nav clearfix">
			<ul>
				<li class="nextPost"><?php previous_posts_link( __( '&larr; newer ', 'keyfunctions' ) ); ?></li>
				<li class="prevPost"><?php next_posts_link( __( 'older &rarr;', 'keyfunctions' ) ); ?></li>
			</ul>					
		</nav>
	<?php endif;
}

// while in single entry view
function keyfunctions_single_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages < 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>" class="content_nav clearfix">
			<ul>
				<li class="next_post"><?php next_post_link( __( '&larr; %link ', 'keyfunctions' ) ); ?></li>
				<li class="prev_post"><?php previous_post_link( __( '%link &rarr;', 'keyfunctions' ) ); ?></li>
			</ul>					
		</nav>
	<?php endif;
}




/*
 * =======================================================================================================================================
 * REGISTER & ENQUEUE SCRIPTS
 * =======================================================================================================================================
 * with this function with both register and enqueue our scripts (making sure to deregister jQuery in admin pages).
 * For performance, unless otherwise desired, load javascripts in footer. In this case, modernizr is the only js file
 * loaded in the head.
*/

function keyfunctions_scripts_and_styles() {

	// register and enqueue modernizr script (in head)
	// no depency specified
	wp_register_script('modernizr',
		get_template_directory_uri() . '/javascripts/vendor/modernizr-2.6.2-respond-1.1.0.min.js', '2.6.2', false);
	wp_enqueue_script('modernizr');
	

	// register and enqueue jQuery
	wp_deregister_script('jquery');
		wp_register_script('jquery', get_template_directory_uri() . '/javascripts/vendor/jquery-1.9.1.min.js', false, '1.9.1', true);
	wp_enqueue_script('jquery');
	
	
	// register and enqueue the plugins.js file 
	// it depends on jQuery and is loaded in the footer
	wp_register_script('plugins',
		get_template_directory_uri() . '/javascripts/plugins.js', '1.0', true, array('jquery') );
	wp_enqueue_script('plugins');
	
	
	// register and enqueue main.js site-wide javascript behaviors file
	// it depends on jQuery and is loaded in the footer
	wp_register_script('main',
		get_template_directory_uri() . '/javascripts/main.js', '1.0', true, array('jquery') );
	wp_enqueue_script('main');
	
	// Adds JavaScript to pages with the comment form to support
	// sites with threaded comments (when in use).
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
 
		
	// Loads our main stylesheet.
	wp_enqueue_style( 'keyfunctions-style', get_stylesheet_uri() );

    
} 
add_action('wp_enqueue_scripts', 'keyfunctions_scripts_and_styles');




/*
 * =======================================================================================================================================
 * ADD 'odd' OR 'even' CSS CLASSES TO post_class()
 * =======================================================================================================================================
 * 
*/
add_filter ( 'post_class' , 'keyfunctions_odd_or_even' );
if( !function_exists( 'keyfunctions_odd_or_even' ) ) {
	global $current_class;
	$current_class = 'odd';
	
	function keyfunctions_odd_or_even ( $classes ) { 
		global $current_class;
		$classes[] = $current_class;
		
		$current_class = ($current_class == 'odd') ? 'even' : 'odd';
		
		return $classes;
	}
}



/*
 * =======================================================================================================================================
 * =======================================================================================================================================
 * =======================================================================================================================================
 * =======================================================================================================================================
EXTRAS
 * =======================================================================================================================================
 * =======================================================================================================================================
 * =======================================================================================================================================
 * =======================================================================================================================================
 * =======================================================================================================================================
 * These are a few extra functions that are also useful
*/



/*
 * =======================================================================================================================================
 * REDIRECT TO THEME OPTIONS
 * =======================================================================================================================================
 * once theme is activated,
 * redirect to the desired page, in this case the 'optionsframework' page
 * uncomment the code below to implement
*/
// if (is_admin() && isset($_GET['activated']) && $pagenow == "themes.php")
// 	wp_redirect('themes.php?page=optionsframework');




/*
 * =======================================================================================================================================
 * HIDE ADMIN BAR
 * =======================================================================================================================================
 * during development, it might be helpful to hide the admin bar.
 * uncomment the code below to implement
*/
//show_admin_bar( false );








/*
 * =======================================================================================================================================
 * A MORE SPECIFIC TITLE ELEMENT
 * =======================================================================================================================================
*/

function keyfunctions_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'keyfunctions' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'keyfunctions_title', 10, 2 );




/*
 * =======================================================================================================================================
 *  DEFINE OUR COMMENT LIST STYLE
 * =======================================================================================================================================
 * template for comments and pingbacks.
 *
 * to override this walker in a child theme without modifying the comments template
 * simply create your own keyfunctions_comment(), and that function will be used instead.
 *
 * used as a callback by wp_list_comments() for displaying the comments.
 *
*/
if ( ! function_exists( 'keyfunctions_comment' ) ) :

function keyfunctions_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    
		<div class="commentWrapper" id="comment-<?php comment_ID(); ?>">
        
        <div class="authorInfo">
            <?php echo get_avatar( $comment, 50 ); ?>
		<?php edit_comment_link( __('<br />edit', 'keyfunctions'), ' ' ); ?>
        </div><!-- /authorInfo -->
               

        <div class="comment_text">
		
	        <h4 class="post_author">
				<?php comment_author_link() ?>
	        </h4>
			
	        <small class="commentmetadata">
	            <span class="post_date"><?php comment_date('M. jS Y') ?> </span> 
	            <span class="post_time"> / <?php comment_time() ?></span> <br />
	        </small>
	
			<?php comment_text() ?> 
			
	        <small class="reply">
	        	<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	        </small>

           <?php if ($comment->comment_approved == '0') : ?> 
           	<p class="pending"><?php _e( 'Your comment is awaiting moderation.', 'keyfunctions' ); ?></p>
           <?php endif; ?>
            
        </div><!-- /commTxt -->
            
	<br class="clearfloat" />
	</div><!-- #comment-##  -->

	<?php
		break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p>
			<?php _e( 'Pingback:', 'keyfunctions' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'keyfunctions'), ' ' ); ?>
		</p>
	<?php
			break;
	endswitch;
}
endif;