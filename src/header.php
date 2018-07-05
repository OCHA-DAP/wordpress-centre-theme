<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="page-wrapper">
 *
 * @package uncode
 */

global $is_redirect, $redirect_page;

if ($redirect_page) {
	$post_id = $redirect_page;
} else {
	if (isset(get_queried_object()->ID) && !is_home()) {
		$post_id = get_queried_object()->ID;
	} else {
		$post_id = null;
	}
}

if (wp_is_mobile()) $html_class = 'touch';
else $html_class = 'no-touch';

if (is_admin_bar_showing()) $html_class .= ' admin-mode';

?><!DOCTYPE html>
<html class="<?php echo esc_attr($html_class); ?>" <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">
<?php if (wp_is_mobile()): ?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
<?php else: ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php endif; ?>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php if(!empty(get_option('hdx-google-analytics-token'))): ?>
    <!-- Start Google Analytics -->
    <script>
        var googleAnalyticsToken = '<?php echo get_option('hdx-google-analytics-token'); ?>';
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
        ga('create', googleAnalyticsToken, 'auto');
        ga('send', 'pageview');
    </script>
    <!-- end Google Analytics -->
<?php endif; ?>

<?php if(!empty(get_option('hdx-mixpanel-token'))): ?>
    <!-- start Mixpanel -->
    <script type="text/javascript">(function(e,a){if(!a.__SV){var b=window;try{var c,l,i,j=b.location,g=j.hash;c=function(a,b){return(l=a.match(RegExp(b+"=([^&]*)")))?l[1]:null};g&&c(g,"state")&&(i=JSON.parse(decodeURIComponent(c(g,"state"))),"mpeditor"===i.action&&(b.sessionStorage.setItem("_mpcehash",g),history.replaceState(i.desiredHash||"",e.title,j.pathname+j.search)))}catch(m){}var k,h;window.mixpanel=a;a._i=[];a.init=function(b,c,f){function e(b,a){var c=a.split(".");2==c.length&&(b=b[c[0]],a=c[1]);b[a]=function(){b.push([a].concat(Array.prototype.slice.call(arguments,
            0)))}}var d=a;"undefined"!==typeof f?d=a[f]=[]:f="mixpanel";d.people=d.people||[];d.toString=function(b){var a="mixpanel";"mixpanel"!==f&&(a+="."+f);b||(a+=" (stub)");return a};d.people.toString=function(){return d.toString(1)+".people (stub)"};k="disable time_event track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config reset people.set people.set_once people.increment people.append people.union people.track_charge people.clear_charges people.delete_user".split(" ");
            for(h=0;h<k.length;h++)e(d,k[h]);a._i.push([b,c,f])};a.__SV=1.2;b=e.createElement("script");b.type="text/javascript";b.async=!0;b.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?MIXPANEL_CUSTOM_LIB_URL:"file:"===e.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";c=e.getElementsByTagName("script")[0];c.parentNode.insertBefore(b,c)}})(document,window.mixpanel||[]);
        mixpanel.init("<?php echo get_option('hdx-mixpanel-token'); ?>");</script>
    <!-- end Mixpanel -->
<?php endif; ?>	

<?php wp_head(); ?>
</head>
<?php
	global $LOGO, $metabox_data, $onepage, $fontsizes, $is_redirect, $menutype;

	if ($post_id !== null) {
		$metabox_data = get_post_custom($post_id);
		$metabox_data['post_id'] = $post_id;
	} else $metabox_data = array();

	$onepage = false;
	$background_div = $background_style = $background_color_css = '';

	if (isset($metabox_data['_uncode_page_scroll'][0]) && $metabox_data['_uncode_page_scroll'][0] == 'on') {
		$onepage = true;
	}

	$boxed = ot_get_option( '_uncode_boxed');
	$fontsizes = ot_get_option( '_uncode_heading_font_sizes');
	$background = ot_get_option( '_uncode_body_background');

	if (isset($metabox_data['_uncode_specific_body_background'])) {
		$specific_background = unserialize($metabox_data['_uncode_specific_body_background'][0]);
		if ($specific_background['background-color'] != '' || $specific_background['background-image'] != '') {
			$background = $specific_background;
		}
	}

	$back_class = '';
	if (!empty($background) && ($background['background-color'] != '' || $background['background-image'] != '')) {
		if ($background['background-color'] !== '') $background_color_css = ' style-'. $background['background-color'] . '-bg';
		$back_result_array = uncode_get_back_html($background, '', '', '', 'div');

		if ((strpos($back_result_array['mime'], 'image') !== false)) {
			$background_style .= (strpos($back_result_array['back_url'], 'background-image') !== false) ? $back_result_array['back_url'] : 'background-image: url(' . $back_result_array['back_url'] . ');';
			if ($background['background-repeat'] !== '') $background_style .= 'background-repeat: '. $background['background-repeat'] . ';';
			if ($background['background-position'] !== '') $background_style .= 'background-position: '. $background['background-position'] . ';';
			if ($background['background-size'] !== '') $background_style .= 'background-size: '. ($background['background-attachment'] === 'fixed' ? 'cover' : $background['background-size']) . ';';
			if ($background['background-attachment'] !== '') $background_style .= 'background-attachment: '. $background['background-attachment'] . ';';
		} else $background_div = $back_result_array['back_html'];
		if ($background_style !== '') $background_style = ' style="'.$background_style.'"';
		if (isset($back_result_array['async_class']) && $back_result_array['async_class'] !== '') {
			$back_class = $back_result_array['async_class'];
			$background_style .= $back_result_array['async_data'];
		}
	}

	$body_attr = '';
	if ($boxed === 'on') {
		$boxed_width = ' limit-width';
	} else {
		$boxed_width = '';
		$body_border = ot_get_option('_uncode_body_border');
		if ($body_border !== '' && $body_border !== 0) {
			$body_attr = ' data-border="' . esc_attr($body_border) . '"';
		}
	}

?>

<body <?php body_class($background_color_css); echo $body_attr; ?>>

	<div class="box-wrapper">
		<div class="box-container">

			<!-- CUSTOM NAV -->
			<?php 
				$menuitems = wp_get_nav_menu_items( 'header-menu' ); 
				$homeURL = esc_url( home_url( get_current_blog_id(), '/' ) );
			?>

			<nav>
				<a href="<?php echo $homeURL ?>"><img class="logo" src="https://centre.humdata.org/wp-content/uploads/2017/03/centre-logo-white.svg" /></a>
				<ul class="main-nav">
				    <?php
				    $count = 0;
				    $submenu = false;
				    foreach( $menuitems as $item ):
				        $link = $item->url;
				        $title = $item->title;
				        if ( !$item->menu_item_parent ):
				        	$parent_id = $item->ID;
				    ?>

				    <li class="item">
				        <a href="<?php echo $link; ?>" class="title">
				            <?php echo $title; ?>
				        </a>
				    <?php endif; ?>

				        <?php if ( $parent_id == $item->menu_item_parent ): ?>

				            <?php if ( !$submenu ): $submenu = true; ?>
				            <ul class="sub-menu">
				            <?php endif; ?>

				                <li class="item">
				                    <a href="<?php echo $link; ?>" class="title"><?php echo $title; ?></a>
				                </li>

				            <?php if ( $menuitems[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ): ?>
				            </ul>
				            <?php $submenu = false; endif; ?>

				        <?php endif; ?>

				    <?php if ( $menuitems[ $count + 1 ]->menu_item_parent != $parent_id ): ?>
				    </li>                           
				    <?php $submenu = false; endif; ?>

				<?php $count++; endforeach; ?>

				</ul>
			</nav>

			<button type="button" class="mobile-nav-toggle collapsed"><span class="icon-bar"></span><span class="icon-bar"></span></button>

			<div class="main-wrapper">
				<div class="main-container">
					<div class="page-wrapper<?php if ($onepage) echo ' main-onepage'; ?>">
						<div class="sections-container">