<?php

$generic_show_title = ot_get_option('_uncode_'.$post_type.'_title');
$page_show_title = (isset($metabox_data['_uncode_specific_title'][0])) ? $metabox_data['_uncode_specific_title'][0] : '';
if($page_show_title === '') {
	$show_title = ($generic_show_title === 'off') ? false : true;
} else {
	$show_title = ($page_show_title === 'off') ? false : true;
}