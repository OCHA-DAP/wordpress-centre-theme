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
									<p>In 2016, the International Federation of the Red Cross and Red Crescent Societies (lFRC) embarked on a journey to improve its information management capabilities ranging from technical platforms to data literacy. A core element of the strategy is the Humanitarian Exchange Language (HXL), a standard that works by adding semantic hashtags to the top of columns in spreadsheets and systems to make it easier to process, combine and visualize data.</p>

									<h3>Challenge:</h3>
									<p>The IFRC has been great at responding to disasters with surge capacity. National societies send staff who lend their data skills for up to three months during the height of a disaster. However, when these months pass, the information management support is no longer provided. In response, the IFRC launched the Go Project. The aim is to improve information management throughout the movement, from compiling templates to maintaining technical platforms and providing consistency through data standards. As a large organisation, technology and process decisions move slowly. And as a membership organisation, it can be difficult to align so many societies on workflows.</p>

									<h3>Centre action:</h3>
									<p>The Centre’s work to define and promote the HXL language and to build the tool infrastructure that make it useful have been vital for the IFRC. The HXL Tag Assist and Quick Charts provide the ideal toolset to push the Go Project forward through flexible standards and rapid prototyping. The HXL infrastructure meant that dashboards could be stood up in hours to test ideas and manage complex data processing without the need to create new systems from scratch. Flexible HXL hashtags meant that templates could be made which national societies could adapt to their own bespoke purposes, but with the added value of being able to visualize and combine data from many societies.</p>

									<h3>Outcome:</h3>
									<p>At the end of the first year of Project Go, the IFRC now has the evidence to make further investment in tools and data. Without HXL, the low-risk environment for initial testing would not have existed.</p> 
									<p>We have also seen how Project Go and HXL worked to support field operations. When Tropical Cyclone Enawo passed over Madagascar in March 2017, the national society was able to stand up an information management hub in hours to help coordinate the response. The Malagasy Red Cross Society, as the main responder, carried out a number of on-the-ground assessments. The data was shared on HDX and included HXL hashtags, which meant staff were able to visualise their work in a few clicks using Quick Charts.</p>
								</div>
								<div class="pos-top pos-center align_left column_parent col-lg-4 boomapps_vccolumn single-internal-gutter sidebar">
									<div>
										<h5 class="label">Partners:</h5>
										<img src="http://localhost:8888/humdata/wp-content/uploads/2017/04/iom-logo.png" width="84">
									</div>
									<div>
										<h5 class="label">Crisis:</h5>
										<a href="#" target="_blank">Rohingya Displacement <i class="fa fa-external-link" aria-hidden="true"></i></a>
									</div>
									<div>
										<h5 class="label">Centre Service:</h5>
										<a href="#">Data Services</a>
									</div>
									<div>
										<h5 class="label">Tags:</h5>
										<ul class="tags">
											<li><a href="#">Madagascar</a></li>
											<li><a href="#">Cyclone Enawo</a></li>
										</ul>
									</div>
									<div>
										<blockquote>“HXL super-powered our project. Without it, we would not have been able to test our ideas so quickly and show senior management our vision.”<br><span>- Simon Johnson, British Red Cross</span></blockquote>
									</div>
								</div>
							</div>
							<div class="row-inner">
								<div class="pos-top pos-center align_left column_parent col-lg-12 boomapps_vccolumn single-internal-gutter">
									<div class="row conclusion">
										<div class="col-lg-8">
											<h3>Conclusion:</h3>
											<p>The Centre’s investment in HXL has helped the IFRC to create efficiency and meet the goals of Project Go. The use of HXL will continue to be critical as the IFRC’s develops its information management capabilities. The IFRC will also seek to integrate the functionality coming from the new HDX tools domain.</p>
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
								<div class="pos-top pos-center align_left column_parent col-lg-8 boomapps_vccolumn single-internal-gutter">
									<h3>Process:</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sollicitudin et purus quis mattis. Aliquam lacinia malesuada nibh, sed condimentum urna laoreet eget. Vivamus in tincidunt est. Donec luctus sed lorem at molestie. Cras cursus ex id nunc porta ornare nec a elit. Vivamus nec purus ipsum. Duis et porttitor neque, ac bibendum sem. Sed ex augue, pulvinar ac diam a, aliquet imperdiet enim. Donec accumsan condimentum lorem, accumsan pretium lacus condimentum sed.</p>

									<div class="visuals-gallery">
										<ul>
											<li><img src="http://localhost:8888/humdata/wp-content/uploads/2017/04/impact-hxl-1.png"></li>
											<li><img src="http://localhost:8888/humdata/wp-content/uploads/2017/04/impact-hxl-2.png"></li>
										</ul>
										<div class="gallery-btn next-btn"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
										<div class="gallery-btn prev-btn"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
									</div>
								</div>
								<div class="pos-top pos-center align_left column_parent col-lg-4 boomapps_vccolumn single-internal-gutter sidebar-related">
									<div>
										<h6>Related content:</h6>
										<ul class="links">
											<li>
												<h6>Asset</h6>
												<a href="http://hxlstandard.org">HXL Standard</a>
											</li>
											<li>
												<h6>Asset</h6>
												<a href="https://tools.humdata.org">HDX Tools</a>
											</li>
											<li>
												<h6>Asset</h6>
												<a href="https://tools.humdata.org/quickcharts/">Quick Charts</a>
											</li>
											<li>
												<h6>Asset</h6>
												<a href="https://tools.humdata.org/examples/hxl/">HXL Tag Assist</a>
											</li>
											<li>
												<h6>Blog</h6>
												<a href="https://medium.com/@Simon_B_Johnson/how-hxl-is-being-used-at-the-british-red-cross-281c0b632df6 ">How HXL is Being Used at the British Red Cross</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</article>


	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>