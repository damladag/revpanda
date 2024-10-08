<header class="rvp-header">
    <div class="rvp-container">
        <div class="rvp-site-logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <?php
                if (function_exists('the_custom_logo') && has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo '<img src="' . esc_url(rvpGetIconUrl('logo.svg')) . '" alt="Site Logo">';
                }
                ?>
            </a>
        </div>
        <div class="rvp-hamburger">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <nav class="rvp-header-nav">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'header_menu',
                'container' => false,
                'menu_class' => 'nav-menu'
            ));
            ?>
        </nav>
        <div class="rvp-header-search">
            <a href="#" class="search-toggle">
                <?php
                if (function_exists('rvpGetIcon')) {
                    rvpGetIcon('search.svg');
                }
                ?>
            </a>
            <div class="search-form hidden">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</header>
