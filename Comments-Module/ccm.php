<?php

class WPC_ET_Builder_Module_Comments extends ET_Builder_Module {
	function init() {
		$this->name       = esc_html__( 'Comments', 'et_builder' );
		$this->slug       = 'et_pb_comments';
		$this->fb_support = true;

		$this->whitelisted_fields = array(
			'admin_label',
			'module_id',
			'module_class',
			'form_background_color',
			'input_border_radius',
			'show_count',
			'show_reply',
			'show_avatar',
			'background_layout',
		);

		$this->fields_defaults = array(
			'input_border_radius' => array( '0px', 'add_default_setting' ),
			'background_layout'   => array( 'light' ),
			'show_count'          => array( 'on' ),
			'show_reply'          => array( 'on' ),
			'show_avatar'         => array( 'on' ),
		);

		$this->main_css_element = '%%order_class%%';

		$this->options_toggles = array(
			'general'  => array(
				'toggles' => array(
					'elements'   => esc_html__( 'Elements', 'et_builder' ),
					'background' => esc_html__( 'Background', 'et_builder' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'text' => array(
						'title'    => esc_html__( 'Text', 'et_builder' ),
						'priority' => 49,
					),
				),
			),
		);

		$this->advanced_options = array(
			'custom_margin_padding' => array(
				'css' => array(
					'important' => 'all',
				),
			),
			'fonts' => array(
				'body' => array(
					'label'          => esc_html__( 'Comment', 'et_builder' ),
					'css'            => array(
						'main' => "{$this->main_css_element} .comment-content p",
					),
					'line_height'    => array(
						'default' => '1em',
					),
					'font_size'      => array(
						'default' => '14px',
					),
					'letter_spacing' => array(
						'default' => '0px',
					),
				),
				'form_field' => array(
					'label'          => esc_html__( 'Field', 'et_builder' ),
					'css'            => array(
						'main'      => "{$this->main_css_element} #commentform textarea, {$this->main_css_element} #commentform input[type='text'], {$this->main_css_element} #commentform input[type='email'], {$this->main_css_element} #commentform input[type='url'], {$this->main_css_element} #commentform label",
						'important' => 'all',
					),
					'line_height'    => array(
						'default' => '1em',
					),
					'font_size'      => array(
						'default' => '18px',
					),
					'letter_spacing' => array(
						'default' => '0px',
					),
				),
				'meta' => array(
					'label'          => esc_html__( 'Meta', 'et_builder' ),
					'css'            => array(
						'main'      => "{$this->main_css_element} .comment_postinfo span",
						'important' => 'all',
					),
					'line_height'    => array(
						'default' => '1em',
					),
					'font_size'      => array(
						'default' => '14px',
					),
					'letter_spacing' => array(
						'default' => '0px',
					),
				),
			),
			'border' => array(
				'label'    => esc_html__( 'Field border', 'et_builder' ),
				'css'      => array(
					'main'      => "{$this->main_css_element} #commentform textarea, {$this->main_css_element} #commentform input[type='text'], {$this->main_css_element} #commentform input[type='email'], {$this->main_css_element} #commentform input[type='url']",
					'important' => 'all',
				),
				'settings' => array(
					'color' => 'alpha',
				),
			),
			'button' => array(
				'button' => array(
					'label' => esc_html__( 'Button', 'et_builder' ),
					'css' => array(
						'plugin_main' => "{$this->main_css_element}.et_pb_comments_module .et_pb_button",
					),
				),
			),
		);

		$this->custom_css_options = array(
			'main_header' => array(
				'label'    => esc_html__( 'Comments Count', 'et_builder' ),
				'selector' => 'h1#comments',
			),
			'comment_body' => array(
				'label'    => esc_html__( 'Comment Body', 'et_builder' ),
				'selector' => '.comment-body',
			),
			'comment_meta' => array(
				'label'    => esc_html__( 'Comment Meta', 'et_builder' ),
				'selector' => '.comment_postinfo',
			),
			'comment_content' => array(
				'label'    => esc_html__( 'Comment Content', 'et_builder' ),
				'selector' => '.comment_area .comment-content',
			),
			'comment_avatar' => array(
				'label'    => esc_html__( 'Comment Avatar', 'et_builder' ),
				'selector' => '.comment_avatar',
			),
			'reply_button' => array(
				'label'    => esc_html__( 'Reply Button', 'et_builder' ),
				'selector' => '.comment-reply-link.et_pb_button',
			),
			'new_title' => array(
				'label'    => esc_html__( 'New Comment Title', 'et_builder' ),
				'selector' => 'h3#reply-title',
			),
			'message_field' => array(
				'label'    => esc_html__( 'Message Field', 'et_builder' ),
				'selector' => '.comment-form-comment textarea#comment',
			),
			'name_field' => array(
				'label'    => esc_html__( 'Name Field', 'et_builder' ),
				'selector' => '.comment-form-author input',
			),
			'email_field' => array(
				'label'    => esc_html__( 'Email Field', 'et_builder' ),
				'selector' => '.comment-form-email input',
			),
			'website_field' => array(
				'label'    => esc_html__( 'Website Field', 'et_builder' ),
				'selector' => '.comment-form-url input',
			),
			'submit_button' => array(
				'label'    => esc_html__( 'Submit Button', 'et_builder' ),
				'selector' => '.form-submit .et_pb_button#et_pb_submit',
			),
		);
	}

	function get_fields() {

		$fields = array(
			'show_avatar' => array(
				'label'           => esc_html__( 'Show author avatar', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'toggle_slug'     => 'elements',
			),
			'show_reply' => array(
				'label'           => esc_html__( 'Show reply button', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'toggle_slug'     => 'elements',
			),
			'show_count' => array(
				'label'           => esc_html__( 'Show comments count', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'toggle_slug'     => 'elements',
			),
			'background_layout' => array(
				'label'           => esc_html__( 'Text Color', 'et_builder' ),
				'type'            => 'select',
				'option_category' => 'color_option',
				'options'         => array(
					'light' => esc_html__( 'Dark', 'et_builder' ),
					'dark'  => esc_html__( 'Light', 'et_builder' ),
				),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'text',
				'description'     => esc_html__( 'Here you can choose the value of your text. If you are working with a dark background, then your text should be set to light. If you are working with a light background, then your text should be dark.', 'et_builder' ),
			),
			'form_background_color' => array(
				'label'        => esc_html__( 'Fields Background Color', 'et_builder' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'toggle_slug'  => 'background',
			),
			'input_border_radius' => array(
				'label'           => esc_html__( 'Fields Border Radius', 'et_builder' ),
				'type'            => 'range',
				'option_category' => 'layout',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'border',
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
			)
		);

		return $fields;
	}

	/**
	 * Get comments markup for comments module
	 *
	 * @return string of comment section markup
	 */
	static function get_comments() {
		global $et_pb_comments_print;

		// Globally flag that comment module is being printed
		$et_pb_comments_print = true;

		// remove filters to make sure comments module rendered correctly if the below filters were applied earlier.
		remove_filter( 'get_comments_number', '__return_zero' );
		remove_filter( 'comments_open', '__return_false' );
		remove_filter( 'comments_array', '__return_empty_array' );

		ob_start();
		comments_template( '', true );
		$comments_content = ob_get_contents();
		ob_end_clean();

		// Globally flag that comment module has been printed
		$et_pb_comments_print = false;

		return $comments_content;
	}

	function et_pb_comments_template() {
		return dirname(__FILE__) . '/comments_template.php';
	}



	function et_pb_comments_submit_button( $submit_button ) {
		return sprintf(
			'<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
			esc_attr( 'submit' ),
			esc_attr( 'et_pb_submit' ),
			esc_attr( 'submit' ),
			esc_html__( 'Submit Comment', 'et_builder' )
		);
	}

	function et_pb_modify_comments_request( $params ) {
		// modify the request parameters the way it doesn't change the result just to make request with unique parameters
		$params->query_vars['type__not_in'] = 'et_pb_comments_random_type_' . $this->et_pb_unique_comments_module_class;
	}

	function shortcode_callback( $atts, $content = null, $function_name ) {
		$module_id             = $this->shortcode_atts['module_id'];
		$module_class          = $this->shortcode_atts['module_class'];
		$button_custom         = $this->shortcode_atts['custom_button'];
		$custom_icon           = $this->shortcode_atts['button_icon'];
		$form_background_color = $this->shortcode_atts['form_background_color'];
		$input_border_radius   = $this->shortcode_atts['input_border_radius'];
		$show_avatar           = $this->shortcode_atts['show_avatar'];
		$show_reply            = $this->shortcode_atts['show_reply'];
		$show_count            = $this->shortcode_atts['show_count'];
		$background_layout     = $this->shortcode_atts['background_layout'];

		$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

		$this->et_pb_unique_comments_module_class = $module_class; // use this variable to make the comments request unique for each module instance

		if ( '' !== $form_background_color ) {
			ET_Builder_Element::set_style( $function_name, array(
				'selector'    => '%%order_class%% #commentform textarea, %%order_class%% #commentform input[type="text"], %%order_class%% #commentform input[type="email"], %%order_class%% #commentform input[type="url"]',
				'declaration' => sprintf(
					'background-color: %1$s;',
					esc_html( $form_background_color )
				),
			) );
		}

		if ( ! in_array( $input_border_radius, array( '', '0' ) ) ) {
			ET_Builder_Element::set_style( $function_name, array(
				'selector'    => '%%order_class%% #commentform textarea, %%order_class%% #commentform input[type="text"], %%order_class%% #commentform input[type="email"], %%order_class%% #commentform input[type="url"]',
				'declaration' => sprintf(
					'-moz-border-radius: %1$s; -webkit-border-radius: %1$s; border-radius: %1$s;',
					esc_html( et_builder_process_range_value( $input_border_radius ) )
				),
			) );
		}

		$module_class .= 'off' === $show_avatar ? ' et_pb_no_avatar' : '';
		$module_class .= 'off' === $show_reply ? ' et_pb_no_reply_button' : '';
		$module_class .= 'off' === $show_count ? ' et_pb_no_comments_count' : '';

		$module_class .= ' et_pb_bg_layout_' . $background_layout;

		// Modify the comments request to make sure it's unique.
		// Otherwise WP generates SQL error and doesn't allow multiple comments sections on single page
		add_action( 'pre_get_comments', array( $this, 'et_pb_modify_comments_request' ), 1 );

		// include custom comments_template to display the comment section with Divi style
		add_filter( 'comments_template', array( $this, 'et_pb_comments_template' ) );

		// Modify submit button to be advanced button style ready
		add_filter( 'comment_form_submit_button', array( $this, 'et_pb_comments_submit_button' ) );

		$comments_content = self::get_comments();

		// remove all the actions and filters to not break the default comments section from theme
		remove_filter( 'comments_template', array( $this, 'et_pb_comments_template' ) );
		remove_action( 'pre_get_comments', array( $this, 'et_pb_modify_comments_request' ), 1 );

		$comments_custom_icon = 'on' === $button_custom ? $custom_icon : '';

		$output = sprintf(
			'<div%3$s class="wpc-comments-module et_pb_module et_pb_comments_module %2$s"%4$s>
				%1$s
			</div>',
			$comments_content,
			( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ),
			( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
			'' !== $comments_custom_icon ? sprintf( ' data-icon="%1$s"', esc_attr( et_pb_process_font_icon( $comments_custom_icon ) ) ) : ''
		);

		return $output;
	}
}