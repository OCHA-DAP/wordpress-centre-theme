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
	$limit_width = $limit_content_width = $the_content = $main_content = $layout = $bg_color = $sidebar_style = $sidebar_bg_color = $sidebar = $sidebar_size = $sidebar_sticky = $sidebar_padding = $sidebar_inner_padding = $sidebar_content = $title_content = $page_custom_width = $row_classes = $main_classes = $footer_content = $footer_classes = $content_after_body = '';
	$with_builder = false;

	$post_type = $post->post_type;

	/** Get general datas **/
    $style = ot_get_option('_uncode_general_style');
    $bg_color = ot_get_option('_uncode_general_bg_color');
	$bg_color = ($bg_color == '') ? ' style-'.$style.'-bg' : ' style-'.$bg_color.'-bg';

	/** Get page width info **/
	$boxed = ot_get_option('_uncode_boxed');

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

	$featured_image = get_post_thumbnail_id($post->ID);

	/** Collect header data **/
	if (isset($metabox_data['_uncode_header_type'][0]) && $metabox_data['_uncode_header_type'][0] !== '') {
		$page_header_type = $metabox_data['_uncode_header_type'][0];
		if ($page_header_type !== 'none') {
			$meta_data = uncode_get_specific_header_data($metabox_data, $post_type, $featured_image);
			$metabox_data = $meta_data['meta'];
		}
	} else {
		$page_header_type = ot_get_option('_uncode_'.$post_type.'_header');
		if ($page_header_type !== '' && $page_header_type !== 'none') {
			$metabox_data['_uncode_header_type'] = array($page_header_type);
			$meta_data = uncode_get_general_header_data($metabox_data, $post_type, $featured_image);
			$metabox_data = $meta_data['meta'];
		}
	}

	/** Get layout info **/
	if (isset($metabox_data['_uncode_active_sidebar'][0]) && $metabox_data['_uncode_active_sidebar'][0] !== '') {
		if ($metabox_data['_uncode_active_sidebar'][0] !== 'off') {
			$layout = (isset($metabox_data['_uncode_sidebar_position'][0])) ? $metabox_data['_uncode_sidebar_position'][0] : '';
			$sidebar = (isset($metabox_data['_uncode_sidebar'][0])) ? $metabox_data['_uncode_sidebar'][0] : '';
			$sidebar_size = (isset($metabox_data['_uncode_sidebar_size'][0])) ? $metabox_data['_uncode_sidebar_size'][0] : 4;
			$sidebar_sticky = (isset($metabox_data['_uncode_sidebar_sticky'][0]) && $metabox_data['_uncode_sidebar_sticky'][0] === 'on') ? ' sticky-element' : '';
			$sidebar_fill = (isset($metabox_data['_uncode_sidebar_fill'][0])) ? $metabox_data['_uncode_sidebar_fill'][0] : '';
			$sidebar_style = (isset($metabox_data['_uncode_sidebar_style'][0])) ? $metabox_data['_uncode_sidebar_style'][0] : $style;
			$sidebar_bg_color = (isset($metabox_data['_uncode_sidebar_bgcolor'][0]) && $metabox_data['_uncode_sidebar_bgcolor'][0] !== '') ? ' style-' . $metabox_data['_uncode_sidebar_bgcolor'][0] . '-bg' : '';
		}
	} else {
		$activate_sidebar = ot_get_option('_uncode_'.$post_type.'_activate_sidebar');
		if ($activate_sidebar !== 'off') {
			$layout = ot_get_option('_uncode_'.$post_type.'_sidebar_position');
			if ($layout === '') $layout = 'sidebar_right';
			$sidebar = ot_get_option('_uncode_'.$post_type.'_sidebar');
			$sidebar_style = ot_get_option('_uncode_'.$post_type.'_sidebar_style');
			$sidebar_size = ot_get_option('_uncode_'.$post_type.'_sidebar_size');
			$sidebar_sticky = ot_get_option('_uncode_' . $post_type . '_sidebar_sticky');
			$sidebar_sticky = ($sidebar_sticky === 'on') ? ' sticky-element sticky-sidebar' : '';
			$sidebar_fill = ot_get_option('_uncode_'.$post_type.'_sidebar_fill');
			$sidebar_bg_color = ot_get_option('_uncode_'.$post_type.'_sidebar_bgcolor');
			$sidebar_bg_color = ($sidebar_bg_color !== '') ? ' style-' . $sidebar_bg_color . '-bg' : '';
		}
	}

	if ($sidebar_style === '') $sidebar_style = $style;

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
		}
		echo '<script type="text/javascript">UNCODE.initHeader();</script>';

		/** Update tweet post date so it appears as first content block on front page **/
		if (is_front_page())
		{
			$now = new DateTime();
			$tweetpost = array();
			$tweetpost['ID'] = 54975; 
			$tweetpost['post_date'] = $now->format('Y-m-d H:i:s');
			wp_update_post($tweetpost);
		}

		/** Build content **/

		$the_content = get_the_content();
		if ( has_shortcode( $the_content, 'vc_row' ) ) $with_builder = true;


		if ( !$with_builder ) {
			$the_content = apply_filters('the_content', $the_content);
			$the_content = $title_content . $the_content;
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

        $generic_content_block_after = ot_get_option('_uncode_' . $post_type . '_content_block_after');
        $content_block_after = $generic_content_block_after !== '' ? $generic_content_block_after : false;

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
?>
        <article id="post-<?= get_the_ID() ?>" class="<?= implode(' ', get_post_class('page-body'.$bg_color)) ?>">
            <div class="post-wrapper">
                <div class="post-body"><?= uncode_remove_wpautop($the_content.$content_after_body) ?></div>
            </div>
        </article>

<?php
endwhile;

// end of the loop.

get_footer(); ?>