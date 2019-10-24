<?php
/**
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
				<header class="entry-header">
				<?php
				if (is_singular()){
					the_title("<h1 class='page-title'>","</h1>");
				} else {
					the_title( sprintf('<h2 class="entry-title"><a href="%s">', get_the_permalink() ),'</a></h2>');
				}	
				?>
				</header>
				
				<?php get_template_part( 'template-parts/content' , 'single' ); ?>
				
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