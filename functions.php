<?php 
//Register main nav menu and footer nav menu
register_nav_menu('primary','main menu');
register_nav_menu('footer','footer menu');

function madcats_scripts(){

	//enqueue main stylesheet
	wp_enqueue_style('madcats-style',get_stylesheet_uri());

	//enqueue stylesheet for sidebar-right layout
	if ( is_page_template( 'page-templates/sidebar-right.php' ) ){
		wp_enqueue_style( 'sidebar-right-style', get_stylesheet_directory_uri() . '/layouts/sidebar-right.css' );
	} 

	//enqueue script for feature layout
	if ( is_page_template( 'page-templates/feature.php' ) ){
		wp_enqueue_style( 'slick-style' , get_stylesheet_directory_uri() . '/js/slick/slick.css');
		wp_enqueue_script( 'slick-script', get_stylesheet_directory_uri() . '/js/slick/slick.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'slider-script', get_stylesheet_directory_uri() . '/js/slider.js', array( 'jquery', 'slick-script' ) );
	} 

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

	//wp_enqueue_script( 'custom_styles', '', array('jquery') );
	wp_enqueue_script( 'madcats_navigation' );

	//enqueue script to allow toggling of modal
	wp_enqueue_script('toggle_modal',get_template_directory_uri().'/js/toggleModal.js',array('jquery'));

	//enqueue script giving headings on longform pages id attributes so they can be navigated
	wp_enqueue_script('add_ids_to_headings',get_template_directory_uri().'/js/addIdsToHeadings.js',array('jquery'));

}

add_action('wp_enqueue_scripts','madcats_scripts');

function init_widgets(){

	register_sidebar( array(
		"name"=>"Below Nav Widgets",
		"id"=>"below-nav",
		"before_widget"=>"<div class='nav-widgets'>",
		"after_widget"=>"</div>",
		"before_title"=>"<h2 class='widgets'>",
		"after_title"=>"</h2>"
	));

	register_sidebar( array(
		"name"=>"footer-widgets",
		"id"=>"footer-widgets",
		"before_widget"=>"<div class='footer-widgets'>",
		"after_widget"=>"</div>"
		)
	);

	register_sidebar( array(
		"name" 			=> "404-widgets",
		"id"   			=> "404-widgets",
		"before_widget" => "<div class='fourohfour-widgets'>",
		"after_widget" 	=> "</div>"
	));

	register_sidebar( array(
		"name" 			=> "madcats-sidebar-widgets",
		"id" 			=> "madcats-sidebar-widgets",
		"before_widget" => '<div class="sidebar-widgets">',
		"after_widget" 	=> '</div>'
	));

	register_sidebar( array(
		"name" 			=> 'feature-widgets-1',
		"id"			=> 'feature-widgets-1',
		"description" 	=> __( 'Left widget column in feature widgets area', 'madcats' ),
		'before_widget' => '<div class="feature-widget-one">',
		'after_widget'  => '</div>'
	));

	register_sidebar( array(
		"name"			=> 'feature-widgets-2',
		"id"			=> 'feature-widgets-2',
		"description" 	=> __( 'Right widget column in feature widgets area', 'madcats' ),
		'before_widget' => '<div class="feature-widget-two">',
		'after_widget'  => '</div>'
	));
}

add_action( 'widgets_init' , 'init_widgets' );

/**
* returns an array of post ids whose content to display
*
* @since 1.0.0
* @param string 	$setting 	The user input as a string of comma-separated integers	
*/

function madcats_get_posts_for_feature( $setting ){
	$posts = get_theme_mod( $setting );
	if ( $posts ){
		return array_map( 'intval' , explode( ',' , $posts ) );
	} else {
		return false;
	}
}

//include customizer options
require get_template_directory() . '/inc/customizer.php';

//Contact Form Widget

class Madcats_Contact_Form_Widget extends WP_Widget{

	public function __construct(){
		parent::__construct(
			'madcats-contact-form-widget',
			__( 'Contact Form Widget', 'madcats' ),
			array(
			 'description' => __( 'add contact form to widget area.', 'madcats' )
			)
		);
	}

	public function widget( $args, $instance ){

		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		if (! empty( $title) ){
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$form = get_theme_mod( 'madcats-contact-form' );
		if ( $form ){
		?>
			[wpforms id="414"]
		<?php
		}

		echo $args['after_widget'];
	}  

	public function form ( $instance ){
		
		if ( isset( $instance['title'] ) ){
			$title = $instance['title'];
		}
		else{
			$title = __( 'Contact', 'madcats' );
		}
		?>

		<p>
			<label for="madcats-contact-widget-admin"><?php _e( 'Title:', 'madcats' ); ?></label> 
			<input 
			type="text" 
			name="title" 
			value="<?php echo esc_attr( $title ) ?>"
			id="title" />
		</p>
		<?php
	}
}

register_widget( 'Madcats_Contact_Form_Widget' );

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

function madcats_breadcrumb_excerpt( $content ){
	$indexp = strpos( $content, '</p>', 300 );
	echo substr( $content, 0, $indexp );
}

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