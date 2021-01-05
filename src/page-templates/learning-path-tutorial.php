<?php
/* Template Name: Learning Path Tutorial */

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
		mpTrack.pageView(document.title, 'learning module');
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

	<article class="learning-path tutorial">
		<div class="learning-path-navigation">
			<div class="navigation-inner content-width">
				<div class="breadcrumbs">
					<span class="text-green">Learning with the Centre</span><a href="<?php echo get_site_url() . '/learning-path/disclosure-risk-assessment-overview/' ?>"> / Disclosure Risk Assessment</a>
				</div>
				<div class="sub-navigation">
					<a href="<?php echo get_site_url() . '/learning-path/disclosure-risk-assessment-methodology/' ?>">See How It's Done</a>
					<a href="#" class="active">Try It On Your Own</a>
					<!-- <a href="#">Request Support</a> -->
				</div>
			</div>
		</div>

		<div class="feature-content">
			<div class="content-width">
				<div class="feature-inner">
					<h1>Try It On Your Own</h1>
					<h3>Conducting a Disclosure Risk Assessment requires you to use statistical methods to estimate the likelihood of a disclosure taking place. The following instructional videos and guidance explain these methods and how they can be applied to humanitarian microdata.</h3>
				</div>
			</div>
		</div>

		<div class="content-width column-container">
			<div class="column column-4">
				<ul class="jump-menu">
					<li><a href="#sectionone">Prepare your data and tools</a></li>
					<li><a href="#sectiontwo">Select Key Variables</a></li>
					<li><a href="#sectionthree">Run Assessment & Interpret Results</a></li>
					<li><a href="#sectionfour">Managing Data Responsibly</a></li>
				</ul>
			</div>

			<div class="column column-8">
				<section id="sectionone">
					<h2>Prepare your data and tools</h2>
					<h4>Load the Packages that You Will Need</h4>
					<p>Packages are collections of R functions, data, and code in a well-defined format. R comes with a standard set of packages. Others are available for download and installation. sdcMicro is an add-on data package in R. You can download the package from CRAN. Once installed, packages have to be loaded into the session to be used. For this session, you will need to load the packages <code>sdcMicro</code>, <code>readxl</code> and <code>tidyverse</code>.</p>
<pre>
<code>
install.packages("sdcMicro")
library(readxl)   
library(sdcMicro)
library(tidyverse)
</code>
</pre>
					<h4>Importing Data from Excel file</h4>
					<div class="quick-tip-container">
						<h5>Quick Tip:</h5>
						<p>If you are working with a spreadsheet, before you import your data to R, it is worth taking the time to make sure that your data is well structured. This includes making sure that the first row in your spreadsheet is the header row, that you delete any comments in the dataset and take the time to deal with missing values. Missing values are represented in R by the NA symbol. In the language, NA is a special value whose properties are different from other values. You may want to explore your data to understand how missing values are handled. Are they represented by N/A or simply a blank cell? It is important to recode any missing values that are not coded as ‘NA’ to ‘NA’ before starting the SDC process (or any other analysis in R). </p>
					</div>
					<p>The next step is to pull your spreadsheet data into R studio - there are a few different ways to do this. One way is to set the working directory using the setwd function and then use the read_excel function to import the excel file to a new object (‘data’) as we have done below.</p>
<pre>
<code>
setwd ("/Users/username/sdcTutorial")
data <-read_excel("sdcTutorial_data.xlsx")
</code>
</pre>
					<h4>Review  Data Structure </h4>
					<p>Before you begin any analysis, you may want to review the data structure. This will tell you the type of object you have, how many rows (observations) and columns (variables) the object contains, the type of data in each column and the first few entries for each column. In the example below, you see that our data file has 7,005 records and 87 variables as well as the classes of the first three variables, numeric (num) and character (chr) respectively, and the first few values for those variables.</p>
<pre>
<code>
str(data)
tibble [7,005 × 87] (S3: tbl_df/tbl/data.frame)
 $ weights                                   : num [1:7005] 0.146 0.146 2.281 0.146 2.281 ...
 $ province                                  : chr [1:7005] "Balkh" "Balkh" "Balkh" "Balkh" ...
 $ district                                  : chr [1:7005] "Khuram Sarbagh" "Sar e Pul" "Pul e khumri" "Dawlatabad" 

…
</code>
</pre>
					<h4>Explore Relationship Between Variables</h4>
					<p>Now that you understand the data structure, we recommend that you explore the relationships between the variables.  One thing that you will notice exploring the data structure is that most of the variables that are likely key variables are categorical. Variables like locations, marital status, disability status have the class ‘chr’ or character (string). One exception is the head of household age which is numeric (num). Remember,  age can be thought of as semi-continuous and treated as a categorical variable for the purpose of disclosure risk assessment.</p>
<pre>
<code>
str(data)
tibble [7,005 × 87] (S3: tbl_df/tbl/data.frame)
 $ weights                                   : num [1:7005] 0.146 0.146 2.281 0.146 2.281 ...
 $ province                                  : chr [1:7005] "Balkh" "Balkh" "Balkh" "Balkh" ...
 $ district                                  : chr [1:7005] "Khuram Sarbagh" "Sar e Pul" "Pul e khumri" "Dawlatabad" 

…
</code>
</pre>
					<div class="quick-tip-container">
						<h5>QUICK TIP on contingency tables:</h5>
						<p>One easy way to explore the relationships between variables is to create contingency tables (or crosstabs). For the age variable, you may want to create a histogram to see if there are any notable outliers. How much time you spend exploring the data will depend on how well you know the data. If you have a good grasp of what the data looks like, this should only take a few minutes. If this is the first time you are working with the data you are assessing, we would recommend spending some time here to really understand what the data is saying.</p>
					</div>
					<div class="quick-tip-container">
						<h5>QUICK TIP on disclosure scenarios:</h5>
						<p>To develop a disclosure scenario, you will need to think through the motivations of a malicious actor, describe the data that they may have access to, and specify how this data and other publically data could be linked to your data and lead to disclosure. This requires you to make assumptions about what types of data and information others are likely to have access to. If you are not sure, we recommend creating multiple disclosure scenarios based on different assumptions and run the disclosure risk assessment on each.</p>
					</div>
				</section>

				<section id="sectiontwo">
					<h2>Select Key Variables</h2>
					<p>The sdcMicro package is built around objects of class sdcMicroObj. In this section, we will walk through how to select key variables, set your sample weight variable and create a subset of your datafile. You will then use these new objects (selectedKeyVars, selectedWeights, and dataSub) as arguments of the function ‘createSdcObj()’ in order to create the sdcMicro object that you will use assess the disclosure risk and apply disclosure control techniques.</p>

					<h4>Create Weight & Key Variable Vectors</h4>
					<p>The first step is to create  vectors for key variables and sample weights. After exploring the data and creating developing disclosure risk scenarios, we identified the key variables that we will use. 
We have identified the following as key variables: district, head of household ethnolinguistic group, age, gender, marital status, and disability status and finally, total number of members in a location. Next, define a vector (here selectedKeyVars) with the names of the different variables as well as a vector with your sample weights.</p>
<pre>
<code>
selectedKeyVars <- c('district', 'hhh_ethnolinguistic_group','hhh_marital_status', 'hhh_age', 'hhh_gender','hhh_disability', 'total_members')
selectedWeights <- c('weights')
</code>
</pre>
				
					<h4>Create Subset of the Data File</h4>
					<p>Now that you know the variables that you want to focus on - the key variables and the sample weights - we are going to create a subset of the data file that contains only these variables. We will use this to create our sdcMicro object in the next step. But first, variables with the class ‘character’ (strings) will need to be converted into factors. In our example, that is district, ethnolinguistic group, marital status, gender and disability status. Use the lapply function (see below) or the as.factor function to convert these variables from strings to factors and then create a subset of the data file.</p>
<pre>
<code>
## 
cols =  c('district', 'hhh_ethnolinguistic_group','hhh_marital_status', 'hhh_gender','hhh_disability')
data[,cols] <- lapply(data[,cols], factor)
subVars <- c(selectedKeyVars, selectedWeights)
subData <- data[,subVars]
</code>
</pre>
				
					<h4>Create sdcMicro Object</h4>
					<p>Finally, you are ready to create the sdcMicro object. The arguments of the function createSdcObj() allow one to specify the data file (subData), the sample weights (selectedWeights) and the keyVars (selectedKeyVars). These are only a few of the arguments that are available. Read more about all of the arguments of this function in the documentation <a href="#">here</a>.</p>
<pre>
<code>
## Create sdcMicro object
objSDC <- createSdcObj(dat=subData, keyVars = selectedKeyVars, weightVar = selectedWeights)
</code>
</pre>
				</section>
			</div>
		</div>


		<section class="section-call-to-action background-gray">
			<div class="content-width align-center">
				<h2 class="text-green">Contact our team for help</h2>
				<p>Our team is available for assistance and specific 
questions about the Disclosure risk assessment process</p>
				<a href="<?php echo get_site_url() . '/learning-path/disclosure-risk-assessment-support/' ?>" class="button-primary">Contact us</a>
			</div>
		</section>
		
	</article>	

	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
