<?php

if(isset($metabox_data['_uncode_active_sidebar'][0]) && $metabox_data['_uncode_active_sidebar'][0] !== '') {
	if($metabox_data['_uncode_active_sidebar'][0] !== 'off') {
		$layout = (isset($metabox_data['_uncode_sidebar_position'][0])) ? $metabox_data['_uncode_sidebar_position'][0] : '';
		$sidebar = (isset($metabox_data['_uncode_sidebar'][0])) ? $metabox_data['_uncode_sidebar'][0] : '';
		$sidebar_size = (isset($metabox_data['_uncode_sidebar_size'][0])) ? $metabox_data['_uncode_sidebar_size'][0] : 4;
		$sidebar_sticky = (isset($metabox_data['_uncode_sidebar_sticky'][0]) && $metabox_data['_uncode_sidebar_sticky'][0] === 'on') ? ' sticky-element' : '';
		$sidebar_fill = (isset($metabox_data['_uncode_sidebar_fill'][0])) ? $metabox_data['_uncode_sidebar_fill'][0] : '';
		$sidebar_style = (isset($metabox_data['_uncode_sidebar_style'][0])) ? $metabox_data['_uncode_sidebar_style'][0] : $style;
		$sidebar_bg_color = (isset($metabox_data['_uncode_sidebar_bgcolor'][0]) && $metabox_data['_uncode_sidebar_bgcolor'][0] !== '') ? ' style-'.$metabox_data['_uncode_sidebar_bgcolor'][0].'-bg' : '';
	}
} else {
	$activate_sidebar = ot_get_option('_uncode_'.$post_type.'_activate_sidebar');
	if($activate_sidebar !== 'off') {
		$layout = ot_get_option('_uncode_'.$post_type.'_sidebar_position');
		if($layout === '') $layout = 'sidebar_right';
		$sidebar = ot_get_option('_uncode_'.$post_type.'_sidebar');
		$sidebar_style = ot_get_option('_uncode_'.$post_type.'_sidebar_style');
		$sidebar_size = ot_get_option('_uncode_'.$post_type.'_sidebar_size');
		$sidebar_sticky = ot_get_option('_uncode_'.$post_type.'_sidebar_sticky');
		$sidebar_sticky = ($sidebar_sticky === 'on') ? ' sticky-element sticky-sidebar' : '';
		$sidebar_fill = ot_get_option('_uncode_'.$post_type.'_sidebar_fill');
		$sidebar_bg_color = ot_get_option('_uncode_'.$post_type.'_sidebar_bgcolor');
		$sidebar_bg_color = ($sidebar_bg_color !== '') ? ' style-'.$sidebar_bg_color.'-bg' : '';
	}
}

if($sidebar_style === '') $sidebar_style = $style;