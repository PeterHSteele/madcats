<?php 
//Register main nav menu and footer nav menu
register_nav_menu('primary','main menu');
register_nav_menu('footer','footer menu');

function madcats_scripts(){

	//enqueue main stylesheet
	wp_enqueue_style('madcats-style',get_stylesheet_uri());

	//enqueue script to allow user to customize colors using theme customizer
	wp_register_script('custom_styles',get_template_directory_uri().'/js/customColors.js');

	$style_array = array(
		'headingColor' => get_theme_mod('heading_color'),
		'headerBackgroundImage' => get_theme_mod('header_background_image'),
		'footerBackgroundImage' => get_theme_mod('footer_background_image')
		);
	wp_localize_script('custom_styles','styles',$style_array);

	//jquery was undefined unless enqueued explicitly for some reason
	wp_enqueue_script('jquery');

	wp_enqueue_script('custom_styles','',array('jquery'));

	//enqueue script to allow toggling of modal
	wp_enqueue_script('toggle_modal',get_template_directory_uri().'/js/toggleModal.js',array('jquery'));

	//enqueue script giving headings on longfrom pages id attributes so they can be navigated
	//wp_enqueue_script('add_ids_to_headings',get_template_directory_uri().'/js/addIdsToHeadings.js',array('jquery'));

}

add_action('wp_enqueue_scripts','madcats_scripts');

function init_widgets(){

	register_sidebar(array(
		"name"=>"Below Nav Widgets",
		"id"=>"below-nav",
		"before_widget"=>"<div class='nav-widgets'>",
		"after_widget"=>"</div>",
		"before_title"=>"<h2 class='widgets'>",
		"after_title"=>"</h2>"
	));

	register_sidebar(array(
		"name"=>"footer_widgets",
		"id"=>"footer_widgets",
		"before_widget"=>"<div class='footer-widgets'>",
		"after_widget"=>"</div>"
		)
	);

}

add_action('widgets_init','init_widgets');

function madcats_customize_register( $wp_customize ){

	//add new theme-specific section to customizer
	$wp_customize->add_section('madcats_customizations',array(
		'title'=>'Madcats Customizations',
		'description'=>'Manage custom images and colors for your site\'s version of the madcats theme.'
		)
	);

	//allow user to customize h1 color
	$wp_customize->add_setting('heading_color',array(
		'default'=>'#e27c22',
		'sanitize_callback'=>'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'heading_color',
			array(
				'label' => __('Heading Color','madcats'),
				'section' => 'madcats_customizations',
				'setting' => 'heading_color'
			)
		)
	);

	//allow user to customize background image for header
	$wp_customize->add_setting('header_background_image',array(
		'default'=>'none',
	));

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'header_background_image',
			array(
				'label'=>'Header Background Image',
				'section'=>'madcats_customizations',
				'setting'=>'header-background-image'
			)
		)
	);

	//allow user to customize background image for footer
	$wp_customize->add_setting('footer_background_image',array(
			'default'=>'none'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'footer_background_image',
			array(
				'label'=>'Footer Background Image',
				'section'=>'madcats_customizations',
				'setting'=>'footer_background_image'
			)
		)
	);

}

add_action('customize_register','madcats_customize_register');


add_theme_support('post-thumbnails');
/*
$defaults = array(
    'default-color'          => '',
    'default-image'          => '',
    'default-repeat'         => '',
    'default-position-x'     => '',
    'default-attachment'     => '',
    'wp-head-callback'       => '_custom_background_cb',
    'admin-head-callback'    => '',
    'admin-preview-callback' => ''
);
add_theme_support( 'custom-background', $defaults );

function remove_admin_login_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_admin_login_header');


*/

?>