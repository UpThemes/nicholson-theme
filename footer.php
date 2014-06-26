<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Nicholson
 * @since Nicholson 1.0
 */
?>
			</div><!-- .row -->
		</div><!-- .container -->
	</main>

	<footer id="footer" class="site-footer" role="contentinfo">
		<?php if(is_active_sidebar('footer-widget-1') || is_active_sidebar('footer-widget-2') || is_active_sidebar('footer-widget-3')) { ?>
			<section class="footer-widgets">
				<div class="container">
					<div class="row">

						<div class="footer-widget footer-widget-1 col-lg-4 col-md-4 col-sm-12">
							<?php 
								if ( dynamic_sidebar('footer-widget-1') ) : 
								else : endif;
							?>
						</div>

						<div class="footer-widget footer-widget-2 col-lg-4 col-md-4 col-sm-12">
							<?php 
								if ( dynamic_sidebar('footer-widget-2') ) : 
								else : endif; 
							?>
						</div>

						<div class="footer-widget footer-widget-3 col-lg-4 col-md-4 col-sm-12">
							<?php 
								if ( dynamic_sidebar('footer-widget-3') ) : 
								else : endif; 
							?>
						</div>

					</div><!-- .row -->
				</div><!-- .container -->
			</section><!-- .footer-widgets -->
		<?php }; ?>

		<section class="site-info">
			<div class="container">
				<div class="row">
					<?php $options = lucid_get_theme_options(); echo $options['lucid_copyright']; ?>
				</div><!-- .row -->
			</div><!-- .container -->
		</section><!-- .site-info -->
	</footer><!--.site-footer -->

</div><!-- #page .hfeed .site -->

<?php wp_footer(); lucid_add_footer_scripts(); ?>

</body>
</html>