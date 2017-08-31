<?php
/**
 * Customizer panels.
 *
 * @package ThoriumDesign
 */

/**
 * Add a custom panels to attach sections too.
 */
function thd_customize_panels( $wp_customize ) {

	// Register a new panel.
	$wp_customize->add_panel( 'site-options', array(
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__( 'Site Options', 'thorium-design' ),
		'description'    => esc_html__( 'Other theme options.', 'thorium-design' ),
	) );
}
add_action( 'customize_register', 'thd_customize_panels' );
