<?php 

/* Template Name: Card Layout */

get_header();
?>

<div class="card-container">
	<?php if (have_posts()) : ?>

		<?php while ( have_posts() ) {
			the_post(); 
		?>
		
		<div class="card">
			<?php 
				the_title();
				the_content();
			?>
		</div>

		<?php } ?>

	<?php endif; ?>
</div><!--.card-container-->	

<?php
get_footer();
?>