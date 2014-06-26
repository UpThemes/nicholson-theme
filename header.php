<?php
/**
 * The Header
 *
 * @package Nicholson
 * @since Nicholson 1.0.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />

	<title><?php bloginfo('name'); ?> | <?php bloginfo('description'); ?></title>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/lib/js/html5.js" type="text/javascript"></script>
	<![endif]-->

	<script>document.createElement('main');</script>

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); wp_head(); lucid_add_header_scripts(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page">
	<?php do_action( 'before' ); ?>
	<header id="header" class="site-header" role="banner">
		<div class="container">
			<div class="row">

			<!-- Start logo -->
			<section class="logo col-lg-3 col-md-3 col-sm-3">
				<a href="<?php echo home_url(); ?>">
					<?php if (get_header_image() != '') {?>
						<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
					<?php } else {
						bloginfo('name'); 
					} ?>
				</a>
			</section>
			<!-- End logo -->

			<!-- Start nav menu -->
			<nav class="site-menu col-lg-6 col-md-6 col-sm-9" role="navigation">
				<h1 class="assistive-text"><?php _e( 'Menu', 'nicholson' ); ?></h1>
				<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'nicholson' ); ?>"><?php _e( 'Skip to content', 'nicholson' ); ?></a></div>

				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav>
			<!-- End nav menu -->

			<!-- Start mobile nav menu -->
			<nav class="mobile-dropdown">
				<a href="#" data-dropdown="#dropdown-1" class="mobile-nav"><span class="mobile-tab icon">&#9776;</span></a>
			</nav>

			<section id="dropdown-1" class="dropdown-menu">
				<form action="<?php echo home_url(); ?>" name="SearchForm" method="get">
					<fieldset>
						<input type="text" name="s" maxlength="64" id="SearchForm" placeholder="Search" />
					</fieldset>
				</form>
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</section>
			<!-- End mobile nav menu -->

			<!-- Start search bar -->
			<section class="search-box col-lg-3 col-md-3">
				<form action="<?php echo home_url(); ?>" name="SearchForm" method="get">
					<input type="text" name="s" maxlength="64" id="SearchForm" placeholder="Search" />
				</form>
				
				<div class="search-button" onclick="SearchForm.submit()"><span class="icon">&#128269;</span></div>
			</section>
			<!-- End search bar -->

			</div><!-- .row -->
		</div><!-- .container -->
	</header><!-- .site-header -->

	<main id="main" class="site-main" role="main">
		<div class="container">
			<div class="row">