<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Nicholson
 * @since Nicholson 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="page-featured">
		<a href="<?php the_permalink(); ?>" class="page-featured">
			<?php the_post_thumbnail('blog-featured'); ?>
		</a>
	</div>
	<header class="entry-header">
		<div class="page-title">
			<h1>
				<?php the_title(); ?>
			</h1>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'nicholson' ), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'nicholson' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
