<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package uncode
 */

get_header();

$body_classes = get_body_class();
?>

<script>
	//mixpanel tracking
	window.onload = function(e) {
		mpTrack.pageView(document.title, '<?php echo $body_classes[1] ?>');
	}
</script>

<?php
/**
 * DATA COLLECTION - START
 *
 */

/** Init variables **/
$limit_width = $limit_content_width = $the_content = $main_content = $layout = $sidebar_style = $sidebar_bg_color = $sidebar = $sidebar_size = $sidebar_sticky = $sidebar_padding = $sidebar_inner_padding = $sidebar_content = $title_content = $navigation_content = $page_custom_width = $row_classes = $main_classes = $footer_classes = $generic_body_content_block = '';
$index_has_navigation = false;

if (isset($post->post_type)) $post_type = $post->post_type . '_index';
else {
	global $wp_taxonomies;
	$get_object = $wp_taxonomies[$wp_query->get_queried_object()->taxonomy];
	$post_type = $get_object->object_type[0] . '_index';
}
$tax = (isset(get_queried_object()->term_id)) ? get_queried_object()->term_id : '';
$single_post_width = ot_get_option('_uncode_' . $post_type . '_single_width');
$single_text_length = ot_get_option('_uncode_' . $post_type . '_single_text_length');
set_query_var( 'single_post_width', $single_post_width );
if ($single_text_length !== '') set_query_var( 'single_text_length', $single_text_length );

/** Get general datas **/
$style = ot_get_option('_uncode_general_style');
$bg_color = ot_get_option('_uncode_general_bg_color');
$bg_color = ($bg_color == '') ? ' style-'.$style.'-bg' : ' style-'.$bg_color.'-bg';

/** Get page width info **/
$generic_content_full = ot_get_option('_uncode_' . $post_type . '_layout_width');
if ($generic_content_full === '')
{
	$main_content_full = ot_get_option('_uncode_body_full');
	if ($main_content_full === '' || $main_content_full === 'off') $limit_content_width = ' limit-width';
}
else
{
	if ($generic_content_full === 'limit') {
		$generic_custom_width = ot_get_option('_uncode_'.$post_type.'_layout_width_custom');
		if (isset($generic_custom_width[0]) && isset($generic_custom_width[1])) {
			if ($generic_custom_width[1] === 'px') {
				$page_custom_width[0] = 12 * round(($generic_custom_width[0]) / 12);
			}
			if (is_array($generic_custom_width) && !empty($generic_custom_width)) {
				$page_custom_width = ' style="max-width: '.implode('', $generic_custom_width).'; margin: auto;"';
			}
		} else {
			$limit_content_width = ' limit-width';
		}
	}
}

/** Collect header data **/
$page_header_type = ot_get_option('_uncode_' . $post_type . '_header');
if ($page_header_type !== '' && $page_header_type !== 'none')
{
	$metabox_data['_uncode_header_type'] = array($page_header_type);
	$term_back = get_option( '_uncode_taxonomy_' . $tax );
	if (isset($term_back['term_media']) && $term_back['term_media'] !== '') $featured_image = $term_back['term_media'];
	else $featured_image = '';
	$meta_data = uncode_get_general_header_data($metabox_data, $post_type, $featured_image);
	$metabox_data = $meta_data['meta'];
}

/** Get layout info **/
$activate_sidebar = ot_get_option('_uncode_' . $post_type . '_activate_sidebar');
if ($activate_sidebar !== 'off')
{
	$layout = ot_get_option('_uncode_' . $post_type . '_sidebar_position');
	if ($layout === '') $layout = 'sidebar_right';
	$sidebar = ot_get_option('_uncode_' . $post_type . '_sidebar');
	$sidebar_style = ot_get_option('_uncode_' . $post_type . '_sidebar_style');
	$sidebar_size = ot_get_option('_uncode_' . $post_type . '_sidebar_size');
	$sidebar_sticky = ot_get_option('_uncode_' . $post_type . '_sidebar_sticky');
	$sidebar_sticky = ($sidebar_sticky === 'on') ? ' sticky-element sticky-sidebar' : '';
	$sidebar_fill = ot_get_option('_uncode_' . $post_type . '_sidebar_fill');
	$sidebar_bg_color = ot_get_option('_uncode_' . $post_type . '_sidebar_bgcolor');
	$sidebar_bg_color = ($sidebar_bg_color !== '') ? ' style-' . $sidebar_bg_color . '-bg' : '';
	if ($sidebar_style === '') $sidebar_style = $style;
}

/**
 * DATA COLLECTION - END
 *
 */

$posts_counter = $wp_query->post_count;

/** Build header **/
if ($page_header_type !== '' && $page_header_type !== 'none')
{
	$get_title = uncode_archive_title();
	$get_subtitle = isset(get_queried_object()->description) ? get_queried_object()->description : '';
	$page_header = new unheader($metabox_data, $get_title, $get_subtitle);

	$header_html = $page_header->html;
	if ($header_html !== '') {
		echo '<div id="page-header">';
		echo uncode_remove_wpautop( $page_header->html );
		echo '</div>';
	}
}
echo '<script type="text/javascript">UNCODE.initHeader();</script>';

if (have_posts()):

	$generic_body_content_block = ot_get_option('_uncode_' . $post_type . '_content_block');

	if ($generic_body_content_block === '') {

		$the_content .=
			'<div id="index-' . rand() . '" class="isotope-system">
				<div class="isotope-wrapper single-gutter">
					<div class="isotope-container isotope-layout style-masonry isotope-pagination" data-type="masonry" data-layout="masonry" data-lg="800">';

		/* Start the Loop */
		while (have_posts()):
			the_post();

			/* Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			*/
			if ($post->post_type === 'post') $template = get_post_format();
			else $template = $post->post_type;
			ob_start();
			get_template_part('content', $template);
			$the_content .= ob_get_clean();
		endwhile;

		$the_content .=
					'</div>
				</div>
			</div>';
	} else {

		$generic_body_content_block = apply_filters( 'wpml_object_id', $generic_body_content_block, 'post' );
		$uncode_block = get_post_field('post_content', $generic_body_content_block);
		$archive_query = ' loop="size:'.get_option('posts_per_page').'|order_by:date|post_type:'.(!is_date() ? $post->post_type : 'post');

		if (is_author()) {
			$archive_query .= '|authors:'.get_queried_object()->ID.'"';
		} else if (is_date()) {
			if (isset($wp_query->query_vars['year'])) $archive_query .= '|year:'.$wp_query->query_vars['year'];
			if (isset($wp_query->query_vars['monthnum'])) $archive_query .= '|month:'.$wp_query->query_vars['monthnum'];
			if (isset($wp_query->query_vars['day'])) $archive_query .= '|day:'.$wp_query->query_vars['day'];
			$archive_query .= '"';
		} else {
			if ($post->post_type === 'post') {
				switch (get_queried_object()->taxonomy) {
					case 'category':
						$tax_query = 'categories';
						break;
					case 'post_tag':
						$tax_query = 'tags';
						break;
					default:
						$tax_query = 'tax_query';
						break;
				}
			} else $tax_query = 'tax_query';
			if ($tax !== '') $archive_query .= '|'.$tax_query.':'.$tax.'"';
			else $archive_query .= '"';
		}

		$regex = '/\[uncode_index(.*?)\]/';
		$regex_attr = '/(.*?)=\"(.*?)\"/';
		preg_match_all($regex, $uncode_block, $matches, PREG_SET_ORDER);
		foreach ($matches as $key => $value) {
			$index_found = false;
			$index_pagination = false;
			$index_infinite = false;
			if (isset($value[1])) {
				preg_match_all($regex_attr, trim($value[1]), $matches_attr, PREG_SET_ORDER);
				foreach ($matches_attr as $key_attr => $value_attr) {
					switch (trim($value_attr[1])) {
						case 'auto_query':
							if ($value_attr[2] === 'yes') $index_found = true;
							break;
						case 'pagination':
							if ($value_attr[2] === 'yes') $index_pagination = true;
							break;
						case 'infinite':
							if ($value_attr[2] === 'yes') $index_infinite = true;
							break;
					}
				}
			}
			if ($index_found) {
				$value[1] = preg_replace('#\s(loop)="([^"]+)"#', $archive_query, $value[1], -1, $index_count);
				if ($index_count === 0) {
					$value[1] .= $archive_query;
				}
				$replacement = '[uncode_index' . $value[1] . ']';
				$uncode_block = str_replace($value[0], $replacement, $uncode_block);
				if ($index_pagination || $index_infinite) $index_has_navigation = true;
			}
		}
		$the_content .= $uncode_block;

	}

	else :

		ob_start();
		get_template_part('content', 'none');
		$the_content .= ob_get_clean();

	endif;

    /** Create html without sidebar **/
    if ($generic_body_content_block === '') $the_content = '<div class="post-content"' . $page_custom_width . '>' . uncode_get_row_template($the_content, $limit_width, $limit_content_width, $style, '', 'double', true, 'double') . '</div>';
    else $the_content = '<div class="post-content"' . $page_custom_width . '>' . $the_content . '</div>';

	/** Display post html **/
?>
<div class="page-body<?= $bg_color ?>">
    <div class="post-wrapper">
        <div class="post-body"><?= do_shortcode($the_content) ?></div>
    </div>
</div>

<?php
// end of the loop.

get_footer(); ?>
