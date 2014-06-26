<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Nicholson
 * @since Nicholson 1.0
 */

get_header(); ?>

		<section class="site-content portfolio-content col-lg-9 col-md-9 col-sm-12">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'portfolio' ); ?>
					
				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				?>

			<?php endwhile; // end of the loop. ?>
		</section><!-- .site-content -->

		<section class="sidebar portfolio-sidebar col-lg-3 col-md-3 col-sm-12">
			<?php $lucid_portfolio_client = get_post_meta($post->ID, '_lt_client', true);
				if( $lucid_portfolio_client != '' ) { ?>
					<section class="client widget">
						<h2 class="widget-title">Client</h2>
						<?php echo $lucid_portfolio_client; ?>
					</section>
			<?php } ?>

			<?php $lucid_portfolio_completed = get_post_meta($post->ID, '_lt_completed', true);
				if( $lucid_portfolio_completed != '' ) { ?>
					<section class="completed widget">
						<h2 class="widget-title">Project Completed</h2>
						<?php echo $lucid_portfolio_completed; ?>
					</section>
			<?php } ?>

			<?php if( has_tag() ) { ?>
				<section class="portfolio-tags widget">
					<h2 class="widget-title">Tagged</h2>
					<?php echo get_the_tag_list('<p>',', ','</p>'); ?>
				</section>
			<?php } ?>

			<?php if ( is_active_sidebar( 'portfolio-1' ) ) : ?>
				<div id="secondary" class="sidebar-container" role="complementary">
					<div class="widget-area">
						<?php dynamic_sidebar( 'portfolio-1' ); ?>
					</div><!-- .widget-area -->
				</div><!-- #secondary -->
			<?php endif; ?>

			<?php $lucid_portfolio_link = get_post_meta($post->ID, '_lt_link', true); 
				if( $lucid_portfolio_link != '' ) { ?>
					<section class="portfolio-link-box">
						<a href="<?php echo $lucid_portfolio_link; ?>" class="portfolio-link">	
							View Project
						</a>
					</section>
			<?php } ?>

		</section>

<?php get_footer(); ?>