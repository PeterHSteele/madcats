<?php
/**
* Customizer Functionality
*
* @package WordPress
* @subpackage madcats
* @since 1.0.0
*/

function madcats_customize_register( $wp_customize ){

	//add new theme-specific section to customizer
	$wp_customize->add_section('madcats_customizations',array(
		'title'=>'Madcats Customizations',
		'description'=>'Manage custom images and colors for your site\'s version of the madcats theme.'
		)
	);

	//allow user to customize h1 color
	/*
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
	*/
	//allow 404 page customization
	$wp_customize->add_setting( '404_image', array(
		'default' => null
	) );


	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize,
		'404_image',
		array(
			'label'   => __( '404 page image' , 'madcats' ),
			'section' => 'madcats_customizations',
			'setting' => '404_image'
		)
	) );

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

	$wp_customize->add_setting( 'madcats-contact-form', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'madcats-contact-form', array(
		'label' => 'Contact Form Shorcode',
		'description' => 'shortcode for a contact form.',
		'section' => 'madcats_customizations',
		'type' => 'text',
		'settings' => 'madcats-contact-form',
	));

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

	//Customize Feature Page
	$wp_customize->add_setting( 'madcats-featured-banner', array(
		'default' => ''
	) );

	$wp_customize->add_section( 'madcats-featured', array(
		'title' => __( 'Madcats Feature Page' , 'madcats' ),
		'description' => __( 'Feature page Settings' , 'madcats' ),
		'priority' => 10,
		'active_callback' => 'madcats_is_featured'
	) );
	
	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize,
		'madcats-featured-banner', 
		array(
			'label' => __( 'Banner Image', 'madcats' ),
			'description' => __( 'The featured image' , 'madcats' ),
			'section' => 'madcats-featured',
			'setting' => 'madcats-featured-banner'
		)
	));

	$wp_customize->add_setting( 'banner-text', array(
		'default' => ''
	) );

	$wp_customize->add_control( 'banner-overlay', array(
		'label' => __( 'Banner Text', 'madcats' ),
		'description' => __( 'text to overlay on top of banner image at top of page' , 'madcats' ),
		'section' => 'madcats-featured',
		'type' => 'textarea',
		'settings' => 'banner-text',
	) );

	$wp_customize->add_setting( 'banner-heading', array(
		'default' => ''
	) );

	$wp_customize->add_control( 'banner-heading', array(
		'label' => __( 'Banner Heading', 'madcats' ),
		'description' => __( 'heading to overlay on top of banner image at top of page' , 'madcats' ),
		'section' => 'madcats-featured',
		'type' => 'text',
		'settings' => 'banner-heading',
	));
	//call to action button link
	$wp_customize->add_setting( 'banner-cta-button-link', array(
		'default' => ''
	) );

	$wp_customize->add_control( 'banner-cta-button-link', array(
		'label' => __( 'Banner Call to Action Link', 'madcats' ),
		'description' => __( 'Link for call to action button' , 'madcats' ),
		'section' => 'madcats-featured',
		'type' => 'text',
		'settings' => 'banner-cta-button-link',
	) );
	//call to action button text
	$wp_customize->add_setting( 'banner-cta-button-text', array(
		'default' => ''
	) );

	$wp_customize->add_control( 'banner-cta-button-text', array(
		'label' => __( 'Banner Call to Action Text', 'madcats' ),
		'description' => __( 'Text for call to action button. Will only show up if call to action link is specified.' , 'madcats' ),
		'section' => 'madcats-featured',
		'type' => 'text',
		'settings' => 'banner-cta-button-text',
	) );
	//setting and control for posts to add to slider
	$wp_customize->add_setting( 'slider-posts', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'slider-posts', array(
		'label' => __( 'Posts to include in slider', 'madcats' ),
		'description' => __( 'Comma-separated list of Post Id\'s.', 'madcats' ),
		'section' => 'madcats-featured',
		'type' => 'text',
		'settings' => 'slider-posts',
	) );
	//second banner image
	$wp_customize->add_setting( 'madcats-featured-banner-2', array(
		'default' => ''
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize,
		'madcats-featured-banner-2',
		array(
			'label' => __( 'Banner Image 2.', 'madcats' ),
			'description' => __( 'image to act as spacer between sections', 'madcats' ),
			'section' => 'madcats-featured',
			'setting' => 'madcats-featured-banner-2'
		)
	));
	//post to display over second banner image
	$wp_customize->add_setting( 'madcats-banner-overlay-2', array(
		'default' => '',
	) );

	$wp_customize->add_control( 'madcats-banner-overlay-2', array(
		'type' => 'number',
		'description' => __( 'post content to overlay second banner section', 'madcats' ),
		'label' => __( 'Second Banner Overlay', 'madcats' ),
		'settings' => 'madcats-banner-overlay-2',
		'section' => 'madcats-featured'
	) );
	//setting and control for posts to add to breadcrumbs
	$wp_customize->add_setting( 'breadcrumb-posts', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'breadcrumb-posts', array(
		'label' => __( 'Posts to include in breadcrumbs', 'madcats' ),
		'description' => __( 'Comma-separated list of Post Id\'s.', 'madcats' ),
		'section' => 'madcats-featured',
		'type' => 'text',
		'settings' => 'breadcrumb-posts',
	) );

	//background image for 'featured-widgets-1' sidebar (which is really a section)
	$wp_customize->add_setting( 'feature-widget-background', array(
		'default' => '',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize,
		'feature-widget-background', 
		array(
			'label' => __( 'Widget Area Background Image', 'madcats' ),
			'description' => __( 'Image for parallax display behind the widget section', 'madcats' ),
			'section' => 'madcats-featured',
			'setting' => 'feature-widget-background'
		)
	));
}

add_action( 'customize_register', 'madcats_customize_register');

function madcats_is_featured(){
	return is_page_template( 'page-templates/feature.php' );
}