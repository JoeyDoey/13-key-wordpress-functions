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

<form class="search_form" action="<?php echo home_url( '/' ); ?>" method="get">
    <input class="input" type="text" id="search_field" value="<?php the_search_query(); ?>" name="s" />
    <input class="submit" type="submit" value="<?php _e('Search','keyfunctions'); ?>" />
</form>