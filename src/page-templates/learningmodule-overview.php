<?php
/* Template Name: Learning Module Overview */

/**
 * The template for Learning Module Overview pages.
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

	<article class="learning-module">
		<div class="learning-module-navigation">
			<div class="navigation-inner content-width">
				<div class="breadcrumbs">
					<span class="text-green">Learning with the Centre</span><a href="#" class="active">/DISCLOSURE RISK ASSESSMENT</a>
				</div>
				<div class="sub-navigation">
					<a href="<?php echo get_site_url() . '/learning-module-methodology/' ?>">See how it works</a>
					<a href="#">Request support</a>
				</div>
			</div>
		</div>

		<div class="feature-content">
			<div class="content-width">
				<div class="feature-inner">
					<h1>We offer step-by-step guidance to support the safe, ethical and effective use of (micro)data in humanitarian response.</h1>
					<h3 class="text-blue">Data is a very important asset for all humanitarian organisations, but can also contain risks: here you can learn more about data responsibility and how to apply a Disclosure Risk assessment methodology based on Statistical Disclosure Control (SDC) to detect potential sensitive information in your datasets, before transferring them to your collaborators inside or outside your organization.</h3>
				</div>
			</div>
		</div>
		<div class="feature-media content-width">
			<!-- <div class='video-container'>
        <video controls>
          <source src="<?php echo get_stylesheet_directory_uri() . '/assets/learning-module/video/overview.mp4' ?>" type='video/mp4'>
          Your browser does not support the video tag.
        </video>
      </div> -->
			<div class="feature-media-caption">
				<h3>Disclosure risk assessment at work</h3>
				<p class="attribution">Tutorial by OCHA</p>
			</div>
		</div>

		<section class="section-importance content-width">
			<h2 class="section-header">Why it is important</h2>
			<div class="column-container has-icons">
				<div class="column column-4 background-gray">
					<div class="column-inner">
						<img class="icon" src="<?php echo get_stylesheet_directory_uri() . '/assets/learning-module/icon-funnel.png' ?>" />
						<h3>Most humanitarian organisations acknowledge the sensitivity of personal data such as names, biometrics, or ID numbers.</h3>
					</div>
				</div>
				<div class="column column-4 background-gray">
					<div class="column-inner">
						<img class="icon" src="<?php echo get_stylesheet_directory_uri() . '/assets/learning-module/icon-eye.png' ?>" />
						<h3>By combining different data points, it may be possible to re-identify individuals or groups and put them at risk.</h3>
					</div>
				</div>
				<div class="column column-4 background-gray">
					<div class="column-inner">
						<img class="icon" src="<?php echo get_stylesheet_directory_uri() . '/assets/learning-module/icon-book.png' ?>" />
						<h3>During emergencies, survey data, and other forms of microdata, need to be shared with partners as fast as possible.</h3>
					</div>
				</div>
			</div>
			<div class="column-container">
				<div class="column column-4 background-gray">
					<div class="column-inner no-pad-top">
						<p class="border-top">This data should be anonymised, as a matter of standard practice, before being shared. However, even after removing the direct identifiers, it may be possible to re-identify respondents.</p>
					</div>
				</div>
				<div class="column column-4 background-gray">
					<div class="column-inner no-pad-top">
						<p class="border-top">Humanitarians can apply statistical disclosure control to humanitarian datasets to help detect this type of risk and make informed decisions about how best to minimise it. This would make it possible for humanitarians to share microdata more widely without harming affected people.</p>
					</div>
				</div>
				<div class="column column-4 background-gray">
					<div class="column-inner no-pad-top">
						<p class="border-top">Having tools, policies and procedures in place to assess and minimise the risk of re-identification in microdata can help humanitarians share data quickly and safely.</p>
					</div>
				</div>
			</div>
		</section>

		<section class="section-stages background-gray">
			<div class="content-width">
				<h2 class="section-header">The Stages of Statistical Disclosure Control</h3>
				<div class="column-container">
					<div class="column column-4">
						<h3>Limiting the risk of re-identification through statistical disclosure control has three distinct phases:</h3>
						<p>Description of the three phases > Assessment is the Disclosure Risk measurement to understand how sensitive and risky data is, Application is the phase where we can apply anonymization techniques while the Re-assessment and data loss quantification is a way to measure again the sensitivity and also to understand how was the compromise  between anonymization and information loss.</p>
					</div>
					<div class="column column-8 align-right">
						<img src="<?php echo get_stylesheet_directory_uri() . '/assets/learning-module/stages-statistical-disclosure.png' ?>" />
					</div>
				</div>
			</div>
		</section>

		<section class="section-faq content-width">
			<h2 class="section-header">General Questions</h2>
			<?php the_content(); ?>
		</section>

		<section class="section-methodology background-gray-medium">
			<div class="content-width align-center">
				<h2 class="text-blue">Try this methodology in your workflow</h2>
				<p>You will learn how to run SDCmicro to assess the sensititivity of your microdata and take action to reduce the risk of re-identification.</p>
				<a href="#" class="button-primary">How it works</a>
			</div>
		</section>

		<section class="section-learnmore background-gray-dark">
			<div class="content-width align-center">
				<h2 class="text-blue">Learn more with us</h2>
				<p>We offer assistance and training for anyone who wants to find more</p>
				<a href="#" class="button-primary button-dark">Book a training</a>
				<a href="#">Or watch our tutorial</a>
			</div>
		</section>


	</article>	

	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
