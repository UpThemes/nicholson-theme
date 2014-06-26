<?php
/**
 * Nicholson Theme Customizer
 *
 * @package Nicholson
 * @since Nicholson 1.2
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @todo add support for primary and secondary colors
 *
 * @since Nicholson 1.0.2
 */
function nicholson_customize_register( $wp_customize ) {
	$options = lucid_get_theme_options();

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Remove default color options
	$wp_customize->remove_section( 'colors' );

	// Default Layout
	$wp_customize->add_section( 'lucid_layout', array(
		'title'    => __( 'Layout', 'nicholson' ),
		'priority' => 80,
	) );

	$wp_customize->add_setting( 'lucid_theme_options[lucid_theme_layouts]', array(
		'type'              => 'option',
		'default'           => $options['lucid_theme_layouts'],
		'sanitize_callback' => 'sanitize_key',
	) );

	$layouts = lucid_theme_layout_options();
	$choices = array();
	foreach ( $layouts as $layout ) {
		$choices[$layout['value']] = $layout['label'];
	}

	$wp_customize->add_control( 'lucid_theme_options[lucid_theme_layouts]', array(
		'section'    => 'lucid_layout',
		'type'       => 'radio',
		'choices'    => $choices,
	) );
}
add_action( 'customize_register', 'nicholson_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Nicholson 1.0.2
 */
function nicholson_customize_preview_js() {
	wp_enqueue_script( 'nicholson_customizer', get_template_directory_uri() . '/lib/admin/js/customizer.js', array( 'customize-preview' ), '20120827', true );
}
add_action( 'customize_preview_init', 'nicholson_customize_preview_js' );