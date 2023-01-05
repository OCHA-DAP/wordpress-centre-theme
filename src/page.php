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

$post_type = $post->post_type;

$page_header = new unheader(uncode_get_general_header_data(['_uncode_header_type' => ['header_basic']], $post_type, get_post_thumbnail_id($post->ID))['meta'], $post->post_title);

$content_block_after = apply_filters('wpml_object_id', ot_get_option('_uncode_'.$post_type.'_content_block_after'), 'post');
$content_after_body = '<div class="post-after row-container" style="max-width: 1024px; margin: auto;">'.get_post_field('post_content', $content_block_after).'</div>';
$content_after_body = apply_filters('related_posts', $post->ID, $content_after_body);

?>

	<script>
		//mixpanel tracking
		window.onload = function (e) {
			mpTrack.pageView(document.title, 'page');
		}
	</script>

<?php while(have_posts()): ?>

	<?php the_post(); ?>

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
				<div class="post-content" style="max-width: 1024px; margin: auto;">
					<div class="row-container">
						<div class="row row-parent style-light double-top-padding double-bottom-padding">
							<?php if($layout === 'sidebar_right' || $layout === 'sidebar_left') : ?>
								<div class="col-lg-4">
									<div class="uncol style-light">
										<div class="uncoltable">
											<div class="uncell">
												<div class="uncont">
													<?php dynamic_sidebar(); ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php endif; ?>
							<?= uncode_remove_wpautop(apply_filters('the_content', get_the_content())) ?>
							<?= wp_link_pages([
								'before' => '<div class="page-links">'.esc_html__('Pages:', 'uncode'),
								'after' => '</div>',
								'link_before' => '<span>',
								'link_after' => '</span>',
								'echo' => 0
							]) ?>
							<?php if((comments_open() || '0' != get_comments_number()) && ot_get_option('_uncode_'.$post_type.'_comments') === 'on') : ?>
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
				<?= uncode_remove_wpautop($content_after_body) ?>
			</div>
		</div>
	</article>

<?php
endwhile;
// end of the loop.

get_footer();
