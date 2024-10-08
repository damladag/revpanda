<?php

declare(strict_types=1);

namespace RVP\Admin;

class PostType
{
	public function __construct()
	{
		add_action('init', [$this, 'register']);
	}

	public function register(): void
	{
		register_post_type('listing', $this->getArgs($this->getLabels()));
	}
	
	public function getLabels() {
		return [
			'name'                  => __('Listings', 'revpanda'),
			'singular_name'         => __('Listing', 'revpanda'),
			'menu_name'             => __('Listings', 'revpanda'),
			'name_admin_bar'        => __('Listing', 'revpanda'),
			'add_new'               => __('Add New', 'revpanda'),
			'add_new_item'          => __('Add New Listing', 'revpanda'),
			'new_item'              => __('New Listing', 'revpanda'),
			'edit_item'             => __('Edit Listing', 'revpanda'),
			'view_item'             => __('View Listing', 'revpanda'),
			'all_items'             => __('All Listings', 'revpanda'),
			'search_items'          => __('Search Listings', 'revpanda'),
			'parent_item_colon'     => __('Parent Listings:', 'revpanda'),
			'not_found'             => __('No listings found.', 'revpanda'),
			'not_found_in_trash'    => __('No listings found in Trash.', 'revpanda'),
			'featured_image'        => __('Featured Image', 'revpanda'),
			'set_featured_image'    => __('Set featured image', 'revpanda'),
			'remove_featured_image' => __('Remove featured image', 'revpanda'),
			'use_featured_image'    => __('Use as featured image', 'revpanda'),
			'archives'              => __('Listing archives', 'revpanda'),
			'insert_into_item'      => __('Insert into listing', 'revpanda'),
			'uploaded_to_this_item' => __('Uploaded to this listing', 'revpanda'),
			'filter_items_list'     => __('Filter listings list', 'revpanda'),
			'items_list_navigation' => __('Listings list navigation', 'revpanda'),
			'items_list'            => __('Listings list', 'revpanda'),
		];
	}

	public function getArgs( $labels ) {
		return [
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => [ 'slug' => 'listing' ],
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => [
				'title',
				'editor',
				'thumbnail',
				'excerpt',
				'comments',
			],
			'show_in_rest' => false,
			'menu_icon' => 'dashicons-admin-post',
		];
	}
}
