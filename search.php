<?php get_header(); ?>
<?php
	echo "Search " . get_search_query();
	if (have_posts()) {
		while (have_posts()) : the_post();
		
		// do stuff
		
		endwhile;
	} else {
		echo "Nothing found.";
		get_search_form();
	}
?>
<?php get_footer(); ?>