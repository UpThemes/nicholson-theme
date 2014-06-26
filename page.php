<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Nicholson
 * @since Nicholson 1.0
 */

get_header();

/* Output column size based on layout option */
$options = lucid_get_theme_options();
$current_layout = $options['lucid_theme_layouts'];

if ( 'content' != $current_layout ) { ?>

	<section class="site-content col-lg-9 col-md-9 col-sm-12">

<?php } else { ?>

	<section class="site-content col-lg-12 col-md-12">

<?php } ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template( '', true );
			?>

		<?php endwhile; // end of the loop. ?>

	</section><!-- .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>