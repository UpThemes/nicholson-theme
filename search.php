<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Nicholson
 * @since Nicholson 1.0
 */

get_header(); ?>

		<section id="primary" class="content-area">
			<div id="content" class="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h3 class="page-title"><?php printf( __( 'Search Results for: %s', 'nicholson' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header><!-- .page-header -->


				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'single' ); ?>

				<?php endwhile; ?>

				<?php nicholson_pagination(); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'search' ); ?>

			<?php endif; ?>

			<div class="clear"></div>

			</div><!-- #content .site-content -->
		</section><!-- #primary .content-area -->

<?php get_footer(); ?>