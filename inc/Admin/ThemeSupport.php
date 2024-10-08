<?php

declare(strict_types=1);

namespace RVP\Admin;

class ThemeSupport
{
    public function __construct()
    {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('custom-logo', ['width' => 40, 'height' => 40]);
    }
}
