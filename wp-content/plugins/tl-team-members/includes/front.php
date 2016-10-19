<?php

class tl_team_member_front {

	/**
	 * Constructor.
	 */
	function __construct() {

		// Actions
		add_action( 'wp_enqueue_scripts', array( $this, 'tl_team_member_scripts' ) );


	}

	/**
	 * Enqueue scripts and styles
	 */
	function tl_team_member_scripts() {
		wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Asap:400,700,400italic' );
		wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array() );
		wp_register_style( 'tl_team_member_styles',  plugin_dir_url( __FILE__ ) . '../' . 'styles.css' );
    	wp_enqueue_style( 'tl_team_member_styles' );

    	wp_deregister_script('jquery');
		wp_register_script('jquery', "//code.jquery.com/jquery-2.2.4.min.js", false, null, true);
		wp_enqueue_script('jquery');

		wp_enqueue_script( 'tl_team_member_sripts', plugin_dir_url( __FILE__ ) . '../' . 'scripts.js', array('jquery'), '20161019', false );
	}

}

// Initialize
new tl_team_member_front();