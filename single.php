<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
while (have_posts()) { ?>
    <h1>single post</h1>
<?php }
get_footer();