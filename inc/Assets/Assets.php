<?php

declare(strict_types=1);

namespace RVP\Assets;

class Assets
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueueAssets']);
        add_action('admin_init', [$this, 'enqueueEditorStyle']);
    }

    public function enqueueEditorStyle() {
        add_editor_style( get_stylesheet_directory_uri() . '/build/css/app.min.css' );
    }
    
    public function enqueueAssets()
    {
        wp_enqueue_style('rvp_theme', get_stylesheet_directory_uri() . '/build/css/app.min.css');
        wp_enqueue_script('rvp_theme', get_stylesheet_directory_uri() . '/build/js/app.min.js', ['jquery'], null, true);
    }
}
