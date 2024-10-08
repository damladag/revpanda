<?php
/**
 * The template for displaying category page
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
while ( have_posts() ) {
	the_post();
	the_content();
}
get_footer();
