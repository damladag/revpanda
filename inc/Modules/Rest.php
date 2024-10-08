<?php

namespace RVP\Modules;

class Rest
{
    /**
     * Constructor: Register REST routes
     */
    public function __construct()
    {
        add_action('rest_api_init', [$this, 'register_routes']);
    }

    /**
     * Register all REST API routes
     *
     * @return void
     */
    public function register_routes(): void
    {
        $namespace = 'iu/v1';

        // Route for retrieving listing
        register_rest_route($namespace, '/get_listings', [
            'methods' => 'GET',
            'callback' => [$this, 'getListing'],
            'permission_callback' => '__return_true',
        ]);

    }

    /**
     * Callback function for retrieving listing posts
     * @param \WP_REST_Request $request
     * @return \WP_Error|\WP_HTTP_Response|\WP_REST_Response
     */
    public function getListing(\WP_REST_Request $request)
    {
        $order = $request->get_param('order');
        $page = $request->get_param('page') ? (int)$request->get_param('page') : 1;
        $posts_per_page = 4;

        $args = [
            'post_type' => 'listing',
            'posts_per_page' => $posts_per_page,
            'paged' => $page,
        ];

        switch ($order) {
            case 'top_rated':
                $args['meta_key'] = 'rvp_rating';
                $args['orderby'] = 'meta_value_num';
                $args['order'] = 'DESC';
                break;
            case 'recently_added':
                $args['orderby'] = 'date';
                $args['order'] = 'DESC';
                break;
            case 'best_free_spins':
                $args['meta_key'] = 'rvp_free_spins';
                $args['orderby'] = 'meta_value_num';
                $args['order'] = 'DESC';
                break;
            case 'best_bonus':
                $args['meta_key'] = 'rvp_bonus_text';
                $args['orderby'] = 'meta_value_num';
                $args['order'] = 'DESC';
                break;
        }

        $query = new \WP_Query($args);
        ob_start();

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                get_template_part('template-parts/loop-templates/listing-item');
            endwhile;
        else :
            echo '<p>'.__( 'No listings available at the moment.', 'revpanda' ).'</p>';
        endif;

        wp_reset_postdata();
        $html = ob_get_clean();

        $total_pages = $query->max_num_pages;

        return new \WP_REST_Response(['html' => $html, 'total_pages' => $total_pages], 200);
    }
}
