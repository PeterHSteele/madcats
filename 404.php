<?php
	//Template to display 404 errors

	get_header();
?>
<section <?php post_class( 'content-area page-four-oh-four'); ?>>
	<main class="site-main">
		<header>
			<h1>whoops, there's nothing here!</h1>
		</header>
		<div>
			<?php 
			if ( get_theme_mod( '404_image' ) ){
				echo wp_get_attachment_image( attachment_url_to_postid( get_theme_mod( '404_image' ) ), 'large' );
			}
			?>
		</div>
	</main>
	<aside role="secondary">
	<?php 
		if ( is_active_sidebar( '404-widgets' ) ){
			dynamic_sidebar( '404-widgets' ); 
		}
	?>
	</aside>
</section>
<?php 

//get_template_part('searchform');

get_footer(); 

?>