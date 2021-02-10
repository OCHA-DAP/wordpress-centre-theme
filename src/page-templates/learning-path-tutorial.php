<?php
/* Template Name: Learning Path Tutorial */

/**
 * The template for Learning Path Tutorial pages.
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

	<article class="learning-path tutorial">
		<?php 
			$menu_name = get_field('menu_name');
			$menu_items = wp_get_nav_menu_items($menu_name);
			include( locate_template( 'partials/menu-learningpath.php', false, false ) );
		?>

		<div class="feature-content">
			<div class="content-width">
				<div class="feature-inner">
					<h1>Try It On Your Own</h1>
					<?php if( get_field('tutorial_introduction') ): ?>
						<h3><?php the_field('tutorial_introduction'); ?></h3>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="content-width column-container">
			<div class="column column-4">
				<ul class="jump-menu">
					<?php
						$sections = get_content_sections();
						foreach( $sections as $section ) {
							$id = $section->getAttribute('id');
							$h2 = $section->getElementsByTagName('h2');
							$title = $h2[0]->textContent;
					?>
						<li><a href="#<?php echo $id ?>"><?php echo $title ?></a></li>
					<?php } ?>
				</ul>
			</div>

			<div class="column column-8">
				<?php 
					$the_content = get_the_content();
					$the_content = apply_filters('the_content', $the_content);
					echo $the_content;
				?>
			</div>
		</div>


		<?php $cta = get_field('call_to_action'); 
			$ctaTitle = $cta['title'];
			if( $ctaTitle ): 
				$bg_color = ($cta['style']=='Light') ? 'background-gray' : 'background-gray-dark'; 
				$text_color = ($cta['style']=='Light') ? 'text-green' : 'text-blue';  
				$btn_style = ($cta['style']=='light') ? '' : 'button-dark'; ?>
				<section class="section-call-to-action <?php echo $bg_color; ?>">
					<div class="content-width align-center">
						<h2 class="<?php echo $text_color; ?>"><?php echo $ctaTitle; ?></h2>
						<p><?php echo $cta['text']; ?></p>
						<?php 
							$link =  $cta['link'];
							if( $link ): 
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
