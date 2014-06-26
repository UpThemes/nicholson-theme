<?php
/*
 * Template Name: Portfolio
 */

get_header(); ?>

<div class="page-title portfolio-title"><!-- Begin page title -->
	<h1>
		<?php the_title(); ?>
	</h1>
</div><!-- End page title -->

<div class="portfolio-filters"><!-- Begin filter links -->
	<ul id="filters">
		<li><a href="#" data-filter="*">All</a></li>
		<?php
		// Create an array and assign the projects taxonomy to it
		$args = array( 'taxonomy' => 'skills' );
		// Call the categories from this array
		$categories=get_categories($args);
		// Now, loop through them and...
		foreach ($categories as $category) {
			echo '<li><a href="#" data-filter=".'.$category->category_nicename.'">'.$category->cat_name;
			echo '</a></li>';
		} ?>
	</ul><!-- End filter loop -->
</div><!-- End filter links -->

<section class="portfolio"><!-- Begin portfolio loop -->
	<div class="container">
		<div id="portfolio" class="row">

		<?php
		// The Query
		$the_query = new WP_Query( 'post_type=portfolio&posts_per_page=-1');
		// The Loop
		while ( $the_query->have_posts() ) :
			$the_query->the_post(); ?>
	
			<section class="single-theme col-lg-4 col-md-4 col-sm-6 col-xs-12 <?php echo custom_taxonomies_terms_links(); ?>">
    				<section class="mosaic-block fade">

       					<div class="mosaic-overlay">
       						<div class="details">
								<h3><?php the_title();?></h3>
              					
              					<?php the_excerpt(); ?>

              					<a href="<?php the_permalink(); ?>" class="preview-link">
                  					View More
                  				</a>
              				</div>
              			</div>

      					<div class="mosaic-backdrop">
							<div class="mosaic-backdrop-background" style="background-image: url(<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'large', true); echo $image_url[0];  ?>);"></div>
						</div>

    				</section>
    			</section>	
    		
		<?php endwhile; wp_reset_postdata(); ?>

		</div>
	</div>
</section><!-- End portfolio loop -->

<?php get_footer(); ?>