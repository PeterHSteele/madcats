<?php 

//Template for displaying search results



get_header() 
?>

<section class="content-area">
	<main class="site-main">
		<h1 class="search-title">
			Search results for: <span class="search-term"><?php echo get_search_query(); ?></span>
		</h1>

		<?php 
		//if there are search results to display,
		if ( have_posts() ){
			//then start the loop
			while( have_posts() ){
				the_post();
				//show the title
				the_title('<h2 class="entry-title"><a href='.esc_url(get_permalink()).'>','</a></h2>');

				?>
				<!--show the excerpt in its own container-->
				<div class="post-content">
					<?php the_excerpt(); ?>
				</div>
				<?php
			}//endwhile
		}//endif
		?>
	</main>
</section>

<?php get_footer(); ?>