<?php

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package uncode
 */

get_header();
?>

<script>
	//mixpanel tracking
	window.onload = function(e) {
		mpTrack.pageView(document.title, 'page');
	}
</script>

<?php
	/**
	 * DATA COLLECTION - START
	 **/

    /** Init variables **/
	require_once( get_stylesheet_directory(). '/partials/data-collection/init-variables.php' );

	/** Get general datas **/
	require_once( get_stylesheet_directory(). '/partials/data-collection/general-datas.php' );

	/** Get page width info **/
	require_once( get_stylesheet_directory(). '/partials/data-collection/page-width.php' );

	$media = get_post_meta($post->ID, '_uncode_featured_media', 1);
	$media_display = get_post_meta($post->ID, '_uncode_featured_media_display', 1);
	$featured_image = get_post_thumbnail_id($post->ID);
	if ($featured_image === '') $featured_image = $media;

	/** Collect header data **/
	require_once( get_stylesheet_directory(). '/partials/data-collection/header-data.php' );

	/** Get layout info **/
	require_once( get_stylesheet_directory(). '/partials/data-collection/layout-info.php' );

	/** Get breadcrumb info **/
	require_once( get_stylesheet_directory(). '/partials/data-collection/breadcrumb-info.php' );

	/** Get title info **/
	require_once( get_stylesheet_directory(). '/partials/data-collection/title-info.php' );

	/** Get media info **/
	require_once( get_stylesheet_directory(). '/partials/data-collection/media-info.php' );

	/**
	 * DATA COLLECTION - END
	 **/

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
		/** Build breadcrumb **/

		if ($show_breadcrumb && !is_front_page() && !is_home())
		{
			if ($breadcrumb_align === '') $breadcrumb_align = 'left';
			$breadcrumb_align = ' text-' . $breadcrumb_align;

			$content_breadcrumb = uncode_breadcrumbs();
			$breadcrumb_title = '<div class="breadcrumb-title h5 text-bold">' . get_the_title() . '</div>';
			echo uncode_get_row_template($breadcrumb_title . $content_breadcrumb, '', $limit_content_width, $style, ' row-breadcrumb row-breadcrumb-' . $style . $breadcrumb_align, 'half', true, 'half');
		}

		/** Update tweet post date so it appears as first content block on front page **/
		if (is_front_page())
		{
			$now = new DateTime();
			$tweetpost = array();
			$tweetpost['ID'] = 54975; 
			$tweetpost['post_date'] = $now->format('Y-m-d H:i:s');
			wp_update_post($tweetpost);
		}

		/** Build media **/

		if ($media !== '' && !$with_builder && $show_media && !post_password_required())
		{
			if ($layout === 'sidebar_right' || $layout === 'sidebar_left')
			{
				$media_size = 12 - $sidebar_size;
			}
			else $media_size = 12;

			$media_array = explode(',', $media);
			$media_counter = count($media_array);
			$rand_id = big_rand();
			if ($media_counter === 0) $media_array = array(
				$media
			);

			if ($media_display === 'isotope') $media_content.= '<div id="gallery-' . $rand_id . '" class="isotope-system post-media">
											<div class="isotope-wrapper half-gutter">
	        										<div class="isotope-container isotope-layout style-masonry" data-type="masonry" data-layout="masonry" data-lg="1000" data-md="600" data-sm="480">';

			foreach ($media_array as $key => $value)
			{
				if ($media_display === 'carousel') $value = $media;
				$block_data = array();
				$block_data['media_id'] = $value;
				$block_data['classes'] = array(
					'tmb'
				);
				$block_data['text_padding'] = 'no-block-padding';
				if ($media_display === 'isotope')
				{
					$block_data['single_width'] = 4;
					$block_data['classes'][] = 'tmb-iso-w4';
				}
				else $block_data['single_width'] = $media_size;
				$block_data['single_style'] = $style;
				$block_data['single_text'] = 'under';
				$block_data['classes'][] = 'tmb-'.$style;
				if ($media_display === 'isotope') {
					$block_data['classes'][] = 'tmb-overlay-anim';
					$block_data['classes'][] = 'tmb-overlay-text-anim';
					$block_data['single_icon'] = 'fa fa-plus2';
					$block_data['overlay_color'] = ($style == 'light') ? 'style-black-bg' : 'style-white-bg';
					$block_data['overlay_opacity'] = '20';
					$lightbox_classes = array();
					$lightbox_classes['data-noarr'] = false;
				} else {
					$lightbox_classes = false;
					$block_data['link_class'] = 'inactive-link';
					$block_data['link'] = '#';
				}
				$block_data['title_classes'] = array();
				$block_data['tmb_data'] = array();
				$block_layout['media'] = array();
				$block_layout['icon'] = array();
				$media_html = uncode_create_single_block($block_data, $rand_id, 'masonry', $block_layout, $lightbox_classes, false, true);
				if ($media_display !== 'isotope') $media_content.= '<div class="post-media">' . $media_html . '</div>';
				else
				{
					$media_content.= $media_html;
				}
				if ($media_display === 'carousel') break;
			}

			if ($media_display === 'isotope') $media_content.= '</div>
											</div>
										</div>';
		}

		/** Build title **/

		if ($show_title) {
			$title_content .= apply_filters( 'uncode_before_body_title', '' );
			$title_content .= '<div class="post-title-wrapper"><h1 class="post-title">' . get_the_title() . '</h1></div>';
			$title_content .= apply_filters( 'uncode_after_body_title', '' );
		}

		/** Build content **/

		$the_content = get_the_content();
		if ( has_shortcode( $the_content, 'vc_row' ) ) $with_builder = true;


		if ( !$with_builder ) {
			$the_content = apply_filters('the_content', $the_content);
			$the_content = $title_content . $the_content;
			if ($media_content !== '') $the_content = $media_content . $the_content;
		}	else {
			$get_content_appended = apply_filters('the_content', '');
			if (!is_null($get_content_appended) && $get_content_appended !== '') $the_content = $the_content . uncode_get_row_template($get_content_appended, $limit_width, $limit_content_width, $style, '', false, true, 'double', $page_custom_width);
		}


    	$the_content .= wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'uncode' ),
			'after'  => '</div>',
			'link_before'	=> '<span>',
	    'link_after'	=> '</span>',
			'echo'	=> 0
		));

		/** Build post after block **/

		$page_content_block_after = (isset($metabox_data['_uncode_specific_content_block_after'][0])) ? $metabox_data['_uncode_specific_content_block_after'][0] : '';
		if ($page_content_block_after === '') {
			$generic_content_block_after = ot_get_option('_uncode_' . $post_type . '_content_block_after');
			$content_block_after = $generic_content_block_after !== '' ? $generic_content_block_after : false;
		} else {
			$content_block_after = $page_content_block_after !== 'none' ? $page_content_block_after : false;
		}

		if ($content_block_after !== false) {
			$content_block_after = apply_filters( 'wpml_object_id', $content_block_after, 'post' );
			$content_after_body = get_post_field('post_content', $content_block_after);
			if (class_exists('Vc_Base')) {
				$vc = new Vc_Base();
				$vc->addShortcodesCustomCss($content_block_after);
			}
			if (has_shortcode($content_after_body, 'vc_row')) $content_after_body = '<div class="post-after row-container"'.$page_custom_width.'>' . $content_after_body . '</div>';
			else $content_after_body = '<div class="post-after row-container">' . uncode_get_row_template($content_after_body, $limit_width, $limit_content_width, $style, '', false, true, 'double', $page_custom_width) . '</div>';
			if (class_exists('RP4WP_Post_Link_Manager')) {
				$automatic_linking_post_amount = RP4WP::get()->settings->get_option( 'automatic_linking_post_amount' );
				$uncode_related = new RP4WP_Post_Link_Manager();
				$related_posts = $uncode_related->get_children($post->ID,false);
				$related_posts_ids = array();
				foreach ($related_posts as $key => $value) {
					if (isset($value->ID)) $related_posts_ids[] = $value->ID;
				}
				$archive_query = '';
				$regex = '/\[uncode_index(.*?)\]/';
				$regex_attr = '/(.*?)=\"(.*?)\"/';
				preg_match_all($regex, $content_after_body, $matches, PREG_SET_ORDER);
				foreach ($matches as $key => $value) {
					$index_found = false;
					if (isset($value[1])) {
						preg_match_all($regex_attr, trim($value[1]), $matches_attr, PREG_SET_ORDER);
						foreach ($matches_attr as $key_attr => $value_attr) {
							switch (trim($value_attr[1])) {
								case 'auto_query':
									if ($value_attr[2] === 'yes') $index_found = true;
									break;
								case 'loop':
									$archive_query = $value_attr[2];
									break;
							}
						}
					}
					if ($index_found) {
						if ($archive_query === '') $archive_query = ' loop="size:10|by_id:' . implode(',', $related_posts_ids) .'|post_type:' . $post->post_type . '"';
						else {
							$parse_query = uncode_parse_loop_data($archive_query);
							$parse_query['by_id'] = implode(',', $related_posts_ids);
							if (!isset($parse_query['order'])) $parse_query['order'] = 'none';
							//$parse_query['post_type'] = $post->post_type;
							$archive_query = ' loop="' . uncode_unparse_loop_data($parse_query) . '"';
						}
						$value[1] = preg_replace('#\s(loop)="([^"]+)"#', $archive_query, $value[1], -1, $index_count);
						if ($index_count === 0) {
							$value[1] .= $archive_query;
						}
						$replacement = '[uncode_index' . $value[1] . ']';
						$content_after_body = str_replace($value[0], $replacement, $content_after_body);
					}
				}
			}
		}

  	/** Build post footer **/

  	$show_comments = ot_get_option('_uncode_' . $post_type . '_comments');

		if ((comments_open() || '0' != get_comments_number()) && $show_comments === 'on')
		{
			ob_start();
			comments_template();
			$footer_content.= ob_get_clean();
		}

  	if ( $layout === 'sidebar_right' || $layout === 'sidebar_left' ) {

  		/** Build structure with sidebar **/

  		if ($sidebar_size === '') $sidebar_size = 4;
  		$main_size = 12 - $sidebar_size;
  		$expand_col = '';

  		/** Collect paddings data **/

  		$footer_classes = ' no-top-padding double-bottom-padding';

  		if ($sidebar_bg_color !== '') {
  			if ($sidebar_fill === 'on') {
  				$sidebar_inner_padding .= ' std-block-padding';
  				$sidebar_padding .= $sidebar_bg_color;
  				$expand_col = ' unexpand';
  				if ($limit_content_width === '') {
  					$row_classes .= ' no-h-padding col-no-gutter no-top-padding';
  					$footer_classes = ' std-block-padding no-top-padding';
  					if (!$with_builder) {
  						$main_classes .= ' std-block-padding';
  					}
  				} else {
  					$row_classes .= ' no-top-padding';
  					if (!$with_builder) {
  						$main_classes .= ' double-top-padding';
  					}
  				}
  			} else {
  				$row_classes .= ' double-top-padding';
  				$row_classes .= ' double-bottom-padding';
  				$sidebar_inner_padding .= $sidebar_bg_color . ' single-block-padding';
  			}
  		} else {
  			if ($with_builder) {
  				if ($limit_content_width === '') {
  					$row_classes .= ' col-std-gutter no-top-padding';
  					if ($boxed !== 'on' && $page_custom_width === '') $row_classes .= ' no-h-padding';
  				} else $row_classes .= ' col-std-gutter no-top-padding';
  				$sidebar_inner_padding .= ' double-top-padding';
  			} else {
  				$row_classes .= ' col-std-gutter double-top-padding';
  				$main_classes .= ' double-bottom-padding';
  			}
  		}

  		$row_classes .= ' no-bottom-padding';
  		$sidebar_inner_padding .= ' double-bottom-padding';

  		/** Build sidebar **/

			$sidebar_content = "";
			ob_start();
			if ($sidebar !== '') {
				dynamic_sidebar($sidebar);
			} else {
				dynamic_sidebar();
			}
			$sidebar_content = ob_get_clean();

			/** Create html with sidebar **/

			$the_content = '<div class="post-content style-'.$style.$main_classes.'">' . $the_content . '</div>';

			if ($footer_content !== '') {
				if ($limit_content_width === '') $footer_content = uncode_get_row_template($footer_content, $limit_width, $limit_content_width, $style, '', false, true, '');
				$footer_content = '<div class="post-footer post-footer-' . $style . ' style-' . $style . $footer_classes . '">' . $footer_content . '</div>';
			}

			$main_content = 	'<div class="col-lg-'.$main_size.'">
					' . $the_content . $footer_content . '
				</div>';

			$the_content = '<div class="row-container">
	        							<div class="row row-parent' . $row_classes . $limit_content_width . '"' . $page_custom_width . '>
													<div class="row-inner">
														' . (($layout === 'sidebar_right') ? $main_content : '') . '
														<div class="col-lg-' . $sidebar_size . '">
															<div class="uncol style-' . $sidebar_style . $expand_col . $sidebar_padding . (($sidebar_fill === 'on' && $sidebar_bg_color !== '') ? '' : $sidebar_sticky) . '">
																<div class="uncoltable' . (($sidebar_fill === 'on' && $sidebar_bg_color !== '') ? $sidebar_sticky : '') . '">
																	<div class="uncell' . $sidebar_inner_padding . '">
																		<div class="uncont">
																			' . $sidebar_content . '
																		</div>
																	</div>
																</div>
															</div>
														</div>
														' . (($layout === 'sidebar_left') ? $main_content : '') . '
													</div>
												</div>
											</div>';

		} else {
			/** Create html without sidebar **/
			if ($with_builder) {
				$the_content = '<div class="post-content">' . $the_content  . '</div>';
			} else {
				$the_content = '<div class="post-content"'.$page_custom_width.'>' . uncode_get_row_template($the_content, $limit_width, $limit_content_width, $style, '', 'double', true, 'double')  . '</div>';
			}
			if ($footer_content !== '') $the_content.= '<div class="post-footer post-footer-' . $style . ' row-container">' . uncode_get_row_template($footer_content, $limit_width, $limit_content_width, $style, '', true, true, 'double', $page_custom_width) . '</div>';
		}

		/** Display post html **/
		echo 	'<article id="post-'. get_the_ID().'" class="'.implode(' ', get_post_class('page-body'.$bg_color)) .'">
						<div class="post-wrapper">
							<div class="post-body">' . uncode_remove_wpautop($the_content . $content_after_body) . '</div>
						</div>
					</article>';

	endwhile; // end of the loop. ?>

<?php get_footer(); ?>