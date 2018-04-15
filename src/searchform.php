<?php
	global $use_live_search;
?>
<form action="<?php echo esc_url(home_url( '/' )); ?>" method="get">
	<div class="search-container-inner">
		<input type="search" class="search-field form-fluid<?php echo ($use_live_search) ? ' form-xl' : ' no-livesearch'; ?>" placeholder="<?php echo esc_html__('Press enter to search','uncode'); ?>" value="" name="s" title="<?php echo esc_html__('Search for:','uncode'); ?>">
	  	<button type="submit">
			<i class="fa fa-search3"></i>
		</button>
	</div>
</form>
