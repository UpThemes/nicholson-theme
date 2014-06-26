<?php
/**
 * The main template file.
 *
 * @package lucid
 * @since nicholson 1.0.2
 */

get_header();

/* Output column size based on layout option */
$options = lucid_get_theme_options();
$current_layout = $options['lucid_theme_layouts'];

if ( 'content' != $current_layout ) { ?>

	<section class="home-content col-lg-9 col-md-9 col-sm-12">

<?php } else { ?>

	<section class="home-content col-lg-12 col-md-12">

<?php } ?>

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php if (function_exists('wp_pagenavi')) { wp_pagenavi(); } else { nicholson_pagination(); };  ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'index' ); ?>

		<?php endif; ?>

	</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
