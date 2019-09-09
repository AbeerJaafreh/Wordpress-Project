<?php
/**
 * Percon functions and definitions
 *
 * @package Percon
 * @since 1.0
 */

// Custom template tags for this theme.
require get_parent_theme_file_path( '/inc/functions/template-tags.php' );

// Functions which enhance the theme by hooking into WordPress.
require get_parent_theme_file_path( '/inc/functions/template-functions.php' );

// Customizer additions.
require get_template_directory() . '/inc/tgmpa/tgmpa-init.php';

// Include header, Hooks for template header
require get_parent_theme_file_path( '/inc/frontend/header.php' );

// Include Frontend_Master Class
require get_parent_theme_file_path( '/inc/classes/frontend/class-percon-master.php' );

// Include Backend_Master Class
require get_parent_theme_file_path( '/inc/classes/backend/class-percon-backend-master.php' );

// Include Statci Class
require get_parent_theme_file_path( '/inc/classes/class-percon-static.php' );

// Customizer Basic Settings.
require get_parent_theme_file_path( '/inc/customizer/basic-settings.php' );

// Sanitization Callback.
require get_parent_theme_file_path( '/inc/customizer/sanitize-callback.php' );

// Customizer additions.
require get_parent_theme_file_path( '/inc/customizer/class-percon-customizer.php' );

// Initial Widgets.
require get_parent_theme_file_path( '/inc/widgets/class-percon-recent-posts.php' );
require get_parent_theme_file_path( '/inc/widgets/widgets-init.php' );

// Load Jetpack compatibility file.
require get_parent_theme_file_path( '/inc/functions/jetpack.php' );

// Adding related Posts
require get_parent_theme_file_path( '/inc/functions/related-posts.php' );

// Adding breadcrumb
require get_parent_theme_file_path( '/inc/functions/breadcrumb.php' );

// Adding custom meta boxes
require get_parent_theme_file_path( '/inc/functions/custom-meta-boxes.php' );

// Pagination for posts.
require get_parent_theme_file_path( '/inc/functions/pagination.php' );

// Implement the Custom Comment feature.
require get_parent_theme_file_path( '/inc/functions/custom-comment.php' );


