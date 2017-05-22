<?php //don't include <?php if your functions.php already contains it on the first line
/*================================================
#2 Load custom Blog Module 
================================================*/
function divi_child_theme_setup() {
	if ( class_exists('ET_Builder_Module')) {
		get_template_part( 'custom-modules/cbm' );
		$cbm = new WPC_ET_Builder_Module_Blog();
		remove_shortcode( 'et_pb_blog' );
		add_shortcode( 'et_pb_blog', array($cbm, '_shortcode_callback') );
	}
}
add_action('wp', 'divi_child_theme_setup', 9999);

/*================================================
#3 Add custom option in the blog module
================================================*/
add_filter( 'et_builder_module_fields_et_pb_blog', 'et_builder_module_fields_et_pb_article_excerpt' );
function et_builder_module_fields_et_pb_article_excerpt() {
	$fields = array(
		'fullwidth' => array(
			'label'             => esc_html__( 'Layout 1', 'et_builder' ),
			'type'              => 'select',
			'option_category'   => 'layout',
			'options'           => array(
				'on'  => esc_html__( 'Fullwidth', 'et_builder' ),
				'off' => esc_html__( 'Grid', 'et_builder' ),
			),
			'affects'           => array(
				'background_layout',
				'use_dropshadow',
				'masonry_tile_background_color',
			),
			'description'        => esc_html__( 'Toggle between the various blog layout types.', 'et_builder' ),
			'computed_affects'   => array(
				'__posts',
			),
			'tab_slug'           => 'advanced',
			'toggle_slug'        => 'layout',
		),
		'excerpt_length' => array(
			'label'             => esc_html__( 'Excerpt Lenght', 'et_builder' ),
			'type'              => 'text',
			'option_category'   => 'layout',
			'description'       => esc_html__( 'Choose the Excerpt Lenght', 'et_builder' ),
			'computed_affects'   => array(
				'__posts',
			),
			'tab_slug'           => 'advanced',
			'toggle_slug'        => 'layout',
		),
		'posts_number' => array(
			'label'             => esc_html__( 'Posts Number', 'et_builder' ),
			'type'              => 'text',
			'option_category'   => 'configuration',
			'description'       => esc_html__( 'Choose how much posts you would like to display per page.', 'et_builder' ),
			'computed_affects'   => array(
				'__posts',
			),
			'toggle_slug'       => 'main_content',
		),
		'include_categories' => array(
			'label'            => esc_html__( 'Include Categories', 'et_builder' ),
			'renderer'         => 'et_builder_include_categories_option',
			'option_category'  => 'basic_option',
			'renderer_options' => array(
				'use_terms' => false,
			),
			'description'      => esc_html__( 'Choose which categories you would like to include in the feed.', 'et_builder' ),
			'toggle_slug'      => 'main_content',
			'computed_affects' => array(
				'__posts',
			),
		),
		'meta_date' => array(
			'label'             => esc_html__( 'Meta Date Format', 'et_builder' ),
			'type'              => 'text',
			'option_category'   => 'configuration',
			'description'       => esc_html__( 'If you would like to adjust the date format, input the appropriate PHP date format here.', 'et_builder' ),
			'toggle_slug'       => 'main_content',
			'computed_affects'  => array(
				'__posts',
			),
		),
		'show_thumbnail' => array(
			'label'             => esc_html__( 'Show Featured Image', 'et_builder' ),
			'type'              => 'yes_no_button',
			'option_category'   => 'configuration',
			'options'           => array(
				'on'  => esc_html__( 'Yes', 'et_builder' ),
				'off' => esc_html__( 'No', 'et_builder' ),
			),
			'description'       => esc_html__( 'This will turn thumbnails on and off.', 'et_builder' ),
			'computed_affects'  => array(
				'__posts',
			),
			'toggle_slug'       => 'elements',
		),
		'show_content' => array(
			'label'             => esc_html__( 'Content', 'et_builder' ),
			'type'              => 'select',
			'option_category'   => 'configuration',
			'options'           => array(
				'off' => esc_html__( 'Show Excerpt', 'et_builder' ),
				'on'  => esc_html__( 'Show Content', 'et_builder' ),
			),
			'affects'           => array(
				'show_more',
			),
			'description'       => esc_html__( 'Showing the full content will not truncate your posts on the index page. Showing the excerpt will only display your excerpt text.', 'et_builder' ),
			'toggle_slug'       => 'main_content',
			'computed_affects'  => array(
				'__posts',
			),
		),
		'show_more' => array(
			'label'             => esc_html__( 'Read More Button', 'et_builder' ),
			'type'              => 'yes_no_button',
			'option_category'   => 'configuration',
			'options'           => array(
				'off' => esc_html__( 'Off', 'et_builder' ),
				'on'  => esc_html__( 'On', 'et_builder' ),
			),
			'depends_show_if'   => 'off',
			'description'       => esc_html__( 'Here you can define whether to show "read more" link after the excerpts or not.', 'et_builder' ),
			'computed_affects'   => array(
				'__posts',
			),
			'toggle_slug'       => 'elements',
		),
		'show_author' => array(
			'label'             => esc_html__( 'Show Author', 'et_builder' ),
			'type'              => 'yes_no_button',
			'option_category'   => 'configuration',
			'options'           => array(
				'on'  => esc_html__( 'Yes', 'et_builder' ),
				'off' => esc_html__( 'No', 'et_builder' ),
			),
			'description'        => esc_html__( 'Turn on or off the author link.', 'et_builder' ),
			'computed_affects'   => array(
				'__posts',
			),
			'toggle_slug'        => 'elements',
		),
		'show_date' => array(
			'label'             => esc_html__( 'Show Date', 'et_builder' ),
			'type'              => 'yes_no_button',
			'option_category'   => 'configuration',
			'options'           => array(
				'on'  => esc_html__( 'Yes', 'et_builder' ),
				'off' => esc_html__( 'No', 'et_builder' ),
			),
			'description'        => esc_html__( 'Turn the date on or off.', 'et_builder' ),
			'computed_affects'   => array(
				'__posts',
			),
			'toggle_slug'        => 'elements',
		),
		'show_categories' => array(
			'label'             => esc_html__( 'Show Categories', 'et_builder' ),
			'type'              => 'yes_no_button',
			'option_category'   => 'configuration',
			'options'           => array(
				'on'  => esc_html__( 'Yes', 'et_builder' ),
				'off' => esc_html__( 'No', 'et_builder' ),
			),
			'description'        => esc_html__( 'Turn the category links on or off.', 'et_builder' ),
			'computed_affects'   => array(
				'__posts',
			),
			'toggle_slug'        => 'elements',
		),
		'show_comments' => array(
			'label'             => esc_html__( 'Show Comment Count', 'et_builder' ),
			'type'              => 'yes_no_button',
			'option_category'   => 'configuration',
			'options'           => array(
				'on'  => esc_html__( 'Yes', 'et_builder' ),
				'off' => esc_html__( 'No', 'et_builder' ),
			),
			'description'        => esc_html__( 'Turn comment count on and off.', 'et_builder' ),
			'computed_affects'   => array(
				'__posts',
			),
			'toggle_slug'        => 'elements',
		),
		'show_pagination' => array(
			'label'             => esc_html__( 'Show Pagination', 'et_builder' ),
			'type'              => 'yes_no_button',
			'option_category'   => 'configuration',
			'options'           => array(
				'on'  => esc_html__( 'Yes', 'et_builder' ),
				'off' => esc_html__( 'No', 'et_builder' ),
			),
			'description'        => esc_html__( 'Turn pagination on and off.', 'et_builder' ),
			'computed_affects'   => array(
				'__posts',
			),
			'toggle_slug'        => 'elements',
		),
		'offset_number' => array(
			'label'            => esc_html__( 'Offset Number', 'et_builder' ),
			'type'             => 'text',
			'option_category'  => 'configuration',
			'description'      => esc_html__( 'Choose how many posts you would like to offset by', 'et_builder' ),
			'toggle_slug'      => 'main_content',
			'computed_affects' => array(
				'__posts',
			),
		),
		'use_overlay' => array(
			'label'             => esc_html__( 'Featured Image Overlay', 'et_builder' ),
			'type'              => 'yes_no_button',
			'option_category'   => 'layout',
			'options'           => array(
				'off' => esc_html__( 'Off', 'et_builder' ),
				'on'  => esc_html__( 'On', 'et_builder' ),
			),
			'affects'           => array(
				'overlay_icon_color',
				'hover_overlay_color',
				'hover_icon',
			),
			'description'       => esc_html__( 'If enabled, an overlay color and icon will be displayed when a visitors hovers over the featured image of a post.', 'et_builder' ),
			'computed_affects'   => array(
				'__posts',
			),
			'tab_slug'          => 'advanced',
			'toggle_slug'       => 'overlay',
		),
		'overlay_icon_color' => array(
			'label'             => esc_html__( 'Overlay Icon Color', 'et_builder' ),
			'type'              => 'color',
			'custom_color'      => true,
			'depends_show_if'   => 'on',
			'tab_slug'          => 'advanced',
			'toggle_slug'       => 'overlay',
			'description'       => esc_html__( 'Here you can define a custom color for the overlay icon', 'et_builder' ),
		),
		'hover_overlay_color' => array(
			'label'             => esc_html__( 'Hover Overlay Color', 'et_builder' ),
			'type'              => 'color-alpha',
			'custom_color'      => true,
			'depends_show_if'   => 'on',
			'tab_slug'          => 'advanced',
			'toggle_slug'       => 'overlay',
			'description'       => esc_html__( 'Here you can define a custom color for the overlay', 'et_builder' ),
		),
		'hover_icon' => array(
			'label'               => esc_html__( 'Hover Icon Picker', 'et_builder' ),
			'type'                => 'text',
			'option_category'     => 'configuration',
			'class'               => array( 'et-pb-font-icon' ),
			'renderer'            => 'et_pb_get_font_icon_list',
			'renderer_with_field' => true,
			'depends_show_if'     => 'on',
			'description'         => esc_html__( 'Here you can define a custom icon for the overlay', 'et_builder' ),
			'tab_slug'            => 'advanced',
			'toggle_slug'         => 'overlay',
			'computed_affects'    => array(
				'__posts',
			),
		),
		'background_layout' => array(
			'label'       => esc_html__( 'Text Color', 'et_builder' ),
			'type'        => 'select',
			'option_category' => 'color_option',
			'options'           => array(
				'light' => esc_html__( 'Dark', 'et_builder' ),
				'dark'  => esc_html__( 'Light', 'et_builder' ),
			),
			'depends_default' => true,
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'text',
			'description'     => esc_html__( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'et_builder' ),
		),
		'masonry_tile_background_color' => array(
			'label'             => esc_html__( 'Grid Tile Background Color', 'et_builder' ),
			'type'              => 'color-alpha',
			'custom_color'      => true,
			'toggle_slug'       => 'background',
			'depends_show_if'   => 'off',
			'depends_to'        => array(
				'fullwidth'
			),
		),
		'use_dropshadow' => array(
			'label'             => esc_html__( 'Use Dropshadow', 'et_builder' ),
			'type'              => 'yes_no_button',
			'option_category'   => 'layout',
			'options'           => array(
				'off' => esc_html__( 'Off', 'et_builder' ),
				'on'  => esc_html__( 'On', 'et_builder' ),
			),
			'tab_slug'          => 'advanced',
			'toggle_slug'       => 'layout',
			'depends_show_if'   => 'off',
			'depends_to'        => array(
				'fullwidth'
			),
		),
		'disabled_on' => array(
			'label'           => esc_html__( 'Disable on', 'et_builder' ),
			'type'            => 'multiple_checkboxes',
			'options'         => array(
				'phone'   => esc_html__( 'Phone', 'et_builder' ),
				'tablet'  => esc_html__( 'Tablet', 'et_builder' ),
				'desktop' => esc_html__( 'Desktop', 'et_builder' ),
			),
			'additional_att'  => 'disable_on',
			'option_category' => 'configuration',
			'description'     => esc_html__( 'This will disable the module on selected devices', 'et_builder' ),
			'tab_slug'        => 'custom_css',
			'toggle_slug'     => 'visibility',
		),
		'admin_label' => array(
			'label'       => esc_html__( 'Admin Label', 'et_builder' ),
			'type'        => 'text',
			'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
			'toggle_slug' => 'admin_label',
		),
		'module_id' => array(
			'label'           => esc_html__( 'CSS ID', 'et_builder' ),
			'type'            => 'text',
			'option_category' => 'configuration',
			'tab_slug'        => 'custom_css',
			'toggle_slug'     => 'classes',
			'option_class'    => 'et_pb_custom_css_regular',
		),
		'module_class' => array(
			'label'           => esc_html__( 'CSS Class', 'et_builder' ),
			'type'            => 'text',
			'option_category' => 'configuration',
			'tab_slug'        => 'custom_css',
			'toggle_slug'     => 'classes',
			'option_class'    => 'et_pb_custom_css_regular',
		),
		'__posts' => array(
			'type' => 'computed',
			'computed_callback' => array( 'ET_Builder_Module_Blog', 'get_blog_posts' ),
			'computed_depends_on' => array(
				'fullwidth',
				'posts_number',
				'include_categories',
				'meta_date',
				'show_thumbnail',
				'show_content',
				'show_more',
				'show_author',
				'show_date',
				'show_categories',
				'show_comments',
				'show_pagination',
				'offset_number',
				'use_overlay',
				'hover_icon',
			),
		),
	);
	return $fields;
}