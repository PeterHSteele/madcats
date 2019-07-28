<?php 
	//Template file for displaying archives

get_header();

//Get rid of the 'Category:' prepended to a category title
$title = get_the_archive_title();
if (preg_match('/Category/',$title)){				
	$title = substr($title,10);
}

?>

<section id="primary" class="content-area">
	<main id="main" class="site-main">

		<h1 class="page-title"><?php echo $title ?></h1>

		<?php 
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();

				the_title('<h2 class="entry-title"><a href='.esc_url(get_permalink()).'>','</a></h2>');

				?>
				<div class="post-content">
					<?php the_content(); ?>
				</div>
				<?php
			}
		}
		?>	
	</main><!--.site-main-->
</section><!--.content-area-->

<?php get_footer() ?>