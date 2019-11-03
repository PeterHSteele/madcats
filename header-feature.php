<?php ?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" type="text/css" href="js/slick-1.8.1/slick/slick.css"/>
	<title><?php wp_title( '&raquo;', true, 'right' ); bloginfo( 'name' )?></title>
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<?php wp_head(); ?>
</head>
<body <?php body_class() ?>>
<?php 

//print_r( is_page_template( 'page-templates/feature.php' ) );?>