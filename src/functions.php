<?php
function uncode_language_setup()
{
	load_child_theme_textdomain('uncode', get_stylesheet_directory() . '/languages');
}
add_action('after_setup_theme', 'uncode_language_setup');

function theme_enqueue_styles()
{
	$production_mode = ot_get_option('_uncode_production');
	$resources_version = ($production_mode === 'on') ? null : rand();
	$parent_style = 'uncode-style';
	$child_style = array('uncode-custom-style');
	wp_enqueue_style($parent_style, get_template_directory_uri() . '/library/css/style.css', array(), $resources_version);
	wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', $child_style, $resources_version);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function custom_javascript()
{
	wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/js/x-footer.js', array('jquery'), false, true);
}
add_filter('wp_enqueue_scripts','custom_javascript');

require_once( get_stylesheet_directory(). '/partials/elements.php' );
require_once( get_stylesheet_directory(). '/partials/headers.php' );

//add extra contact fields to user profiles
function user_contact($contactmethods) {
	$contactmethods['position'] = 'Position';
	$contactmethods['twitter'] = 'Twitter';
	$contactmethods['facebook'] = 'Facebook';
	$contactmethods['linkedin'] = 'LinkedIn';
	return $contactmethods;
}
add_filter('user_contactmethods','user_contact',10,1);


//shortcodes
function quote($att, $content = null) {
    return '<div class="quote">"'.$content.'"</div>';
}
add_shortcode('quote', 'quote');