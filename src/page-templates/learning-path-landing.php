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
		mpTrack.pageView(document.title, 'learning module');
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
				    'meta_value' => 'page-templates/learning-path-overview.php'
				));
				$section_pages = $pages;
				$jump_menu_pages = $pages; 
			?>

			<div class="column-container">
				<div class="column column-3">
					<ul class="jump-menu">
						<li>LEARNING PATHS</li>
						<?php
							foreach($jump_menu_pages as $page) {
								$page_slug = $page->post_name;
								$page_query = new WP_Query('page_id=' . $page->ID);
								while ($page_query->have_posts()) : $page_query->the_post(); 
									if (get_field('excerpt')): ?>
										<li><a href="#<?php echo $page_slug ?>"><?php echo the_title(); ?></a></li>
								<?php endif;
								endwhile; 
							}
						?>
					</ul>
				</div>
				<div class="column column-9">

				<?php
					foreach($section_pages as $page){
						$page_slug = $page->post_name;
						$page_query = new WP_Query('page_id=' . $page->ID);
						while ($page_query->have_posts()) : $page_query->the_post(); 
							if (get_field('excerpt')): ?>
							<section id="<?php echo $page_slug; ?>">
								<h2 class="section-header"><?php echo the_title(); ?></h2>
								<p><?php echo get_field('excerpt'); ?></p>
								<?php $video = get_field('overview_video');
									$videoID = $video['id'];
									if ($videoID): ?>
										<div class="feature-media">
								      	<iframe id="overviewFeatureVideo" class="video-container" src="https://www.youtube.com/embed/<?php echo $video['id']; ?>
								?modestbranding=1&rel=0&enablejsapi=1"></iframe>
											<?php if ($video['title']): ?>
												<div class="feature-media-caption">
													<h3><?php echo $video['title']; ?></h3>
													<p class="attribution"><?php echo $video['attribution']; ?></p>
												</div>
											<?php endif; ?>
										</div>
								<?php endif; ?>
								<a class="button-primary" href="<?php echo get_page_link(); ?>">Learn How It Works</a>
							</section>
						<?php endif;
						endwhile; 
					} 
				?>
				</div>
			</div>
									

		</div>					
	</article>	

	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
