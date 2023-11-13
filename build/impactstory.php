<?php
/* Template Name: ImpactStory */

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

?>

	<script>
		//mixpanel tracking
		window.onload = function (e) {
			mpTrack.pageView(document.title, 'impact story');
		}
	</script>

<?php while(have_posts()): ?>

	<?php the_post(); ?>

	<div id="page-header"><?= uncode_remove_wpautop($page_header->html) ?></div>

	<script type="text/javascript">UNCODE.initHeader();</script>

	<article class="impact-story page-body style-color-xsdn-bg page type-page status-publish has-post-thumbnail hentry">
		<div class="post-wrapper">
			<div class="post-body">
				<div class="post-content">
					<div data-parent="true" class="row-container boomapps_vcrow" data-section="0">
						<div class="row limit-width row-parent" data-imgready="true">
							<div class="row-inner">
								<div class="pos-top pos-center align_left column_parent col-lg-8 boomapps_vccolumn single-internal-gutter">

									<?php if(get_field('author')):
										$author = get_field('author'); ?>
										<div class="author-info">
											<h5 class="author">By <a
														href="<?php echo get_author_posts_url($author['ID'], $author['user_nicename']); ?>"><?php echo $author['display_name'] ?></a>
											</h5>
											<div class="social-links">
												<a href="mailto:<?php echo $author['user_email'] ?>"><i
															class="fa fa-envelope" aria-hidden="true"></i></a>
											</div>
										</div>
									<?php else: ?>
										<div class="author-info default">
											<h5 class="author">By Centre Team</h5>
										</div>
									<?php endif; ?>

									<?php $partners = get_field('partners');
									if($partners): ?>
										<div class="story-info">
											<h5 class="label">Partners:</h5>
											<?php if($partners['partner_url']): ?>
											<a href="<?php echo $partners['partner_url']; ?>" target="_blank">
												<?php endif;
												echo $partners['partner_name'];
												if($partners['partner_url']): ?>
											</a>
										<?php endif; ?>
										</div>
									<?php endif; ?>

									<?php $services = get_field('centre_service');
									if($services): ?>
										<div class="story-info">
											<h5 class="label">Centre Service:</h5>
											<span class="services">
												<?php foreach($services as $key => $service): ?>
													<a
													href="<?php echo $service['value']; ?>"><?php echo $service['label']; ?></a><?php if($key < count($services) - 1) echo ', ';
												endforeach; ?>
												</span>
										</div>
									<?php endif; ?>

									<?php $terms = get_field('tags');
									if($terms): ?>
										<div class="story-info">
											<h5 class="label">Tags:</h5>
											<div class="tags">
												<ul>
													<?php foreach($terms as $term): ?>
														<li>
															<a href="<?php echo get_term_link($term); ?>"><?php echo $term->name; ?></a>
														</li>
													<?php endforeach; ?>
												</ul>
											</div>
										</div>
									<?php endif; ?>

									<div class='summary'>
										<?php if(get_field('summary')): ?>
											<h3>Summary:</h3>
											<?php the_field('summary'); ?>
										<?php endif; ?>
									</div>

									<?php if(get_field('challenge')): ?>
										<h3>Challenge:</h3>
										<?php the_field('challenge'); ?>
									<?php endif; ?>

									<?php if(get_field('centre_action')): ?>
										<h3>Centre action:</h3>
										<?php the_field('centre_action'); ?>
									<?php endif; ?>

									<?php if(get_field('outcome')): ?>
										<h3>Outcome:</h3>
										<?php the_field('outcome'); ?>
									<?php endif; ?>

									<?php if(get_field('conclusion')): ?>
										<h3>Conclusion:</h3>
										<?php the_field('conclusion'); ?>
									<?php endif; ?>
								</div>

								<div class="pos-top pos-center align_left column_parent col-lg-4 boomapps_vccolumn single-internal-gutter sidebar">
									<div>
										<?php $quote = get_field('quote');
										if($quote['quote_text']): ?>
											<blockquote>“<?php echo $quote['quote_text']; ?>
												”<br><span>- <?php echo $quote['quote_author']; ?>, <?php echo $quote['quote_author_organization']; ?></span>
											</blockquote>
										<?php endif; ?>

										<div class="volunteer-signup">
											<p>Want to know the latest about the Centre and HDX?<br>Sign up for our
												newsletter.</p>
											<?php echo do_shortcode('[mailchimp-newsletter-form]'); ?>
                                        </div>

										<?php if(have_rows('related_content')): ?>
											<h6>Related content:</h6>
											<ul class="links">
												<?php while(have_rows('related_content')): the_row();
													$link = get_sub_field('link'); ?>

													<li>
														<?php if($link): ?>
															<h6><?php echo get_sub_field('link_type'); ?></h6>
															<a href="<?php echo $link['url']; ?>"
															   target="<?php echo $link['target']; ?>">
																<?php echo $link['title']; ?>
															</a>
														<?php endif; ?>
													</li>
												<?php endwhile; ?>
											</ul>
										<?php endif; ?>
									</div>
								</div>
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
