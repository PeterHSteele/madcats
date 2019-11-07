</div><!--container-->
<footer class="page-footer <?php echo is_page_template( 'page-templates/feature.php' ) ? 'feature' : '' ?>">
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

<script type="text/javascript" src="./js/slick-1.8.1/slick/slick.min.js"></script>
</body>
</html>