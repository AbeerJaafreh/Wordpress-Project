<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( esc_html__( 'Direct access forbidden.', 'percon' ) );
}

if ( ! class_exists( 'Percon_Static' ) ) :
	class Percon_Static {

		/**
		 * Allow HTML tag from escaping HTML
		 *
		 * @return void
		 * @since v1.0
		 */
		public static function html_allow() {
			return array(
				'a'      => array(
					'href'  => array(),
					'title' => array(),
				),
				'br'     => array(),
				'del'    => array(),
				'span'   => array(),
				'em'     => array(),
				'strong' => array(),
				'h1'     => array(
					'class' => array(),
					'id'    => array(),
				),
				'h2'     => array(
					'class' => array(),
					'id'    => array(),
				),
				'h3'     => array(
					'class' => array(),
					'id'    => array(),
				),
				'h4'     => array(
					'class' => array(),
					'id'    => array(),
				),
				'h5'     => array(
					'class' => array(),
					'id'    => array(),
				),
				'h6'     => array(
					'class' => array(),
					'id'    => array(),
				),
				'div'    => array(
					'class' => array(),
					'id'    => array(),
				),
				'p'      => array(
					'class' => array(),
					'id'    => array(),
				),
			);
		}

	}

	// Removing this line is like not having a functions.php file
	new Percon_Static;

endif;
