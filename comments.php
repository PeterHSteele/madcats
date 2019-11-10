<?php
/**
* The template for displaying comments
*
* @package Wordpress
* @subpackage Madcats
* @since 1.0.0
*/

if ( post_password_required() ){
	return;
}

?>
<div class="comments">
	<h2 class="comments-title">
		<?php printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'title of comment section', 'madcats' ), get_comments_number() ); ?>
	</h2>

	<ul class="comments-list">
		<?php wp_list_comments(); ?>
	</ul>
	<?php
	comment_form(array(
		'must_log_in' => '<p>'
	));
	?>
<div><!--.comments-->