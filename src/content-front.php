<?php

/**
 * @package uncode
 */

global $wp_query;
$vars = $wp_query->query_vars; 

$category = get_the_category();
$category_name = $category[0]->cat_name;
$category_class = strtolower(str_replace(' ','',$category_name));
?>

<div class='col-lg-4 content-block'>
	<div class='content-block--inner <?= $category_class ?>'>
		<div class='category-tag'><?= $category_name ?></div>
		<div class='content-block--content'>
			<div class='category'><?= $category_name ?></div>
			<?= the_content(); ?>
			<span class='source'>by <?= the_title(); ?></span>
		</div>
	</div>
</div>