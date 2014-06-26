<?php

function lucid_enqueue_color_picker( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'color-picker', get_template_directory_uri() . '/lib/admin/colors/colors.js', array( 'wp-color-picker' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'lucid_enqueue_color_picker' );


function lucid_primary_color_styles() {
    $options = lucid_get_theme_options();
    $default_color_key = '#77cc6d';

    if ( isset( $options['lucid_primary_color'] ) )
        $default_color_key = $options['lucid_primary_color']; ?>
		
		<style>
        	a,
        	a:visited,
        	.mosaic-block a:hover,
			.mosaic-block a:visited { 
        		color: <?php echo $options['lucid_primary_color']; ?>;
        	}

        	.post-timestamp,
        	.search-button:hover,
        	.pagination a:hover,
        	.pagination .current,
        	ul#filters li a:hover,
        	.site-menu ul li a:hover,
        	.site-menu ul ul,
        	.site-menu ul li.hovered a,
        	.post.format-quote,
        	.fade .mosaic-overlay,
        	.format-link,
        	::selection,
        	.mobile-nav:hover,
        	.portfolio-link {
        		background-color: <?php echo $options['lucid_primary_color']; ?>;
        	}

        	#comment:focus,
        	input[type=text]:focus,
			input[type=password]:focus,
			input[type=email]:focus,
			textarea:focus {
        		border-color: <?php echo $options['lucid_primary_color']; ?>;
        	}

        	.fade .mosaic-overlay {
        		background: rgba(<?php $rgb = hex2rgb( $options['lucid_primary_color'] ); $mosaic_color= implode(",", $rgb); echo $mosaic_color; ?>, 0.9);
        	}
        </style>

    <?php 
}
add_action( 'wp_head', 'lucid_primary_color_styles' );

function lucid_secondary_color_styles() {
    $options = lucid_get_theme_options();
    $default_color_key = '#77cc6d';

    if ( isset( $options['lucid_secondary_color'] ) )
        $default_color_key = $options['lucid_secondary_color']; ?>
		
		<style>
        	a:hover { 
        		color: <?php echo $options['lucid_secondary_color']; ?>;
        	}

        	.site-menu ul ul a:hover,
        	.site-menu ul ul li.current_page_item:hover a,
        	.portfolio-link:hover {
        		background-color: <?php echo $options['lucid_secondary_color']; ?>;
        	}

        	.post.format-quote {
        		border-color: <?php echo $options['lucid_secondary_color']; ?>;
        	}

        	.format-link {
        		border-left: 10px solid <?php echo $options['lucid_secondary_color']; ?>;
        	}
        </style>

    <?php 
}
add_action( 'wp_head', 'lucid_secondary_color_styles' );

function hex2rgb( $colour ) {
        if ( $colour[0] == '#' ) {
                $colour = substr( $colour, 1 );
        }
        if ( strlen( $colour ) == 6 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
        } elseif ( strlen( $colour ) == 3 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
        } else {
                return false;
        }
        $r = hexdec( $r );
        $g = hexdec( $g );
        $b = hexdec( $b );
        return array( $r, $g, $b );
}