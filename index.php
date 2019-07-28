<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
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
					
				if (is_singular()){
					the_title("<h1 class='page-title'>","</h1>");
				} else {
					the_title( sprintf('<h2 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ),'</a></h2>');
				}
					
				?>
					<div class="main-image">
						<?php  if ( the_post_thumbnail() ){
							the_post_thumbnail();
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
get_footer();