<?php
/*
*
* Template part for displaying content of individual posts
*
*/
if ( ! get_theme_mod( 'hide_post_meta' ) ): ?>		
	<div class="entry-meta">
		<?php 
			madcats_posted_by();
			madcats_posted_on();
			madcats_get_categories();
		?>
	</div>
<?php endif; ?>
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