<?php
$query = new \WP_Query([
    'post_type' => 'listing',
    'posts_per_page' => 4,
]);

if ($query->have_posts()) :
    ?>
    <div class="rvp-listing">
        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <?php
            get_template_part('template-parts/loop-templates/listing-item');
            ?>
        <?php endwhile; ?>
    </div>

    <?php wp_reset_postdata(); ?>
<?php else : ?>
    <p> <?php echo __( 'No listings available at the moment.', 'revpanda' ); ?></p>
<?php endif; ?>
