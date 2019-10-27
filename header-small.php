<?php 
/** 
* Display small-screen specific header.
* 
* @package Madcats
* @since 1.0.0
* 
*/
?>
<div class="small-screen-modal no-display">
	<?php get_template_part('searchform'); ?>
	<button class="modal-close">
		Close
	</button>
</div>
<header class='small-screen-header'>
	<ul>
		<li class="small-screen-header-item">
				<button id="nav-toggle">
					<i class="fa fa-bars fa-lg"></i>
				</button>

		</li>
	<?php if (is_active_sidebar('below-nav')) : ?>
		<li  id="small-screen-header-search" class="small-screen-header-item">	
			<button>
				<i class="fa fa-search fa-lg"></i>
			</button>
		</li>
	<?php endif; ?>
</ul>
<?php
	if ( has_nav_menu('primary') ) : ?>
	<nav class="main-navigation toggle-display" aria-label="<?php esc_attr_e( 'Primary Menu', 'madcats' )?>">
	<?php 
		wp_nav_menu(
			array(
				'theme_location'=>'primary',
				'menu_class'=>'primary-nav'
			)
		);
	?>
	</nav>
	<?php endif; ?>
</header>