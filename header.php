<?php ?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title><?php wp_title( '&raquo;', true, 'right' ); bloginfo( 'name' )?></title>
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<?php wp_head(); ?>
</head>
<body <?php body_class() ?>>
<?php wp_body_open() ?>
<div class='container'>
<?php 
	get_header( 'small' );
?>
<header class='large-screen-header'>
	<?php if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	} ?>
	<?php
	if (has_nav_menu('primary')) : ?>
		<nav class="main-navigation">
			<?php 
			wp_nav_menu(
				array(
					'theme_location'=>'primary',
					'menu_class'=>'primary-nav',
				)
			);
			?>
		</nav>
	<?php endif; ?>
	<?php if (is_active_sidebar('below-nav')) {
		dynamic_sidebar('below-nav');
	} 
	?>
</header>