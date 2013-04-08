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
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width">
	
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<?php 
	// this action hook loads our scripts and styles
	// on singular posts with comments, it loads the
	// comment-reply js as needed
	wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<header class="header">
	<div class="inner clearfix">

		<hgroup>
			<h1>
				<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> " rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
			</h1>
			
			<h2><?php bloginfo( 'description' ); ?></h2>
		</hgroup>
		
			
		<nav>
			<?php 
			// if defined, insert the "main_menu" here
			if ( has_nav_menu( 'main_menu' ) ) { ?>
				<?php $defaults = array(
				  'theme_location'  => 'main_menu',
				  'menu'            => '', 
				  'container'       => false, 
				  'echo'            => true,
				  'fallback_cb'     => false,
				  'items_wrap'      => '<ul id="%1$s"> %3$s</ul>',
				  'depth'           => 0 );
				  wp_nav_menu( $defaults );
				?>
			<?php } 
			// if NOT defined, just list pages here				
			else { ?>
				<ul>
					<?php wp_list_pages('title_li='); ?>
				</ul>
			<?php } ?>			
		</nav>		

		
	</div>
</header>


<!-- start: body_content -->
<section class="body_content clearfix">
