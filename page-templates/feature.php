<?php
/** 
*
* Template Name: Featured
* 
* Page template for featured content
* @since 1.0.0
* @package wordpress
* @subpackage madcats
*
*/
get_header( 'feature' );
$url = get_theme_mod( 'madcats-featured-banner' );
?>
<div class="banner" style="background-image: url(<?php echo $url ? esc_url( $url ): ''?>)"><!--.banner-->
		<?php 
		//banner heading
		if ( get_theme_mod( 'banner-heading') ) : 
		?>
			<h1><?php echo esc_html( get_theme_mod('banner-heading') ); ?></h1>
		<?php 
		else :
		?>
			<h1><?php echo bloginfo( 'name' ); ?></h1>
		<?php 
		endif; 
		?>	
	<div class="banner-text">
		<p><?php 
		//banner text
		echo esc_html( get_theme_mod( 'banner-text' ) ); ?></p>
		<?php
		//link for call to action
		$cta_link = get_theme_mod( 'banner-cta-button-link' );
		if ( $cta_link ){
			//text for call to action button
			$cta_text = get_theme_mod( 'banner-cta-button-text' );
		?>
			<button>
				<a href="<?php echo esc_url( $cta_link ); ?>"><?php echo $cta_text ? $cta_text : __( 'Learn More', 'madcats' ); ?></a>
			</button>
		<?php
		}
		?>
	</div>
</div><!--.banner-->
<?php 
$slides = madcats_get_posts_for_feature( 'slider-posts' );
if ( $slides ) : 
	?>
	<section class="slider-container">
		<div class="slider">
		<?php
			global $post;
			foreach( $slides as $slide ){
				$post = get_post( $slide );
				get_template_part( 'template-parts/content', 'slide' );
			}
			wp_reset_postdata();
		?>
		</div><!--.slider-->
	</section><!--.slider-container-->
<?php 
endif;
$crumbs = madcats_get_posts_for_feature( 'breadcrumb-posts' );
$banner_2 = get_theme_mod( 'madcats-featured-banner-2' );
$overlay_2 = get_theme_mod( 'madcats-banner-overlay-2');
//if ( $slides && $crumbs && $overlay_2 ) :
/*style="background-image: url( <?php echo 'banner_2' ? esc_url( $banner_2 ) : '' ?> ) "*/
?>
	<div class="feature-banner-2" >
		<div class='feature-banner-2-content'>
		<?php 
		//$post = get_post( $overlay_2 );
		the_title('<h2>', '</h2>');
		echo '<p>' . wp_kses( get_the_content( null, false, $post ), array( 'p' , 'a' ) ) . '</p>';
		?>
		</div>
	</div>
<?php
//endif;
if ( $crumbs ) :
?>
	<section class="breadcrumbs">
		<?php 
		global $post;
		foreach( $crumbs as $crumb ){
			$post = get_post( $crumb );
			get_template_part( 'template-parts/content', 'breadcrumb' );
		}
		?>
	</section>
<?php
endif;
$widget_background_image = get_theme_mod( 'feature-widget-background' );
?>
<section class="feature-widgets-section" style="background-image: url( <?php echo $widget_background_image ? esc_url( $widget_background_image ) : '' ?> )">
	<div class="mask feature-mask">
	<?php if ( is_active_sidebar( 'feature-widgets-1' ) ) : ?>
		<div class="feature-widget-col feature-widgets-1">
			<?php dynamic_sidebar( 'feature-widgets-1' ); ?>
		</div>
	<?php
	endif;
	if ( is_active_sidebar( 'feature-widgets-2' ) ) :
	?>
		<div class="feature-widget-col feature-widgets-2">
			<?php dynamic_sidebar( 'feature-widgets-2' ); ?>
		</div>
	<?php endif; ?>
	</div> 
</section>
<?php
$feature_footer = ' feature';
get_footer();