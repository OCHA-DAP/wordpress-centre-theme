<?php
/* Template Name: Learning Path Landing */

/**
 * The template for Learning Path Landing page.
 *
 * @package uncode
 */

get_header();
?>

<script>
	//mixpanel tracking
	window.onload = function(e) {
		//mpTrack.pageView(document.title, 'learning module');
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


	while ( have_posts() ) : the_post(); ?>

	<div id="page-header" data-imgready="true">
		<div class="header-basic">
			<div class="background-element header-wrapper header-scroll-opacity header-parallax style-color-rgdb-bg header-only-text" data-height="35">
			<div id="particles-js"><canvas width="1572" height="600" style="width: 100%; height: 100%;"></canvas></div>
			<div class="header-main-container limit-width">
				<div class="header-content header-center header-middle header-align-center">
					<div class="header-content-inner">
						<h1 class="header-title"><span>Learn With The Centre</span></h1>
					</div>
				</div>
			</div>
		</div>
	</div>


	<article class="learning-path landing">
		<div class="content-width">
			<?php 
				$the_content = get_the_content();
				$the_content = apply_filters('the_content', $the_content); 
			?>
			<div class="landing-introduction"><?php echo $the_content; ?></div>

			<?php
				$pages = get_pages(array(
					'post_type' => 'page',
				    'meta_key' => '_wp_page_template',
				    'hierarchical' => 0,
				    'meta_value' => 'page-templates/learning-path.php',
				    'sort_column' => 'post_date', 
                    'sort_order' => 'DESC'
				));
				$section_pages = $pages;
				$jump_menu_pages = $pages; 
			?>

			<div class="column-container">
				<div class="column column-3">
					<ol class="breadcrumb header-subtitle" vocab="http://schema.org/" typeof="BreadcrumbList">
						<li property="itemListElement" typeof="ListItem">
							<a href="https://centre.humdata.org/" itemprop="url">Home</a>
						</li>
						<li property="itemListElement" typeof="ListItem">
							<a href="https://centre.humdata.org/" itemprop="url">Resources</a>
						</li>
						</li>
						<li property="itemListElement" typeof="ListItem" class="current">All Learning Paths</li>
					</ol>
					<ul class="jump-menu">
						<li>ALL LEARNING PATHS</li>
						<?php
							foreach($jump_menu_pages as $page) {
								$page_slug = $page->post_name;
								$page_order = $page->menu_order;
								$page_query = new WP_Query('page_id=' . $page->ID);
								while ($page_query->have_posts()) : $page_query->the_post();
									if ($page_order==0): ?>
										<li><a href="<?php echo get_permalink($page->ID); ?>"><?php echo the_title(); ?></a></li>
								<?php endif;
								endwhile; 
							}
						?>
					</ul>
				</div>
				<div class="column column-9">
					<div class="column-container column-flow">
				<?php
					foreach($section_pages as $page){
						$page_slug = $page->post_name;
						$page_order = $page->menu_order;
						$page_query = new WP_Query('page_id=' . $page->ID);
						while ($page_query->have_posts()) : $page_query->the_post();
							if ($page_order==0): ?>
								<div class="column column-4 landing-item">
									<div class='thumb'>
										<div class='category-label'><?php echo get_field('category_type'); ?></div>
									</div>
									<h6 class="subtitle"><?php echo get_field('category_type'); ?></h6>
									<a href="<?php echo get_page_link(); ?>"><span class='title'><?php echo the_title(); ?></span></a>
									<p><?php echo get_field('landing_excerpt'); ?></p>
								</div>
						<?php endif;
						endwhile; 
					} 
				?>
					</div>
				</div>
			</div>
									

		</div>					
	</article>	

	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>

