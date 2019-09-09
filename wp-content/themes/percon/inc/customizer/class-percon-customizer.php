<?php
/**
 * Customizer functionality for the theme.
 *
 * @package Percon
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Percon_Customizer' ) ) {
	/**
	 * The Percon Customizer Settings
	 */
	class Percon_Customizer {
		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			//add customizer settings control
			add_filter( 'percon_filter_features', array( $this, 'percon_filter_features' ) );

			//includes all files of controls
			add_action( 'after_setup_theme', array( $this, 'percon_include_features' ), 0 );

			//Include JS Controls Types
			add_action( 'customize_register', array( $this, 'percon_register_control_types' ), 0 );

			//Include Preview Unit JS
			add_action( 'customize_preview_init', array( $this, 'percon_customize_preview_js' ) );

			//Include Controls Scripts
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'percon_panels_js' ) );
		}

		/**
		 * Filter The customizer Panel.
		 * @since 1.0
		 */
		public function percon_filter_features( $array ) {
			$files_to_load = array(
				'typography/typography-settings',
				'customizer-toggle-control/class-percon-toggle-control',
				'customizer-radio-image/class/class-percon-customize-control-radio-image',
				'customizer-alpha-color-picker/class-percon-customize-alpha-color-control',
				'customizer-repeater/class/class-percon-customizer-repeater-control',
			);

			return array_merge(
				$array,
				$files_to_load
			);
		}

		/**
		 * Include All files.
		 *
		 * @since Percon 1.0
		 */
		public function percon_include_features() {
			$percon_allowed_phps = array();
			$percon_allowed_phps = apply_filters( 'percon_filter_features', $percon_allowed_phps );
			foreach ( $percon_allowed_phps as $file ) {
				$percon_file_to_include = get_template_part( '/inc/customizer/' . $file );
			}
		}

		/**
		 * Register JS control types.
		 *
		 * @since  1.0
		 * @access public
		 * @return void
		 */
		public function percon_register_control_types( $wp_customize ) {
			get_template_part( 'inc/customizer/customizer-range-value/class/class-percon-customizer-range-value-control' );
			get_template_part( 'inc/customizer/customizer-select-multiple/class/class-percon-select-multiple' );
			get_template_part( 'inc/customizer/customizer-dimensions/class-percon-customizer-dimensions-control' );

			// Register JS control types.
			$wp_customize->register_control_type( 'Percon_Select_Multiple' );
			$wp_customize->register_control_type( 'Percon_Customizer_Dimensions_Control' );
			$wp_customize->register_control_type( 'Percon_Customizer_Range_Value_Control' );
		}

		/**
		 * Customizer Preview Unit JS.
		 *
		 * @since  1.0
		 * @access public
		 * @return void
		 */
		public function percon_customize_preview_js() {
			wp_enqueue_script( 'percon-customize-preview', get_theme_file_uri( '/assets/custom/customize-preview.js' ), array( 'jquery' ), '1.0', true );
		}

		/**
		 * Customizer Controls JS.
		 *
		 * @since  1.0
		 * @access public
		 * @return void
		 */
		public function percon_panels_js() {
			wp_enqueue_script( 'percon-customize-controls', get_theme_file_uri( '/assets/custom/customize-controls.js' ), array( 'jquery' ), '1.0', true );
			wp_enqueue_style( 'percon-customize-controls', get_theme_file_uri( '/assets/custom/customize-control.css' ), null );
		}
	}
}
new Percon_Customizer;
