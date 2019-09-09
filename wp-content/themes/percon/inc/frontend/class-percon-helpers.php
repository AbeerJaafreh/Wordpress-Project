<?php
/**
 * Theme Helpers
 *
 * @package Percon
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Percon_Helpers' ) ) {
	/**
	 * The Percon Helpers
	 */
	class Percon_Helpers {

		public function __construct() {
			//Print Theme Colors
			$this->percon_color();

			//Print Main Colors
			$this->percon_other_colors();

			//Spacing Elements
			$this->percon_spaing_elements();

			//Header Color Background and styles
			$this->percon_backgound_image_cover_bg();
		}
		/**
		 * Hexa to RGBA Convector
		 *
		 * @package Percon
		 * @since 1.0
		 */
		private function percon_hex_2_rgba( $color, $opacity = false ) {
			$default = 'rgb(0,0,0)';
			//Return default if no color provided
			if ( empty( $color ) ) {
				return $default;
			}

			//Sanitize $color if "#" is provided
			if ( '#' == $color[0] ) {
				$color = substr( $color, 1 );
			}

			//Check if color has 6 or 3 characters and get values
			if ( strlen( $color ) == 6 ) {
				$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
			} elseif ( strlen( $color ) == 3 ) {
				$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
			} else {
				return $default;
			}

			//Convert hexadec to rgb
			$rgb = array_map( 'hexdec', $hex );

			//Check if opacity is set(rgba or rgb)
			if ( $opacity ) {
				if ( abs( $opacity ) > 1 ) {
					$opacity = 1.0;
				}
				$output = 'rgba(' . implode( ',', $rgb ) . ',' . $opacity . ')';
			} else {
				$output = 'rgb(' . implode( ',', $rgb ) . ')';
			}

			//Return rgb(a) color string
			return $output;
		}

		/**
		 * Theme Colors
		 *
		 * @package Percon
		 * @since 1.0
		 */
		public function percon_color() {
			$percon_color = percon_get_options( array( 'theme_color', '#ef8354' ) );
			?>
			::selection {
				background: <?php echo esc_attr( $percon_color ); ?> none repeat scroll 0 0;
				color: #fff;
			}
			*::-moz-selection {
				background: <?php echo esc_attr( $percon_color ); ?> none repeat scroll 0 0;
				color: #fff;
			}
			a,
			a:hover,
			.post-sticky i,
			.post-entry .post-details .post-meta a,
			.sidebar .widget ul li a:hover,
			.footer-widgets .widget ul li a:hover,
			.post-entry .post-more-link,
			.post-entry .post-details .post-meta,
			.sidebar .recent-posts-widget ul li time,
			.footer .recent-posts-widget ul li time,
			#breadcrumb .current,
			.comments-area .comment-reply-link,
			.comments-area .comment-edit-link,
			.comments-area .media-body .comment-time,
			#wp-calendar #prev a:hover,
			#wp-calendar #next a:hover,
			#calendar_wrap #today,
			.error-404.not-found h1,
			.flex-caption .cat-links a {
				color: <?php echo esc_attr( $percon_color ); ?>
			}
			.flexslider .flex-direction-nav a:hover,
			.post-sharing div.sharedaddy .sd-social-icon .sd-content ul li[class*='share-'] a:hover,
			.flex-caption .caption-button a,
			.site-content .btn-primary,
			.post-entry .post-image.video:before,
			.searchform .search-submit,
			.pagination li a:hover,
			.pagination li.active a,
			input[type="button"],
			input[type="reset"],
			input[type="submit"],
			.site-content .btn-outline-primary:hover,
			.header .social-item li a:hover {
				background-color: <?php echo esc_attr( $percon_color ); ?>
			}
			.flexslider .flex-control-paging li a,
			.site-content .btn-primary,
			.flexslider .flex-control-paging li a.flex-active {
				border-color: <?php echo esc_attr( $percon_color ); ?>
			}

			<?php
		} // end percon_color function

		/**
		 * Other Colors
		 *
		 * @package Percon
		 * @since 1.0
		 */
		public function percon_other_colors() {
				$header_text_color           = get_theme_mod( 'header_textcolor' );
				$main_menu_color             = percon_get_options( array( 'main_menu_color', '#1b1b1b' ) );
				$menu_hover_color            = percon_get_options( array( 'menu_hover_color', '#ef8354' ) );
				$menu_submenu_bg             = percon_get_options( array( 'dropdown_menu_bg', '#ffffff' ) );
				$menu_submenu_color          = percon_get_options( array( 'dropdown_menu_color', '#1b1b1b' ) );
				$menu_submenu_bg_hover_color = percon_get_options( array( 'dropdown_menu_hover_bg_color', '#ef8354' ) );

			if ( ! empty( $header_text_color ) ) {
				$head_text_color = $header_text_color;
			} else {
				$head_text_color = '000000';
			}
			?>

				.site-branding-text .site-title,
				.site-branding-text .site-title a,
				.site-branding-text .site-description {
					color: #<?php echo esc_attr( $head_text_color ); ?>
				}
				.navigation .stellarnav li a {
					color: <?php echo esc_attr( $main_menu_color ); ?>
				}
				.navigation .stellarnav .sub-menu li a {
					color: <?php echo esc_attr( $menu_submenu_color ); ?>
				}
				.navigation .stellarnav ul ul {
					background-color: <?php echo esc_attr( $menu_submenu_bg ); ?>
				}
				.navigation .stellarnav li.current_page_item a,
				.navigation .stellarnav>ul>li>a:hover {
					color: <?php echo esc_attr( $menu_hover_color ); ?>
				}
				.navigation .stellarnav ul ul li a:hover {
					background-color: <?php echo esc_attr( $menu_submenu_bg_hover_color ); ?>
				}
			<?php
		}

		/**
		 * Theme Spacing Element
		 *
		 * @package Percon
		 * @since 1.0
		 */
		public function percon_spaing_elements() {
			//Blog Wrapper Padding
			$blog_wrap_desktop_top    = percon_get_options( array( 'top_padding', 195 ) );
			$blog_wrap_desktop_bottom = percon_get_options( array( 'bottom_padding', 135 ) );
			$blog_wrap_tablet_top     = percon_get_options( array( 'tablet_top_padding', 195 ) );
			$blog_wrap_tablet_bottom  = percon_get_options( array( 'tablet_bottom_padding', 135 ) );

			$blog_wrap_mobile_top    = percon_get_options( array( 'mobile_top_padding', 175 ) );
			$blog_wrap_mobile_bottom = percon_get_options( array( 'mobile_bottom_padding', 135 ) );

			//Logo Padding
			$logo_desktop_top    = percon_get_options( array( 'logo_top_padding', 20 ) );
			$logo_desktop_bottom = percon_get_options( array( 'logo_bottom_padding', 20 ) );

			$logo_tablet_top    = percon_get_options( array( 'logo_tablet_top_padding', 20 ) );
			$logo_tablet_bottom = percon_get_options( array( 'logo_tablet_bottom_padding', 20 ) );

			$logo_mobile_top    = percon_get_options( array( 'logo_mobile_top_padding', 20 ) );
			$logo_mobile_bottom = percon_get_options( array( 'logo_mobile_bottom_padding', 20 ) );

			$css                        = '';
			$content_padding_css        = '';
			$tablet_content_padding_css = '';
			$mobile_content_padding_css = '';
			$logo_desktop_padding_css   = '';
			$logo_tablet_padding_css    = '';
			$logo_mobile_padding_css    = '';

			// Content top padding
			if ( isset( $blog_wrap_desktop_top ) && '' != $blog_wrap_desktop_top ) {
				$content_padding_css .= 'padding-top:' . $blog_wrap_desktop_top . 'px;';
			}

			// Content bottom padding
			if ( isset( $blog_wrap_desktop_bottom ) && '' != $blog_wrap_desktop_bottom ) {
				$content_padding_css .= 'padding-bottom:' . $blog_wrap_desktop_bottom . 'px;';
			}

			// Content padding css
			if ( isset( $blog_wrap_desktop_top ) && '' != $blog_wrap_desktop_top
				|| isset( $blog_wrap_desktop_bottom ) && '' != $blog_wrap_desktop_bottom ) {
				$css .= '.blog-page-block {' . $content_padding_css . '}';
			}

			// Tablet content top padding
			if ( isset( $blog_wrap_tablet_top ) && '' != $blog_wrap_tablet_top ) {
				$tablet_content_padding_css .= 'padding-top:' . $blog_wrap_tablet_top . 'px;';
			}

			// Tablet content bottom padding
			if ( isset( $blog_wrap_tablet_bottom ) && '' != $blog_wrap_tablet_bottom ) {
				$tablet_content_padding_css .= 'padding-bottom:' . $blog_wrap_tablet_bottom . 'px;';
			}

			// Tablet content padding css
			if ( isset( $blog_wrap_tablet_top ) && '' != $blog_wrap_tablet_top
				|| isset( $blog_wrap_tablet_bottom ) && '' != $blog_wrap_tablet_bottom ) {
				$css .= '@media (max-width: 768px){.blog-page-block {' . $tablet_content_padding_css . '}}';
			}

			// Mobile content top padding
			if ( isset( $blog_wrap_mobile_top ) && '' != $blog_wrap_mobile_top ) {
				$mobile_content_padding_css .= 'padding-top:' . $blog_wrap_mobile_top . 'px;';
			}

			// Mobile content bottom padding
			if ( isset( $blog_wrap_mobile_bottom ) && '' != $blog_wrap_mobile_bottom ) {
				$mobile_content_padding_css .= 'padding-bottom:' . $blog_wrap_mobile_bottom . 'px;';
			}

			// Mobile content padding css
			if ( isset( $blog_wrap_mobile_bottom ) && '' != $blog_wrap_mobile_bottom
				|| isset( $mobile_content_bottom_padding ) && '' != $mobile_content_bottom_padding ) {
				$css .= '@media (max-width: 480px){.blog-page-block{' . $mobile_content_padding_css . '}}';
			}

			//logo top padding
			if ( isset( $logo_tablet_top ) && '' != $logo_tablet_top ) {
				$logo_desktop_padding_css .= 'padding-top:' . $logo_tablet_top . 'px;';
			}

			//logo bottom padding
			if ( isset( $logo_desktop_bottom ) && '' != $logo_desktop_bottom ) {
				$logo_desktop_padding_css .= 'padding-bottom:' . $logo_desktop_bottom . 'px;';
			}

			// logo padding css
			if ( isset( $logo_desktop_top ) && '' != $logo_desktop_top
				|| isset( $logo_desktop_bottom ) && '' != $logo_desktop_bottom ) {
				$css .= '.site-header .site-logo {' . $logo_desktop_padding_css . '}';
			}

			//logo tablet top padding
			if ( isset( $logo_tablet_top ) && '' != $logo_tablet_top ) {
				$logo_tablet_padding_css .= 'padding-top:' . $logo_tablet_top . 'px;';
			}

			//logo tablet bottom padding
			if ( isset( $logo_tablet_bottom ) && '' != $logo_tablet_bottom ) {
				$logo_tablet_padding_css .= 'padding-bottom:' . $logo_tablet_bottom . 'px;';
			}

			// logo tablet padding css
			if ( isset( $logo_tablet_top ) && '' != $logo_tablet_top
				|| isset( $logo_tablet_bottom ) && '' != $logo_tablet_bottom ) {
				$css .= '@media (max-width: 768px){ .site-header .site-logo {' . $logo_tablet_padding_css . '}}';
			}

			//logo tablet top padding
			if ( isset( $logo_mobile_top ) && '' != $logo_mobile_top ) {
				$logo_mobile_padding_css .= 'padding-top:' . $logo_mobile_top . 'px;';
			}

			//logo tablet bottom padding
			if ( isset( $logo_mobile_bottom ) && '' != $logo_mobile_bottom ) {
				$logo_mobile_padding_css .= 'padding-bottom:' . $logo_mobile_bottom . 'px;';
			}

			// logo tablet padding css
			if ( isset( $logo_mobile_top ) && '' != $logo_mobile_top
				|| isset( $logo_mobile_bottom ) && '' != $logo_mobile_bottom ) {
				$css .= '@media (max-width: 480px){ .site-header .site-logo {' . $logo_mobile_padding_css . '}}';
			}

			// Return CSS
			if ( ! empty( $css ) ) {
				echo esc_attr( $css );
			}
		}

		/**
		 * Theme Background Colors
		*
		* @package Percon
		* @since 1.0
		*/
		public function percon_backgound_image_cover_bg() {
			?>

			<?php if ( has_header_image() ) { ?>
				.header.custom-header {
					background: url(<?php echo esc_url( get_header_image() ); ?>) no-repeat center center;
				}
			<?php } ?>
			<?php
		}


	}
}

new Percon_Helpers;
