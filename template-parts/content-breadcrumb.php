<?php
/**
* Template Part for displaying a breacrumb on the featured page
*
* @package WordPress
* @subpackage madcats
* @since 1.0.0
*/
?>

<div class="crumb">
	<?php 
	the_post_thumbnail( 'full' ); 
	the_title( 
		sprintf( 
			'<h3><a href="%s">',
			 get_the_permalink()
		), 
		'</a></h3>' 
	);

	madcats_breadcrumb_excerpt( get_the_content( null, false, $post ) );
	/*
	$content = wp_kses( 
		get_the_content( null, false, $post ),
		array( 
			'h2' => array(),
			'h3' => array(),
			'h4' => array(),
			'h5' => array(),
			'h6' => array(),
			'p' => array(),
			'ul' => array(),
			'li' => array(),
			'a' => array( 
				'href' => true 
			) 
		)
	);
	*/

	//$content = str_replace( array( '</a>', '</ul>' ), array( '</a><p>' , '</ul><p>' ), $content );

	/*foreach ( array( '</a>', '</ul>') as $tag ){
		preg_replace( $tag, '<p>', $content );
	}*/

	//echo $content;
	?>
</div>