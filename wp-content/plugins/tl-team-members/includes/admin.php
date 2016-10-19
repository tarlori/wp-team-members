<?php

class tl_team_member_admin {

	/**
	 * Constructor.
	 */
	function __construct() {

		// Actions
		add_action( 'manage_tl_team_member_post_posts_custom_column', array( $this, 'tl_team_member_posts_custom_column' ), 10, 2 );

		// Filters
		add_filter( 'manage_tl_team_member_post_posts_columns', array( $this, 'tl_team_member_posts_columns' ) );

	}

	/**
	 * Manage posts columns.
	 *
	 * @param array $default
	 *
	 * @return array
	 */
	function tl_team_member_posts_columns( $default ) {

		unset( $default['date'] );
		unset( $default['title'] );
		$default['title'] = __( 'Name', 'tl_team_member' );
		$default['position'] = __( 'Position', 'tl_team_member' );
		$default['facebook'] = __( 'Facebook', 'tl_team_member' );
		$default['media'] = __( 'Photo', 'tl_team_member' );
		$default['date'] = __( 'Posted', 'tl_team_member' );

		return $default;

	}

	/**
	 * Manage custom columns.
	 *
	 * @param string $column_name
	 * @param int $post_id
	 *
	 * @return mixed
	 */
	function tl_team_member_posts_custom_column( $column_name, $post_id ) {

		switch( $column_name ) {

			case 'position':

				$position = get_field( 'tl_team_member_position', $post_id );

				echo $position;

			break;

			case 'facebook':

				echo '<a href="' . get_field( 'tl_team_member_facebook', $post_id ) . '" target="_blank">' . __( 'Facebook', 'tl_team_member' ) . '</a>';

			break;

			case 'media':

				if( has_post_thumbnail($post_id) ) {
					echo '<img src="' . wp_get_attachment_image_src(get_post_thumbnail_id($post_id))[0] . '" alt="media" width="100">';
				} else {
					echo __( 'No photo', 'tl_team_member' );
				}

			break;

		}

	}

}

// Initialize
new tl_team_member_admin();