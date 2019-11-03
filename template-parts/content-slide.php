<?php
/**
* Template part for displaying a slide in the slideshow on the feature page
*
* @package WordPress
* @subpackage madcats
* @since 1.0.0
*/

?>
<div class="slide">
	<?php 
	the_post_thumbnail( 'full' ); 
	?>
	<div class="slide-text">
		<?php
		the_title( '<h2>', '</h2>' ); 
		the_excerpt();
		//echo '<p>' . wp_kses( get_the_content( null, false, $post), array( 'p' ) ) . '</p>';
		?>
	</div>
</div>