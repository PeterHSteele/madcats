<?php get_header(); ?>
<section class="content-area">
	<main class="site-main">
		<?php if ( have_posts() ) :
			
			while( have_posts() ) :
				the_post();
				?>

				<h1 class='page-title'><?php the_title(); ?></h1>
				
				<?php
				
				if ( the_post_thumbnail() ) : ?> 
					<div class='main-image'>
						<?php the_post_thumbnail(); ?>
					</div>
				<?php endif; ?>
				
			
				<div class="post-content">
					<?php the_content(); ?>
				</div>
			
			<?php endwhile; ?>
		<?php endif; ?>
	</main><!--.site-main-->
</section><!--.content-area-->

<?php get_footer() ?>