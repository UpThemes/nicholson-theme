<?php
/**
 * @package Nicholson
 * @since Nicholson 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<section class="post-details">
		<div class="post-timestamp">
			<?php echo nicholson_date_time(); ?>
		</div>

		<div class="comments-link">
			<a href="<?php comments_link(); ?>">
				<?php comments_number( 
					'<span class="comment-number">0</span><br/>Comments', 
					'<span class="comment-number">1</span><br/>Comment', 
					'<span class="comment-number">%</span><br/>Comments' 
					); 
				?>
			</a>
		</div>
	</section>

	<div class="entry-featured">
		<a href="<?php the_permalink(); ?>" class="entry-featured">
			<?php the_post_thumbnail('blog-featured'); ?>
		</a>
	</div>

	<header class="entry-header <?php if(has_post_thumbnail()) { echo 'has-featured'; } ?>">
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'nicholson' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h1>
		
		<section class="mobile-meta">
			<?php the_time(get_option('date_format')); ?> 
			<span class="lowercase">by</span> <?php the_author_posts_link(); ?>
		</section>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'nicholson' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'nicholson' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
