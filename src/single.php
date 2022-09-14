<?php

/**
 * The Template for displaying all single posts.
 *
 * @package uncode
 */

get_header();

$post_type = $post->post_type;

$tag_ids = wp_get_post_tags($post->ID, ['fields' => 'ids']);

$page_header = new unheader(uncode_get_general_header_data(['_uncode_header_type' => ['header_basic']], $post_type, get_post_thumbnail_id($post->ID))['meta'], $post->post_title);

$content_block_after = apply_filters('wpml_object_id', ot_get_option('_uncode_'.$post_type.'_content_block_after'), 'post');
$content_after_body = '<div class="post-after row-container">'.get_post_field('post_content', $content_block_after).'</div>';
$content_after_body = apply_filters('related_posts', $post->ID, $content_after_body);
?>

	<script>
		//mixpanel tracking
		window.onload = function (e) {
			mpTrack.pageView(document.title, '<?=strtolower(uncode_custom_just_category($block_data['id']))?>');
		}
	</script>

<?php

while(have_posts()):
	the_post();
	?>

	<div id="page-header"><?= uncode_remove_wpautop($page_header->html) ?></div>

	<script type="text/javascript">UNCODE.initHeader();</script>

	<?php
	if(class_exists('Vc_Base')) :
		$vc = new Vc_Base();
		$vc->addShortcodesCustomCss($content_block_after);
	endif;
	?>

	<article id="post-<?= get_the_ID() ?>" class="<?= implode(' ', get_post_class('page-body style-color-xsdn-bg')) ?>">
		<div class="post-wrapper">
			<div class="post-body">
				<div class="row-container">
					<div class="row row-parent col-std-gutter no-bottom-padding"
						 style="max-width: 1024px; margin: auto;">
						<div class="row-inner">
							<div class="col-lg-3">
								<div class="uncol style-light">
									<div class="uncoltable">
										<div class="uncell">
											<div class="uncont">
												<?php dynamic_sidebar(ot_get_option('_uncode_'.$post_type.'_sidebar')); ?>
												<?= uncode_author_info() ?>
												<div class="post-share">
													<div class="detail-container">
														<h5>Share</h5>
														<div class="share-button share-buttons share-inline only-icon"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-9">
								<div class="post-content style-light double-bottom-padding">
									<?= uncode_remove_wpautop(apply_filters('the_content', get_the_content())) ?>
									<?= wp_link_pages([
										'before' => '<div class="page-links">'.esc_html__('Pages:', 'uncode'),
										'after' => '</div>',
										'link_before' => '<span>',
										'link_after' => '</span>',
										'echo' => 0
									]) ?>
									<?php if($tag_ids): ?>
										<div class="widget-container post-tag-container uncont text-left">
											<div class="tagcloud dark">
												<?= wp_tag_cloud([
													'smallest' => 11,
													'largest' => 11,
													'unit' => 'px',
													'include' => $tag_ids,
													'taxonomy' => 'post_tag',
													'echo' => false,
													'number' => 999
												]) ?>
											</div>
										</div>
									<?php endif; ?>
								</div>
								<?= uncode_remove_wpautop($content_after_body) ?>
								<?php if(comments_open() || '0' != get_comments_number()) : ?>
									<div class="post-footer post-footer-light style-light no-top-padding double-bottom-padding">
										<div class="row-container">
											<div class="row row-parent style-light no-top-padding no-bottom-padding">
												<?= comments_template() ?>
											</div>
										</div>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</article>

<?php
endwhile;
// end of the loop.

get_footer();