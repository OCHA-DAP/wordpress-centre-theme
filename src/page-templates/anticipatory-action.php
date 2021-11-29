<?php
/* Template Name: Anticipatory Action */

/**
 * The template for Anticipatory Action page.
 *
 * @package uncode
 */

get_header();

$menu_name = get_field('menu_name');
?>

<script>
	//mixpanel tracking
	// window.onload = function(e) {
	// 	mixpanel.track('page view', { 'page type': 'learning module', 'learning module name': '<?php echo $menu_name ?>', 'learning module template': 'tutorial' });
	// }
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

	<article class="anticipatory-action page-body">
		<?php
			$menu_items = wp_get_nav_menu_items($menu_name);
			include( locate_template( 'partials/menu-learningpath.php', false, false ) );
		?>

		<?php if( get_field('tutorial_introduction') ): ?>
						<h3><?php the_field('tutorial_introduction'); ?></h3>
					<?php endif; ?>

		<div class="feature-content">
			<div class="content-width">
				<div class="feature-inner">
					
				</div>
			</div>
		</div>

		<div class="content-width column-container post-content">
			<div class="row limit-width">
				<div class="row-inner">
					<div class="col-lg-3">
						<ul class="jump-menu">
							<?php
								$sections = get_content_sections();
								foreach( $sections as $section ) {
									$id = $section->getAttribute('id');
									$h3 = $section->getElementsByTagName('h3');
									$title = $h3[0]->textContent;
							?>
								<li><a href="#<?php echo $id ?>"><?php echo $title ?></a></li>
							<?php } ?>
						</ul>
					</div>

					<div class="col-lg-9">
						<?php 
							$the_content = get_the_content();
							$the_content = apply_filters('the_content', $the_content);
							echo $the_content;
						?>

						<!-- country resource section -->
						<?php $country_resources = get_field('country_resources');
							if ($country_resources['faq_id']): ?>
							<section class="section-faq">
								<h3><?php echo $country_resources['title']; ?></h3>
								<div class="accordion overview-accordion" id="faqAccordion">

								<?php 
								$id = $country_resources['faq_id'];
								$json = file_get_contents('https://centre.humdata.org/wp-json/wp/v2/ufaq?ufaq-category='.$id);
								$items = json_decode($json);

								//sort items by slug
								function cmp($a, $b) {
								   return strcmp($a->slug, $b->slug);
								}
								usort($items, "cmp");

								foreach($items as $key=>$var) { ?>
									<div class="card">
										<div class="card-header" id="heading<?php echo $key ?>">
											<h4 class="my-0">
												<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse<?php echo $key ?>" aria-expanded="true" aria-controls="collapse<?php echo $key ?>">
													<?php echo $items[$key]->title->rendered ?>
												</button>
											</h4>
										</div>
										<div id="collapse<?php echo $key ?>" class="collapse" aria-labelledby="heading<?php echo $key ?>" data-parent="#faqAccordion">
											<div class="card-body">
												<?php echo $items[$key]->content->rendered ?>
											</div>
										</div>
									</div>
								<?php } ?>
											  
							</section>
						<?php endif; ?>

						<!-- global resource section -->
						<?php $global_resources = get_field('global_resources'); ?>
							<h3><?php echo $global_resources['title']; ?></h3>
							<?php 
								$links = $global_resources['links']; 
								if ( $links ):
									foreach( $links as $link ): ?> 
										<ul>  
										<?php foreach( $link as $l ): ?>
											<li><a href="<?php echo $l['link_name']; ?>" target="_blank"><?php echo $l['link_name']; ?></a></li>
										<?php endforeach; ?>
										</ul>
									<?php endforeach;
								endif;  
							?>
					</div>
				</div>
			</div>
		</div>

		
	</article>	

	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
