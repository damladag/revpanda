<?php

declare( strict_types=1 );

namespace RVP\Admin;

class MetaBox {
	public function __construct() {
		add_action( 'init', [
			$this,
			'registerMetaFields',
		] );

		add_action( 'add_meta_boxes', [
			$this,
			'addMetaBoxes',
		] );

		add_action( 'save_post_listing', [
			$this,
			'saveMetaBoxData',
		], 10, 2 );
	}

	/**
	 * Register meta fields for the 'listing' post type.
	 */
	public function registerMetaFields(): void {
		$meta_fields = [
			'rvp_rating' => [
				'type' => 'number',
				'sanitize_callback' => 'sanitize_text_field',
			],
			'rvp_ref_link' => [
				'type' => 'string',
				'sanitize_callback' => 'sanitize_text_field',
			],
			'rvp_bonus_text' => [
				'type' => 'string',
				'sanitize_callback' => 'sanitize_text_field',
			],
			'rvp_free_spins' => [
				'type' => 'string',
				'sanitize_callback' => 'sanitize_text_field',
			],
		];

		foreach ( $meta_fields as $meta_key => $meta_args ) {
			register_post_meta( 'listing', $meta_key, array_merge( [
				'show_in_rest' => true,
				'single' => true,
				'auth_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			], $meta_args ) );
		}
	}

	/**
	 * Responsible to add meta boxes to the 'listing' post edit screen.
	 */
	public function addMetaBoxes(): void {
		add_meta_box( 
			'rvp_listing_details', __( 'Listing Details', 'revpanda' ), 
			[ $this, 'renderMetaBox'], 
			'listing', 
			'normal', 
			'high' 
		);
	}

	/**
	 * Responsible to render HTML codes in the editor for custom fields. 
	 * We are also showing the existing values in the input fields.
	 * All the strings are translatable. 
	 */
	public function renderMetaBox( \WP_Post $post ): void {
		// Add nonce for security
		wp_nonce_field( 'rvp_save_listing_meta', 'rvp_listing_meta_nonce' );

		// Retrieve existing values
		$rating = get_post_meta( $post->ID, 'rvp_rating', true );
		$referralLink = get_post_meta( $post->ID, 'rvp_ref_link', true );
		$bonusText = get_post_meta( $post->ID, 'rvp_bonus_text', true );
		$freeSpinsText = get_post_meta( $post->ID, 'rvp_free_spins', true );

		?>
		<p>
			<label for="rvp_rating"><?php _e( 'Rating', 'revpanda' ); ?></label><br>
			<input type="number" step="0.01" name="rvp_rating" id="rvp_rating" placeholder="3.5" value="<?php echo esc_attr( $rating ); ?>" class="regular-text">
		</p>
		<p>
			<label for="rvp_ref_link"><?php _e( 'Affiliate Link', 'revpanda' ); ?></label><br>
			<input type="text" name="rvp_ref_link" id="rvp_ref_link" placeholder="https://example.com" value="<?php echo esc_attr( $referralLink ); ?>" class="regular-text">
		</p>
		<p>
			<label for="rvp_bonus_text"><?php _e( 'Bonus (€)', 'revpanda' ); ?></label><br>
			<input type="text" name="rvp_bonus_text" id="rvp_bonus_text" placeholder="<?php echo __('500', 'revpanda') ?>" value="<?php echo esc_attr( $bonusText ); ?>" class="regular-text">
		</p>
		<p>
			<label for="rvp_free_spins"><?php _e( 'Free Spins', 'revpanda' ); ?></label><br>
			<input type="text" name="rvp_free_spins" id="rvp_free_spins" placeholder="<?php echo __('100', 'revpanda') ?>" value="<?php echo esc_attr( $freeSpinsText ); ?>" class="regular-text">
		</p>
		<?php
	}

	/**
	 * Responsible to update meta in the database. 
	 * We are using some usual checks like does user have capability, is nonce set correctly for security. 
	 * We are also sanitizing the data before saving it to the database.
	 *
	 * @param int $post_id Post ID.
	 * @param \WP_Post|null $post Post object.
	 */
	public function saveMetaBoxData( int $post_id, \WP_Post $post = null ): void {
		// Check if this is an autosave or a revision.
		if ( wp_is_post_autosave( $post_id ) || wp_is_post_revision( $post_id ) ) {
			return;
		}

		// Check user permissions.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// Check and verify nonce is set.
		if ( ( ! isset( $_POST['rvp_listing_meta_nonce'] ) ) || ( ! wp_verify_nonce( $_POST['rvp_listing_meta_nonce'], 'rvp_save_listing_meta' ) ) ) {
			return;
		}

		// Sanitize and save fields.
		if ( isset( $_POST['rvp_rating'] ) ) {
			$rating = floatval( sanitize_text_field($_POST['rvp_rating']) );
			update_post_meta( $post_id, 'rvp_rating', $rating );
		}

		if ( isset( $_POST['rvp_ref_link'] ) ) {
			$ref_link = sanitize_text_field( $_POST['rvp_ref_link'] );
			update_post_meta( $post_id, 'rvp_ref_link', $ref_link );
		}

		if ( isset( $_POST['rvp_bonus_text'] ) ) {
			$bonus_text = sanitize_text_field( $_POST['rvp_bonus_text'] );
			update_post_meta( $post_id, 'rvp_bonus_text', $bonus_text );
		}

		if ( isset( $_POST['rvp_free_spins'] ) ) {
			$free_spins = sanitize_text_field( $_POST['rvp_free_spins'] );
			update_post_meta( $post_id, 'rvp_free_spins', $free_spins );
		}
	}
}
