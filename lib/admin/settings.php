<?php
/**
 * Lucid Theme Options
 *
 * @package nicholson
 * @since nicholson 1.0.0
 */

/**
 * Properly enqueue styles and scripts for our theme options page.
 *
 * @since nicholson 1.0.2
 */
function  lucid_admin_enqueue_scripts( $hook_suffix ) {
	wp_enqueue_style( 'lucid-theme-options', get_template_directory_uri() . '/lib/admin/css/theme-options.css' );
}
add_action( 'admin_print_styles', 'lucid_admin_enqueue_scripts' );

/**
 * Check for theme updates.
 *
 * @since nicholson 1.0.0
 */
require_once( get_template_directory() . '/lib/admin/update.php' );

/**
 * Set up our font options
 *
 * @since nicholson 1.0.2
 */
require_once( get_template_directory() . '/lib/admin/fonts/fonts.php' );

/**
 * Set up our color options.
 *
 * @since nicholson 1.0.2
 */
require_once( get_template_directory() . '/lib/admin/colors/colors.php' );

/**
 * Make the theme available to the WordPress customizer
 *
 * @since nicholson 1.0.2
 */
require_once( get_template_directory() . '/lib/admin/customizer.php' );
 
/**
 * Register the form setting for our _s_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, lucid_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are properly
 * formatted, and safe.
 *
 * @since nicholson 1.0.2
 */
function lucid_theme_options_init() {
	register_setting(
		'lucid_options', // Options group, see settings_fields() call in lucid_theme_options_render_page()
		'lucid_theme_options', // Database option, see _s_get_theme_options()
		'lucid_theme_options_validate' // The sanitization callback, see lucid_theme_options_validate()
	);
 
	// Register our settings field group
	add_settings_section(
		'general', // Unique identifier for the settings section
		'', // Section title (we don't want one)
		'__return_false', // Section callback (we don't want anything)
		'theme_options' // Menu slug, used to uniquely identify the page; see lucid_theme_options_add_page()
	);
 
	// Register our individual settings fields
	add_settings_field( 'header_font_options', __( 'Heading Font', 'nicholson' ), 'lucid_settings_field_header_font', 'theme_options', 'general' );
	add_settings_field( 'body_font_options', __( 'Body Font', 'nicholson' ), 'lucid_settings_field_body_font', 'theme_options', 'general' );
	add_settings_field( 'lucid_primary_color', __( 'Primary Color', 'nicholson' ), 'lucid_primary_color_field', 'theme_options', 'general' );
	add_settings_field( 'lucid_secondary_color', __( 'Secondary Color', 'nicholson' ), 'lucid_secondary_color_field', 'theme_options', 'general' );
	add_settings_field( 'lucid_copyright', __( 'Copyright Text', 'nicholson' ), 'lucid_settings_field_copyright', 'theme_options', 'general' );
	add_settings_field( 'lucid_theme_layouts', __( 'Default Layout', 'nicholson' ), 'lucid_settings_field_layout', 'theme_options', 'general' );
	add_settings_field( 'lucid_header_scripts', __( 'Header Scripts', 'nicholson' ), 'lucid_settings_field_header_scripts', 'theme_options', 'general' );
	add_settings_field( 'lucid_footer_scripts', __( 'Footer Scripts', 'nicholson' ), 'lucid_settings_field_footer_scripts', 'theme_options', 'general' );
}
add_action( 'admin_init', 'lucid_theme_options_init' );
 
/**
 * Change the capability required to save the 'lucid_options' options group.
 *
 * @see lucid_theme_options_init() First parameter to register_setting() is the name of the options group.
 * @see lucid_theme_options_add_page() The edit_theme_options capability is used for viewing the page.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function lucid_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_lucid_options', 'lucid_option_page_capability' );
 
/**
 * Add our theme options page to the admin menu.
 *
 * @since lucid 1.0.2
 */
function lucid_theme_options_add_page() {
	$theme_page = add_menu_page(
		__( 'Lucid Options', 'nicholson' ),   // Name of page
		__( 'Lucid Options', 'nicholson' ),   // Label in menu
		'edit_theme_options',          // Capability required
		'theme_options',               // Menu slug, used to uniquely identify the page
		'lucid_theme_options_render_page', // Function that renders the options page
		false,
		50 // Place the menu between Comments and Appearance
	);
}
add_action( 'admin_menu', 'lucid_theme_options_add_page' );

/**
 * Adds Admin Menu Separators 
 *
 * @since nicholson 1.0.2
 */
function lucid_admin_menu_separator() {
	add_admin_menu_separator(49);
	add_admin_menu_separator(51);
}
add_action('admin_menu','lucid_admin_menu_separator');


/**
 * Create admin menu separator 
 *
 * @since nicholson 1.0.2
 */
function add_admin_menu_separator($position) {
	global $menu;
	$index = 0;

	foreach($menu as $offset => $section) {
		if (substr($section[2],0,9)=='separator')
		    $index++;
		if ($offset>=$position) {
			$menu[$position] = array('','read',"separator{$index}",'','wp-menu-separator');
			break;
	    }
	}
	ksort( $menu );
}
 
/**
 * Returns the options array for Nicholson
 *
 * @since nicholson 1.0.2
 */
function lucid_get_theme_options() {
	$saved = (array) get_option( 'lucid_theme_options' );
	$defaults = array(
		'header_font_options' 	=> '',
		'body_font_options'		=> '',
		'lucid_primary_color'	=> '',
		'lucid_secondary_color'	=> '',
		'lucid_copyright'		=> '',
		'lucid_header_scripts'	=> '',
		'lucid_footer_scripts'	=> '',
		'lucid_theme_layouts'	=> 'content'
	);
 
	$defaults = apply_filters( 'lucid_default_theme_options', $defaults );
 
	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );
 
	return $options;
}

/**
 * Renders the header font options.
 *
 * @since nicholson 1.0.2
 */
function lucid_settings_field_header_font() {
	$options = lucid_get_theme_options();
	?>
	<select name="lucid_theme_options[header_font_options]" id="header-font-options">
		<?php
			$selected = $options['header_font_options'];
			$p = '';
			$r = '';
 
			foreach ( lucid_header_font_options() as $option ) {
				$label = $option['name'];
				if ( $selected == $option['value'] ) // Make default first in list
					$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
				else
					$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
			}
			echo $p . $r;
		?>
	</select><br/>
	<label class="description" for="lucid_theme_options[selectinput]"><?php _e( 'The font used for page headings, post headings, etc.', 'nicholson' ); ?></label>
	<?php
}

/**
 * Renders the header font options.
 *
 * @since nicholson 1.0.2
 */
function lucid_settings_field_body_font() {
	$options = lucid_get_theme_options();
	?>
	<select name="lucid_theme_options[body_font_options]" id="body-font-options">
		<?php
			$selected = $options['body_font_options'];
			$p = '';
			$r = '';
 
			foreach ( lucid_body_font_options() as $option ) {
				$label = $option['name'];
				if ( $selected == $option['value'] ) // Make default first in list
					$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
				else
					$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
			}
			echo $p . $r;
		?>
	</select><br/>
	<label class="description" for="lucid_theme_options[selectinput]"><?php _e( 'The font used for body copy.', 'nicholson' ); ?></label>
	<?php
}

/**
 * Renders the primary color option field.
 *
 * @since nicholson 1.0.2
 */
function lucid_primary_color_field() {
	$options = lucid_get_theme_options(); 
	?>
	<input type="text" name="lucid_theme_options[lucid_primary_color]" id="lucid-primary-color" value="<?php echo esc_attr( $options['lucid_primary_color'] ); ?>" class="my-color-field" data-default-color="#77cc6d" /><br/>
	<label class="description" for="lucid-primary-color"><?php _e( 'Primary site color.', 'nicholson' ); ?></label>
	<?php
}

/**
 * Renders the secondary color option field.
 *
 * @since nicholson 1.0.2
 */
function lucid_secondary_color_field() {
	$options = lucid_get_theme_options(); 
	?>
	<input type="text" name="lucid_theme_options[lucid_secondary_color]" id="lucid-secondary-color" value="<?php echo esc_attr( $options['lucid_secondary_color'] ); ?>" class="my-color-field" data-default-color="#77cc6d" /><br/>
	<label class="description" for="lucid-secondary-color"><?php _e( 'Secondary site color, used for hovers, active elements, etc.', 'nicholson' ); ?></label>
	<?php
}

/**
 * Renders the copyright input field.
 *
 * @since nicholson 1.0.2
 */
function lucid_settings_field_copyright() {
	$options = lucid_get_theme_options();
	?>
	<input type="text" name="lucid_theme_options[lucid_copyright]" id="lucid-copyright" value="<?php echo esc_attr( $options['lucid_copyright'] ); ?>" /><br/>
	<label class="description" for="lucid-copyright"><?php _e( 'Copyright text that appears in the footer.', 'nicholson' ); ?></label>
	<?php
}
 
/**
 * Renders the header scripts field.
 *
 * @since nicholson 1.0.2
 */
function lucid_settings_field_header_scripts() {
	$options = lucid_get_theme_options();
	?>
	<textarea class="large-text" type="text" name="lucid_theme_options[lucid_header_scripts]" id="lucid-header-scripts" cols="50" rows="10" /><?php echo esc_textarea( $options['lucid_header_scripts'] ); ?></textarea>
	<label class="description" for="lucid-header-scripts"><?php _e( 'Outputs immediately before closing the &lt;/head&gt; tag.', 'nicholson' ); ?></label>
	<?php
}

/**
 * Renders the footer scripts field.
 *
 * @since nicholson 1.0.2
 */
function lucid_settings_field_footer_scripts() {
	$options = lucid_get_theme_options();
	?>
	<textarea class="large-text" type="text" name="lucid_theme_options[lucid_footer_scripts]" id="lucid-footer-scripts" cols="50" rows="10" /><?php echo $options['lucid_footer_scripts']; ?></textarea>
	<label class="description" for="lucid-footer-scripts"><?php _e( 'Outputs immediately after closing the &lt;/footer&gt; tag. Place your Google Analytics tracking code here.', 'nicholson' ); ?></label>
	<?php
}

/**
 * Return an array of layout options registered for Twenty Eleven.
 *
 * @since nicholson 1.0.2
 */
function lucid_theme_layout_options() {
	$layout_options = array(
		'content' => array(
			'value' => 'content',
			'label' => __( 'One-column, no sidebar', 'nicholson' ),
			'thumbnail' => get_template_directory_uri() . '/lib/admin/layouts/content.png',
		),
		'content-sidebar' => array(
			'value' => 'content-sidebar',
			'label' => __( 'Content on left', 'nicholson' ),
			'thumbnail' => get_template_directory_uri() . '/lib/admin/layouts/content-sidebar.png',
		),
		'sidebar-content' => array(
			'value' => 'sidebar-content',
			'label' => __( 'Content on right', 'nicholson' ),
			'thumbnail' => get_template_directory_uri() . '/lib/admin/layouts/sidebar-content.png',
		),
	);

	return apply_filters( 'lucid_theme_layout_options', $layout_options );
}

/**
 * Render the Layout setting field.
 *
 * @since nicholson 1.0.2
 */
function lucid_settings_field_layout() {
	$options = lucid_get_theme_options();
	foreach ( lucid_theme_layout_options() as $layout ) {
		?>
		<div class="layout image-radio-option theme-layout">
		<label class="description">
			<input type="radio" name="lucid_theme_options[lucid_theme_layouts]" value="<?php echo esc_attr( $layout['value'] ); ?>" <?php checked( $options['lucid_theme_layouts'], $layout['value'] ); ?> />
			<span>
				<img src="<?php echo esc_url( $layout['thumbnail'] ); ?>" width="136" height="122" alt="" />
				<?php echo $layout['label']; ?>
			</span>
		</label>
		</div>
		<?php
	}
}

/**
 * Add layout classes to the array of body classes.
 *
 * @since nicholson 1.0.2
 */
function lucid_layout_classes( $existing_classes ) {
	$options = lucid_get_theme_options();
	$current_layout = $options['lucid_theme_layouts'];

	if ( in_array( $current_layout, array( 'content-sidebar', 'sidebar-content' ) ) )
		$classes = array( 'two-column' );
	else
		$classes = array( 'one-column' );

	if ( 'content-sidebar' == $current_layout )
		$classes[] = 'right-sidebar';
	elseif ( 'sidebar-content' == $current_layout )
		$classes[] = 'left-sidebar';
	else
		$classes[] = $current_layout;

	/**
	 * Filter the layout body classes.
	 *
	 * @since nicholson 1.0.2
	 *
	 * @param array  $classes        An array of body classes.
	 * @param string $current_layout The current theme layout.
	 */
	$classes = apply_filters( 'lucid_layout_classes', $classes, $current_layout );

	return array_merge( $existing_classes, $classes );
}
add_filter( 'body_class', 'lucid_layout_classes' );
 
/**
 * Renders the Theme Options administration screen.
 *
 * @since nicholson 1.0.2
 */
function lucid_theme_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon('options-general'); ?>
		<?php $theme_name = wp_get_theme(); ?>
		<h2><?php printf( __( '%s Theme Options', 'nicholson' ), $theme_name ); ?></h2>
		<?php settings_errors(); ?>
 
		<form method="post" action="options.php">
			<?php
				settings_fields( 'lucid_options' );
				do_settings_sections( 'theme_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}
 
/**
 * Sanitize and validate form input. Accepts an array, return a sanitized array.
 *
 * @param array $input Unknown values.
 * @return array Sanitized theme options ready to be stored in the database.
 *
 * @since nicholson 1.0.2
 */
function lucid_theme_options_validate( $input ) {
	$output = array();

	// The sample text input must be safe text with no HTML tags
	if ( isset( $input['lucid_copyright'] ) && ! empty( $input['lucid_copyright'] ) )
		$output['lucid_copyright'] = wp_filter_nohtml_kses( $input['lucid_copyright'] );

	// The sample text input must be safe text with no HTML tags
	if ( isset( $input['lucid_primary_color'] ) && ! empty( $input['lucid_primary_color'] ) )
		$output['lucid_primary_color'] = wp_filter_nohtml_kses( $input['lucid_primary_color'] );

	// The sample text input must be safe text with no HTML tags
	if ( isset( $input['lucid_secondary_color'] ) && ! empty( $input['lucid_secondary_color'] ) )
		$output['lucid_secondary_color'] = wp_filter_nohtml_kses( $input['lucid_secondary_color'] );
 
	// The sample select option must actually be in the array of select options
	if ( isset( $input['header_font_options'] ) && array_key_exists( $input['header_font_options'], lucid_header_font_options() ) )
		$output['header_font_options'] = $input['header_font_options'];

	// The sample select option must actually be in the array of select options
	if ( isset( $input['body_font_options'] ) && array_key_exists( $input['body_font_options'], lucid_body_font_options() ) )
		$output['body_font_options'] = $input['body_font_options'];

	// The sample textarea must be safe text with the allowed tags for posts
	if ( isset( $input['lucid_header_scripts'] ) && ! empty( $input['lucid_header_scripts'] ) )
		$output['lucid_header_scripts'] = $input['lucid_header_scripts'];

	// The sample textarea must be safe text with the allowed tags for posts
	if ( isset( $input['lucid_footer_scripts'] ) && ! empty( $input['lucid_footer_scripts'] ) )
		$output['lucid_footer_scripts'] = $input['lucid_footer_scripts'];

	// The sample radio button value must be in our array of radio button values
	if ( isset( $input['lucid_theme_layouts'] ) && array_key_exists( $input['lucid_theme_layouts'], lucid_theme_layout_options() ) )
		$output['lucid_theme_layouts'] = $input['lucid_theme_layouts'];
 
	return apply_filters( 'lucid_theme_options_validate', $output, $input );
}

/**
 * Add our header scripts to the theme.
 *
 * @since nicholson 1.0.2
 */
function lucid_add_header_scripts() {
	$options = lucid_get_theme_options(); 
	echo $options['lucid_header_scripts'];
}

/**
 * Add our footer scripts to the theme.
 *
 * @since nicholson 1.0.2
 */
function lucid_add_footer_scripts() {
	$options = lucid_get_theme_options(); 
	echo $options['lucid_footer_scripts'];
}