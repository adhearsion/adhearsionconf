<?php
/**
 * @package WordPress
 * @subpackage Sideways8: Skeleton
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if gte IE 9 ]><html class="no-js ie9" lang="en"> <![endif]-->

	<title><?php wp_title('|',true,'right'); ?><?php bloginfo('name'); ?></title>

	<meta name="description" content="<?php bloginfo('description'); ?>" />

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Mobile Specific Metas
	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
	================================================== -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/stylesheets/base.css">
	<link rel="stylesheet" href= "<?php echo get_template_directory_uri(); ?>/style.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/stylesheets/layout.css">

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-114x114.png">

	<!-- Fonts
	================================================== -->
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="header-wrapper" class="container container-wrapper">
<div class="container">

	<div class="header">

		<div class="four columns">

			<div class="logo">
				<a href="<?php echo home_url(); ?>" class="">
					<img src="<?php echo get_field('logo', 'options'); ?>"
					alt="<?php echo get_bloginfo('description');?>"
					title="<?php echo get_bloginfo('name');?>"
					class="" />
				</a>
			</div>
		</div>

		<div class="twelve columns omega menu-primary-desktop container-wrapper">
			<div class="header-quote">Building the Voice Applications of Tomorrow</div> 
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			<div style="clear: both"></div>
		</div>

	</div><!--header-->

</div><!--container-->
</div><!--header-wrapper-->

<div id="content-wrapper" class="container container-wrapper<?php if (is_front_page()) { echo ' frontpage'; }?>">
<div class="container">
	<div id="menu-primary-mobile">
		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
	</div>