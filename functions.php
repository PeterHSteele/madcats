<?php 
//Register main nav menu and footer nav menu
register_nav_menu('primary','main menu');
register_nav_menu('footer','footer menu');

function madcats_scripts(){

	//enqueue main stylesheet
	wp_enqueue_style('madcats-style',get_stylesheet_uri());

	//enqueue script to allow user to customize colors using theme customizer
	wp_register_script('custom_styles',get_template_directory_uri().'/js/customColors.js');
	//enqueue nav-toggle script
	wp_register_script( 'madcats_navigation', get_template_directory_uri() . '/js/navigation.js' );

	$style_array = array(
		'headingColor' => get_theme_mod('heading_color'),
		'headerBackgroundImage' => get_theme_mod('header_background_image'),
		'footerBackgroundImage' => get_theme_mod('footer_background_image')
		);
	wp_localize_script('custom_styles','styles',$style_array);

	//jquery was undefined unless enqueued explicitly for some reason
	wp_enqueue_script('jquery');

	wp_enqueue_script( 'custom_styles', '', array('jquery') );
	wp_enqueue_script( 'madcats_navigation' );

	//enqueue script to allow toggling of modal
	wp_enqueue_script('toggle_modal',get_template_directory_uri().'/js/toggleModal.js',array('jquery'));

	//enqueue script giving headings on longform pages id attributes so they can be navigated
	wp_enqueue_script('add_ids_to_headings',get_template_directory_uri().'/js/addIdsToHeadings.js',array('jquery'));

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

	//customize whether post meta should appear
	$wp_customize->add_setting( 'hide_post_meta', array(
		'default' => false
	));

	$wp_customize->add_control( 'post-meta-display', array(
		'label' => 'Hide post meta',
		'description' => 'Hides meta information (author, date posted, and more ) typically shown on posts by default',
		'section' => 'madcats_customizations',
		'type' => 'checkbox',
		'settings' => 'hide_post_meta',
	));

}

add_action('customize_register','madcats_customize_register');


add_theme_support('post-thumbnails');

function madcats_custom_logo_setup(){
	$defaults = array(
		'height' => 100,
		'width'	 => 100,
		'flex-height' => true,
		'flex-width'  => true
	);

	add_theme_support('custom-logo', $defaults);
}

add_action( 'after_setup_theme', 'madcats_custom_logo_setup');
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

/* Template Tags */

//Theme mod for whether to show post meta

if ( ! function_exists( 'madcats_posted_by' ) ) :
	/**
	* Print the post author's name
	*
	* @since 1.0.0
	*/
	function madcats_posted_by(){
		echo sprintf( 
			'<span>%s<a href=%s>%s</a> </span>',
			__( 'Posted by: ', 'madcats'),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);
	}
endif;

if ( ! function_exists( 'madcats_posted_on' ) ) :
	function madcats_posted_on(){
		echo sprintf( 
			'<span class="post-date" >%1$s <time datetime="%2$s">%3$s</time>. </span>',
			__( 'on', 'madcats' ),
			get_the_date( DATE_WC3 ),
			get_the_date()
		);
	}
endif;

if ( ! function_exists( 'madcats_get_categories' ) ) :
	function madcats_get_categories(){
		$categories = get_the_category();
		$output = '';
		foreach ( $categories as $category ){
			$output .= sprintf( 
				'<a class="madcats-category" href="%s">%s</a><span class="sep"> </span>',
				esc_url( get_category_link( $category->term_id ) ),
				$category->name
			);
		}

		echo sprintf( 
			'<span><i class="fas fa-folder"></i> %s</span>',
			$output
		);
	}
endif;
?>