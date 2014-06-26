<?php
/**
 * Template Name: Layout - Full-width Content
 *
 * @package Nicholson
 * @since Nicholson 1.0
 */

get_header(); ?>

	<section class="site-content col-lg-12 col-md-12 col-sm-12">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template( '', true );
			?>

		<?php endwhile; // end of the loop. ?>
	</section><!-- .site-content -->

<?php get_footer(); ?>