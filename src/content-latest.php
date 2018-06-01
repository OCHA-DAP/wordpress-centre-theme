<?php

/**
 * @package uncode
 */

global $wp_query;
$vars = $wp_query->query_vars; 

$category = get_the_category();
$category_name = $category[0]->cat_name;
$category_class = strtolower(str_replace(' ','',$category_name));

$post_id = get_the_ID();

// if ( has_post_thumbnail() ) {
// 	$featured_image = get_the_post_thumbnail();
// }

//get link based on post format
$custom_post = uncode_custom_just_post( $post_id );
$post_format = get_post_format( $post_id );
$the_link = ($post_format==='link') ? get_url_in_content( $custom_post ) : get_the_permalink();

//get first image in post
$item_media = catch_that_image($post_id);

$post_media = ($category_name==='Video' || $category_name==='Slideshow') ? $custom_post : '<img src="' . $item_media . '" />';


$author = get_the_author();
?>

<div class='slide-item <?= $category_class ?>'>
	<?php if ($category_name!=='Video') { ?> <a class='underline' href='<?= $the_link ?>'> <?php } ?>
		<div class='slide-overlay'></div>
		<?= $post_media ?>
		<div class='text-overlay'>
			<div class='category-tag'><?= $category_name ?></div>
			<div class='title'><a class='underline' href='<?= $the_link ?>'><span><?php the_title(); ?></span></a></div>
			<div class='source'><a class='underline' href='<?= $the_link ?>'><span>by <?= get_the_author() ?></span></a></div>
		</div>
	<?php if ($category_name!=='Video') { ?></a><?php } ?>
</div>