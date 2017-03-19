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
	wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/js/humdata-footer.js', array('jquery'), false, true);
}
add_filter('wp_enqueue_scripts','custom_javascript');

require_once( get_stylesheet_directory(). '/partials/elements.php' );
require_once( get_stylesheet_directory(). '/partials/headers.php' );

//get first link in post content
function get_content_link( $content = false )
{
if ( ! in_the_loop() )
    return;

    // allows using this function also for excerpts
    ! $content AND $content = get_the_content();

    $content = preg_match_all( '/href\s*=\s*[\"\']([^\"\']+)/', $content, $links );
    $content = $links[1][0];
    //$content = make_clickable( $content );

    return $content;
}


//add extra contact fields to user profiles
function user_contact($contactmethods) 
{
	$contactmethods['position'] = 'Position';
	$contactmethods['twitter'] = 'Twitter';
	$contactmethods['facebook'] = 'Facebook';
	$contactmethods['linkedin'] = 'LinkedIn';
	return $contactmethods;
}
add_filter('user_contactmethods','user_contact',10,1);


//shortcodes
function quote($att, $content = null) 
{
	return '<blockquote>“'.$content.'”</blockquote>';
}
add_shortcode('quote', 'quote');


function label($att, $content = null) 
{
	return '<div class="label">'.$content.'</div>';
}
add_shortcode('label', 'label');


function dataviz($att, $content = null) 
{
	extract(shortcode_atts(array(
      'title' => '',
      'author' => 'humdata',
   ), $att));
	$str = '<img src="'.$content.'"/><p class="title">'.$title.'</p><p class="author">By '.$author.'</p>';
	return $str;
}
add_shortcode('dataviz', 'dataviz');


function tweet($att, $content = null) 
{
	extract(shortcode_atts(array(
      'author' => '',
   ), $att));
	$str = '<p class="tweet-text">“'.$content.'”</p><p class="author">@'.$author.'<br><i class="fa fa-twitter twhite" aria-hidden="true"></i></p>';
	return $str;
}
add_shortcode('tweet', 'tweet');


function video($att, $content = null) 
{
	extract(shortcode_atts(array(
      'mp4' => ''
   ), $att));
	$str = '<div class="content video preview"><video muted autoplay loop><source src="'.$mp4.'" type="video/mp4">Your browser does not support the video tag.</video><div class="btn playpause-btn"></div></div>';
	return $str;
}
add_shortcode('video', 'video');
