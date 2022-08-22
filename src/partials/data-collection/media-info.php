<?php

$generic_show_media = ot_get_option('_uncode_'.$post_type.'_media');
$page_show_media = (isset($metabox_data['_uncode_specific_media'][0])) ? $metabox_data['_uncode_specific_media'][0] : '';
if($page_show_media === '') {
	$show_media = ($generic_show_media === 'off') ? false : true;
} else {
	$show_media = ($page_show_media === 'off') ? false : true;
}