<?php

/**
 * @package uncode
 */

global $wp_query;
$vars = $wp_query->query_vars; 

//get category info
$category = get_the_category();
$category_name = $category[0]->cat_name;
$category_class = strtolower(str_replace(' ','',$category_name));

//get post id
$post_id = get_the_ID();

//get link based on post format
$custom_post = uncode_custom_just_post( $post_id );
$post_format = get_post_format( $post_id );
$the_link = ($post_format==='link') ? get_url_in_content( $custom_post ) : get_the_permalink();

//get first image in post
$item_media = has_post_thumbnail($post_id) ? get_the_post_thumbnail($post_id) : catch_that_image($post_id);

//format post media
if ($category_name==='Announcement')
	$post_media = has_post_thumbnail($post_id) ? get_the_post_thumbnail($post_id) : '<div class="img-container"><img src="' . catch_that_image($post_id) . '" /></div>';
else if ($category_name==='Video')
	$post_media = '<div class="slide-overlay"></div>' . $post_media;
else if ($category_name==='Slideshow' || $category_name==='Dataviz')
	$post_media = $custom_post;
else {
	$post_media = '<div class="img-container"><img src="' . $item_media . '" /></div>';
}

//configure link target
$link_target = ($category_name==='Dataviz' || $category_name==='Announcement') ? '_blank' : '_self';

//get author
$author = get_the_author();
?>

<div class='col-lg-4 content-block'>
	<div class='content-block--inner <?= $category_class ?>'>
		<div class='category-tag'><?= $category_name ?></div>
		<a href='<?= $the_link ?>' target='<?= $link_target ?>'><?= $post_media ?></a>
	</div>
	<div class='content-block--content dark'>
		<h6><?= $category_name ?></h6>
		<a href='<?= $the_link ?>' class='title <?= $category_class ?>-title' target='<?= $link_target ?>'>
			<p><span class='label'><?= the_title(); ?></span></p>
		</a>
		<span class='source'>by <?= $author ?></span>
	</div>
</div>