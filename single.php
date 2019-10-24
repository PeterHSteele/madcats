<?php
/**
 *
 * Template for displaying single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Madcats
 * @since 1.0.0
 */

get_header();

?>

	<section id="primary" class="content-area" >
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) {
			
			// Load posts loop.
			while ( have_posts() ) {
				the_post();
				?>
				<header class="entry-header single">
				<?php the_title("<h1 class='page-title'>","</h1>");	?>
				</header>
					<div class="main-image">
						<?php  if ( has_post_thumbnail( ) ){
							the_post_thumbnail( 'large' );
						}
						?>
					</div>
					<div class="post-content">
						<?php
							the_content();
						?>
					</div>
				<?php
					
				}

		} else {
		?>
			<h2>There's nothing on this website</h2>
		<?php	

		}
		?>

		</main><!-- .site-main -->
	</section><!-- .content-area -->

<?php
get_sidebar( 'below-nav-medium-screen' );
get_footer();