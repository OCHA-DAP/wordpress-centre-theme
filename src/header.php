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

<!-- start Drift -->
<script>
	!function() {
	  var t;
	  if (t = window.driftt = window.drift = window.driftt || [], !t.init) return t.invoked ? void (window.console && console.error && console.error("Drift snippet included twice.")) : (t.invoked = !0, 
	  t.methods = [ "identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide", "off", "on" ], 
	  t.factory = function(e) {
	    return function() {
	      var n;
	      return n = Array.prototype.slice.call(arguments), n.unshift(e), t.push(n), t;
	    };
	  }, t.methods.forEach(function(e) {
	    t[e] = t.factory(e);
	  }), t.load = function(t) {
	    var e, n, o, i;
	    e = 3e5, i = Math.ceil(new Date() / e) * e, o = document.createElement("script"), 
	    o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src = "https://js.driftt.com/include/" + i + "/" + t + ".js", 
	    n = document.getElementsByTagName("script")[0], n.parentNode.insertBefore(o, n);
	  });
	}();
	drift.SNIPPET_VERSION = '0.3.1';
	drift.load('78e66wr87xr8');
</script>
<!-- end Drift -->

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
	<?php echo uncode_remove_wpautop( $background_div ) ; ?>
	<?php do_action( 'before' );

	$body_border = ot_get_option('_uncode_body_border');
	if ($body_border !== '' && $body_border !== 0) {
		$general_style = ot_get_option('_uncode_general_style');
		$body_border_color = ot_get_option('_uncode_body_border_color');
		if ($body_border_color === '') $body_border_color = ' style-' . $general_style . '-bg';
		else $body_border_color = ' style-' . $body_border_color . '-bg';
		$body_border_frame ='<div class="body-borders" data-border="'.$body_border.'"><div class="top-border body-border-shadow"></div><div class="right-border body-border-shadow"></div><div class="bottom-border body-border-shadow"></div><div class="left-border body-border-shadow"></div><div class="top-border'.$body_border_color.'"></div><div class="right-border'.$body_border_color.'"></div><div class="bottom-border'.$body_border_color.'"></div><div class="left-border'.$body_border_color.'"></div></div>';
		echo $body_border_frame;
	}

	?>
	<div class="box-wrapper<?php echo esc_html($back_class); ?>"<?php echo wp_kses_post($background_style); ?>>
		<div class="box-container<?php echo esc_attr($boxed_width); ?>">
		<script type="text/javascript">UNCODE.initBox();</script>
		<?php
			if ($is_redirect !== true) {
				if ($menutype === 'vmenu-offcanvas' || $menutype === 'menu-overlay' || $menutype === 'menu-overlay-center') {
					$mainmenu = new unmenu('offcanvas_head', $menutype);
					echo uncode_remove_wpautop( $mainmenu->html );
				}
				$mainmenu = new unmenu($menutype, $menutype);
				echo uncode_remove_wpautop( $mainmenu->html );
			}
			?>
			<script type="text/javascript">UNCODE.fixMenuHeight();</script>

			<!-- build expand menu -->
			<div class="hdc-overlay-menu">
				<?php 
					$menu_items = wp_get_nav_menu_items( 'expand-menu' );
					$menu_list .= '<ul class="expand-menu">';
					foreach( $menu_items as $menu_item ) {
						$menu_list .= '<li><a href="' . $menu_item->url . '">' . $menu_item->title . '</a></li>';
					}
					$menu_list .= '</ul>';

					$product_sites = wp_get_nav_menu_items( 'product-sites-menu' );
					$product_list .= '<h6>Our Product Sites:</h6><ul class="product-sites">';
					foreach( $product_sites as $product_site  ) {
						$product_title = strtolower($product_site->title);
						$product_list .= '<li><a href="' . $product_site->url . '" target="_blank"><img src="' . get_stylesheet_directory_uri() . '/assets/' . $product_title . '-white.svg" height="25"></a></li>';
					}
					$product_list .= '</ul>';

					$expand_menu_content = '<div>' . $menu_list . $product_list . '</div>';
					echo $expand_menu_content ;

					//show search if control is set to ON in WP
					$search_active = ot_get_option( '_uncode_menu_search' );
					if ($search_active === 'on') {
				?>
					<div class="search-container"><?php get_search_form( true ); ?></div>
				<?php } ?>
			</div>

			<!--  -->

			<div class="main-wrapper">
				<div class="main-container">
					<div class="page-wrapper<?php if ($onepage) echo ' main-onepage'; ?>">
						<div class="sections-container">