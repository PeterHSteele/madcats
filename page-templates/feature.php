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
	<div class="banner-text">
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
$slides = get_theme_mod( 'slider-posts' );
if ( $slides ) : 
	$slides = explode( ',', $slides ); 
	$slides = array_map( 'intval', $slides );
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
<?php endif; ?>
<div class="breadcrumbs">
	<div class="crumb crumb-1"></div>
</div>

<?php

get_footer();