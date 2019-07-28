<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label> 
		<span class="sr-only">Search</span>
		<input type="search"  placeholder="<?php echo esc_attr_x('Search','Placeholder'); ?>" value="<?php echo get_search_query(); ?>" name="s">
	</label>
	<input type="submit" value="<?php echo esc_attr_x('Submit','Value'); ?>">
</form>


<!--<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'twentysixteen' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'twentysixteen' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'twentysixteen' ); ?></span></button>
</form>-->