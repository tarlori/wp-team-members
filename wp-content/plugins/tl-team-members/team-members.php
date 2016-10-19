<?php
/*
Plugin Name: TL Team Members
Description: Plugin that allows to add team members as custom post types.
Author: Lorand Tar
Version: 1.0
Author URI: http://tarlorand.com/
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'tl_team_member' ) ) {

	class tl_team_member {

		/**
		 * Constructor.
		 */
		function __construct() {

			// Do exactly nothing here

		}

		/**
		 * Initialize the class.
		 *
		 * The real constructor to initialize Team Members.
		 *
		 * @return void
		 */
		function initialize() {

			// Variables
			$this->settings = array(

				// Basic
				'name' => __( 'Team Members', 'tl_team_member' ),
				'version' => '1.0',

				// URLs
				'basename' => plugin_basename( __FILE__ ),
				'path' => plugin_dir_path( __FILE__ ),
				'dir' => plugin_dir_url( __FILE__ ),

			);

			// Admin panel
			if( is_admin() ) {

				include( $this->settings['path'] . 'includes/admin.php' );

			} else {
				include( $this->settings['path'] . 'includes/front.php' );
			}

			// Actions
			add_action( 'init',	array( $this, 'register_post_types' ), 5 );

			// Image sizes
			add_image_size( 'tl_team_member_media', 318, 180, false );

		}

		/**
		 * Register post types.
		 *
		 * @return void
		 */
		function register_post_types() {

			// Team member post
			register_post_type( 'tl_team_member_post', array(
			  'labels' => array(
								'name' => __( 'Team Members', 'tl_team_member' ),
								'singular_name' => __( 'Team Member', 'tl_team_member' ),
								'add_new' => __( 'Add New' , 'tl_team_member' ),
								'add_new_item' => __( 'Add New Post' , 'tl_team_member' ),
								'edit_item' => __( 'Edit Post' , 'tl_team_member' ),
								'new_item' => __( 'New Post' , 'tl_team_member' ),
								'view_item' => __( 'View Post', 'tl_team_member' ),
								'search_items' => __( 'Search Posts', 'tl_team_member' ),
								'not_found' => __( 'No Posts found', 'tl_team_member' ),
								'not_found_in_trash' => __( 'No Posts found in Trash', 'tl_team_member' ),
							),
			  'public' => true,
			  'menu_position' => 20,
			  'supports' => array(
								'title',
								'editor',
								'thumbnail',
							),
			  'menu_icon' => 'dashicons-admin-users',
			));

			// ACF plugin fields
			register_field_group(array (
				'key' => 'group_57712d81b6f0e',
				'title' => __( 'Team Member Fields', 'tl_team_member' ),
				'fields' => array (
					array (
						'key' => 'tl_field_1',
						'label' => __( 'Position', 'tl_team_member' ),
						'name' => 'tl_team_member_position',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
						'readonly' => 0,
						'disabled' => 0,
					),
					array (
						'key' => 'tl_field_2',
						'label' => __( 'Facebook URL', 'tl_team_member' ),
						'name' => 'tl_team_member_facebook',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
						'readonly' => 0,
						'disabled' => 0,
					),
					array (
						'key' => 'tl_field_3',
						'label' => __( 'Twitter URL', 'tl_team_member' ),
						'name' => 'tl_team_member_twitter',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
						'readonly' => 0,
						'disabled' => 0,
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'tl_team_member_post',
						),
					),
				),
				'options' => array (
					//
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'active' => 1,
				'description' => '',
			));

		}

	}

	/**
	 * Return the one true acf Instance to functions everywhere.
	 *
	 * @return object
	 */
	function tl_team_member() {

		global $tl_team_member;

		if( ! isset( $tl_team_member ) ) {

			$tl_team_member = new tl_team_member();

			$tl_team_member->initialize();

		}

		return $tl_team_member;

	}

	// Initialize
	tl_team_member();

}