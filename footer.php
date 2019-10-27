</div><!--container-->
<footer class="page-footer">
	<div class="mask">
	<?php if (has_nav_menu('footer') ): ?>
	<nav>
		<?php 
			wp_nav_menu(array(
				'theme_location'=>'footer',
				'menu_class'=>'footer_nav'
				)
			);
		?>
	</nav>
	<?php endif; 
	if ( is_active_sidebar( 'footer-widgets' ) ){
		dynamic_sidebar( 'footer-widgets' );
	}
	?>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>