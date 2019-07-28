<?php
	//page for displaying lists of posts by category
	get_header();
?>

<div class="card-container">
	<?php if ( have_posts() ) : ?>
	 <?php 	while ( have_posts() ){
			the_post();
	?>
		<div class="card">
			<h2><?php the_title() ?></h2>
			<?php 
				the_post_thumbnail(); 
				the_excerpt();
			?>
		</div>
	<?php
		} //endwhile
	endif; //endif
 	?>
</div>

<?php get_footer() ?>