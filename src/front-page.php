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
?>

<script>
	//mixpanel tracking
	window.onload = function(e) {
		mpTrack.pageView(document.title, 'home');
	}
</script>

<?php
/**
/* LATEST POSTS
**/

$latest_stories_args = array (
	'cat' => array(3, 105, 98, 110, 145, 200, 268), //blog, dataviz, video, slideshow, impact story, announcement
	'posts_per_page' => 6, 
	'orderby' => 'date'  
);

// // set the number of posts per page
// $posts_per_page = 3;

// // get sticky posts array
// $sticky_posts = get_option( 'sticky_posts' );
// if (is_array($sticky_posts)) {
//     $sticky_count = count($sticky_posts);

//     if ($sticky_count < $posts_per_page) {
//     	$latest_stories_args = array (
// 			'posts_per_page' => $posts_per_page - $sticky_count
// 		);
//     } else {
//         $latest_stories_args = array (
// 			'posts_per_page' => 1  
// 		);
//     }
// }

$latest_posts = new WP_query($latest_stories_args);


if ($latest_posts->have_posts()) :
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
?>

	<section class='latest-stories-module latest-carousel'>
		<h3>Latest Stories</h3>
		<div class='slick-slideshow'>
			<?php while ($latest_posts->have_posts()) : $latest_posts->the_post();
				get_template_part( 'content', 'latest-stories' );
			endwhile; ?>
		</div>
	</section>

<?php endif;


/**
/* LATEST PRESS
**/
$press_args = array (
	'cat' => array(2,101), //article, case study
	'posts_per_page' => 6
);

$latest_press = new WP_query($press_args);
if ($latest_press->have_posts()) : ?>
	<section class='latest-press-module latest-carousel'>
		<h3>Latest Press</h3>
		<div class='slick-slideshow''>
			<?php while ($latest_press->have_posts()) : $latest_press->the_post();
				get_template_part( 'content', 'latest-press' );
			endwhile; ?>
		</div>
	</section>
<?php endif;


/**
/* TWITTER MODULE
**/
if (is_front_page()) { ?>
	<section class='twitter-module'>
		<div class='row'>
			<div class='row-inner'>
				<div class='col-lg-2'></div>
				<div class='col-lg-7'>
					<div class='tweet'>
						<a href='http://www.twitter.com/humdata' target='_blank' class='twitter-logo'><div class='fa fa-twitter twhite' aria-hidden='true'></div></a>
						<div class='tweet-content'>
							<p class='tweet-text'><span></span></p>
							<p class='author'></p>
						</div>
					</div>
				</div>
				<div class='col-lg-2'></div>
			</div>
		</div>
	</section>
<?php } ?>

<?php get_footer(); ?>