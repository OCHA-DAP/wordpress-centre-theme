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

if(isset($post->post_type)) $post_type = $post->post_type.'_index';
else {
	global $wp_taxonomies;
	$get_object = $wp_taxonomies[$wp_query->get_queried_object()->taxonomy];
	$post_type = $get_object->object_type[0].'_index';
}
$tax = (isset(get_queried_object()->term_id)) ? get_queried_object()->term_id : '';
$single_post_width = ot_get_option('_uncode_'.$post_type.'_single_width');
$single_text_length = ot_get_option('_uncode_'.$post_type.'_single_text_length');
set_query_var('single_post_width', $single_post_width);
if($single_text_length !== '') set_query_var('single_text_length', $single_text_length);

$page_header = new unheader(uncode_get_general_header_data(['_uncode_header_type' => ['header_basic']], $post_type, '')['meta'], uncode_archive_title(), isset(get_queried_object()->description) ? get_queried_object()->description : '');

$body_classes = get_body_class();
?>

	<script>
		//mixpanel tracking
		window.onload = function (e) {
			mpTrack.pageView(document.title, '<?=$body_classes[1]?>');
		}
	</script>

	<div id="page-header"><?= uncode_remove_wpautop($page_header->html) ?></div>

	<script type="text/javascript">UNCODE.initHeader();</script>

	<div class="page-body style-color-xsdn-bg">
		<div class="post-wrapper">
			<div class="post-body">
				<div class="post-content">
					<?php if(have_posts()) : ?>
						<?= do_shortcode(apply_filters('archive_posts', $post, $post_type, $tax)) ?>
					<?php else : ?>
						<?= get_template_part('content', 'none') ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

<?php
// end of the loop.

get_footer();
