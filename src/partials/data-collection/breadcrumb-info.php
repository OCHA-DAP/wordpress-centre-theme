<?php

$generic_breadcrumb = ot_get_option('_uncode_'.$post_type.'_breadcrumb');
$page_breadcrumb = (isset($metabox_data['_uncode_specific_breadcrumb'][0])) ? $metabox_data['_uncode_specific_breadcrumb'][0] : '';
if($page_breadcrumb === '') {
	$breadcrumb_align = ot_get_option('_uncode_'.$post_type.'_breadcrumb_align');
	$show_breadcrumb = ($generic_breadcrumb === 'off') ? false : true;
} else {
	$breadcrumb_align = (isset($metabox_data['_uncode_specific_breadcrumb_align'][0])) ? $metabox_data['_uncode_specific_breadcrumb_align'][0] : '';
	$show_breadcrumb = ($page_breadcrumb === 'off') ? false : true;
}