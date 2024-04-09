<?php
/*
Template Name: Blank Template

/**
 * A completely blank/empty page template.
 * It does not inherit any header, footer, resources, or other elements from the theme.
 * Currently used for the event page in 2024.
 *
 */

$pageID = get_the_ID();
$mixpanelToken = ($_SERVER['HTTP_HOST'] === 'hdx-centre.site.strattic.io' || $_SERVER['HTTP_HOST'] === 'centre.humdata.org') ? 'hdx-mixpanel-token-prod' : 'hdx-mixpanel-token-local';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<title><?php echo get_the_title($pageID); ?></title>
    <script src="<?php echo esc_url(includes_url('js/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo get_stylesheet_directory_uri().'/js/humdata-mixpanel.js'; ?>"></script>

	<?php if(!empty(get_option($mixpanelToken))) : ?>
        <script type="text/javascript">(function(e,a){if(!a.__SV){var b=window;try{var c,l,i,j=b.location,g=j.hash;c=function(a,b){return(l=a.match(RegExp(b+"=([^&]*)")))?l[1]:null};g&&c(g,"state")&&(i=JSON.parse(decodeURIComponent(c(g,"state"))),"mpeditor"===i.action&&(b.sessionStorage.setItem("_mpcehash",g),history.replaceState(i.desiredHash||"",e.title,j.pathname+j.search)))}catch(m){}var k,h;window.mixpanel=a;a._i=[];a.init=function(b,c,f){function e(b,a){var c=a.split(".");2==c.length&&(b=b[c[0]],a=c[1]);b[a]=function(){b.push([a].concat(Array.prototype.slice.call(arguments, 0)))}}var d=a;"undefined"!==typeof f?d=a[f]=[]:f="mixpanel";d.people=d.people||[];d.toString=function(b){var a="mixpanel";"mixpanel"!==f&&(a+="."+f);b||(a+=" (stub)");return a};d.people.toString=function(){return d.toString(1)+".people (stub)"};k="disable time_event track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config reset opt_in_tracking opt_out_tracking has_opted_in_tracking has_opted_out_tracking clear_opt_in_out_tracking people.set people.set_once people.unset people.increment people.append people.union people.track_charge people.clear_charges people.delete_user".split(" ");
            for(h=0;h<k.length;h++)e(d,k[h]);a._i.push([b,c,f])};a.__SV=1.2;b=e.createElement("script");b.type="text/javascript";b.async=!0;b.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?MIXPANEL_CUSTOM_LIB_URL:"file:"===e.location.protocol&&"//cdn4.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn4.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn4.mxpnl.com/libs/mixpanel-2-latest.min.js";c=e.getElementsByTagName("script")[0];c.parentNode.insertBefore(b,c)}})(document,window.mixpanel||[]);
            mixpanel.init("<?=get_option($mixpanelToken)?>");
        </script>
	<?php endif; ?>

	<meta property="og:image" content="https://centre.humdata.org/wp-content/themes/uncode-child/assets/centreforHumdata_OG.png">
	<link rel="icon" href="https://centre.humdata.org/wp-content/uploads/2018/07/favicon_32x32.png" sizes="192x192">
    <link rel="apple-touch-icon" href="https://centre.humdata.org/wp-content/uploads/2018/07/favicon_32x32.png">
    <meta name="msapplication-TileImage" content="https://centre.humdata.org/wp-content/uploads/2018/07/favicon_32x32.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<?php
// Start the loop
if (have_posts()) :
    while (have_posts()) : the_post();
        // Display post content
        the_content();
    endwhile;
endif;
?>

<script>
    // mixpanel tracking
    window.onload = function (e) {
        mpTrack.pageView(document.title, '<?php echo get_post($pageID)->post_name; ?>');
    }
</script>

</body>
</html>