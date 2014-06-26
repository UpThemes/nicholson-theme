<?php
/** Register portfolio post type */
function portfolio_register() {
	$labels = array(
		'name' => _x('Portfolio', 'post type general name', 'nicholson'),
		'singular_name' => _x('Portfolio Item', 'post type singular name', 'nicholson'),
		'add_new' => _x('Add New', 'portfolio item', 'nicholson'),
		'add_new_item' => __('Add New Portfolio Item', 'nicholson'),
		'edit_item' => __('Edit Portfolio Item', 'nicholson'),
		'new_item' => __('New Portfolio Item', 'nicholson'),
		'view_item' => __('View Portfolio Item', 'nicholson'),
		'search_items' => __('Search Portfolio', 'nicholson'),
		'not_found' =>  __('Nothing found', 'nicholson'),
		'not_found_in_trash' => __('Nothing found in Trash', 'nicholson'),
		'parent_item_colon' => ''
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'menu_position' => 6,
		'supports' => array('title','editor','thumbnail', 'tags'),
		'taxonomies' => array('post_tag'),
	  ); 
 
	register_post_type( 'portfolio' , $args );
}
add_action('init', 'portfolio_register');

register_taxonomy(
	'skills', 
	'portfolio', 
	array(
		'hierarchical' => true, 
		'label' => 'Skills', 
		'singular_label' => 'skill', 
		'rewrite' => true, 
		'query_var' => 'skills'
	)
);

/** Set up data fields */
function lucid_portfolio_admin_init(){
	add_meta_box('lucid_portfolio_completed', 'Project Completion Date', 'lucid_portfolio_completed', 'Portfolio', 'side', 'default');
	add_meta_box('lucid_portfolio_link', 'Project Link', 'lucid_portfolio_link', 'Portfolio', 'side', 'default');
	add_meta_box('lucid_portfolio_featured', 'Project Hero Image', 'lucid_portfolio_featured_image', 'Portfolio', 'side', 'default');
	add_meta_box('lucid_portfolio_client', 'Project Client', 'lucid_portfolio_client', 'Portfolio', 'side', 'default');
}
add_action('admin_init', 'lucid_portfolio_admin_init');

/** 
 * Portfolio Completed Date
 *
 * @since nicholson 1.0.2
 */

/** Add our meta box */
function lucid_portfolio_completed() {
	global $post;

	echo '<input type="hidden" name="lucid_completed_noncename" id="lucid_completed_noncename" value="' .
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	$lucid_portfolio_completed = get_post_meta($post->ID, '_lt_completed', true);

	echo '<input type="text" name="_lt_completed" value="' . $lucid_portfolio_completed  . '" class="widefat" />';
}

/** Save our meta box data */
function lucid_portfolio_completed_save_meta($post_id, $post) {
	if ( !wp_verify_nonce( $_POST['lucid_completed_noncename'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	$events_meta['_lt_completed'] = $_POST['_lt_completed'];

	foreach ($events_meta as $key => $value) { 
		if( $post->post_type == 'revision' ) return; 
		$value = implode(',', (array)$value);
		if(get_post_meta($post->ID, $key, FALSE)) { 
			update_post_meta($post->ID, $key, $value);
		} else {
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); 
	}
}
add_action('save_post', 'lucid_portfolio_completed_save_meta', 1, 2); 

/** 
 * Portfolio Featured Image
 *
 * @since nicholson 1.0.2
 */

/** Add our meta box */
function lucid_portfolio_featured_image() {
	global $post;

	echo '<input type="hidden" name="lucid_featured_image_noncename" id="lucid_featured_image_noncename" value="' .
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	$lucid_portfolio_featured_image = get_post_meta($post->ID, '_lt_featured', true);

	echo '<input type="text" name="_lt_featured" value="' . $lucid_portfolio_featured_image . '" class="widefat" />';
}

/** Save our meta box data */
function lucid_portfolio_featured_save_meta($post_id, $post) {
	if ( !wp_verify_nonce( $_POST['lucid_featured_image_noncename'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	$events_meta['_lt_featured'] = $_POST['_lt_featured'];

	foreach ($events_meta as $key => $value) { 
		if( $post->post_type == 'revision' ) return; 
		$value = implode(',', (array)$value);
		if(get_post_meta($post->ID, $key, FALSE)) { 
			update_post_meta($post->ID, $key, $value);
		} else {
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); 
	}
}
add_action('save_post', 'lucid_portfolio_featured_save_meta', 1, 2); 

/** 
 * Portfolio Link
 *
 * @since nicholson 1.0.2
 */

/** Add our meta box */
function lucid_portfolio_link() {
	global $post;

	echo '<input type="hidden" name="lucid_link_noncename" id="lucid_link_noncename" value="' .
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	$lucid_portfolio_link = get_post_meta($post->ID, '_lt_link', true);

	echo '<input type="text" name="_lt_link" value="' . $lucid_portfolio_link . '" class="widefat" />';
}

/** Save our meta box data */
function lucid_portfolio_link_save_meta($post_id, $post) {
	if ( !wp_verify_nonce( $_POST['lucid_link_noncename'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	$events_meta['_lt_link'] = $_POST['_lt_link'];

	foreach ($events_meta as $key => $value) { 
		if( $post->post_type == 'revision' ) return; 
		$value = implode(',', (array)$value);
		if(get_post_meta($post->ID, $key, FALSE)) { 
			update_post_meta($post->ID, $key, $value);
		} else {
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); 
	}
}
add_action('save_post', 'lucid_portfolio_link_save_meta', 1, 2); 

/** 
 * Portfolio client
 *
 * @since nicholson 1.0.2
 */

/** Add our meta box */
function lucid_portfolio_client() {
	global $post;

	echo '<input type="hidden" name="lucid_client_noncename" id="lucid_client_noncename" value="' .
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	$lucid_portfolio_client = get_post_meta($post->ID, '_lt_client', true);

	echo '<input type="text" name="_lt_client" value="' . $lucid_portfolio_client . '" class="widefat" />';
}

/** Save our meta box data */
function lucid_portfolio_client_save_meta($post_id, $post) {
	if ( !wp_verify_nonce( $_POST['lucid_client_noncename'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	$events_meta['_lt_client'] = $_POST['_lt_client'];

	foreach ($events_meta as $key => $value) { 
		if( $post->post_type == 'revision' ) return; 
		$value = implode(',', (array)$value);
		if(get_post_meta($post->ID, $key, FALSE)) { 
			update_post_meta($post->ID, $key, $value);
		} else {
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); 
	}
}
add_action('save_post', 'lucid_portfolio_client_save_meta', 1, 2); 

/** Set up custom taxonomy query */
function custom_taxonomies_terms_links() {
	global $post, $post_id;
	// get post by post id
	$post = &get_post($post->ID);
	// get post type by post
	$post_type = $post->post_type;
	// get post type taxonomies
	$taxonomies = get_object_taxonomies($post_type);
	foreach ($taxonomies as $taxonomy) {
		// get the terms related to post
		$terms = get_the_terms( $post->ID, $taxonomy );
		if ( !empty( $terms ) ) {
			$out = array();
			foreach ( $terms as $term )
				$out[] = $term->slug;
			$return = join( ' ', $out );
		}
	}
	return $return;
}