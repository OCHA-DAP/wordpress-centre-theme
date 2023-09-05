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

$page_header = new unheader($metabox_data, $post->post_title);

/**
 * /* LATEST POSTS
 **/
$latest_stories_args = array(
	'cat' => array(3, 105, 98, 110, 145, 200, 268), //blog, dataviz, video, slideshow, impact story, announcement
	'posts_per_page' => 6,
	'orderby' => 'date'
);

$latest_posts = new WP_query($latest_stories_args);

/**
 * /* LATEST PRESS
 **/
$press_args = array(
	'cat' => array(2, 101), //article, case study
	'posts_per_page' => 6
);

$latest_press = new WP_query($press_args);

?>

	<script>
		//mixpanel tracking
		window.onload = function (e) {
			mpTrack.pageView(document.title, 'home');
		}
	</script>

	<div id="page-header"><?= uncode_remove_wpautop($page_header->html) ?></div>

<?php if($latest_posts->have_posts()) : ?>

	<section class="latest-stories-module latest-carousel">
		<h3>Latest Stories</h3>
		<div class="slick-slideshow">
			<?php while($latest_posts->have_posts()) : $latest_posts->the_post();
				get_template_part('content', 'latest-stories');
			endwhile; ?>
		</div>
	</section>

<?php endif; ?>

<?php if($latest_press->have_posts()) : ?>
	<section class="latest-press-module latest-carousel">
		<h3>Latest Press</h3>
		<div class="slick-slideshow">
			<?php while($latest_press->have_posts()) : $latest_press->the_post();
				get_template_part('content', 'latest-press');
			endwhile; ?>
		</div>
	</section>
<?php endif;


/**
/* TWITTER MODULE
**/
if (is_front_page()) { ?>
	<section class="twitter-module hidden">
		<div class="row">
			<div class="row-inner">
				<div class="col-lg-2"></div>
				<div class="col-lg-7">
					<div class="tweet">
						<a href="http://www.twitter.com/humdata" target="_blank" class="twitter-logo"><div class="fa fa-twitter twhite" aria-hidden="true"></div></a>
						<div class="tweet-content">
							<p class="tweet-text"><span></span></p>
							<p class="author"></p>
						</div>
					</div>
				</div>
				<div class="col-lg-2"></div>
			</div>
		</div>
	</section>
<?php } ?>

<?php
get_footer();
