
<!DOCTYPE html>

<!-- made by xavier-burrow.com -->

<html lang="en">
<head>
	<meta charset="utf-8" />
	<title><?php wp_title(); ?></title>
	<meta name="description" content="<?php bloginfo(); ?>">
	<meta name="keywords" content="">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/lib/icons/favicon.png">
	<?php wp_head(); ?>

	<script type="text/javascript">
		var siteUrl = "<?php echo get_site_url(); ?>";
		var baseUrl = "<?php echo get_template_directory_uri(); ?>/";
	</script>

	<script
  	src="https://code.jquery.com/jquery-3.2.1.min.js"
  	integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  	crossorigin="anonymous"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/lib/build/victoriabeck.min.js"></script>
</head>
<body <?php body_class(); ?>>

<?php
	get_template_part("loading");
	get_template_part("analytics");
	get_template_part('nav');
?>

<div class='content'>
