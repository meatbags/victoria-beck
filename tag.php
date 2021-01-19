<?php get_header(); ?>

<?php
	single_tag_title();
	
	if (have_posts()) {
		while (have_posts()) : the_post();
		
		// do stuff
		
		endwhile;
	}
?>

<?php get_footer(); ?>