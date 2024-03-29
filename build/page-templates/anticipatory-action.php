<?php
/* Template Name: Anticipatory Action */

/**
 * The template for Anticipatory Action page.
 *
 * @package uncode
 */

get_header();

$post_type = $post->post_type;

$menu_name = get_field('menu_name');
$page_header = new unheader(uncode_get_general_header_data(['_uncode_header_type' => ['header_basic']], $post_type, get_post_thumbnail_id($post->ID))['meta'], $post->post_title);

?>

<?php while(have_posts()): ?>

	<?php the_post(); ?>

	<div id="page-header"><?= uncode_remove_wpautop($page_header->html) ?></div>

	<script type="text/javascript">UNCODE.initHeader();</script>

	<article class="anticipatory-action page-body">
		<?php if(get_field('tutorial_introduction')): ?>
			<h3><?php the_field('tutorial_introduction'); ?></h3>
		<?php endif; ?>

		<div class="feature-content">
			<div class="content-width">
				<div class="feature-inner">

				</div>
			</div>
		</div>

		<div class="content-width column-container post-content">
			<div class="row limit-width">
				<div class="row-inner">
					<div class="col-lg-3">
						<ul class="jump-menu">
							<?php
							$sections = get_content_sections();
							foreach($sections as $section) {
								$id = $section->getAttribute('id');
								$h3 = $section->getElementsByTagName('h3');
								$title = $h3[0]->textContent;
								?>
								<li><a href="#<?php echo $id ?>"><?php echo $title ?></a></li>
							<?php } ?>
						</ul>
					</div>

					<div class="col-lg-9">
						<?php
						$the_content = get_the_content();
						$the_content = apply_filters('the_content', $the_content);
						echo $the_content;
						?>

						<!-- country resource section -->
						<?php $country_resources = get_field('country_resources');
						if($country_resources['faq_id']): ?>
							<section class="section-faq">
								<h3><?php echo $country_resources['title']; ?></h3>
								<div class="accordion overview-accordion" id="faqAccordion">

									<?php
									$id = $country_resources['faq_id'];
									$url = get_site_url();
									$json = file_get_contents($url.'/wp-json/wp/v2/ufaq?ufaq-category='.$id);
									$items = json_decode($json);

									//sort items by slug
									function cmp($a, $b)
									{
										return strcmp($a->slug, $b->slug);
									}

									usort($items, "cmp");

									foreach($items as $key => $var) { ?>
										<div class="card">
											<div class="card-header" id="heading<?php echo $key ?>">
												<h4 class="my-0">
													<button class="btn btn-link btn-block text-left" type="button"
															data-toggle="collapse"
															data-target="#collapse<?php echo $key ?>"
															aria-expanded="true"
															aria-controls="collapse<?php echo $key ?>">
														<?php echo $items[$key]->title->rendered ?>
													</button>
												</h4>
											</div>
											<div id="collapse<?php echo $key ?>" class="collapse"
												 aria-labelledby="heading<?php echo $key ?>"
												 data-parent="#faqAccordion">
												<div class="card-body">
													<?php echo $items[$key]->content->rendered ?>
												</div>
											</div>
										</div>
									<?php } ?>

							</section>
						<?php endif; ?>

						<!-- global resource section -->
						<?php $global_resources = get_field('global_resources'); ?>
						<h3><?php echo $global_resources['title']; ?></h3>
						<?php
						$links = $global_resources['links'];
						if($links):
							foreach($links as $link): ?>
								<ul>
									<?php foreach($link as $l): ?>
										<li><a href="<?php echo $l['link_url']; ?>"
											   target="_blank"><?php echo $l['link_name']; ?></a></li>
									<?php endforeach; ?>
								</ul>
							<?php endforeach;
						endif;
						?>
					</div>
				</div>
			</div>
		</div>
	</article>

<?php
endwhile;
// end of the loop.

get_footer();
