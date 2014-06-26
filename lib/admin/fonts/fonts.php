<?php

/**
 * Import our font options
 */
require_once( get_template_directory() . '/lib/admin/fonts/header-fonts.php' );
require_once( get_template_directory() . '/lib/admin/fonts/body-fonts.php' );

/**
 * Add our header fonts to the theme.
 */
function lucid_header_font_styles() {
    $options = lucid_get_theme_options();
    $fonts = lucid_header_font_options();
    $current_font_key = 'arial';

    if ( isset( $options['header_font_options'] ) )
        $current_font_key = $options['header_font_options'];

    if ( isset( $fonts[ $current_font_key ] ) ) {
        $current_font = $fonts[ $current_font_key ]; ?>

        <style>
        	<?php echo $current_font['import']; ?>

        	h1,h2,h3,h4,h5,h6,
        	.logo,
        	.post-month,
        	.post-date,
        	.post-year,
        	.comments-link { 
        		<?php echo $current_font['css'] ?> 
        	}
        </style>

        <?php
    }
}
add_action( 'wp_head', 'lucid_header_font_styles' );

/**
 * Add our header fonts to the theme.
 */
function lucid_body_font_styles() {
    $options = lucid_get_theme_options();
    $fonts = lucid_body_font_options();
    $current_font_key = 'arial';

    if ( isset( $options['body_font_options'] ) )
        $current_font_key = $options['body_font_options'];

    if ( isset( $fonts[ $current_font_key ] ) ) {
        $current_font = $fonts[ $current_font_key ]; ?>

        <style>
        	<?php echo $current_font['import']; ?>

        	body,
        	input,
			textarea { 
        		<?php echo $current_font['css'] ?> 
        	}
        </style>

        <?php
    }
}
add_action( 'wp_head', 'lucid_body_font_styles' );