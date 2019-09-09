<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @version    2.6.1
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
get_template_part( '/inc/tgmpa/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'percon_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 */
function percon_register_required_plugins() {
	$plugins = array(
		array(
			'name'     => 'Contact Form 7',
			'slug'     => 'contact-form-7',
			'required' => false,
		),
		array(
			'name'     => 'Jetpack',
			'slug'     => 'jetpack',
			'required' => false,
		),
		array(
			'name'     => 'Recent Tweets Widget',
			'slug'     => 'recent-tweets-widget',
			'required' => false,
		),
		array(
			'name'     => 'Social Icons Widget',
			'slug'     => 'social-icons-widget-by-wpzoom',
			'required' => false,
		),
		array(
			'name'     => 'Heart Button',
			'slug'     => 'heart-this',
			'required' => false,
		),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 */
	$config = array(
		'id'           => 'percon',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}
