<?php
/**
 * The template for displaying 404 page
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

global $rvpContainer;
$urlHelper = $rvpContainer->get('UrlHelper');

?>
<div class="rvp-404-page">
	<h1 class="rvp-h1">
		<?php echo __( '404 Not Found', 'revpanda' ); ?>
	</h1>
	<div>
		<a href="<?php echo get_home_url() ?>" class="rvp-h6">
			<?php echo __( 'Go to Homepage', 'revpanda' ); ?>
		</a>
	</div>
</div>

<?php get_footer() ?>
