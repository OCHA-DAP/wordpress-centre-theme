<?php

if(isset($metabox_data['_uncode_header_type'][0]) && $metabox_data['_uncode_header_type'][0] !== '') {
	// $page_header_type = $metabox_data['_uncode_header_type'][0];
	// if ($page_header_type !== 'none') {
	// 	$meta_data = uncode_get_specific_header_data($metabox_data, $post_type, $featured_image);
	// 	$metabox_data = $meta_data['meta'];
	// 	$show_title = $meta_data['show_title'];
	// }
} else {
	$page_header_type = ot_get_option('_uncode_'.$post_type.'_header');
	if($page_header_type !== '' && $page_header_type !== 'none') {
		$metabox_data['_uncode_header_type'] = array($page_header_type);
		$meta_data = uncode_get_general_header_data($metabox_data, $post_type, $featured_image);
		$metabox_data = $meta_data['meta'];
		$show_title = $meta_data['show_title'];
	}
}