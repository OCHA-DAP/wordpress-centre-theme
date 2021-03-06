<?php
/* Template Name: Learning Path Overview */

/**
 * The template for Learning Path Overview pages.
 *
 * @package uncode
 */

get_header();

$menu_name = get_field('menu_name');
?>

<script>
	//mixpanel tracking
	window.onload = function(e) {
		mixpanel.track('page view', { 'page type': 'learning module', 'learning module name': '<?php echo $menu_name ?>', 'learning module template': 'overview' });
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

	<?php 
		$menu_items = wp_get_nav_menu_items($menu_name);
		include( locate_template( 'partials/menu-learningpath.php', false, false ) );
	?>

	<article class="learning-path">
		<div class="feature-content">
			<div class="content-width">
				<div class="feature-inner">
					<h1><?php echo get_the_title(); ?></h1>
					<?php if (get_field('introduction')): ?>
						<h3><?php echo get_field('introduction'); ?></h3>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<?php $video = get_field('overview_video');
			$videoID = $video['id'];
			if ($videoID): ?>
				<div class="feature-media content-width">
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

		<?php $threeColModule = get_field('3_column_module');
			if ($threeColModule['column_1']['title'] && $threeColModule['column_2']['title'] && $threeColModule['column_3']['title']): ?>
				<section class="section-3-col-module content-width">
					<h2 class="section-header"><?php echo $threeColModule['title']; ?></h2>
					<div class="column-container <?php if ($threeColModule['has_icons']) echo 'has-icons' ?>">
						<?php for ($i=1; $i<4; $i++) { 
							$column = $threeColModule['column_'.$i]; ?>
							<div class="column column-4 background-gray">
								<div class="column-inner">
									<?php if ($threeColModule['has_icons']) { ?>
										<img class="icon" src="<?php echo get_stylesheet_directory_uri() . '/assets/learning-path/icon-'. $column['icon_type'] .'.png' ?>" />
									<?php } ?>
									<h3 class="fixed-height"><?php echo $column['title']; ?></h3>
									<p class="border-top"><?php echo $column['text']; ?></p>
								</div>
							</div>
						<?php } ?>
					</div>
				</section>
		<?php endif; ?>

		<?php $imageModule = get_field('module_with_image');
			if ($imageModule['content']['title'] && $imageModule['content']['text']): ?>
				<section class="section-module-with-img background-gray">
					<div class="content-width">
						<h2 class="section-header"><?php echo $imageModule['title']; ?></h3>
						<div class="column-container">
							<div class="column column-4">
								<h3><?php echo $imageModule['content']['title']; ?></h3>
								<p><?php echo $imageModule['content']['text']; ?></p>
							</div>
							<div class="column column-8 align-right">
								<?php $image = $imageModule['content']['image'];
									if( !empty( $image ) ): ?>
									    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
								<?php endif; ?>
							</div>
						</div>
					</div>
				</section>
		<?php endif; ?>


		<?php $faq = get_field('faq');
			if ($faq['category_id']): ?>
			<section class="section-faq content-width">
				<div class="column-container">
					<div class="column column-8">
						<h2 class="section-header"><?php echo $faq['title']; ?></h2>
						<div class="accordion overview-accordion" id="faqAccordion">

				<?php 
				$id = $faq['category_id'];
				$json = file_get_contents('https://centre.humdata.org/wp-json/wp/v2/ufaq?ufaq-category='.$id);
				$items = json_decode($json);

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
							  
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php 
			$the_content = get_the_content();
			$the_content = apply_filters('the_content', $the_content);
			echo $the_content;
		?>

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

		<section class="section-call-to-action background-gray-dark">
			<div class="content-width align-center">
				<h2 class="text-green">Learn more with us</h2>
				<p>We offer assistance for anyone who wants to learn more</p>
				<a href="#" class="request-support button-primary button-dark">Request Support</a>
			</div>
		</section>

	</article>

	<?php include( locate_template( 'partials/modal-learningpathsupport.php', false, false ) ); ?>
	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
