<?php

$boxed = ot_get_option('_uncode_boxed');

$page_content_full = (isset($metabox_data['_uncode_specific_layout_width'][0])) ? $metabox_data['_uncode_specific_layout_width'][0] : '';
if($page_content_full === '') {
	/** Use generic page width **/
	$generic_content_full = ot_get_option('_uncode_'.$post_type.'_layout_width');
	if($generic_content_full === '') {
		$main_content_full = ot_get_option('_uncode_body_full');
		if($main_content_full !== 'on') $limit_content_width = ' limit-width';
	} else {
		if($generic_content_full === 'limit') {
			$generic_custom_width = ot_get_option('_uncode_'.$post_type.'_layout_width_custom');
			if($generic_custom_width[1] === 'px') {
				$generic_custom_width[0] = 12 * round(($generic_custom_width[0]) / 12);
			}
			if(is_array($generic_custom_width) && !empty($generic_custom_width)) {
				$page_custom_width = ' style="max-width: '.implode('', $generic_custom_width).'; margin: auto;"';
			}
		}
	}
} else {
	/** Override page width **/
	if($page_content_full === 'limit') {
		$limit_content_width = ' limit-width';
		$page_custom_width = (isset($metabox_data['_uncode_specific_layout_width_custom'][0])) ? unserialize($metabox_data['_uncode_specific_layout_width_custom'][0]) : '';
		if(is_array($page_custom_width) && !empty($page_custom_width) && $page_custom_width[0] !== '') {
			if($page_custom_width[1] === 'px') {
				$page_custom_width[0] = 12 * round(($page_custom_width[0]) / 12);
			}
			$page_custom_width = ' style="max-width: '.implode("", $page_custom_width).'; margin: auto;"';
		} else $page_custom_width = '';
	}
}