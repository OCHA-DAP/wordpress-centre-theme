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
					<a href="#" class="active">See How It's Done</a>
					<!-- <a href="#">Request Support</a> -->
				</div>
			</div>
		</div>

		<div class="feature-content">
			<div class="content-width">
				<div class="feature-inner">
					<h1>See How It's Done</h1>
					<h3>Conducting a Disclosure Risk Assessment requires you to use statistical methods to estimate the likelihood of a disclosure taking place. The following instructional videos and guidance explain these methods and how they can be applied to humanitarian microdata.</h3>
				</div>
			</div>
		</div>

		<section class="section-step content-width">
			<div class="column-container">
				<div class="column column-5">
					<h2 class="numbered">Prepare the Disclosure Risk Assessment</h2>
					<p>Before you start the risk assessment, it is important to explore your data. This could involve reviewing the original questionnaire and the sample methodology, assessing the data environment and conducting exploratory analysis to understand the relationships between variables.</p>
					<div class="button-read-more">Read More</div>
				</div>
				<div class="column column-7 align-right">
					<iframe class="video-container" src="https://www.youtube.com/embed/QPRw9knMy1c?modestbranding=1&rel=0"></iframe>
				</div>
			</div>

			<div class="content-drawer">
				<div class="column-container">
					<div class="column column-4">
						<h3 class="pad-bottom">Start by reviewing the questionnaire.</h3>
					</div>
					<div class="column column-4">
						<h3 class="pad-bottom">Have the sampling weights on hand.</h3>
					</div>
					<div class="column column-4">
						<h3 class="pad-bottom">Explore your data.</h3>
					</div>
				</div>
				<div class="column-container pad-bottom">
					<div class="column column-4 no-pad-top">
						<p class="border-top">In case of survey data, you should review the questionnaire before starting the assessment. This will help you to understand the different variables represented in the dataset.</p>
					</div>
					<div class="column column-4 no-pad-top">
						<p class="border-top">Sampling weights are used to correct for the systematic differences in the selection probabilities of different respondents. If you are working with data collected through sampling, you will need the sample weights to perform a disclosure risk assessment.</p>
					</div>
					<div class="column column-4 no-pad-top">
						<p class="border-top">The first step in the risk assessment is to get to know the data you have. Applying Statistical Disclosure Control requires you to understand relationships between variables. Before jumping into the assessment, take the time to dig into those relationships.</p>
					</div>
				</div>

				<div class="column-container">
					<div class="column column-4">
						<h3 class="pad-bottom">Remove all direct identifiers from the dataset.</h3>
					</div>
					<div class="column column-4">
						<h3 class="pad-bottom">Set up your tool of choice.</h3>
					</div>
					<div class="column column-4"></div>
				</div>
				<div class="column-container">
					<div class="column column-4 no-pad-top">
						<p class="border-top">It is important to gather information about the survey methodology, such as strata, sampling methods, survey design and sample weights. This will be important throughout the statistical disclosure control process.</p>
					</div>
					<div class="column column-4 no-pad-top">
						<p class="border-top">At the Centre for Humanitarian Data, we use sdcMicro to perform the disclosure risk assessment. This is one of a few open source tools that can be used to apply Statistical Disclosure Control.  If this is your first time using sdcMicro, you can download the package from the Comprehensive R Archive Network.</p>
					</div>
					<div class="column column-4 no-pad-top"></div> 
				</div>

				<div class='section-faq'>
					<h2>General Questions</h2>
					<?php echo do_shortcode("[ultimate-faqs include_category='disclosure-risk-assessment-step-1']"); ?>
				</div>
			</div>
		</section>

		<section class="section-step background-gray">
			<div class="content-width">
				<div class="column-container">
					<div class="column column-7">
						<iframe class="video-container" src="https://www.youtube.com/embed/2iUZyMmUFbI?modestbranding=1&rel=0"></iframe>
					</div>
					<div class="column column-5">
						<h2 class="numbered">Selecting Your Key Variables</h2>
						<p>The first step in a disclosure risk assessment is the selection of key variables. These are the variables, or the columns in your dataset, that are most likely to lead to the disclosure of confidential information, including an individual’s identity.  Watch this video to learn more about different types of variables and how to select your key variables.</p>
						<a href="#" class="button-read-more">Read More</a>
					</div>
				</div>

				<div class="content-drawer">
					<div class="column-container">
						<div class="column column-4">
							<h3 class="pad-bottom">Start by classifying the variables in your microdata as identifying and non-identifying.</h3>
						</div>
						<div class="column column-4">
							<h3 class="pad-bottom">Select your key variables.</h3>
						</div>
						<div class="column column-4">
							<h3 class="pad-bottom">While direct identifiers are always considered sensitive, the sensitivity of indirect identifiers and non-identifying variables may depend on the context.</h3>
						</div>
					</div>
					<div class="column-container pad-bottom">
						<div class="column column-4 no-pad-top">
							<p class="border-top">Identifying variables contain information that can lead to the identification of respondents in the dataset. These can be further categorised as either direct identifiers or indirect identifiers (also referred to as quasi-identifiers). Remember, direct identifiers such as full names, addresses, phone numbers and GPS coordinates should always be removed from the microdata before starting the risk assessment.</p>
							<p>Non-identifying variables cannot be used to re-identify individuals but could lead to the disclosure of confidential information.</p>
						</div>
						<div class="column column-4 no-pad-top">
							<p class="border-top">A key variable is typically an indirect identifier that could be used to re-identify individuals within a datasets or to link records between different datasets. Common examples of key variables are age, material status, geographical variables, gender and religion. Removing all indirect identifiers from a dataset is likely to severely limit the analytical value of the dataset. The SDC process is intended to assess the disclosure risk presented by the indirect identifiers and to take steps to limit that risk, when possible, while maintaining the analytic power of the data.</p>
						</div>
						<div class="column column-4 no-pad-top">
							<p class="border-top">Because the sensitivity of variables is context specific, it is important to understand both the data environment and the real life situation when selecting your key variables. Remember that even when indirect identifiers are not themselves sensitive in nature, it may still be possible to combine them with other variables and lead to the <b>disclosure of sensitive information</b>.</p>
						</div>
					</div>

					<div class="column-container">
						<div class="column column-4">
							<h3 class="pad-bottom">Note whether your key variables are continuous or categorical.</h3>
						</div>
						<div class="column column-4">
							<h3 class="pad-bottom">Pay close attention to exclusive or partial variables.</h3>
						</div>
						<div class="column column-4"></div>
					</div>
					<div class="column-container">
						<div class="column column-4 no-pad-top">
							<p class="border-top">You will use different techniques to assess the disclosure risk of continuous and categorical variables. Categorical variables take values from a finite set (i.e. gender) whereas continuous variables are numeric variables that can take an infinite number of values (i.e. income). Continuous variables can be transformed into categorical variables by creating intervals (i.e. income brackets).</p>
						</div>
						<div class="column column-4 no-pad-top">
							<p class="border-top">While you do not want to remove all indirect identifiers, it may be important to remove some. For example, you may want to consider removing variables with many missing values, such as a variable recorded only for a select group.</p>
						</div>
						<div class="column column-4 no-pad-top"></div> 
					</div>

					<div class='section-faq'>
						<h2>General Questions</h2>
						<?php echo do_shortcode("[ultimate-faqs include_category='disclosure-risk-assessment-step-2']"); ?>
					</div>
				</div>
			</div>
		</section>

		<section class="section-step content-width">
			<div class="column-container">
				<div class="column column-5">
					<h2 class="numbered">Run the Assessment</h2>
					<p>There are a number of different methods that can be used to evaluate the probability of individuals within a dataset being correctly re-identified. Watch the video to learn more about these different methods and how they are applied.</p>
					<a href="#" class="button-read-more">Read More</a>
				</div>
				<div class="column column-7 align-right">
					<iframe class="video-container" src="https://www.youtube.com/embed/ZRyyZo76fVo?modestbranding=1&rel=0"></iframe>
				</div>
			</div>

			<div class="content-drawer">
				<div class="column-container">
					<div class="column column-4">
						<h3 class="pad-bottom">Apply the appropriate risk assessment method depending on the nature of your key variables.</h3>
					</div>
					<div class="column column-4">
						<h3 class="pad-bottom">Don’t forget continuous key variables.</h3>
					</div>
					<div class="column column-4">
						<h3 class="pad-bottom">Calculate the sample and population frequency of keys.</h3>
					</div>
				</div>
				<div class="column-container pad-bottom">
					<div class="column column-4 no-pad-top">
						<p class="border-top">There are different disclosure risk assessment methods for continuous and categorical key variables. Assessing the disclosure risk for categorical key variables is based on the concept of uniqueness with more unique combinations of key variables (15, female, widowed) having a higher risk of disclosure. For continuous variables, variables that can take an infinite number of values, the concept of uniqueness of a key is not helpful because every respondent could have a unique value for these variables. Most disclosure risk measures for continuous variables are a posteriori measures. For this reason, they are not useful for assessing the initial disclosure risk but can instead be used to evaluate disclosure risk after the data has been treated.</p>
					</div>
					<div class="column column-4 no-pad-top">
						<p class="border-top">We focus on categorical variables because they are more prevalent in humanitarian datasets but that doesn’t mean that you should ignore continuous key variables. One way to work with these variables in a disclosure risk assessment is to transform your continuous variable into categorical variables by creating intervals (income brackets, age ranges etc). If you don’t want to do this, outlier detection is one way to assess the disclosure risk of continuous key variables. You can apply Statistical Disclosure Control methods for continuous variables and then use risk assessment techniques like record linkage to evaluate the difference between the original and treated data.</p>
					</div>
					<div class="column column-4 no-pad-top">
						<p class="border-top">The unique combinations of key variable values are called keys. One way to assess disclosure risk is to calculate the frequency of different keys within the dataset and, if working with a sample, within the population. As a general rule, the more individual respondents that share a key, the lower the risk of a disclosure taking place.</p>
					</div>
				</div>

				<div class="column-container">
					<div class="column column-4">
						<h3 class="pad-bottom">Review k-anonymity, a common risk measure for categorical data.</h3>
					</div>
					<div class="column column-4">
						<h3 class="pad-bottom">Calculate the Individual Disclosure Risk.</h3>
					</div>
					<div class="column column-4">
						<h3 class="pad-bottom">Calculate the Individual Disclosure Risk.</h3>
					</div>
				</div>
				<div class="column-container">
					<div class="column column-4 no-pad-top">
						<p class="border-top">To achieve k-anonymity there needs to be at least k individuals in the dataset that share a combination of values for the selected key variables. A record that has the same key as two other individuals in the dataset would satisfy 3-anonymity because there are at least three (k) individuals in the dataset with that key. A record that violates 2-anonymity is said to be a unique record because it is the only record in the dataset with that specific key.</p>
						<p>Remember that k-anonymity does not take into account sample weights. While there may only be three individuals in the sample that share a key, depending on the sample weights, this may correspond to many thousands of people in the population.</p>
					</div>
					<div class="column column-4 no-pad-top">
						<p class="border-top">The Individual Disclosure Risk is the <b>probability</b> that an individual within a dataset could be correctly re-identified. The main factors influencing the individual risk calculation are the sample frequencies (the number of individuals that share a combination of key variables in the sample) and the sample weights. When individuals with rare combinations of key variables also have small sample weights, they will have a high relative individual disclosure risk. In other words, if the number of individuals with this specific combination of key variables is expected to be low in the population, this increases the risk that they can be correctly re-identified.</p>
					</div>
					<div class="column column-4 no-pad-top">
						<p class="border-top">Individual disclosure risk measures are useful for identifying high-risk records. These individual risk measures can also be aggregated to obtain a global disclosure risk measure for the entire file. A straightforward way of calculating global risk is to take the average (mean) of the individual risks.</p>
					</div>  
				</div>

				<div class='section-faq'>
					<h2>General Questions</h2>
					<?php echo do_shortcode("[ultimate-faqs include_category='disclosure-risk-assessment-step-3']"); ?>
				</div>
			</div>
		</section>

		<section class="section-step background-gray">
			<div class="content-width">
				<div class="column-container">
					<div class="column column-7">
						<iframe class="video-container" src="https://www.youtube.com/embed/vOK9owB5uYI?modestbranding=1&rel=0"></iframe>
					</div>
					<div class="column column-5">
						<h2 class="numbered">Read the Assessment Result</h2>
						<p>Once you have run the assessment, it is important to understand how to interpret the results. Because the disclosure risk measures discussed above provide you with a probability of a disclosure taking place, your own judgement remains important when deciding how to proceed. Watch this video to learn more about what the risk probability means and the actions you might take to lower the risk.</p>
						<a href="#" class="button-read-more">Read More</a>
					</div>
				</div>

				<div class="content-drawer">
					<div class="column-container">
						<div class="column column-4">
							<h3 class="pad-bottom">Consider different risk measures when interpreting the results of the assessment.</h3>
						</div>
						<div class="column column-4">
							<h3 class="pad-bottom">Set a risk threshold that is right for your organization and context.</h3>
						</div>
						<div class="column column-4">
							<h3 class="pad-bottom">Approach the global risk measure with caution.</h3>
						</div>
					</div>
					<div class="column-container pad-bottom">
						<div class="column column-4 no-pad-top">
							<p class="border-top">Calculating these different disclosure risk measures helps you decide whether and how to share your data. On HDX, we calculate the global risk and review k-anonymity for all microdata shared on the platform.</p>
						</div>
						<div class="column column-4 no-pad-top">
							<p class="border-top">The risk threshold will vary according to who you are sharing the data with and the and the sensitivity of data in your context. When setting your risk threshold, consider existing institutional policies, guidelines, and applicable regulations in the country of operation. On HDX, our threshold for Global Risk of microdata is 3%.</p>
						</div>
						<div class="column column-4 no-pad-top">
							<p class="border-top">A common way to calculate the Global Risk is to take the average of the individual disclosure risk scores. Even if the global risk is below the agreed risk threshold, there could still be a small number of individuals in the dataset with high individual risk.</p>
						</div>
					</div>

					<div class='section-faq'>
						<h2>General Questions</h2>
						<?php echo do_shortcode("[ultimate-faqs include_category='disclosure-risk-assessment-step-4']"); ?>
					</div>
				</div>
			</div>
		</section>

		<section class="section-step content-width">
			<div class="column-container">
				<div class="column column-5">
					<h2 class="numbered">Manage Data Responsibly</h2>
					<p>Knowing the disclosure risk helps you make informed decisions about whether and how to share the data. Because we want to bias toward sharing data responsibly, it is important to consider options that will allow for you to share the data in a way that protects the individuals in the dataset as opposed to simply not sharing the data at all. Watch the video to learn more about your options for managing microdata responsibly.</p>
					<a href="#" class="button-read-more">Read More</a>
				</div>
				<div class="column column-7 align-right">
					<iframe class="video-container" src="https://www.youtube.com/embed/fI3h4MymDPk?modestbranding=1&rel=0"></iframe>
				</div>
			</div>

			<div class="content-drawer">
				<div class="column-container">
					<div class="column column-4">
						<h3 class="pad-bottom">Use disclosure control techniques to reduce the risk of disclosure.</h3>
					</div>
					<div class="column column-4">
						<h3 class="pad-bottom">Navigate the trade off between disclosure risk and data utility.</h3>
					</div>
					<div class="column column-4">
						<h3 class="pad-bottom">Find other ways to share your data responsibly.</h3>
					</div>
				</div>
				<div class="column-container pad-bottom">
					<div class="column column-4 no-pad-top">
						<p class="border-top">Disclosure control techniques are either non-perturbative or perturbative. Non-perturbative methods preserve the integrity of the data but limit the disclosure risk by reducing the detail in the microdata. These methods include local suppression, recoding, and eliminating variables. Through local suppression individual values are suppressed and replaced with missing values (NA) whereas, with global recoding, the number of distinct values for a given variable is reduced by creating intervals. Perturbative methods, on the other hand, alter values and as a result limit disclosure risk by creating uncertainty around what the true values are.</p>
					</div>
					<div class="column column-4 no-pad-top">
						<p class="border-top">The optimum trade-off between risk and utility in the statistical disclosure process depends greatly on who the users are and the conditions under which the microdata is shared. The application of disclosure control techniques will always result in the loss of information. After applying SDC, you need to quantify the information loss in order to determine if there is still value in sharing the data. Otherwise, it may be necessary to reverse course and find other methods for sharing the data.</p>
					</div>
					<div class="column column-4 no-pad-top">
						<p class="border-top">If the disclosure risk or information loss after applying SDC is too high, there are still options for sharing the data. For example, you share only the metadata on HDX via HDXConnect. This option allows you to let users know that the data exists and is available ‘by request’. Once users request access, you decide whether and how to share it. Alternatively, you could decide to share the data with trusted partners under strict terms and conditions defined in a data sharing agreement or information sharing protocol.</p>
					</div>
				</div>

				<div class='section-faq'>
					<h2>General Questions</h2>
					<?php echo do_shortcode("[ultimate-faqs include_category='disclosure-risk-assessment-step-5']"); ?>
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
							<h3>Guidance Note on Statistical Disclosure Control</h3>
							<p class="attribution">OCHA</p>
							<p>This guidance note outlines the steps involved in the SDC process, potential applications for its use, case studies and key actions for humanitarian data practitioners to take when managing sensitive microdata.</p>
						</div>
					</div>
					<div class="column column-6 align-left">
						<div class="section-card">
							<img src="<?php echo get_stylesheet_directory_uri() . '/assets/learning-path/icon-documentation.png' ?>" />
							<h3>Statistical Disclosure Control Documentation</h3>
							<p class="attribution">World Bank</p>
							<p>SDCMicro is a free, R-based open-source package for the generation of protected microdata for researchers and public use. This package can be used for the generation of anonymized (micro)data</p>
						</div>
					</div>
				</div>
			</div>
		</section>
	</article>	

	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
