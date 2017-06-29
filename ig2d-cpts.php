<?php
/*
Plugin Name: CPT NAME HERE
Plugin URI: http://www.igot2design.com
Description: Generates a custom post type.
Version: 1.0
Author: iGot2Design
Author URI: http://www.igot2design.com
License: GPL2
*/

// Register the CPT
function ig2d_foos_cpt() {
	$labels = array(
		'name'               => _x( 'foos', 'post type general name' ),
		'singular_name'      => _x( 'foo', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'foo' ),
		'add_new_item'       => __( 'Add New foo' ),
		'edit_item'          => __( 'Edit foo' ),
		'new_item'           => __( 'New foo' ),
		'all_items'          => __( 'All foos' ),
		'view_item'          => __( 'View foo' ),
		'search_items'       => __( 'Search foos' ),
		'not_found'          => __( 'No foos found' ),
		'not_found_in_trash' => __( 'No foos found in the Trash' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'foos'
		);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our foos and foo specific data',
		'public'        => true,
		'menu_icon'     => 'dashicons-book',
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'revisions' ),
		'has_archive'   => true,
		'rewrite' => array('slug' => 'foos')
		);
	register_post_type( 'foo', $args );
}
add_action( 'init', 'ig2d_foos_cpt' );

//rewrites permalinks rules 
function flush_rewrite_rules() {
	ig2d_foos_cpt();

	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'flush_rewrite_rules' );


// Add custom messages (replaces 'post' with 'foo')
function ig2d_foo_messages( $messages ) {
	global $post, $post_ID;
	$messages['foo'] = array(
		0 => '',
		1 => sprintf( __('foo updated. <a href="%s">View foo</a>'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('foo updated.'),
		5 => isset($_GET['revision']) ? sprintf( __('foo restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('foo published. <a href="%s">View foo</a>'), esc_url( get_permalink($post_ID) ) ),
		7 => __('foo saved.'),
		8 => sprintf( __('foo submitted. <a target="_blank" href="%s">Preview foo</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('foo scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview foo</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('foo draft updated. <a target="_blank" href="%s">Preview foo</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);
return $messages;
}
add_filter( 'post_updated_messages', 'ig2d_foo_messages' );


// foo categories
function ig2d_foo_taxonomies() {
	$labels = array(
		'name'              => _x( 'foo Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'foo Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search foo Categories' ),
		'all_items'         => __( 'All foo Categories' ),
		'parent_item'       => __( 'Parent foo Category' ),
		'parent_item_colon' => __( 'Parent foo Category:' ),
		'edit_item'         => __( 'Edit foo Category' ),
		'update_item'       => __( 'Update foo Category' ),
		'add_new_item'      => __( 'Add New foo Category' ),
		'new_item_name'     => __( 'New foo Category' ),
		'menu_name'         => __( 'foo Categories' ),
		);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'rewrite' => array(
			'slug' => 'foo-category'
			)
		);
	register_taxonomy( 'foo_category', 'foo', $args );
}
add_action( 'init', 'ig2d_foo_taxonomies', 0 );


// Check for custom template files in theme and use files in plugin if they don't exist
function ig2d_foo_template_include($template) {
	if ( is_post_type_archive('foo') || is_tax('foo_category') ) {
		if ( file_exists(get_stylesheet_directory() . '/archive-foo.php') )
			return get_stylesheet_directory() . '/archive-foo.php';
		return plugin_dir_path(__FILE__) . '/archive-foo.php';
	} elseif ( is_singular('foo') ) {
		if ( file_exists(get_stylesheet_directory() . '/single-foo.php') )
			return get_stylesheet_directory() . '/single-foo.php';
		return plugin_dir_path(__FILE__) . '/single-foo.php';
	}
	return $template;
}
add_filter('template_include', 'ig2d_foo_template_include');

?>