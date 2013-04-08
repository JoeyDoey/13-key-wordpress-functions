13 Key WordPress-Functions
==========================

<p>
  After a few years (or even month, really) of designing and developing WordPress themes, especially for clients, you start to realize that a lot of the functionality can be standardized or distilled down into a "starter theme or kit". 
  This helps get the development process started and moving along apace. 
</p>

<p>
  The best first step in doing this, I've found, is to nail down most of the common functions and include them in the <code>functions.php</code>. 
  This <code>functions.php</code> file will need to be extended to meet the particular theme needs as new projects arise, but it'll provide a more than awesome starting point for development.


  There are about 13 key functions that I like to start out with and will add to them as needed. These include:
</p>


<ol>
  <li>Custom Menu Support</li>
  <li>Visual Editor Style</li>
  <li>Default Custom Avatar</li>
  <li>Post Formats</li>
  <li>Featured Image</li>
  <li>Attachment Display Settings</li>
  <li>Feed Links (RSS)</li>
  <li>Load Text Domain (translation ready)</li>
  <li>Content Width Definition</li>
  <li>Dynamic Sidebar(s)</li>
  <li>Custom "more" Link</li>
  <li>Basic Pagination</li>
  <li>Register and Enque Scripts &amp; Styles</li>
</ol>
<ul>
  <li>
    Extras:
    <ul>
      <li>Redirect After Theme Activation</li>
      <li>Hide Admin bar (during development)</li>
    </ul>
  </li>
</ul>


<h2>Custom Menu Support</h2>
<p>At the very least, a standard theme will need a main navigation menu, perhaps in the header and a secondary navigation menu in the footer. To do this, we will register those two menus "<strong>Main Menu</strong>" and "<strong>Secondary Menu</strong>"</p>

<pre><code>if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  'main_menu' =&gt; __( 'Main Menu', 'cake' ),
		  'secondary_menu' =&gt; __( ''Secondary Menu', 'cake' ),
		)
	);
}</code></pre>


<h2>Visual Editor Style</h2>
<p>This function allows you to use custom CSS to style the WordPress TinyMCE visual editor.</p>

<pre><code>add_editor_style();</code></pre>


<h2>Default Custom Avatar</h2>

<pre><code>if ( !function_exists('keyfunctions_addgravatar') ) {
	function keyfunctions_addgravatar( $avatar_defaults ) {
		$myavatar = get_template_directory_uri() . '/images/avatar.png';
		$avatar_defaults[$myavatar] = 'avatar';
		return $avatar_defaults;
	}
	add_filter( 'avatar_defaults', 'keyfunctions_addgravatar' );
}</code></pre>


<h2>Post Formats</h2>

<pre><code>add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );</code></pre>

<h2>Featured Image</h2>
<pre><code>add_theme_support( 'post-thumbnails' );</code></pre>

<pre><code>// regular size
add_image_size( 'regular', 400, 350, true );

// medium size
add_image_size( 'medium', 650, 500, true );
	
// large thumbnails
add_image_size( 'large', 960, '' );</code></pre>


<h2>Attachment Display Settings</h2>
<pre><code>// show our custom image sizes when inserting media
function keyfunctions_show_image_sizes($sizes) {
    $sizes['regular'] = __( 'Our Regular Size', 'cake' );
    $sizes['medium'] = __( 'Our Medium Size', 'cake' );
    $sizes['large'] = __( 'Our Large Size', 'cake' );
    return $sizes;
}
add_filter('image_size_names_choose', 'keyfunctions_show_image_sizes');</code></pre>


<h2>Feed Links (RSS)</h2>
<p>With this function you take the first step towards making your theme available for translation.</p>
<pre><code>// Adds RSS feed links to <head> for posts and comments.
add_theme_support( 'automatic-feed-links' );</code></pre>

<h2>Load Text Domain (translation ready)</h2>
<pre><code>add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup(){
    load_theme_textdomain('my_theme', get_template_directory() . '/languages');
}</code></pre>


<h2>Content Width Definition</h2>
<pre><code>if ( ! isset( $content_width ) )
	$content_width = 600;</code></pre>


<p>WordPress also recommends addition of the following CSS rules:</p>

<pre><code>.size-auto, 
.size-full,
.size-large,
.size-medium,
.size-thumbnail {
	max-width: 100%;
	height: auto;
}</code></pre>



<h2>Dynamic Sidebar(s)</h2>
<pre><code>if(function_exists('register_sidebar')){
	register_sidebar(array(
		'name' =&gt; 'Main Sidebar',
		'before_widget' =&gt; '&lt;aside id="%1$s" class="widget %2$s"&gt;',
		'after_widget' =&gt; '&lt;/aside&gt;',
		'before_title' =&gt; '&lt;h3&gt;',
		'after_title' =&gt; '&lt;/h3&gt;',
	));
}</code></pre>



<h2>Custom "more" Link</h2>
<pre><code>function new_excerpt_more($more) {
       global $post;
	return '...&lt;br /&gt;&lt;br /&gt;&lt;a href="'. get_permalink($post->ID) . '" class="read_more"&gt;read more &rarr;&lt;/a&gt;';
}
add_filter('excerpt_more', 'new_excerpt_more');</code></pre>


<h2>Basic Pagination</h2>
<pre><code>function keyfunctions_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query-&gt;max_num_pages &gt; 1 ) : ?&gt;
		&lt;nav id="&lt;?php echo $nav_id; ?&gt;" class="content_nav clearfix"&gt;
			&lt;ul&gt;
				&lt;li class="nextPost"&gt;&lt;?php previous_posts_link( __( '&larr; newer ', 'cake' ) ); ?&gt;&lt;/li&gt;
				&lt;li class="prevPost"&gt;&lt;?php next_posts_link( __( 'older &rarr;', 'cake' ) ); ?&gt;&lt;/li&gt;
			&lt;/ul&gt;					
		&lt;/nav&gt;
	&lt;?php endif;
}?&gt;</code></pre>


<h2>Register and Enque Scripts &amp; Styles</h2>
<pre><code>function keyfunctions_scripts_and_styles() {
    if (!is_admin()) {

		// register and enque modernizr script (in head)
		// no depency specified
		wp_register_script('modernizr',
			get_template_directory_uri() . '/javascripts/vendor/modernizr-2.6.2-respond-1.1.0.min.js', '2.6.2', false);
		wp_enqueue_script('modernizr');
		
		// register and enque jQuery
		wp_deregister_script('jquery');
			wp_register_script('jquery', get_template_directory_uri() . '/javascripts/vendor/jquery-1.9.1.min.js', false, '1.9.1', true);
		wp_enqueue_script('jquery');
		
		// register and enque the plugins.js file 
		// it depends on jQuery and is loaded in the footer
		wp_register_script('plugins',
			get_template_directory_uri() . '/javascripts/plugins.js', '1.0', true, array('jquery') );
		wp_enqueue_script('plugins');
		
		// register and enque main.js site-wide javascript behaviors file
		// it depends on jQuery and is loaded in the footer
		wp_register_script('script',
			get_template_directory_uri() . '/javascripts/main.js', '1.0', true, array('jquery') );
		wp_enqueue_script('script');
		
    }
    
	// Loads our main stylesheet.
	wp_enqueue_style( 'keyfunctions-style', get_stylesheet_uri() );

	// Adds JavaScript to pages with the comment form to support
	// sites with threaded comments (when in use).
	if ( is_singular() &amp;&amp; comments_open() &amp;&amp; get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
    
} 
add_action('wp_enqueue_scripts', 'keyfunctions_scripts_and_styles');
</code></pre>

