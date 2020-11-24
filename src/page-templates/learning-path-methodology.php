<?php
/* Template Name: Learning Path Methodology */

/**
 * The template for Learning Path Methodology pages.
 *
 * @package uncode
 */

get_header();
?>

<script>
	//mixpanel tracking
	window.onload = function(e) {
		//mpTrack.pageView(document.title, 'learning module');
	}
</script>

<?php
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
		// $page_header_type = $metabox_data['_uncode_header_type'][0];
		// if ($page_header_type !== 'none') {
		// 	$meta_data = uncode_get_specific_header_data($metabox_data, $post_type, $featured_image);
		// 	$metabox_data = $meta_data['meta'];
		// 	$show_title = $meta_data['show_title'];
		// }
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

	<article class="learning-path methodology">
		<div class="learning-path-navigation">
			<div class="navigation-inner content-width">
				<div class="breadcrumbs">
					<span class="text-green">Learning with the Centre</span><a href="<?php echo get_site_url() . '/learning-path/disclosure-risk-assessment-overview/' ?>"> / Disclosure Risk Assessment</a>
				</div>
				<div class="sub-navigation">
					<a href="#" class="active">How it is Done</a>
					<a href="#">Request Support</a>
				</div>
			</div>
		</div>

		<div class="feature-header">
			<div class="content-width">
				<h1>How it is Done</h1>
			</div>
		</div>

		<section class="section-step content-width">
			<div class="column-container">
				<div class="column column-5">
					<h2 class="numbered text-blue">Before you get started</h2>
					<p>Before we start the risk assessment, it is important to explore the data you have and make sure you know how it was collected.</p>
					<p>This could involve reviewing the original questionnaire and the sample methodology, assessing the data environment and doing some initial exploratory analysis to understand the relationships between variables.</p>
					<div class="button-read-more">Read More</div>
				</div>
				<div class="column column-7 align-right">
					<div class="placeholder-media"></div>
				</div>
			</div>

			<div class="content-drawer">
				<div class="column-container">
					<div class="column column-4">
						<h3 class="pad-bottom">Start by Reviewing the Questionnaire</h3>
					</div>
					<div class="column column-4">
						<h3 class="pad-bottom">Ask about the Sampling Methodology</h3>
					</div>
					<div class="column column-4">
						<h3 class="pad-bottom">Decide on what tool you are going to use and get it set up!</h3>
					</div>
				</div>
				<div class="column-container pad-bottom">
					<div class="column column-4 no-pad-top">
						<p class="border-top">In case of survey data, an inspection of the survey questionnaire is useful as it will help when we have to classify the variables.</p>
					</div>
					<div class="column column-4 no-pad-top">
						<p class="border-top">It is important to gather information about the survey methodology, such as strata, sampling methods, survey design and sample weights. This will be important throughout the statistical disclosure control process.</p>
					</div>
					<div class="column column-4 no-pad-top">
						<p class="border-top">At the Centre, we use sdcMicro but it is one of a few open source tools that can be used to apply statistical disclosure control.  If this is your first time using sdcMicro, you will have to install it using the command install.packages ("sdcMicro"). Remember, every time you open R, you will need to load the packages that you are going to use. You can load sdcMicro with the command library(sdcMicro).</p>
					</div>
				</div>

				<div class="column-container">
					<div class="column column-4">
						<h3 class="pad-bottom">Start Exploring Data</h3>
					</div>
				</div>
				<div class="column-container">
					<div class="column column-4 no-pad-top">
						<p class="border-top">It is important to gather information about the survey methodology, such as strata, sampling methods, survey design and sample weights. This will be important throughout the statistical disclosure control process.</p>
					</div>
				</div>

				<div class='section-faq'>
					<h2>Related Questions</h2>
					<?php the_content(); ?>
				</div>
			</div>
		</section>

		<section class="section-step background-gray-light">
			<div class="content-width">
				<div class="column-container">
					<div class="column column-7">
						<div class="placeholder-media"></div>
					</div>
					<div class="column column-5">
						<h2 class="numbered text-blue">Setting Your Key Variables</h2>
						<p>The first step in the risk assessment is the selection of your key variables. These are the columns in your dataset that could lead to the risk of re-identification of individuals or groups.</p>
						<p>Watch the video to learn more about different types of variables and considerations to make when selecting key variables.</p>
						<a href="#" class="button-read-more">Read More</a>
					</div>
				</div>
			</div>
		</section>

		<section class="section-step content-width">
			<div class="column-container">
				<div class="column column-5">
					<h2 class="numbered text-blue">Run the assessment</h2>
					<p>There are a number of different methods that can be used to evaluate the probability of individuals within our dataset being correctly re-identified.</p>
					<p>Watch the video to learn more about these different measures and how to apply them in sdcMicro.</p>
					<a href="#" class="button-read-more">Read More</a>
				</div>
				<div class="column column-7 align-right">
					<div class="placeholder-media"></div>
				</div>
			</div>
		</section>

		<section class="section-step background-gray-light">
			<div class="content-width">
				<div class="column-container">
					<div class="column column-7">
						<div class="placeholder-media"></div>
					</div>
					<div class="column column-5">
						<h2 class="numbered text-blue">Read the assessment result</h2>
						<p>Once you have run the assessment it is important to understand how to read and interpret the results. Remember, the disclosure risk measures that we have discussed provide you with a probability of an event occurring, they do not provide certainty. Our own judgement remains important when deciding how to proceed.</p>
						<p>Watch the video and click below to learn more about what the risk probability means and the actions you might take to lower the risk.</p>
						<a href="#" class="button-read-more">Read More</a>
					</div>
				</div>
			</div>
		</section>

		<section class="section-step content-width">
			<div class="column-container">
				<div class="column column-5">
					<h2 class="numbered text-blue">Handle data responsibly</h2>
					<p>Knowing the risk of re-identification helps you make informed decisions about whether and how best to share your microdata.</p>
					<p>If the dataset contains sensitive information, you could learn more on how to anonymise and try the assessment again or explore other options for sharing the data safely.</p>
					<a href="#" class="button-read-more">Read More</a>
				</div>
				<div class="column column-7 align-right">
					<div class="placeholder-media"></div>
				</div>
			</div>
		</section>

		<section class="section-documentation background-horizontal-gradient">
			<div class="content-width">
				<h2 class="section-header">Full documentation</h2>
				<div class="column-container">
					<div class="column column-6 align-right">
						<div class="section-card">
							<img src="<?php echo get_stylesheet_directory_uri() . '/assets/learning-path/icon-guideline.png' ?>" />
							<h3>Data Responsibility Guidelines</h3>
							<p class="attribution">OCHA</p>
							<p>The Guidelines offer a set of key actions, outputs, and tools for data responsibility at each step in the data management, from collecting and storing to disseminating and destroying.</p>
						</div>
					</div>
					<div class="column column-6 align-left">
						<div class="section-card">
							<img src="<?php echo get_stylesheet_directory_uri() . '/assets/learning-path/icon-documentation.png' ?>" />
							<h3>Statistical Disclosure Control Documentation</h3>
							<p class="attribution">World Bank</p>
							<p>SDCMicro is free, R-based open-source package for the generation of protected microdata for researchers and public use. This package can be used for the generation of anonymized (micro)data</p>
						</div>
					</div>
				</div>
			</div>
		</section>
	</article>	

	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
