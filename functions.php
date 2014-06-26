<?php

/**
 * Nicholson functions and definitions
 *
 * @package Nicholson
 * @since Nicholson 1.0
 *
 */

/** Set up theme options */
require_once( get_template_directory() . '/lib/admin/settings.php' );
require_once( get_template_directory() . '/lib/inc/portfolio-functions.php' );

/** Set the content width based on the theme's design and stylesheet. */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

/** Set theme defaults */
if ( ! function_exists( 'nicholson_setup' ) ) :
function nicholson_setup() {

	/* Custom template tags for this theme */
	require( get_template_directory() . '/lib/inc/template-tags.php' );

	/* Custom functions that act independently of the theme templates */
	require( get_template_directory() . '/lib/inc/extras.php' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	/* Make theme available for translation */
	load_theme_textdomain( 'nicholson', get_template_directory() . '/lib/languages' );

	/* Add default posts and comments RSS feed links to head */
	add_theme_support( 'automatic-feed-links' );

	/* Enable support for Post Thumbnails */
	add_theme_support( 'post-thumbnails' );

	/* Add our thumbnail sizes */
	add_image_size( 'blog-featured', 1200, 350, true );

	/* This theme uses wp_nav_menu() in one location */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'nicholson' ),
	) );

	/* Enable support for Post Formats */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'quote', 'link' ) );

	/* Setup the WordPress core custom background feature */
	add_theme_support( 'custom-background', apply_filters( 'lucid_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => get_template_directory_uri() . '/images/background.png',
	) ) );

	/* Setup the WordPress core custom header feature */
	add_theme_support( 'custom-header', apply_filters( 'lucid_custom_header_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'nicholson_setup' );

/** Register widgetized area and update sidebar with default widgets */
function nicholson_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'nicholson' ),
		'id' => 'sidebar-1',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => __( 'Portfolio Sidebar', 'nicholson' ),
		'id' => 'portfolio-1',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => 'Footer Widget 1',
		'id' => 'footer-widget-1',
		'before_widget' => '<section>',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => 'Footer Widget 2',
		'id' => 'footer-widget-2',
		'before_widget' => '<section>',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => 'Footer Widget 3',
		'id' => 'footer-widget-3',
		'before_widget' => '<section>',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'nicholson_widgets_init' );

/** Enqueue scripts and styles */
function nicholson_manage_scripts() {
	/** Enqueue our stylesheet */
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	/** Enqueue jQuery and jQuery UI */
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js' );

	/** Mobile navigation menu */
	wp_enqueue_script( 'dropdown', get_template_directory_uri() . '/lib/js/jquery.dropdown.js' );

	/** HTML5 Fallback */
	wp_enqueue_script( 'html5', get_template_directory_uri() . '/lib/js/html5.js' );

	if( is_page_template('portfolio.php') ) {
		wp_enqueue_script( 'isotope', get_template_directory_uri() . '/lib/js/jquery.isotope.min.js' );
		wp_enqueue_script( 'mosaic', get_template_directory_uri() . '/lib/js/jquery.mosaic.min.js' );
		wp_enqueue_script( 'portfolio', get_template_directory_uri() . '/lib/js/portfolio.js' );
	}

	/** Enqueue main JS file */
	wp_enqueue_script( 'nicholson_main', get_template_directory_uri() . '/lib/js/main.js' );
}
add_action( 'wp_enqueue_scripts', 'nicholson_manage_scripts' );

/** Add custom body class to portfolio */
add_filter( 'body_class', 'add_portfolio_class' );
function add_portfolio_class( $classes ) {
	if(is_page_template('portfolio-single.php')) 
		$classes[] = 'portfolio';
   		return $classes;
}

/** Extract first occurance of text from a string */
if( !function_exists ('extract_from_string') ) :
function extract_from_string($start, $end, $tring) {
	$tring = stristr($tring, $start);
	$trimmed = stristr($tring, $end);
	return substr($tring, strlen($start), -strlen($trimmed));
}
endif;

/** Register pagination */
function nicholson_pagination($pages = '', $range = 2) {  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination clearfix'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "<div class='clear'></div></div>\n";
     }
}

/** Nicholson Datetime */
function nicholson_date_time() { ?>
	<span class="post-month"><?php the_time('M'); ?></span><br/>
	<span class="post-date"><?php the_time('j'); ?></span><br/>
	<span class="post-year"><?php the_time('Y'); ?></span>
<?php }
