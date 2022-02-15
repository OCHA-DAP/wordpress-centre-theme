<?php
/* Template Name: Learning Path Methodology */

/**
 * The template for Learning Path Methodology pages.
 *
 * @package uncode
 */

get_header();

$menu_name = get_field('menu_name');
?>

<script>
	//mixpanel tracking
	window.onload = function(e) {
		mixpanel.track('page view', { 'page type': 'learning module', 'learning module name': '<?php echo $menu_name ?>', 'learning module template': 'methodology' });
	}
</script>

<?php
	/**
	 * DATA COLLECTION - START
	 **/

	/** Init variables **/
	$limit_width = $limit_content_width = $the_content = $main_content = $layout = $bg_color = $sidebar_style = $sidebar_bg_color = $sidebar = $sidebar_size = $sidebar_sticky = $sidebar_padding = $sidebar_inner_padding = $sidebar_content = $title_content = $media_content = $page_custom_width = $row_classes = $main_classes = $footer_content = $footer_classes = $content_after_body = '';
	$with_builder = false;

	$post_type = $post->post_type;

	/** Get general datas **/
	if (isset($metabox_data['_uncode_specific_style'][0]) && $metabox_data['_uncode_specific_style'][0] !== '') {
		$style = $metabox_data['_uncode_specific_style'][0];
		if (isset($metabox_data['_uncode_specific_bg_color'][0]) && $metabox_data['_uncode_specific_bg_color'][0] !== '') {
			$bg_color = $metabox_data['_uncode_specific_bg_color'][0];
		}
	} else {
		$style = ot_get_option('_uncode_general_style');
		if (isset($metabox_data['_uncode_specific_bg_color'][0]) && $metabox_data['_uncode_specific_bg_color'][0] !== '') {
			$bg_color = $metabox_data['_uncode_specific_bg_color'][0];
		} else $bg_color = ot_get_option('_uncode_general_bg_color');
	}
	$bg_color = ($bg_color == '') ? ' style-'.$style.'-bg' : ' style-'.$bg_color.'-bg';

	/** Get page width info **/
	$boxed = ot_get_option('_uncode_boxed');

	$page_content_full = (isset($metabox_data['_uncode_specific_layout_width'][0])) ? $metabox_data['_uncode_specific_layout_width'][0] : '';
	if ($page_content_full === '') {
		/** Use generic page width **/
		$generic_content_full = ot_get_option('_uncode_'.$post_type.'_layout_width');
		if ($generic_content_full === '') {
			$main_content_full = ot_get_option('_uncode_body_full');
			if ($main_content_full !== 'on') $limit_content_width = ' limit-width';
		} else {
			if ($generic_content_full === 'limit') {
				$generic_custom_width = ot_get_option('_uncode_'.$post_type.'_layout_width_custom');
				if ($generic_custom_width[1] === 'px') {
					$generic_custom_width[0] = 12 * round(($generic_custom_width[0]) / 12);
				}
				if (is_array($generic_custom_width) && !empty($generic_custom_width)) {
					$page_custom_width = ' style="max-width: '.implode('', $generic_custom_width).'; margin: auto;"';
				}
			}
		}
	} else {
		/** Override page width **/
		if ($page_content_full === 'limit') {
			$limit_content_width = ' limit-width';
			$page_custom_width = (isset($metabox_data['_uncode_specific_layout_width_custom'][0])) ? unserialize($metabox_data['_uncode_specific_layout_width_custom'][0]) : '';
			if (is_array($page_custom_width) && !empty($page_custom_width) && $page_custom_width[0] !== '') {
				if ($page_custom_width[1] === 'px') {
					$page_custom_width[0] = 12 * round(($page_custom_width[0]) / 12);
				}
				$page_custom_width = ' style="max-width: '.implode("", $page_custom_width).'; margin: auto;"';
			} else $page_custom_width = '';
		}
	}

	$media = get_post_meta($post->ID, '_uncode_featured_media', 1);
	$media_display = get_post_meta($post->ID, '_uncode_featured_media_display', 1);
	$featured_image = get_post_thumbnail_id($post->ID);
	if ($featured_image === '') $featured_image = $media;

	/** Collect header data **/
	if (isset($metabox_data['_uncode_header_type'][0]) && $metabox_data['_uncode_header_type'][0] !== '') {
		// $page_header_type = $metabox_data['_uncode_header_type'][0];
		// if ($page_header_type !== 'none') {
		// 	$meta_data = uncode_get_specific_header_data($metabox_data, $post_type, $featured_image);
		// 	$metabox_data = $meta_data['meta'];
		// 	$show_title = $meta_data['show_title'];
		// }
	} else {
		$page_header_type = ot_get_option('_uncode_'.$post_type.'_header');
		if ($page_header_type !== '' && $page_header_type !== 'none') {
			$metabox_data['_uncode_header_type'] = array($page_header_type);
			$meta_data = uncode_get_general_header_data($metabox_data, $post_type, $featured_image);
			$metabox_data = $meta_data['meta'];
			$show_title = $meta_data['show_title'];
		}
	}

	while ( have_posts() ) : the_post();
		/** Build header **/
		if ($page_header_type !== '' && $page_header_type !== 'none') {
			$page_header = new unheader($metabox_data, $post->post_title);

			$header_html = $page_header->html;
			if ($header_html !== '') {
				echo '<div id="page-header">';
				echo uncode_remove_wpautop( $page_header->html );
				echo '</div>';
			}

			if (!empty($page_header->poster_id) && $page_header->poster_id !== false && $media !== '') {
				$media = $page_header->poster_id;
			}
		}
		echo '<script type="text/javascript">UNCODE.initHeader();</script>';
	?>

	<article class="learning-path methodology">
		<?php
			$menu_items = wp_get_nav_menu_items($menu_name);
			include( locate_template( 'partials/menu-learningpath.php', false, false ) );
		?>

		<div class="feature-content">
			<div class="content-width">
				<div class="feature-inner">
					<h1><?php echo get_the_title(); ?></h1>
					<?php if( get_field('methodology_introduction') ): ?>
						<h3><?php the_field('methodology_introduction'); ?></h3>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<?php $steps = get_field('methodology_step');
			if( $steps ): 
				foreach( $steps as $key=>$step ): 
					$read_more = $step['read_more']; 
					$faq = $step['faq_category_id']; ?>
					<section class="section-step <?php if($key%2!=0) echo 'background-gray'; ?>">
						<div class="content-width">
							<div class="column-container">
								<?php if($key%2!=0): ?>
									<div class="column column-7">
										<iframe class="video-container" src="https://www.youtube.com/embed/<?php echo $step['step_video_id'] ?>?modestbranding=1&rel=0"></iframe>
									</div>
									<div class="column column-5">
										<h2 class="numbered"><?php echo $step['step_title']; ?></h2>
										<p><?php echo $step['step_description']; ?></p>
										<?php if( $read_more ): ?><div class="button-read-more">Read More</div><?php endif; ?>
									</div>
								<?php else: ?>
									<div class="column column-5">
										<h2 class="numbered"><?php echo $step['step_title']; ?></h2>
										<p><?php echo $step['step_description']; ?></p>
										<?php if( $read_more ): ?><div class="button-read-more">Read More</div><?php endif; ?>
									</div>
									<div class="column column-7 align-right">
										<iframe class="video-container" src="https://www.youtube.com/embed/<?php echo $step['step_video_id'] ?>?modestbranding=1&rel=0"></iframe>
									</div>
								<?php endif; ?>
							</div>

							<?php if( $read_more ): ?>
								<div class="content-drawer">
									<div class="column-container column-flow">
										<?php foreach( $read_more as $key=>$item ): ?>
											<div class="column column-4">
												<h3 class="fixed-height"><?php echo $item['item_title']; ?></h3>
												<p class="border-top"><?php echo $item['item_description']; ?></p>
											</div>
										<?php endforeach; ?>
									</div>

									<?php if( $faq ): ?>
										<div class='section-faq content-width'>
											<h2>General Questions</h2>

											<div class="column-container">
												<div class="column column-10">
													<div class="accordion" id="faqAccordion<?php echo $faq ?>">

												<?php 

												$url = get_site_url();
												$json = file_get_contents($url.'/wp-json/wp/v2/ufaq?ufaq-category='.$faq);
												$items = json_decode($json);

												foreach($items as $key=>$item) { 
													$id = $faq . $key; ?>

													<div class="card">
														<div class="card-header" id="heading<?php echo $id ?>">
															<h4 class="my-0">
																<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse<?php echo $id ?>" aria-expanded="true" aria-controls="collapse<?php echo $id ?>">
																	<?php echo $item->title->rendered ?>
																</button>
															</h4>
														</div>
														<div id="collapse<?php echo $id ?>" class="collapse" aria-labelledby="heading<?php echo $id ?>" data-parent="#faqAccordion<?php echo $faq ?>">
															<div class="card-body">
																<?php echo $item->content->rendered ?>
															</div>
														</div>
													</div>
												<?php } ?>
															  
												</div>
											</div>

										</div>
									<?php endif; ?>
								</div>
							<?php endif; ?>

						</div>
					</section>
				<?php endforeach; ?>
			<?php endif; ?>
		<?php ?>

		<?php 
			$the_content = get_the_content();
			$the_content = apply_filters('the_content', $the_content);
			echo $the_content;
		?>

		<?php $resources = get_field('methodology_resources');
			if( $resources['resource_one']['resource_title'] && $resources['resource_two']['resource_title'] ): ?>
				<section class="section-card-container background-gray">
					<div class="content-width">
						<h2 class="section-header"><?php echo $resources['methodology_resources_title']; ?></h2>
						<div class="column-container">
							<div class="column column-6 align-right">
								<a class="section-card" href="https://centre.humdata.org/guidance-note-statistical-disclosure-control" target="_blank">
									<?php $icon_one = ($resources['resource_one']['resource_type']=='technical_documentation') ? 'icon-documentation.png': 'icon-guideline.png'; ?>
									<img src="<?php echo get_stylesheet_directory_uri() . '/assets/learning-path/' . $icon_one;  ?>" />
									<h3><?php echo $resources['resource_one']['resource_title']; ?></h3>
									<p class="attribution"><?php echo $resources['resource_one']['resource_attribution']; ?></p>
									<p class="body"><?php echo $resources['resource_one']['resource_description']; ?></p>
								</a>
							</div>
							<div class="column column-6 align-left">
								<a class="section-card" href="https://sdcpractice.readthedocs.io/en/latest" target="_blank">
									<?php $icon_two = ($resources['resource_two']['resource_type']=='technical_documentation') ? 'icon-documentation.png': 'icon-guideline.png'; ?>
									<img src="<?php echo get_stylesheet_directory_uri() . '/assets/learning-path/' . $icon_two;  ?>" />
									<h3><?php echo $resources['resource_two']['resource_title']; ?></h3>
									<p class="attribution"><?php echo $resources['resource_two']['resource_attribution']; ?></p>
									<p class="body"><?php echo $resources['resource_two']['resource_description']; ?></p>
								</a>
							</div>
						</div>
					</div>
				</section>
		<?php endif; ?>

		<?php $cta = get_field('call_to_action'); 
			if ($cta['title']):
				$styleLight = strtolower($cta['style'])=='light' ? true : false;
				$bg_color = ($styleLight) ? 'background-gray' : 'background-gray-dark'; 
				$btn_style = ($styleLight) ? '' : 'button-dark'; ?>
				<section class="section-call-to-action <?php echo $bg_color; ?>">
					<div class="content-width align-center">
						<h2 class="text-green"><?php echo $cta['title']; ?></h2>
						<p><?php echo $cta['text']; ?></p>
						<?php 
							$link =  $cta['link'];
							if ($link): 
								$link_url = $link['url'];
    							$link_title = $link['title'];
    							$link_target = $link['target'] ? $link['target'] : '_self'; ?>
								<a href="<?php echo esc_url($link_url); ?>" class="button-primary <?php echo $btn_style; ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
						<?php endif; ?>
					</div>
				</section>
		<?php endif; ?>
	</article>	

	<?php include( locate_template( 'partials/modal-learningpathsupport.php', false, false ) ); ?>
	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
