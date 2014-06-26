<?php
/**
 * Sidebar containing the main widget area
 *
 * @package Nicholson
 * @since nicholson 1.0.2
 */

$options = lucid_get_theme_options();
$current_layout = $options['lucid_theme_layouts'];

if ( is_page_template('sidebar-left-template.php') || is_page_template('sidebar-right-template.php') || 'content' != $current_layout ) : ?>
	
	<aside id="sidebar" class="sidebar col-lg-3 col-md-3 col-sm-12" role="complementary">
		<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

			<section id="archives" class="widget">
				<h3 class="widget-title"><?php _e( 'Archives', 'nicholson' ); ?></h3>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</section>

			<section id="meta" class="widget">
				<h3 class="widget-title"><?php _e( 'Meta', 'nicholson' ); ?></h3>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</section>

		<?php endif; // end sidebar widget area ?>
	</aside><!-- #secondary .widget-area -->

<?php endif; ?>