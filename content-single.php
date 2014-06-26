<?php
/**
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
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php nicholson_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php the_tags(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'nicholson' ), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'nicholson' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->
	
</article><!-- #post-<?php the_ID(); ?> -->
