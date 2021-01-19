<?php

// scripts & styles

add_action( 'wp_enqueue_scripts', 'VictoriaBeck_load_scripts' );
function VictoriaBeck_load_scripts()
{
	wp_register_style( 'VictoriaBeckstyle', get_template_directory_uri() . '/lib/build/style.css' );
	wp_enqueue_style( 'VictoriaBeckstyle' );
}
// setup

function VictoriaBeck_setup()
{
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'VictoriaBeck_setup' );

// customise admin

function add_admin_post_types() {
	register_post_type('projects', array(
		'label' => 'Projects',
		'public' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'rewrite' => array('slug' => 'projects'),
		'query_var' => true,
		'menu_icon' => 'dashicons-format-gallery',
		'taxonomies' => array('category', 'post_tag'),
		'supports' => array('title', 'editor', 'revisions', 'thumbnail')
	));

	register_post_type('clients', array(
		'label' => 'Clients',
		'public' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'rewrite' => array('slug' => 'clients'),
		'query_var' => true,
		'menu_icon' => 'dashicons-admin-users',
		'taxonomies' => array('category', 'post_tag'),
		'supports' => array('title', 'editor', 'revisions', 'thumbnail')
	));

	register_post_type('portfolio', array(
		'label' => 'PDF',
		'public' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'rewrite' => array('slug' => 'portfolio'),
		'query_var' => true,
		'menu_icon' => 'dashicons-media-default',
		'taxonomies' => array('category', 'post_tag'),
		'supports' => array('title', 'editor', 'revisions', 'thumbnail')
	));
}
add_action('init', 'add_admin_post_types');

function custom_admin_menu() {
	remove_menu_page( 'edit.php' );
	remove_menu_page( 'edit-comments.php' );
	remove_post_type_support('projects', 'editor');
	remove_post_type_support('portfolio', 'editor');
	remove_post_type_support('clients', 'editor');
}
add_action('admin_menu', 'custom_admin_menu' );

// defaults

add_action( 'comment_form_before', 'VictoriaBeck_enqueue_comment_reply_script' );
function VictoriaBeck_enqueue_comment_reply_script()
{
	if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}

add_filter( 'the_title', 'VictoriaBeck_title' );
function VictoriaBeck_title( $title ) {
	if ( $title == '' ) {
		return '&rarr;';
	} else {
		return $title;
	}
}

add_filter( 'wp_title', 'VictoriaBeck_filter_wp_title' );
function VictoriaBeck_filter_wp_title( $title )
{
	return $title . esc_attr( get_bloginfo( 'name' ) );
}

add_action( 'widgets_init', 'VictoriaBeck_widgets_init' );
function VictoriaBeck_widgets_init()
{
	register_sidebar( array (
		'name' => __( 'Sidebar Widget Area', 'VictoriaBeck' ),
		'id' => 'primary-widget-area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
}

function VictoriaBeck_custom_pings( $comment )
{
	$GLOBALS['comment'] = $comment;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
	<?php
}

add_filter( 'get_comments_number', 'VictoriaBeck_comments_number' );
function VictoriaBeck_comments_number( $count )
{
	if ( !is_admin() ) {
		global $id;
		$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
		return count( $comments_by_type['comment'] );
	} else {
		return $count;
	}
}
