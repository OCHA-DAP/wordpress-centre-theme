<?php

/**
 * The Template for displaying all single posts.
 *
 * @package uncode
 */

get_header();

$post_category = strtolower(uncode_custom_just_category($block_data['id']));
?>

<script>
	//mixpanel tracking
	window.onload = function(e) {
		mpTrack.pageView(document.title, '<?php echo $post_category ?>');
	}
</script>

<?php
/**
 * DATA COLLECTION - START
 *
 */

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
 *
 */

while (have_posts()):
	the_post();

	/** Build header **/
	if ($page_header_type !== '' && $page_header_type !== 'none')
	{
		$page_header = new unheader($metabox_data, $post->post_title);

		$header_html = $page_header->html;
		if ($header_html !== '') {
			echo '<div id="page-header">';
			echo uncode_remove_wpautop( $page_header->html );
			echo '</div>';
		}

		if (!empty($page_header->poster_id) && $page_header->poster_id !== false && $media !== '')
		{
			$media = $page_header->poster_id;
		}
	}
	echo '<script type="text/javascript">UNCODE.initHeader();</script>';

	/** Build content **/

	$the_content = get_the_content();

    $the_content = apply_filters('the_content', $the_content);
    $the_content = $title_content . $the_content;
    if ($media_content !== '') $the_content = $media_content . $the_content;

	$the_content .= wp_link_pages( array(
		'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'uncode' ),
		'after'  => '</div>',
		'link_before'	=> '<span>',
    'link_after'	=> '</span>',
		'echo'	=> 0
	));

	/** Build tags **/

	$page_show_tags = (isset($metabox_data['_uncode_specific_tags'][0])) ? $metabox_data['_uncode_specific_tags'][0] : '';
	if ($page_show_tags === '')
	{
		$generic_show_tags = ot_get_option('_uncode_' . $post_type . '_tags');
		$show_tags = ($generic_show_tags === 'off') ? false : true;
		if ($show_tags) $show_tags_align = ot_get_option('_uncode_' . $post_type . '_tags_align');
	}
	else
	{
		$show_tags = ($page_show_tags === 'off') ? false : true;
		if ($show_tags) $show_tags_align = (isset($metabox_data['_uncode_specific_tags_align'][0])) ? $metabox_data['_uncode_specific_tags_align'][0] : '';
	}

	if ($show_tags) {
		$tag_ids = wp_get_post_tags( $post->ID, array( 'fields' => 'ids' ) );
		if ( $tag_ids ) {
			$args = array(
				'smallest'                  => 11,
				'largest'                   => 11,
				'unit'                      => 'px',
				'include'                   => $tag_ids,
				'taxonomy'                  => 'post_tag',
				'echo'                      => false,
				'number'										=> 999,
			);

			$tag_cloud = '<div class="widget-container post-tag-container uncont text-'.$show_tags_align.'"><div class="tagcloud dark">' . wp_tag_cloud($args) . '</div></div>';

			$the_content .= $tag_cloud;
	  }
	}

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
		if (has_shortcode($content_after_body, 'vc_row')) $content_after_body = '<div class="post-after row-container">' . $content_after_body . '</div>';
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

	$show_comments = ot_get_option('_uncode_' . $post_type . '_comments');

	if ((comments_open() || '0' != get_comments_number()) && $show_comments === 'on')
	{
		ob_start();
		comments_template();
		$footer_content.= ob_get_clean();
	}

	if ($layout === 'sidebar_right' || $layout === 'sidebar_left')
	{

		/** Build structure with sidebar **/

		if ($sidebar_size === '') $sidebar_size = 4;
		$main_size = 12 - $sidebar_size;
		$expand_col = '';

		/** Collect paddings data **/

		$footer_classes = ' no-top-padding double-bottom-padding';

		if ($sidebar_bg_color !== '')
		{
			if ($sidebar_fill === 'on')
			{
				$sidebar_inner_padding.= ' std-block-padding';
				$sidebar_padding.= $sidebar_bg_color;
				$expand_col = ' unexpand';
				if ($limit_content_width === '')
				{
					$row_classes.= ' no-h-padding col-no-gutter no-top-padding';
					$footer_classes = ' std-block-padding no-top-padding';
                    $main_classes.= ' std-block-padding';
				}
				else
				{
					$row_classes.= ' no-top-padding';
                    $main_classes.= ' double-top-padding';
				}
			}
			else
			{
				$row_classes .= ' double-top-padding';
				$row_classes .= ' double-bottom-padding';
				$sidebar_inner_padding.= $sidebar_bg_color . ' single-block-padding';
			}
		}
		else
		{
            $row_classes.= ' col-std-gutter';
            $main_classes.= ' double-bottom-padding';
		}

		$row_classes.= ' no-bottom-padding';
		$sidebar_inner_padding.= '';

		/** Build sidebar **/

		$sidebar_content = "";
		ob_start();
		if ($sidebar !== '')
		{
			dynamic_sidebar($sidebar);
		}
		else
		{
			dynamic_sidebar();
		}
		$sidebar_content = ob_get_clean();

		$sidebar_content .= uncode_author_info();

		//show share in sidebar
		$page_show_share = (isset($metabox_data['_uncode_specific_share'][0])) ? $metabox_data['_uncode_specific_share'][0] : '';
		if ($page_show_share === '') {
			$generic_show_share = ot_get_option('_uncode_' . $post_type . '_share');
			$show_share = ($generic_show_share === 'off') ? false : true;
		} else {
			$show_share = ($page_show_share === 'off') ? false : true;
		}

		if ($show_share)
			$sidebar_content .= '<div class="post-share">
	          						<div class="detail-container">
	          							<h5>Share</h5>
										<div class="share-button share-buttons share-inline only-icon"></div>
									</div>
								</div>';

		/** Create html with sidebar **/


		$the_content = '<div class="post-content style-' . $style . $main_classes . '">' . $the_content . '</div>';

		if ($footer_content !== '') {
			if ($limit_content_width === '') $footer_content = uncode_get_row_template($footer_content, $limit_width, $limit_content_width, $style, '', false, true, '');
			$footer_content = '<div class="post-footer post-footer-' . $style . ' style-' . $style . $footer_classes . '">' . $footer_content . '</div>';
		}


		$main_content = '<div class="col-lg-' . $main_size . '">
											' . $the_content . $content_after_body . $footer_content . '
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
	}
	else
	{

		/** Create html without sidebar **/
        $the_content = '<div class="post-content"' . $page_custom_width . '>' . uncode_get_row_template($the_content, $limit_width, $limit_content_width, $style, '', 'double', true, 'double') . '</div>';
		$the_content .= $content_after_body;
		$the_content .= '<div class="post-footer post-footer-' . $style . ' row-container">' . uncode_get_row_template($footer_content, $limit_width, $limit_content_width, $style, '', false, true, 'double', $page_custom_width) . '</div>';
	}

	/** Display post html **/
?>

    <article id="post-<?= get_the_ID() ?>" class="<?= implode(' ', get_post_class('page-body'.$bg_color)) ?>">
        <div class="post-wrapper">
            <div class="post-body"><?= uncode_remove_wpautop($the_content) ?></div>
        </div>
    </article>

<?php
endwhile;
// end of the loop.

get_footer(); ?>