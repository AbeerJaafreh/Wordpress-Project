<?php
/**
 *  Percon Besic Theme Settings
 *
 * @since Percon 1.0
 *
 * @return array percon_customize_register
 *
*/

function percon_get_categories_select() {
	$categories = get_categories();
	$wp_cats    = array();
	foreach ( $categories as $category_list ) {
		$wp_cats[ $category_list->cat_ID ] = $category_list->cat_name;
	}

	return $wp_cats;

}

function percon_customize_register( $wp_customize ) {

	//Basic Post Message Settings
	$wp_customize->get_setting( 'blogname' )->transport               = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport       = 'postMessage';
	$wp_customize->get_setting( 'custom_logo' )->transport            = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->active_callback = '__return_false';

	// Sidebar choices
	$sidebar_choices = array(
		'full'  => array(
			'url'   => get_theme_file_uri( '/inc/customizer/customizer-radio-image/img/full-width.png' ),
			'label' => esc_html__( 'Full Width', 'percon' ),
		),
		'left'  => array(
			'url'   => get_theme_file_uri( '/inc/customizer/customizer-radio-image/img/sidebar-left.png' ),
			'label' => esc_html__( 'Left Sidebar', 'percon' ),
		),
		'right' => array(
			'url'   => get_theme_file_uri( '/inc/customizer/customizer-radio-image/img/sidebar-right.png' ),
			'label' => esc_html__( 'Right Sidebar', 'percon' ),
		),
	);

	// Changing for site Identity
	$wp_customize->selective_refresh->add_partial(
		'blogname',
		array(
			'selector'        => '.site-title a',
			'render_callback' => 'percon_customize_partial_blogname',
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'blogdescription',
		array(
			'selector'        => '.site-description',
			'render_callback' => 'percon_customize_partial_blogdescription',
		)
	);

	if ( class_exists( 'Percon_Customizer_Dimensions_Control' ) ) {
		/**
		 * Blog Padding
		 */
		$wp_customize->add_setting(
			'percon_options[logo_top_padding]',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'percon_sanitize_number',
				'default'           => 20,
			)
		);
		$wp_customize->add_setting(
			'percon_options[logo_bottom_padding]',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'percon_sanitize_number',
				'default'           => 20,
			)
		);

		$wp_customize->add_setting(
			'percon_options[logo_tablet_top_padding]',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'percon_sanitize_number_blank',
				'default'           => 20,
			)
		);
		$wp_customize->add_setting(
			'percon_options[logo_tablet_bottom_padding]',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'percon_sanitize_number_blank',
				'default'           => 20,
			)
		);

		$wp_customize->add_setting(
			'percon_options[logo_mobile_top_padding]',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'percon_sanitize_number_blank',
				'default'           => 20,
			)
		);
		$wp_customize->add_setting(
			'percon_options[logo_mobile_bottom_padding]',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'percon_sanitize_number_blank',
				'default'           => 20,
			)
		);

		$wp_customize->add_control(
			new Percon_Customizer_Dimensions_Control(
				$wp_customize,
				'percon_options[logo_padding]',
				array(
					'label'       => esc_html__( 'Logo Padding (px)', 'percon' ),
					'section'     => 'title_tagline',
					'settings'    => array(
						'desktop_top'    => 'percon_options[logo_top_padding]',
						'desktop_bottom' => 'percon_options[logo_bottom_padding]',
						'tablet_top'     => 'percon_options[logo_tablet_top_padding]',
						'tablet_bottom'  => 'percon_options[logo_tablet_bottom_padding]',
						'mobile_top'     => 'percon_options[logo_mobile_top_padding]',
						'mobile_bottom'  => 'percon_options[logo_mobile_bottom_padding]',
					),
					'priority'    => 20,
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				)
			)
		);
	}

	$wp_customize->add_setting(
		'percon_options[theme_color]',
		array(
			'default'           => '#ef8354',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'              => 'theme_mod',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'percon_options[theme_color]',
			array(
				'label'   => esc_html__( 'Theme Color', 'percon' ),
				'section' => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'percon_options[menu_color]',
		array(
			'default'           => '#1b1b1b',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'              => 'theme_mod',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'percon_options[menu_color]',
			array(
				'label'   => esc_html__( 'Menu Color', 'percon' ),
				'section' => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'percon_options[menu_hover_color]',
		array(
			'default'           => '#ef8354',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'              => 'theme_mod',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'percon_options[menu_hover_color]',
			array(
				'label'   => esc_html__( 'Menu Hover Color', 'percon' ),
				'section' => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'percon_options[dropdown_menu_bg]',
		array(
			'default'           => '#ffffff',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'              => 'theme_mod',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'percon_options[dropdown_menu_bg]',
			array(
				'label'   => esc_html__( 'Dropdown Menu Background', 'percon' ),
				'section' => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'percon_options[dropdown_menu_color]',
		array(
			'default'           => '#1b1b1b',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'              => 'theme_mod',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'percon_options[dropdown_menu_color]',
			array(
				'label'   => esc_html__( 'Dropdown Menu Color', 'percon' ),
				'section' => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'percon_options[dropdown_menu_hover_bg_color]',
		array(
			'default'           => '#ef8354',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'              => 'theme_mod',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'percon_options[dropdown_menu_hover_bg_color]',
			array(
				'label'   => esc_html__( 'Dropdown Menu Hover Background Color', 'percon' ),
				'section' => 'colors',
			)
		)
	);

	/**
	 * Percon WordPress Theme Header Settings
	 */
	$wp_customize->add_section(
		'percon_header_settings',
		array(
			'title'    => esc_html__( 'Header Settings', 'percon' ),
			'priority' => 20,
		)
	);

	$wp_customize->add_setting(
		'percon_options[socials_status]',
		array(
			'default'           => false,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'percon_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new Percon_Toggle_Control(
			$wp_customize,
			'percon_options[socials_status]',
			array(
				'label'   => esc_html__( 'Socials Icons:', 'percon' ),
				'type'    => 'ios',
				'section' => 'percon_header_settings',
			)
		)
	);

	$wp_customize->add_setting(
		'percon_options[social_profile_target]',
		array(
			'default'           => '_blank',
			'capability'        => 'edit_theme_options',
			'type'              => 'theme_mod',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'percon_options[social_profile_target]',
			array(
				'label'   => esc_html__( 'Social Link Target', 'percon' ),
				'type'    => 'select',
				'section' => 'percon_header_settings',
				'choices' => array(
					'_blank' => esc_html__( 'New Window', 'percon' ),
					'_self'  => esc_html__( 'Same Window', 'percon' ),
				),
			)
		)
	);

	if ( class_exists( 'Percon_Customizer_Repeater_Control' ) ) {
		$wp_customize->add_setting(
			'percon_options[social_url]',
			array(
				'sanitize_callback' => 'percon_customizer_repeater_sanitize',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Percon_Customizer_Repeater_Control(
				$wp_customize,
				'percon_options[social_url]',
				array(
					'label'                             => esc_html__( 'Social URL', 'percon' ),
					'section'                           => 'percon_header_settings',
					'customizer_repeater_image_control' => false,
					'customizer_repeater_icon_control'  => true,
					'customizer_repeater_link_control'  => true,
				)
			)
		);
	}

	$wp_customize->add_setting(
		'percon_options[header_search_form_status]',
		array(
			'default'           => false,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'percon_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new Percon_Toggle_Control(
			$wp_customize,
			'percon_options[header_search_form_status]',
			array(
				'label'   => esc_html__( 'Search Form:', 'percon' ),
				'type'    => 'ios',
				'section' => 'percon_header_settings',
			)
		)
	);

	$wp_customize->add_setting(
		'percon_options[header_slideshow_status]',
		array(
			'default'           => false,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'percon_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new Percon_Toggle_Control(
			$wp_customize,
			'percon_options[header_slideshow_status]',
			array(
				'label'   => esc_html__( 'Slideshow Status:', 'percon' ),
				'type'    => 'ios',
				'section' => 'percon_header_settings',
			)
		)
	);

	$wp_customize->add_setting(
		'percon_options[header_slideshow_category]',
		array(
			'default'           => '_blank',
			'capability'        => 'edit_theme_options',
			'type'              => 'theme_mod',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'percon_options[header_slideshow_category]',
			array(
				'label'   => esc_html__( 'Select Slideshow Category', 'percon' ),
				'type'    => 'select',
				'section' => 'percon_header_settings',
				'choices' => percon_get_categories_select(),
			)
		)
	);

	$wp_customize->add_setting(
		'percon_options[header_slideshow_count]',
		array(
			'sanitize_callback' => 'percon_sanitize_number_range',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new percon_Customizer_Range_Value_Control(
			$wp_customize,
			'percon_options[header_slideshow_count]',
			array(
				'label'      => esc_html__( 'Slideshow Count:', 'percon' ),
				'section'    => 'percon_header_settings',
				'type'       => 'range-value',
				'input_attr' => array(
					'min'  => 0,
					'max'  => 10,
					'step' => 1,
				),
				'sum_type'   => false,
			)
		)
	);

	$wp_customize->add_setting(
		'percon_options[header_boxes_status]',
		array(
			'default'           => false,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'percon_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new Percon_Toggle_Control(
			$wp_customize,
			'percon_options[header_boxes_status]',
			array(
				'label'   => esc_html__( 'Header Boxes Status:', 'percon' ),
				'type'    => 'ios',
				'section' => 'percon_header_settings',
			)
		)
	);

	if ( class_exists( 'Percon_Customizer_Repeater_Control' ) ) {
		$wp_customize->add_setting(
			'percon_options[header_boxes]',
			array(
				'sanitize_callback' => 'percon_customizer_repeater_sanitize',
				'capability'        => 'edit_theme_options',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Percon_Customizer_Repeater_Control(
				$wp_customize,
				'percon_options[header_boxes]',
				array(
					'label'                             => esc_html__( 'Header Box', 'percon' ),
					'section'                           => 'percon_header_settings',
					'customizer_repeater_image_control' => true,
					'customizer_repeater_icon_control'  => false,
					'customizer_repeater_link_control'  => true,
					'customizer_repeater_title_control' => true,
				)
			)
		);
	}

	/**
	 * Percon WordPress Theme General Settings
	 */
	$wp_customize->add_section(
		'percon_general_settings',
		array(
			'title'    => esc_html__( 'General Settings', 'percon' ),
			'priority' => 20,
		)
	);

	$wp_customize->add_setting(
		'percon_options[hide_sidebar_on_mobile]',
		array(
			'default'           => true,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'percon_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new Percon_Toggle_Control(
			$wp_customize,
			'percon_options[hide_sidebar_on_mobile]',
			array(
				'label'   => esc_html__( 'Hide Sidebar On Mobile:', 'percon' ),
				'type'    => 'ios',
				'section' => 'percon_general_settings',
			)
		)
	);

	/**
	 * Percon WordPress Theme Blog Settings
	 */
	$wp_customize->add_section(
		'percon_blog_settings',
		array(
			'title'    => esc_html__( 'Blog Settings', 'percon' ),
			'priority' => 20,
		)
	);

	if ( class_exists( 'Percon_Customize_Control_Radio_Image' ) ) {

		$wp_customize->add_setting(
			'percon_options[blog_sidebar_dispay]',
			array(
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_key',
				'type'              => 'theme_mod',
				'default'           => 'right',
			)
		);

		$wp_customize->add_control(
			new Percon_Customize_Control_Radio_Image(
				$wp_customize,
				'percon_options[blog_sidebar_dispay]',
				array(
					'label'   => esc_html__( 'Blog Sidebar Layout', 'percon' ),
					'section' => 'percon_blog_settings',
					'choices' => $sidebar_choices,
				)
			)
		);
	}

	$wp_customize->add_setting(
		'percon_options[excerpt_length]',
		array(
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'absint',
			'type'              => 'theme_mod',
			'default'           => 45,
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'percon_options[excerpt_length]',
		array(
			'label'       => esc_html__( 'Excerpt Length: ', 'percon' ),
			'description' => esc_html__( 'How many words want to show per page?', 'percon' ),
			'section'     => 'percon_blog_settings',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 1,
				'max'  => 100,
				'step' => 1,
			),
		)
	);

	$wp_customize->add_setting(
		'percon_options[blog_pagination]',
		array(
			'default'           => false,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'percon_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new Percon_Toggle_Control(
			$wp_customize,
			'percon_options[blog_pagination]',
			array(
				'label'   => esc_html__( 'Blog Pagination:', 'percon' ),
				'type'    => 'ios',
				'section' => 'percon_blog_settings',
			)
		)
	);

	$wp_customize->add_setting(
		'percon_options[blog_related_posts]',
		array(
			'default'           => true,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'percon_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new Percon_Toggle_Control(
			$wp_customize,
			'percon_options[blog_related_posts]',
			array(
				'label'   => esc_html__( 'Display Related Posts:', 'percon' ),
				'type'    => 'ios',
				'section' => 'percon_blog_settings',
			)
		)
	);

	$wp_customize->add_setting(
		'percon_options[blog_posts_navigation]',
		array(
			'default'           => true,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'percon_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new Percon_Toggle_Control(
			$wp_customize,
			'percon_options[blog_posts_navigation]',
			array(
				'label'   => esc_html__( 'Display Posts Navigation:', 'percon' ),
				'type'    => 'ios',
				'section' => 'percon_blog_settings',
			)
		)
	);

	$wp_customize->add_setting(
		'percon_options[blog_archive_search]',
		array(
			'default'           => true,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'percon_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new Percon_Toggle_Control(
			$wp_customize,
			'percon_options[blog_archive_search]',
			array(
				'label'   => esc_html__( 'Display Archive Search Form:', 'percon' ),
				'type'    => 'ios',
				'section' => 'percon_blog_settings',
			)
		)
	);

	if ( class_exists( 'Percon_Customize_Control_Radio_Image' ) ) {

		$wp_customize->add_setting(
			'percon_options[archive_sidebar_dispay]',
			array(
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_key',
				'type'              => 'theme_mod',
				'default'           => 'right',
			)
		);

		$wp_customize->add_control(
			new Percon_Customize_Control_Radio_Image(
				$wp_customize,
				'percon_options[archive_sidebar_dispay]',
				array(
					'label'   => esc_html__( 'Archive Sidebar Layout', 'percon' ),
					'section' => 'percon_blog_settings',
					'choices' => $sidebar_choices,
				)
			)
		);
	}

	if ( class_exists( 'Percon_Customize_Control_Radio_Image' ) ) {

		$wp_customize->add_setting(
			'percon_options[search_sidebar_dispay]',
			array(
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_key',
				'type'              => 'theme_mod',
				'default'           => 'right',
			)
		);

		$wp_customize->add_control(
			new Percon_Customize_Control_Radio_Image(
				$wp_customize,
				'percon_options[search_sidebar_dispay]',
				array(
					'label'   => esc_html__( 'Search Sidebar Layout', 'percon' ),
					'section' => 'percon_blog_settings',
					'choices' => $sidebar_choices,
				)
			)
		);
	}

	if ( class_exists( 'Percon_Customize_Control_Radio_Image' ) ) {

		$wp_customize->add_setting(
			'percon_options[single_post_sidebar_dispay]',
			array(
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_key',
				'type'              => 'theme_mod',
				'default'           => 'right',
			)
		);

		$wp_customize->add_control(
			new Percon_Customize_Control_Radio_Image(
				$wp_customize,
				'percon_options[single_post_sidebar_dispay]',
				array(
					'label'   => esc_html__( 'Single Post Sidebar Layout', 'percon' ),
					'section' => 'percon_blog_settings',
					'choices' => $sidebar_choices,
				)
			)
		);
	}

	/**
	 * Percon WordPress Theme Footer
	 */
	$wp_customize->add_section(
		'percon_footer',
		array(
			'title'    => esc_html__( 'Footer Settings', 'percon' ),
			'priority' => 20,
		)
	);

	$wp_customize->add_setting(
		'percon_options[footer_widgets_status]',
		array(
			'default'           => true,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'percon_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new Percon_Toggle_Control(
			$wp_customize,
			'percon_options[footer_widgets_status]',
			array(
				'label'   => esc_html__( 'Display Footer Widgets Section:', 'percon' ),
				'type'    => 'ios',
				'section' => 'percon_footer',
			)
		)
	);

	$wp_customize->add_setting(
		'percon_options[footer_top_btn_status]',
		array(
			'default'           => true,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'percon_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new Percon_Toggle_Control(
			$wp_customize,
			'percon_options[footer_top_btn_status]',
			array(
				'label'   => esc_html__( 'Go Top Button:', 'percon' ),
				'type'    => 'ios',
				'section' => 'percon_footer',
			)
		)
	);

	$wp_customize->add_setting(
		'percon_options[footer_instagram_status]',
		array(
			'default'           => false,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new Percon_Toggle_Control(
			$wp_customize,
			'percon_options[footer_instagram_status]',
			array(
				'label'   => esc_html__( 'Display Instagram:', 'percon' ),
				'type'    => 'ios',
				'section' => 'percon_footer',
			)
		)
	);

	$wp_customize->add_setting(
		'percon_options[footer_instagram_username]',
		array(
			'default'           => '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'percon_sanitize_html',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'percon_options[footer_instagram_username]',
		array(
			'label'   => esc_html__( 'Instagram Username:', 'percon' ),
			'type'    => 'text',
			'section' => 'percon_footer',
		)
	);

	$wp_customize->add_setting(
		'percon_options[footer_copyright_text]',
		array(
			'default'           => 'Percon - Copyright 2018. All Right Reserved. Design by <a target="_blank" href="http://tortoiz.com/">Tortoiz</a>.',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'percon_sanitize_html',
			'capability'        => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'percon_options[footer_copyright_text]',
		array(
			'label'   => esc_html__( 'Footer Copyright Text:', 'percon' ),
			'type'    => 'text',
			'section' => 'percon_footer',
		)
	);

	/**
	 * End Percon WordPress Theme Footer Control Panel
	 */
}
add_action( 'customize_register', 'percon_customize_register' );
