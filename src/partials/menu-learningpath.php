<?php
	if (!empty($menu_items)):
		$active = ( $_SERVER['REQUEST_URI'] == parse_url( $menu_items[0]->url, PHP_URL_PATH ) ) ? 'active' : ''; ?>
		<div class="learning-path-navigation">
			<div class="navigation-inner content-width">
				<div class="breadcrumbs">
					<a href="<?php echo get_site_url() ?>/learning-path"><span class="text-green">Learn with the Centre</span></a> / <a href="<?php echo $menu_items[0]->url ?>" class="<?php echo $active ?>"><?php echo $menu_items[0]->title ?></a>
				</div>
				<div class="sub-navigation">
					<?php for ($i = 1; $i < count($menu_items); $i++) {
						$active = ( $_SERVER['REQUEST_URI'] == parse_url( $menu_items[$i]->url, PHP_URL_PATH ) ) ? 'active' : '';
						if (strpos($menu_items[$i]->url, 'request-support')==true) { ?>
							<a href="#" class="request-support"><?php echo $menu_items[$i]->title ?></a>
						<?php 
						} else { ?>
							<a href="<?php echo $menu_items[$i]->url ?>" class="<?php echo $active ?>"><?php echo $menu_items[$i]->title ?></a>
					<?php }
					} ?>
				</div>
			</div>
		</div>
<?php endif; ?>

