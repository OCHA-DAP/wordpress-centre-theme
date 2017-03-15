<?php
function uncode_language_setup()
{
	load_child_theme_textdomain('uncode', get_stylesheet_directory() . '/languages');
}
add_action('after_setup_theme', 'uncode_language_setup');

function uncode_hdx_api_init(){
    add_settings_field('hdx-mixpanel-token', 'HDX Mixpanel Token', 'render_hdx_mixpanel_token', 'general');
    add_settings_field('hdx-google-analytics-token', 'HDX Google Analytics Token', 'render_hdx_google_analytics_token', 'general');
    // Register our setting so that $_POST handling is done for us and
    // our callback function just has to echo the <input>
    register_setting( 'general', 'hdx-mixpanel-token' );
    register_setting( 'general', 'hdx-google-analytics-token' );
}
add_action( 'admin_init', 'uncode_hdx_api_init' );

function render_hdx_mixpanel_token() {
    echo '<input name="hdx-mixpanel-token" id="hdx-mixpanel-token" type="text" value="' . get_option('hdx-mixpanel-token') . '" class="code" />';
}
function render_hdx_google_analytics_token() {
    echo '<input name="hdx-google-analytics-token" id="hdx-google-analytics-token" type="text" value="' . get_option('hdx-google-analytics-token') . '" class="code" />';
}

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



