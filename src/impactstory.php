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
		$page_header_type = $metabox_data['_uncode_header_type'][0];
		if ($page_header_type !== 'none') {
			$meta_data = uncode_get_specific_header_data($metabox_data, $post_type, $featured_image);
			$metabox_data = $meta_data['meta'];
			$show_title = $meta_data['show_title'];
		}
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

	<article class="impact-story page-body style-color-xsdn-bg page type-page status-publish has-post-thumbnail hentry">
		<div class="post-wrapper">
			<div class="post-body">
				<div class="post-content">
					<div data-parent="true" class="row-container boomapps_vcrow" data-section="0">
						<div class="row limit-width row-parent" data-imgready="true">
							<div class="row-inner">
								<div class="pos-top pos-center align_left column_parent col-lg-8 boomapps_vccolumn single-internal-gutter">

									<?php if( get_field('author') ): 
										$author = get_field('author');  ?>
										<div class="author-info">
											<h5 class="author">By <a href="<?php echo get_author_posts_url( $author['ID'], $author['user_nicename'] ); ?>"><?php echo $author['display_name'] ?></a></h5>
											<div class="social-links">
												<a href="mailto:<?php echo $author['user_email'] ?>"><i class="fa fa-envelope" aria-hidden="true"></i></a>
											</div>
										</div>
									<?php else: ?>
										<h5 class="author">By Centre Team</h5>
									<?php endif; ?>
								

									<?php if( get_field('summary') ): ?>
										<?php the_field('summary'); ?>
									<?php endif; ?>

									<?php if( get_field('challenge') ): ?>
										<h3>Challenge:</h3>
										<?php the_field('challenge'); ?>
									<?php endif; ?>

									<?php if( get_field('centre_action') ): ?>
										<h3>Centre action:</h3>
										<?php the_field('centre_action'); ?>
									<?php endif; ?>

									<?php if( get_field('outcome') ): ?>
										<h3>Outcome:</h3>
										<?php the_field('outcome'); ?>
									<?php endif; ?>
								</div>
								
								<div class="pos-top pos-center align_left column_parent col-lg-4 boomapps_vccolumn single-internal-gutter sidebar">
									<?php $partners = get_field('partners');
										if( $partners ): ?>
											<div>
												<h5 class="label">Partners:</h5>
												<?php if( $partners['partner_url'] ): ?>
													<a href="<?php echo $partners['partner_url']; ?>" target="_blank">
												<?php endif; ?>

													<?php if( $partners['partner_logo']['url'] ): ?>
														<img class="partner-logo" src="<?php echo $partners['partner_logo']['url']; ?>" />
													<?php else: 
														echo $partners['partner_name'];
													endif; ?>
												<?php if( $partners['partner_url'] ): ?>
													</a>
												<?php endif; ?>
											</div>
									<?php endif; ?>

									<?php $story_type = get_field('impact_story_type');
										if( $story_type ): ?>
											<div>
												<h5 class="label"><?php echo $story_type['type']; ?>:</h5>
												<a href="<?php echo $story_type['name']['url']; ?>" target="_blank"><?php echo $story_type['name']['title']; ?><i class="fa fa-external-link" aria-hidden="true"></i></a>
											</div>
									<?php endif; ?>

									<?php $services = get_field('centre_service');
										if( $services ): ?>
											<div>
												<h5 class="label">Centre Service:</h5>
												<div class="services">
												<?php foreach( $services as $key=>$service ): ?>
													<a href="<?php echo $service['value']; ?>"><?php echo $service['label']; ?></a><?php if ($key<count($services)-1) echo ', ';
												endforeach; ?>
												</div>
											</div>
									<?php endif; ?>

									<div>
										<h5 class="label">Tags:</h5>
										<?php the_tags( '<ul class="tags"><li>', '</li><li>', '</li></ul>' ); ?>
									</div>

									<?php $quote = get_field('quote');
										if( $quote['quote_text'] ): ?>
											<div>
												<blockquote>“<?php echo $quote['quote_text']; ?>”<br><span>- <?php echo $quote['quote_author']; ?>, <?php echo $quote['quote_author_organization']; ?></span></blockquote>
											</div>
									<?php endif; ?>
								</div>
							</div>
							<div class="row-inner">
								<div class="pos-top pos-center align_left column_parent col-lg-12 boomapps_vccolumn single-internal-gutter">
									<div class="row conclusion">
										<div class="col-lg-8">
											<?php if( get_field('conclusion') ): ?>
												<h3>Conclusion:</h3>
												<?php the_field('conclusion'); ?>
											<?php endif; ?>
										</div>
										<div class="col-lg-4 volunteer-signup">
											<p>Interested in getting involved?<br>Signup to our volunteer list</p>
											<div id="mc_embed_signup">
												<form action="//humdata.us14.list-manage.com/subscribe/post?u=ea3f905d50ea939780139789d&amp;id=99796325d1" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
												    <div id="mc_embed_signup_scroll">
														<div class="mc-field-group">
															<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Your email address"><input type="submit" value="submit" name="subscribe" id="mc-embedded-subscribe" class="btn submit-btn">
														</div>
														
														<div id="mce-responses" class="clear">
															<div class="response" id="mce-error-response" style="display:none"></div>
															<div class="response" id="mce-success-response" style="display:none"></div>
														</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
													    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_ea3f905d50ea939780139789d_99796325d1" tabindex="-1" value=""></div>
												    </div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row-inner">
								<?php $images = get_field('visuals');
									if( $images ): ?>
										<div class="visuals-gallery">
										    <ul class="visuals">
										        <?php foreach( $images as $id=>$image ): ?>
										            <li class="visual<?php if ($id==0) echo ' active' ?>">
										                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
										                <p class="photo-credit"><?php echo $image['caption']; ?></p>
										            </li>
										        <?php endforeach; ?>
										    </ul>
											<ul class="dot-indicator">
										        <?php foreach( $images as $id=>$image ): ?>
													<li class="dot<?php if ($id==0) echo ' active' ?>"></li>
										        <?php endforeach; ?>
											</ul>
											<div class="gallery-btn next-btn"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
											<div class="gallery-btn prev-btn"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
									    </div>
								<?php endif; ?>

								<?php if( have_rows('related_content') ): ?>
									<div class="pos-top pos-center align_left column_parent col-lg-4 boomapps_vccolumn single-internal-gutter sidebar-related">
										<div>
											<h6>Related content:</h6>
											<ul class="links">
												<?php while( have_rows('related_content') ): the_row(); 
													$link = get_sub_field('link'); ?>
													
													<li>
														<?php if( $link ): ?>
															<h6><?php echo get_sub_field('link_type'); ?></h6>
															<a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
																<?php echo $link['title']; ?>
															</a>
														<?php endif; ?>
													</li>
												<?php endwhile; ?>
											</ul>
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

	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>