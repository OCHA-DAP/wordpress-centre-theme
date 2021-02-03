<?php
	if (!empty($menu_items)): ?>
		<div class="learning-path-navigation">
			<div class="navigation-inner content-width">
				<div class="breadcrumbs">
					<span class="text-green">Learning with the Centre</span><a href="<?php echo $menu_items[0]->url ?>" class="active"> / <?php echo $menu_items[0]->title ?></a>
				</div>
				<div class="sub-navigation">
					<?php for ($i = 1; $i < count($menu_items); $i++) { 
						if (strpos($menu_items[$i]->url, $_SERVER['REQUEST_URI'])==true) { ?>
							<a href="#" class="active"><?php echo $menu_items[$i]->title ?></a>
						<?php }
						else { 
							if (strpos($menu_items[$i]->url, 'request-support')==true) { ?>
								<a href="#" class="request-support"><?php echo $menu_items[$i]->title ?></a>
							<?php 
							} else { ?>
								<a href="<?php echo $menu_items[$i]->url ?>"><?php echo $menu_items[$i]->title ?></a>
						<?php }
						} 
					} ?>
				</div>
			</div>
		</div>
<?php endif; ?>
