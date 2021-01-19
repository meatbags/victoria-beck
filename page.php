<?php get_header(); ?>

<?php
	if (has_post_thumbnail()) {
		the_post_thumbnail();
	}
	the_title();
	the_content();
	the_excerpt();
	the_author_posts_link();
	the_tags();
	the_category( '|' )
	get_comments_link();
?>

<?php get_footer(); ?>