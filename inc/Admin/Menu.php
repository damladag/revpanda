<?php

declare(strict_types=1);

namespace RVP\Admin;

class Menu {
    public function __construct()
    {
        add_action('after_setup_theme', [$this, 'registerNavMenu']);
    }

    public function registerNavMenu()
    {
        register_nav_menus([
            'header_menu' => __('Header Menu', 'revpanda'),
        ]);
    }
}