<?php
$rating = get_post_meta(get_the_ID(), 'rvp_rating', true);
$referralLink = get_post_meta(get_the_ID(), 'rvp_ref_link', true);
$bonusText = get_post_meta(get_the_ID(), 'rvp_bonus_text', true);
$freeSpinsText = get_post_meta(get_the_ID(), 'rvp_free_spins', true);
?>

<div class="rvp-listing-item">
    <div class="rvp-listing-info">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('thumbnail'); ?>
        <?php endif; ?>
        <h4 class="rvp-listing-title"><?php the_title(); ?></h4>
    </div>
    <div class="rvp-listing-details">
        <?php if (!empty($bonusText)) : ?>
            <div class="rvp-listing-bonus rvp-text">
                <div><?php echo __('100% Up to', 'revpanda'); ?>
                    <span class="rvp-h2"> €<?php echo esc_html($bonusText); ?> </span> <?php echo __('Bonus', 'revpanda'); ?> </div>
            </div>
        <?php endif; ?>
        <?php if (!empty($freeSpinsText)) : ?>
            <div class="rvp-listing-free-spins rvp-text">
                <p><span class="rvp-h2"><?php echo esc_html($freeSpinsText); ?></span><?php echo __(' Free Spins', 'revpanda'); ?></p>
            </div>
        <?php endif; ?>
    </div>
    <div class="rvp-listing-right">
        <?php if (!empty($rating)) : ?>
            <div class="rvp-listing-rating rvp-h4">
                <span><?php echo __('Star Rating', 'revpanda'); ?></span>
                <div class="rvp-listing-rating-stars">
                    <div class="rating-stars" style="position: relative;">
                        <div class="stars-empty">
                            <?php for ($i = 0; $i < 5; $i++) { echo '<span class="star">&#9734;</span>'; } ?>
                        </div>
                        <div class="stars-filled" style="width: <?php echo esc_attr(($rating / 5) * 100); ?>%;">
                            <?php for ($i = 0; $i < 5; $i++) { echo '<span class="star">&#9733;</span>'; } ?>
                        </div>
                    </div>
                    <span class="rating-value rvp-text-large"><?php echo esc_html($rating); ?></span>
                </div>
            </div>
        <?php endif; ?>
        <div class="rvp-listing-action">
            <?php if (!empty($referralLink)) : ?>
                <a href="<?php echo esc_url($referralLink); ?>" class="rvp-listing-button rvp-h3"><?php echo __('Claim Offer', 'revpanda'); ?></a>
            <?php endif; ?>
            <a href="<?php the_permalink(); ?>" class="rvp-listing-read-link rvp-text-small"><?php echo __('Read Review', 'revpanda' ); ?></a>
        </div>
    </div>
</div>

