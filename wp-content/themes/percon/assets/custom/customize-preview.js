/**
 * File customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */
(function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		});
	});

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		});
	});

	// Header search form
	wp.customize( 'percon_options[header_search_form_status]', function( value ) {
		value.bind( function( to ) {
			if( to ) {
				$( '.header .header-search-form' ).css({'display': 'block'});
			} else {
				$( '.header .header-search-form' ).css({'display': 'none'});
			}
		});
	});

	// Header social icons
	wp.customize( 'percon_options[socials_status]', function( value ) {
		value.bind( function( to ) {
			if( to ) {
				$( '.header .social-item' ).css({'display': 'block'});
			} else {
				$( '.header .social-item' ).css({'display': 'none'});
			}
		});
	});

	wp.customize( 'percon_options[logo_margin_top]', function( value ) {
		value.bind( function( to ) {
			$( '.navbar-header .logo' ).css({'margin-top': ''+to+'px'});
		});
	});

	wp.customize( 'percon_options[logo_margin_bottom]', function( value ) {
		value.bind( function( to ) {
			$( '.navbar-header .logo' ).css({'margin-bottom': ''+to+'px'});
		});
	});

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			$( '.site-branding-text .site-title, .site-branding-text .site-title a, .site-branding-text .site-description' ).css({
				color: to
			});
		});
	});

	// blog Grid
	wp.customize( 'percon_options[dropdown_menu_bg]', function( value ) {
		value.bind( function( to ) {
			$( '.navigation .stellarnav ul ul' ).css({'background': ''+to+''});
		});
	});

	wp.customize( 'percon_options[menu_color]', function( value ) {
		value.bind( function( to ) {
			$( '.navigation .stellarnav li a' ).css({'color': ''+to+''});
		});
	});

	wp.customize( 'percon_options[dropdown_menu_color]', function( value ) {
		value.bind( function( to ) {
			$( '.navigation .stellarnav .sub-menu li a' ).css({'color': ''+to+''});
		});
	});

	wp.customize( 'percon_options[menu_hover_color]', function( value ) {
		value.bind( function( to ) {
			$( '.navigation .stellarnav li.current_page_item a, .navigation .stellarnav>ul>li>a:hover' ).css({'color': ''+to+''});
		});
	});

	// Footer Background

	wp.customize( 'percon_options[footer_copyright_text]', function( value ) {
		value.bind( function( to ) {
			$( 'footer.sub-footer .site-info' ).html( to );
		});
	});


	//Logo Padding
	wp.customize("percon_options[logo_top_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-percon_logo_top_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-percon_logo_top_padding">.header .logo { padding-top: ' + to + "px; }</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("percon_options[logo_bottom_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-percon_logo_bottom_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-percon_logo_bottom_padding">.header .logo { padding-bottom: ' + to + "px; }</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("percon_options[logo_tablet_top_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-percon_logo_tablet_top_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-percon_logo_tablet_top_padding">@media (max-width: 768px){ .header .logo { padding-top: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("percon_options[logo_tablet_bottom_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-percon_logo_tablet_bottom_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-percon_logo_tablet_bottom_padding">@media (max-width: 768px){ .header .logo { padding-bottom: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("percon_options[logo_mobile_top_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-percon_logo_mobile_top_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-percon_logo_mobile_top_padding">@media (max-width: 480px){ .header .logo { padding-top: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	wp.customize("percon_options[logo_mobile_bottom_padding]", function( value ) {
		value.bind( function( to ) {
			var $child = $(".customizer-percon_logo_mobile_bottom_padding");
			if (to) {
				/** @type {string} */
				var img = '<style class="customizer-percon_logo_mobile_bottom_padding">@media (max-width: 480px){ .header .logo { padding-bottom: ' + to + "px; }}</style>";
				if ($child.length) {
					$child.replaceWith(img);
				} else {
					$("head").append(img);
				}
			} else {
				$child.remove();
			}
		});
	});

	//End Logo Padding

} )( jQuery );
