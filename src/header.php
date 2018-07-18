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
				<a href="<?php echo $homeURL ?>">
					<!-- <img class="logo" src="https://centre.humdata.org/wp-content/uploads/2017/03/centre-logo-white.svg" /> -->
					<svg class='logo' viewBox="0 0 245 77" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
					    <defs>
					        <polygon id="path-1" points="122.38455 77 244.769 77 244.769 0.148 0.0001 0.148 0.0001 77 122.38455 77"></polygon>
					    </defs>
					    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					        <g transform="translate(0.000000, -1.000000)">
					            <path d="M20.4617,30.5366 L20.4617,30.4946 C20.4617,27.2676 22.9287,24.6106 26.3877,24.6106 C28.5177,24.6106 29.8467,25.3276 30.9007,26.5086 L28.9397,28.6176 C28.2227,27.8586 27.5057,27.3736 26.3667,27.3736 C24.7637,27.3736 23.6247,28.7866 23.6247,30.4526 L23.6247,30.4946 C23.6247,32.2236 24.7427,33.6156 26.4937,33.6156 C27.5687,33.6156 28.3067,33.1516 29.0867,32.4136 L30.9637,34.3116 C29.8677,35.5136 28.6017,36.3786 26.3457,36.3786 C22.9507,36.3786 20.4617,33.7636 20.4617,30.5366" id="Fill-1"></path>
					            <path d="M40.1606,29.5875 C39.9706,28.1535 39.1276,27.1835 37.7776,27.1835 C36.4486,27.1835 35.5846,28.1325 35.3316,29.5875 L40.1606,29.5875 Z M32.1886,30.5365 L32.1886,30.4945 C32.1886,27.2675 34.4876,24.6105 37.7776,24.6105 C41.5526,24.6105 43.2816,27.5415 43.2816,30.7475 C43.2816,31.0005 43.2606,31.2955 43.2396,31.5915 L35.3736,31.5915 C35.6896,33.0465 36.7016,33.8055 38.1356,33.8055 C39.2116,33.8055 39.9916,33.4675 40.8776,32.6455 L42.7126,34.2695 C41.6576,35.5765 40.1396,36.3785 38.0936,36.3785 C34.6986,36.3785 32.1886,33.9955 32.1886,30.5365 L32.1886,30.5365 Z" id="Fill-3"></path>
					            <path d="M45.664,24.8215 L48.87,24.8215 L48.87,26.4245 C49.608,25.4755 50.557,24.6105 52.181,24.6105 C54.606,24.6105 56.019,26.2135 56.019,28.8075 L56.019,36.1255 L52.813,36.1255 L52.813,29.8195 C52.813,28.3015 52.096,27.5205 50.873,27.5205 C49.65,27.5205 48.87,28.3015 48.87,29.8195 L48.87,36.1255 L45.664,36.1255 L45.664,24.8215 Z" id="Fill-5"></path>
					            <path d="M59.3288,32.9197 L59.3288,27.5627 L57.9788,27.5627 L57.9788,24.8217 L59.3288,24.8217 L59.3288,21.9327 L62.5348,21.9327 L62.5348,24.8217 L65.1918,24.8217 L65.1918,27.5627 L62.5348,27.5627 L62.5348,32.3927 C62.5348,33.1307 62.8508,33.4887 63.5678,33.4887 C64.1578,33.4887 64.6848,33.3417 65.1498,33.0887 L65.1498,35.6607 C64.4748,36.0617 63.6938,36.3147 62.6188,36.3147 C60.6578,36.3147 59.3288,35.5347 59.3288,32.9197" id="Fill-7"></path>
					            <path d="M67.553,24.8215 L70.759,24.8215 L70.759,27.0995 C71.412,25.5385 72.467,24.5265 74.365,24.6105 L74.365,27.9635 L74.196,27.9635 C72.066,27.9635 70.759,29.2505 70.759,31.9495 L70.759,36.1255 L67.553,36.1255 L67.553,24.8215 Z" id="Fill-9"></path>
					            <path d="M83.4769,29.5875 C83.2869,28.1535 82.4439,27.1835 81.0939,27.1835 C79.7649,27.1835 78.9009,28.1325 78.6479,29.5875 L83.4769,29.5875 Z M75.5049,30.5365 L75.5049,30.4945 C75.5049,27.2675 77.8039,24.6105 81.0939,24.6105 C84.8689,24.6105 86.5979,27.5415 86.5979,30.7475 C86.5979,31.0005 86.5769,31.2955 86.5559,31.5915 L78.6899,31.5915 C79.0059,33.0465 80.0179,33.8055 81.4519,33.8055 C82.5279,33.8055 83.3079,33.4675 84.1939,32.6455 L86.0289,34.2695 C84.9739,35.5765 83.4559,36.3785 81.4099,36.3785 C78.0149,36.3785 75.5049,33.9955 75.5049,30.5365 L75.5049,30.5365 Z" id="Fill-11"></path>
					            <path d="M95.8548,27.563 L94.5258,27.563 L94.5258,24.927 L95.8548,24.927 L95.8548,24.21 C95.8548,22.966 96.1708,22.059 96.7618,21.468 C97.3518,20.878 98.2168,20.583 99.3558,20.583 C100.3678,20.583 101.0428,20.709 101.6328,20.899 L101.6328,23.556 C101.1698,23.387 100.7268,23.282 100.1778,23.282 C99.4398,23.282 99.0178,23.662 99.0178,24.505 L99.0178,24.948 L101.6118,24.948 L101.6118,27.563 L99.0608,27.563 L99.0608,36.125 L95.8548,36.125 L95.8548,27.563 Z" id="Fill-13"></path>
					            <path d="M111.6708,30.5366 L111.6708,30.4946 C111.6708,28.8286 110.4688,27.3736 108.6968,27.3736 C106.8628,27.3736 105.7658,28.7866 105.7658,30.4526 L105.7658,30.4946 C105.7658,32.1606 106.9678,33.6156 108.7398,33.6156 C110.5738,33.6156 111.6708,32.2026 111.6708,30.5366 M102.6028,30.5366 L102.6028,30.4946 C102.6028,27.2466 105.2178,24.6106 108.7398,24.6106 C112.2398,24.6106 114.8338,27.2046 114.8338,30.4526 L114.8338,30.4946 C114.8338,33.7426 112.2188,36.3786 108.6968,36.3786 C105.1968,36.3786 102.6028,33.7846 102.6028,30.5366" id="Fill-15"></path>
					            <path d="M117.153,24.8215 L120.359,24.8215 L120.359,27.0995 C121.012,25.5385 122.067,24.5265 123.965,24.6105 L123.965,27.9635 L123.796,27.9635 C121.666,27.9635 120.359,29.2505 120.359,31.9495 L120.359,36.1255 L117.153,36.1255 L117.153,24.8215 Z" id="Fill-17"></path>
					            <path d="M132.2937,20.7304 L135.4997,20.7304 L135.4997,26.4244 C136.2377,25.4754 137.1867,24.6104 138.8107,24.6104 C141.2357,24.6104 142.6487,26.2134 142.6487,28.8074 L142.6487,36.1254 L139.4427,36.1254 L139.4427,29.8194 C139.4427,28.3014 138.7257,27.5214 137.5027,27.5214 C136.2797,27.5214 135.4997,28.3014 135.4997,29.8194 L135.4997,36.1254 L132.2937,36.1254 L132.2937,20.7304 Z" id="Fill-19"></path>
					            <path d="M145.3469,32.1393 L145.3469,24.8213 L148.5529,24.8213 L148.5529,31.1273 C148.5529,32.6453 149.2699,33.4253 150.4929,33.4253 C151.7159,33.4253 152.4959,32.6453 152.4959,31.1273 L152.4959,24.8213 L155.7019,24.8213 L155.7019,36.1253 L152.4959,36.1253 L152.4959,34.5223 C151.7579,35.4713 150.8089,36.3363 149.1849,36.3363 C146.7599,36.3363 145.3469,34.7333 145.3469,32.1393" id="Fill-21"></path>
					            <path d="M158.5691,24.8215 L161.7741,24.8215 L161.7741,26.4245 C162.5121,25.4755 163.4821,24.6105 165.1061,24.6105 C166.5831,24.6105 167.7001,25.2645 168.2911,26.4035 C169.2821,25.2435 170.4631,24.6105 172.0031,24.6105 C174.3861,24.6105 175.8191,26.0445 175.8191,28.7655 L175.8191,36.1255 L172.6141,36.1255 L172.6141,29.8195 C172.6141,28.3015 171.9391,27.5205 170.7371,27.5205 C169.5351,27.5205 168.7971,28.3015 168.7971,29.8195 L168.7971,36.1255 L165.5911,36.1255 L165.5911,29.8195 C165.5911,28.3015 164.9171,27.5205 163.7151,27.5205 C162.5121,27.5205 161.7741,28.3015 161.7741,29.8195 L161.7741,36.1255 L158.5691,36.1255 L158.5691,24.8215 Z" id="Fill-23"></path>
					            <path d="M186.806,30.4945 L186.806,30.4525 C186.806,28.5755 185.562,27.3315 184.064,27.3315 C182.567,27.3315 181.302,28.5545 181.302,30.4525 L181.302,30.4945 C181.302,32.3715 182.567,33.6155 184.064,33.6155 C185.562,33.6155 186.806,32.3715 186.806,30.4945 M178.096,30.4945 L178.096,30.4525 C178.096,26.6775 180.564,24.6105 183.242,24.6105 C184.95,24.6105 186.005,25.3905 186.764,26.2975 L186.764,20.7305 L189.969,20.7305 L189.969,36.1255 L186.764,36.1255 L186.764,34.5015 C185.984,35.5555 184.908,36.3365 183.242,36.3365 C180.606,36.3365 178.096,34.2695 178.096,30.4945" id="Fill-25"></path>
					            <path d="M199.5216,32.1393 L199.5216,31.5703 C198.9736,31.3173 198.2566,31.1483 197.4756,31.1483 C196.1056,31.1483 195.2616,31.6963 195.2616,32.7093 L195.2616,32.7513 C195.2616,33.6153 195.9786,34.1213 197.0116,34.1213 C198.5096,34.1213 199.5216,33.2993 199.5216,32.1393 M192.1616,32.8773 L192.1616,32.8353 C192.1616,30.3683 194.0386,29.2293 196.7166,29.2293 C197.8556,29.2293 198.6776,29.4183 199.4796,29.6933 L199.4796,29.5033 C199.4796,28.1743 198.6566,27.4363 197.0536,27.4363 C195.8306,27.4363 194.9666,27.6683 193.9326,28.0483 L193.1316,25.6023 C194.3756,25.0533 195.5986,24.6953 197.5186,24.6953 C199.2686,24.6953 200.5336,25.1593 201.3356,25.9603 C202.1786,26.8043 202.5586,28.0483 202.5586,29.5663 L202.5586,36.1253 L199.4586,36.1253 L199.4586,34.9023 C198.6776,35.7663 197.6026,36.3363 196.0416,36.3363 C193.9116,36.3363 192.1616,35.1133 192.1616,32.8773" id="Fill-27"></path>
					            <path d="M205.7446,32.9197 L205.7446,27.5627 L204.3946,27.5627 L204.3946,24.8217 L205.7446,24.8217 L205.7446,21.9327 L208.9506,21.9327 L208.9506,24.8217 L211.6076,24.8217 L211.6076,27.5627 L208.9506,27.5627 L208.9506,32.3927 C208.9506,33.1307 209.2666,33.4887 209.9836,33.4887 C210.5746,33.4887 211.1016,33.3417 211.5656,33.0887 L211.5656,35.6607 C210.8906,36.0617 210.1106,36.3147 209.0346,36.3147 C207.0736,36.3147 205.7446,35.5347 205.7446,32.9197" id="Fill-29"></path>
					            <path d="M220.6542,32.1393 L220.6542,31.5703 C220.1062,31.3173 219.3892,31.1483 218.6082,31.1483 C217.2382,31.1483 216.3942,31.6963 216.3942,32.7093 L216.3942,32.7513 C216.3942,33.6153 217.1112,34.1213 218.1442,34.1213 C219.6422,34.1213 220.6542,33.2993 220.6542,32.1393 M213.2942,32.8773 L213.2942,32.8353 C213.2942,30.3683 215.1712,29.2293 217.8492,29.2293 C218.9882,29.2293 219.8102,29.4183 220.6122,29.6933 L220.6122,29.5033 C220.6122,28.1743 219.7892,27.4363 218.1862,27.4363 C216.9632,27.4363 216.0992,27.6683 215.0652,28.0483 L214.2642,25.6023 C215.5082,25.0533 216.7312,24.6953 218.6512,24.6953 C220.4012,24.6953 221.6662,25.1593 222.4682,25.9603 C223.3112,26.8043 223.6912,28.0483 223.6912,29.5663 L223.6912,36.1253 L220.5912,36.1253 L220.5912,34.9023 C219.8102,35.7663 218.7352,36.3363 217.1742,36.3363 C215.0442,36.3363 213.2942,35.1133 213.2942,32.8773" id="Fill-31"></path>
					            <g id="Group-35" transform="translate(0.000000, 0.852500)">
					                <mask id="mask-2" fill="white">
					                    <use xlink:href="#path-1"></use>
					                </mask>
					                <g id="Clip-34"></g>
					                <polygon id="Fill-33" mask="url(#mask-2)" points="66.1451 77 63.9641 73.989 92.3481 53.433 241.0511 53.433 241.0511 3.865 3.7181 3.865 3.7181 53.433 58.8661 53.433 58.8661 57.151 0.0001 57.151 0.0001 0.147 244.7691 0.147 244.7691 57.151 93.5541 57.151"></polygon>
					            </g>
					        </g>
					    </g>
					</svg>
				</a>
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
				        
				            <?php echo $title; ?>
				        
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