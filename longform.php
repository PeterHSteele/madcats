<?php 

/*Template Name: Longform*/
//template file for displaying longform text pieces

get_header('longform');
?>

<section class='content-area longform'>
	<main class="site-main">
		<?php if (have_posts() ){
			while (have_posts()){

				the_post();

			 	the_content(); ?>

		<?php }} ?>
	</main>
</section>

<?php get_footer() ?>