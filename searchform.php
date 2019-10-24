<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label> 
		<span class="sr-only">Search</span>
		<input type="search"  placeholder="<?php echo esc_attr_x('Search','Placeholder'); ?>" value="<?php echo get_search_query(); ?>" name="s">
	</label>
	<input type="submit" value="<?php echo esc_attr_x('Submit','Value'); ?>">
</form>